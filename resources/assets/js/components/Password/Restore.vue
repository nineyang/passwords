<template>

    <div class="modal fade restore-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    Are you sure restore account:{{account}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="confirm()">Restore</button>
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
                id: 0,
                belongBox: 0
            };
        },

        watch: {
            deleted(newVal, oldVal){
                this.id = newVal;
                let password = this.$store.state.passwordList[newVal];
                this.account = password.account;
                this.belongBox = password.boxId;
            }
        },
        computed: {
            deleted () {
                return this.$store.state.deletePassword;
            },
        },
        methods: {
            confirm(){
                let url = '/boxes/' + this.belongBox + '/passwords/' + this.id + '/restore';
                axios.put(url, {})
                    .then(response => {
                        if (response.data.code == 0) {
                            this.decr('deleted');
                            this.incr(this.belongBox);
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