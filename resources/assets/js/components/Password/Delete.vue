<template>

    <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    Are you sure delete account:{{account}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="confirm()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                account: '',
                id: 0
            };
        },

        watch: {
            deleted(newVal, oldVal){
                this.id = newVal;
                this.account = this.$store.state.passwordList[newVal].account;
            }
        },
        computed: {
            deleted () {
                return this.$store.state.deletePassword;
            },
        },
        methods: {
            confirm(){
                let url = '/boxes/' + this.$store.state.selectedBox + '/passwords/' + this.id;
                axios.delete(url, {})
                    .then(response => {
                        if (response.data.code == 0) {
                            this.incr('deleted');
                            this.decr(this.$store.state.selectedBox);
                            this.$store.commit('addDeletedPasswordList', response.data.data[0]);
                            this.$store.commit('deletePasswordList', this.id);
                            this.closeModal();
                        } else {

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
            closeModal(){
                Vue.nextTick(() => {
                    $('.close-modal').trigger('click');
                });
            },
        }

    }
</script>