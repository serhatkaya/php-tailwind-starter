const { spawn } = require("child_process");
const path = require("path");

// Start [PHP server]
const phpServer = spawn("php", [
  "-S",
  "localhost:1881",
  "-t",
  path.join(__dirname, "./public"),
]);

phpServer.stdout.on("data", (data) => {
  console.log(`[PHP Server]: ${data}`);
});

phpServer.stderr.on("data", (data) => {
  console.error(`[PHP Server]: ${data}`);
});

phpServer.on("close", (code) => {
  console.log(`[PHP Server] process exited with code ${code}`);
});
