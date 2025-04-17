<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Chat SOTF</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f4f4f4;
    }

    #chat-container {
      width: 50%;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    #chatbox {
      height: 300px;
      overflow-y: auto;
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
      background-color: #fdfdfd;
    }

    input[type="text"] {
      width: 75%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      padding: 10px 15px;
      font-size: 16px;
      border: none;
      background-color: #007bff;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    p {
      margin: 5px 0;
    }
  </style>
</head>
<body>

  <div id="chat-container">
    <h2>Chatbot SOTF</h2>
    <div id="chatbox"></div>

    <input type="text" id="mensaje" placeholder="Haz tu pregunta sobre SOTF">
    <button onclick="enviarMensaje()">Enviar</button>
  </div>

  <script>
    function enviarMensaje() {
      const input = document.getElementById("mensaje");
      const mensaje = input.value.trim();
      if (!mensaje) return;

      document.getElementById("chatbox").innerHTML += `<p><strong>Tú:</strong> ${mensaje}</p>`;

      fetch("chatbot.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `mensaje=${encodeURIComponent(mensaje)}`
      })
      .then(res => res.text())
      .then(respuesta => {
        document.getElementById("chatbox").innerHTML += `<p><strong>Chatbot:</strong> ${respuesta}</p>`;
        input.value = "";
        document.getElementById("chatbox").scrollTop = document.getElementById("chatbox").scrollHeight;
      });
    }


    document.getElementById("mensaje").addEventListener("keyup", function(event) {
      if (event.key === "Enter") {
        enviarMensaje();
      }
    });
  </script>

</body>
</html>
