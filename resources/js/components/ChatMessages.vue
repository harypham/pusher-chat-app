<template>
    <div>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
        <span v-show="isTyping" class="help-block" style="font-style: italic;">
            {{ userName }} is typing...
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            messages: Array,
            userName: String,
            isTyping: Boolean,
        },
    };
</script>