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
                        <div :class="{ 'form-group': true, 'has-error': error.url }">
                            <label for="url" class="control-label">Url:</label>
                            <input type="url" name="url" class="form-control" id="url" v-model="url"
                                   required="required">
                        </div>
                        <div :class="{ 'form-group': true, 'has-error': error.account }">
                            <label for="account" class="control-label">Account:</label>
                            <input type="text" name="account" class="form-control" id="account" v-model="account"
                                   required="required">
                        </div>
                        <div :class="{ 'form-group': true, 'has-error': error.password }">
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
                        <div :class="{ 'form-group': true, 'has-error': error.title }">
                            <label for="pwdTitle" class="control-label">Title:</label>
                            <input type="text" name="pwdTitle" class="form-control" id="pwdTitle" v-model="newTitle"
                                   required="required">
                        </div>

                        <div :class="{ 'form-group': true, 'has-error': error.safetyLevel }">
                            <label for="safetyLevel" class="control-label">SafetyLevel:</label>
                            <div v-for="item , key in safety_levels">
                                <label class="radio-inline">
                                    <input v-model="safetyLevel" type="radio" name="safetyLevel" v-bind:value="key"
                                           :checked="safetyLevel==key">
                                    {{item}}
                                </label>
                            </div>

                        </div>

                        <div :class="{ 'form-group': true, 'has-error': error.description }">
                            <label for="pwdDescription" class="control-label">Description:</label>
                            <textarea class="form-control" id="pwdDescription" v-model="pwdDescription"
                                      required="required"></textarea>
                        </div>
                        <div :class="{ 'form-group': true, 'has-error': error.boxId }">
                            <label for="boxId" class="control-label">SelectBox:</label>
                            <select class="form-control" v-model="boxId" id="boxId" required="required">
                                <option v-for="box in boxes" v-bind:value="box.id">{{box.title}}</option>
                            </select>
                        </div>
                        <div class="form-group" v-show="errorInfo != ''">
                            <p class="text-danger">{{errorInfo}}</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-modal" data-dismiss="modal">
                        Close
                    </button>
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
                defaultTitle: '新增记录',
                pwdDescription: '',
                boxId: this.$store.state.selected,
                newTitle: '',
                url: '',
                account: '',
                password: '',
                safetyLevel: 1,
                error: {
                    title: false,
                    description: false,
                    url: false,
                    account: false,
                    password: false,
                    safetyLevel: false,
                    boxId: false
                },
                errorInfo: '',
                belongBox: 0,
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

                if (this.$store.state.selectedPassword == 0) {
                    this.add(data);
                } else {
                    this.put(this.$store.state.selectedPassword, data);
                }
            },
            clearData(){
                this.pwdDescription = '';
                this.boxId = this.$store.state.selected;
                this.newTitle = '';
                this.url = '';
                this.account = '';
                this.password = '';
                this.safetyLevel = 1;
            },
            closeModal(){
                Vue.nextTick(() => {
                    $('.close-modal').trigger('click');
                });
            },
            get(){
                axios.get('/boxes/' + this.$store.state.selectedBox + '/passwords/' + this.$store.state.selectedPassword, {})
                    .then(response => {
                        if (response.data.code == 0) {
                            let info = response.data.data[0];
                            this.account = info.account;
                            this.boxId = info.boxId;
                            this.url = info.url;
                            this.safetyLevel = info.safetyLevel;
                            this.newTitle = info.title;
                            this.pwdDescription = info.description;
                            this.belongBox = info.boxId;
                        } else {

                        }

                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data.message);
                        }
                    });
            },
            add(data){
                axios.post('/boxes/' + this.boxId + '/passwords', data)
                    .then(response => {
                        if (response.data.code == 0) {
                            this.$store.commit('updatePasswordList', response.data.data[0]);
                            this.incr(this.boxId);

//                            this.clearData();
                            this.closeModal();
                        } else {
                            let errors = response.data.error;
                            for (let error in errors) {
                                this.error[error] = true;
                                this.errorInfo += errors[error];
                            }
                        }

                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data.message);
                        }
                    });
            },
            incr(id, incr = 1){
// 所选+1
                let currCount = this.$store.state.passwordCount[id];
                if (currCount != '99+') {
                    this.$store.commit({
                        type: 'updatePasswordAccount',
                        id: id,
                        count: currCount ? currCount * 1 + incr : 1
                    });
                }
            },
            decr(id, decr = 1){
// 所选-1
                let currCount = this.$store.state.passwordCount[id];
                if (currCount != '99+') {
                    this.$store.commit({
                        type: 'updatePasswordAccount',
                        id: id,
                        count: currCount ? currCount * 1 - decr : 1
                    });
                }
            },
            put(id, data){
                axios.put('/boxes/' + this.boxId + '/passwords/' + id, data)
                    .then(response => {
                        if (response.data.code == 0) {
                            if (this.belongBox != this.boxId) {
                                this.$store.commit('deletePasswordList', id);
                                this.incr(this.boxId);
                                this.decr(this.belongBox);
                            } else {
                                this.$store.commit('updatePasswordList', response.data.data[0]);
                            }

//                            this.clearData();
                            this.closeModal();
                        } else {
                            let errors = response.data.error;
                            for (let error in errors) {
                                this.error[error] = true;
                                this.errorInfo += errors[error];
                            }
                        }

                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data.message);
                        }
                    });
            }
        },
        computed: {
            selected () {
                return this.$store.state.selectedBox;
            },
            selectedPassword () {
                return this.$store.state.selectedPassword;
            }
        },
        watch: {
            selected (newVal, oldVal) {
                this.boxId = newVal;
            },
            selectedPassword (newVal, oldVal) {
                if (newVal != 0) {
                    this.get();
                }
            }
        }
    }
</script>