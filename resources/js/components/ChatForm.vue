<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..."
               v-model="newMessage" @keyup.enter="sendMessage" @keydown="isTypingNow">
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user','userName'],
        data() {
            return {
                newMessage: '',
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });
                this.newMessage = ''
            },

            isTypingNow(){
               let node = this;
                setTimeout(function() {
                    Echo.private('chat').whisper('typing', {
                        typing: true,
                        userName: node.userName
                    });
                }, 500);
            }
        }
    }
</script>
