<template>
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="passwordModalLabel">{{title ? title : defaultTitle}}</h4>
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
                            <input type="password" name="password" class="form-control" id="password" v-model="account"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <label for="safety_level" class="control-label">Password:</label>
                            <input type="text" name="safety_level" class="form-control" id="safety_level"
                                   v-model="safety_level"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label">Title:</label>
                            <input type="text" name="title" class="form-control" id="title" v-model="newTitle"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description:</label>
                            <textarea class="form-control" id="description" v-model="description"
                                      required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="type" class="control-label">Type:</label>
                            <select class="form-control" v-model="type" id="type" required="required">
                                <option v-for="value , key in types" v-bind:value="key">{{value}}</option>
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
        props: ['title', 'types'],
        data(){
            return {
                defaultTitle: '新增Password',
                description: '',
                type: '',
                newTitle: '',
                url: '',
                account: '',
                password: '',
                safety_level: 1
            }
        },
        methods: {
            addMessage(){

            }
        },
        mounted(){
            Vue.nextTick(() => {
                $("#safety_level").slider({
                    precision: 2,
                    value: 8.115
                });

                var slider = new Slider("#safety_level", {
                    precision: 2,
                    value: 8.115 
                });
            });
        }
    }
</script>