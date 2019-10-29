<template>
    <div>
        <h5>ID: {{ group.id }}</h5>
        <h5>Name: {{ group.name }}</h5>
        <h5> --- Chat here --- </h5>
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
        </div>
        <div class="input-group">
            <input id="btn-input" type="text" name="message" class="form-control input-sm"
                   placeholder="Type your message here...">
            <span class="input-group-btn">
            <button class="btn btn-primary btn-sm ml-2">Send</button>
        </span>
        </div>
    </div>
</template>

<script>
    import EventBus from '../eventbus';
    export default {
        data() {
            return {
                group: '',
                messages:'',
            }
        },
        mounted() {
            EventBus.$on('groupCreated', (data) => {
                this.group = data;
            });
        }
    }
</script>