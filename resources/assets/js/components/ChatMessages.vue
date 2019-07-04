<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                       <i class="fa fa-comment"></i> {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    <span style="background:#cfcfcf;">{{ message.message }} </span>

                        <ul class="replies">
                            <li class="left clearfix" v-for="reply in message.replies">{{reply.message}}</li>
                        </ul>
                        

                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" id="btn-chat2" @click="sendReply(message.id)">
                                Send As Reply
                            </button>
                        </span>
                </p>
            </div>
        </li>
        <div class="input-group">
            <textarea id="input-reply" type="text" name="reply" class="form-control input-sm" placeholder="Add your reply message ..." v-model="newReply"></textarea>
        </div>
    </ul>
</template>



<script>
  export default {
    props: ['messages','user'],
    data() {
        return {
            newReply: ''
        }
    },
    methods: {
            sendReply(msgId) {
                const that = this;
                axios.post('/sendReply', {
                    message: that.newReply,
                    parent_msg_id:msgId,
                    
                })
                .then(function (response) {
                    let msgId = response.data.payload.id;
                    let msgText = response.data.payload.message;
                    axios.get("/messages").then(response => {
                        buffer:that.messages = response.data;
                    });

                    that.$emit('messagesent', {
                        user: response.data.userObject,
                        message: msgText,
                        msgId:msgId
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }    
  };
</script>