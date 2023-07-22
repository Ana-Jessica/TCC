// server.js
const express = require('express');
const http = require('http');
const socketIO = require('socket.io');
const mysql = require('mysql2');

const app = express();
const server = http.createServer(app);
const io = socketIO(server);

// Configuração do banco de dados MySQL
const db = mysql.createConnection({
  host: 'localhost', // Endereço do servidor MySQL
  user: 'root', // Usuário do banco de dados MySQL
  password: '', // Senha do banco de dados MySQL
  database: 'db_dev', // Nome do banco de dados MySQL
});

// Defina a porta para o servidor
const PORT = 3000;

// Rota para servir o arquivo HTML
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

// Conexão de socket
io.on('connection', (socket) => {
  console.log('Novo usuário conectado.');

  // Consulta as mensagens salvas no banco de dados e envia para o novo usuário
  db.query('SELECT * FROM messages', (err, results) => {
    if (!err) {
      const messages = results.map((row) => row.message);
      socket.emit('chat history', messages);
    }
  });

  // Lidar com a mensagem recebida do cliente
  socket.on('chat message', (msg) => {
    console.log('Mensagem recebida:', msg);

    // Insere a mensagem no banco de dados
    db.query('INSERT INTO messages (message) VALUES (?)', [msg], (err) => {
      if (err) {
        console.error('Erro ao salvar a mensagem no banco de dados:', err);
      }
    });

    // Enviar mensagem para todos os clientes conectados
    io.emit('chat message', msg);
  });

  // Lidar com desconexões
  socket.on('disconnect', () => {
    console.log('Usuário desconectado.');
  });
});

// Inicie o servidor
server.listen(PORT, () => {
  console.log(`Servidor rodando em http://localhost:${PORT}`);
});
