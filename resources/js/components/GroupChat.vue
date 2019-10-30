<template>
    <div>
        <h5>ID: {{ group.id }}</h5>
        <h5>Name: {{ group.name }}</h5>
        <h5> --- Chat here --- </h5>
        <div>
            <ul class="chat">
                <li class="left clearfix" v-for="conversation in conversations">
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">
                                <!--{{ conversation.user_id }}-->
                            </strong>
                        </div>
                        <p>
                            {{ conversation.message }}
                        </p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="input-group">
            <input id="btn-input" type="text" name="message" class="form-control input-sm"
                   placeholder="Type your message here..." v-model="newmessage">
            <span class="input-group-btn">
            <button class="btn btn-primary btn-sm ml-2" @click="saveNewGroupMessage(group.id)">Send</button>
        </span>
        </div>
    </div>
</template>

<script>
    import EventBus from '../eventbus';

    export default {
        data() {
            return {
                conversations: [],
                group: '',
                newmessage: '',
            }
        },
        mounted() {

            this.fetchingConversations();
            EventBus.$on('groupCreated', (data) => {
                this.group = data;
            });
        },
        methods: {
            fetchingConversations() {
                axios.get('/conversations').then(data => {
                    this.conversations = data.data.conversations;
                });
            },
            saveNewGroupMessage(id) {
                axios({
                    method: 'post',
                    url: '/conversations',
                    data: {
                        newmessage: this.newmessage,
                        group_id: id
                    }
                }).then((response) => {
                    console.log(response);
                }, (error) => {
                    console.log(error);
                });

            }
        }
    }
</script>