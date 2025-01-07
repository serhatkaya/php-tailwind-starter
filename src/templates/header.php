<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tailwind + Hot Reload</title>
    <link href="/css/styles.css" rel="stylesheet">
    <?php if (defined('ENVIRONMENT') && ENVIRONMENT === 'development'): ?>
    <script>
        (function() {
            let ws = null;
            let reconnectAttempts = 0;
            const maxReconnectAttempts = 5;

            function connect() {
                ws = new WebSocket('ws://localhost:8080');
                
                ws.onopen = () => {
                    console.log('Connected to hot reload server');
                    reconnectAttempts = 0;
                };

                ws.onmessage = (event) => {
                    const data = JSON.parse(event.data);
                    if (data.type === 'reload') {
                        location.reload();
                    }
                };

                ws.onclose = () => {
                    console.log('Disconnected from hot reload server');
                    if (reconnectAttempts < maxReconnectAttempts) {
                        reconnectAttempts++;
                        console.log(`Reconnecting... Attempt ${reconnectAttempts}`);
                        setTimeout(connect, 1000);
                    }
                };

                ws.onerror = (error) => {
                    console.error('WebSocket Error:', error);
                };
            }

            connect();
        })();
    </script>
    <?php endif; ?>
</head>
<body class="bg-gray-100">
<?php include_once BASE_PATH . '/src/templates/nav.php'; ?> 