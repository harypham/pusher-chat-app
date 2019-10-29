<template>
    <div class="panel panel-default">
        <div class="panel-heading">Create Group</div>
        <div class="panel-body-v2">
            <form>
                <div class="form-group">
                    <input class="form-control" type="text" v-model="groupName" placeholder="Group Name">
                </div>
                <div class="form-group">
                    <div class="d-flex">
                        <span> Choose members:</span>
                        <div class="col-2" v-for="user in users">
                            <input type="checkbox" :value="user.id" v-model="userIds">{{ user.name }}
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer text-center">
            <button type="submit" @click.prevent="createGroup"
                    class="btn btn-primary">
                Create Group
            </button>
        </div>
    </div>
</template>
<script>
    import EvenBus from '../eventbus';

    export default {
        props: ['users', 'iduser'],
        data() {
            return {
                groupName: '',
                userIds: [],
            }
        },
        mounted() {
            this.listenForNewGroup();
        },
        methods: {
            createGroup() {
                axios.post('/groups', {groupName: this.groupName, userIds: this.userIds})
                    .then((response) => {
                        EvenBus.$emit('groupCreated', response.data.group);
                    });
            },
            listenForNewGroup() {
                Echo.private('users.' + this.iduser)
                    .listen('GroupCreated', (data) => {
                        EvenBus.$emit('groupCreated', data.group);
                    });
            }
        }
    }
</script>
<style scoped>
    .panel-body-v2 {
        overflow-y: scroll;
        height: 150px;
    }
</style>
