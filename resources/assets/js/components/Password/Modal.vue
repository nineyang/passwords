<template>
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="passwordModalLabel">{{pwdTitle ? pwdTitle : defaultTitle}}</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="url" class="control-label">Url:</label>
                            <input type="url" name="url" class="form-control" id="url" v-model="url"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <label for="account" class="control-label">Account:</label>
                            <input type="text" name="account" class="form-control" id="account" v-model="account"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password:</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password"
                                       v-model="password"
                                       required="required">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </button>
                                  </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwdTitle" class="control-label">Title:</label>
                            <input type="text" name="pwdTitle" class="form-control" id="pwdTitle" v-model="newTitle"
                                   required="required">
                        </div>

                        <div class="form-group">
                            <label for="safetyLevel" class="control-label">SafetyLevel:</label>
                            <div v-for="item , key in safety_levels">
                                <label class="radio-inline">
                                    <input v-model="safetyLevel" type="radio" name="safetyLevel" v-bind:value="key"
                                           :checked="safetyLevel==key">
                                    {{item}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="pwdDescription" class="control-label">Description:</label>
                            <textarea class="form-control" id="pwdDescription" v-model="pwdDescription"
                                      required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="boxId" class="control-label">Type:</label>
                            <select class="form-control" v-model="boxId" id="boxId" required="required">
                                <option value="0">未分类</option>
                                <option v-for="box in boxes" v-bind:value="box.id">{{box.title}}</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="addMessage">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: ['pwdTitle', 'boxes', 'safety_levels'],
        components: {},
        data(){
            return {
                defaultTitle: '新增Password',
                pwdDescription: '',
                boxId: this.$store.state.selected,
                newTitle: '',
                url: '',
                account: '',
                password: '',
                safetyLevel: 1,
            }
        },
        methods: {
            addMessage(){
                let data = {
                    title: this.newTitle,
                    description: this.pwdDescription,
                    account: this.account,
                    password: this.password,
                    safetyLevel: this.safetyLevel,
                    boxId: this.boxId,
                    url: this.url
                };
                axios.post('/boxes/' + this.boxId + '/passwords', data)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data.message);
                        }
                    });
            }
        },
        mounted(){

        },
        computed: {
            selected () {
                return this.$store.state.selected;
            }
        },
        watch: {
            selected (newVal, oldVal) {
                this.boxId = newVal;
            }
        }
    }
</script>