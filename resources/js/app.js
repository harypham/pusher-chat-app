require('./bootstrap');
window.Vue = require('vue');
import ChatMessages from './components/ChatMessages';
import ChatForm from './components/ChatForm';

const app = new Vue({
    el: '#app',
    components: {
        'chat-messages': ChatMessages,
        'chat-form': ChatForm
    },
    data: {
        messages: [],
        isTyping: false,
        userName:'',
    },

    created() {
        this.fetchMessages();
        this.listenNewMessage();

    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message).then(response => {
            });
        },

        listenNewMessage() {
            Echo.private('chat').listen('MessageSent', (data) => {
                this.messages.push({
                    message: data.message.message,
                    user: data.user
                });
            });

            Echo.private('chat').listenForWhisper('typing', (data) => {
                let node = this;
                this.isTyping = data.typing;
                this.userName = data.userName;

                setTimeout(function () {
                    node.isTyping = false
                }, 5000);
            });
        }
    }
});
