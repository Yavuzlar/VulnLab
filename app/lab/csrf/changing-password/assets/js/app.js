const chatButton = document.querySelector('.chatbox__button');
const chatContent = document.querySelector('.chatbox__support');
const icons = {
    isClicked: '&emsp;&emsp;&emsp; <img src="assets/images/chatbox-icon.png" /> &emsp;&emsp;&emsp;',
    isNotClicked: '&emsp;&emsp;&emsp;&emsp; <img src="assets/images/chatbox-icon.png" /> &emsp;&emsp;&emsp;&emsp;'
}
const chatbox = new InteractiveChatbox(chatButton, chatContent, icons);
chatbox.display();
chatbox.toggleIcon(false, chatButton);

