<template>
    <div class="modal fade password-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    <div :class="{ 'form-group': true, 'has-error': $store.state.passwordModal.error.password }"
                         v-show="$store.state.passwordModal.type == 'password'">
                        <label for="mainPassword" class="control-label">请输入主密码:</label>
                        <input type="text" name="mainPassword" class="form-control" id="mainPassword"
                               v-model="mainPassword"
                               required="required">
                    </div>
                    <div :class="{ 'form-group': true, 'has-error': $store.state.passwordModal.error.code }"
                         v-show="$store.state.passwordModal.type == 'code'">
                        <label for="code" class="control-label">请输入邮件收到的code:</label>
                        <input type="text" name="code" class="form-control" id="code"
                               v-model="code"
                               required="required">
                        <button style="margin-top:5px;" type="button" class="btn btn-primary pull-right btn-sm"
                                @click="sendEmail">Send
                            Again</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group" v-show="$store.state.passwordModal.error.info != ''">
                        <p class="text-danger">{{$store.state.passwordModal.error.info}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-modal close-password-modal" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" @click="confirm">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                mainPassword: '',
                code: '',
            };
        },

        methods: {
            confirm(){
                let type = this.$store.state.passwordModal.type;
                var key, value;
                if (type == 'password') {
                    key = 'mainPassword';
                    value = this.mainPassword;
                } else {
                    key = 'code';
                    value = this.code;
                }
                console.log(key , value);
                this.$store.commit({
                    type: 'updatePasswordModal',
                    key: key,
                    value: value
                });
            },
            closeModal(){
                Vue.nextTick(() => {
                    $('.close-password-modal').trigger('click');
                });
            },
            sendEmail(){
                let url = '/boxes/' + this.$store.state.selectedBox + '/passwords/' +
                    this.$store.state.selectedPassword + '/email/code';
                axios.get(url, {});
            }
        }

    }
</script>