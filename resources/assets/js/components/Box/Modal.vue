<template>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{title ? title : defaultTitle}}</h4>
                </div>
                <div class="modal-body">
                    <form>
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
                    <button type="button" class="btn btn-primary" @click="addBox">Save changes</button>
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
                defaultTitle: '新增',
                description: '',
                type: '',
                newTitle: ''
            }
        },
        methods: {
            addBox(){
                let data = {
                    title: this.newTitle,
                    description: this.description,
                    type: this.type
                };
                axios.post('/boxes', data)
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

        }
    }
</script>