const WebSocket = require("ws");
const chokidar = require("chokidar");
const path = require("path");

const wss = new WebSocket.Server({ port: 8080 });
const clients = new Set();

console.log("Hot reload server started on port 8080");

wss.on("connection", (ws) => {
  clients.add(ws);
  console.log("Client connected");

  ws.on("close", () => {
    clients.delete(ws);
    console.log("Client disconnected");
  });
});

// Watch for file changes
const watcher = chokidar.watch(
  ["src/**/*.php", "public/**/*.php", "public/css/**/*.css"],
  {
    ignored: /(^|[\/\\])\../, // ignore dotfiles
    persistent: true,
  }
);

watcher.on("change", (path) => {
  console.log(`File ${path} has been changed`);
  clients.forEach((client) => {
    if (client.readyState === WebSocket.OPEN) {
      client.send(JSON.stringify({ type: "reload" }));
    }
  });
});
