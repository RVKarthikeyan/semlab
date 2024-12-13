document.addEventListener("DOMContentLoaded", () => {
    const chatBox = document.getElementById("chat-box");
    const userInput = document.getElementById("user-input");
    const sendButton = document.getElementById("send-button");
  
    const addMessage = (message, sender) => {
      const messageDiv = document.createElement("div");
      messageDiv.className = sender;
      messageDiv.innerText = message;
      chatBox.appendChild(messageDiv);
      chatBox.scrollTop = chatBox.scrollHeight;
    };
  
    const sendMessage = () => {
      const message = userInput.value.trim();
      if (message) {
        addMessage(`You: ${message}`, "user-message");
        userInput.value = "";
  
        // Send message to the server
        fetch("server.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ message }),
        })
          .then((response) => response.json())
          .then((data) => {
            addMessage(`AI: ${data.reply}`, "ai-message");
          })
          .catch((error) => {
            addMessage("AI: Something went wrong!", "ai-message");
            console.error("Error:", error);
          });
      }
    };
  
    sendButton.addEventListener("click", sendMessage);
  
    userInput.addEventListener("keypress", (event) => {
      if (event.key === "Enter") sendMessage();
    });
  });
  