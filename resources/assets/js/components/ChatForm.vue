<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Write message ..." v-model="newMessage" @keyup.enter="sendMessage">
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                const that = this;

                axios.post('/sendMessage', {
                    message: that.newMessage,
                    user: that.user
                })
                .then(function (response) {

                    console.log(response.data);

                    let msgId = response.data.payload.id;
                    let msgText = response.data.payload.message;

                that.$emit('messagesent', {
                    user: that.user,
                    message: msgText,
                    msgId:msgId
                });
                    console.log(response.data.payload.id);
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.newMessage = ''
            }
        }    
    }
</script>