<template>
    <div>
        <div class="col-sm-3 col-md-3" v-for="item in this.$store.state.passwordList">
            <div class="thumbnail">
                <div class="caption">
                    <h4 v-tooltip:right="item.title">{{item.title}}</h4>
                    <p v-tooltip:right="item.account">{{item.subAccount}}</p>

                    <p class="pull-right">
                        <button @click="updateSelected(item.id)" data-toggle="modal" data-target="#passwordModal"
                                type="button" class="btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 编辑
                        </button>
                        <button type="button" class="btn btn-default btn-xs">
                            <a :href="item.url" target="_blank" class="none-style-a"
                               v-tooltip:bottom="item.url">
                                <span class="glyphicon glyphicon-share-alt"
                                      aria-hidden="true"></span> 跳转
                            </a>

                        </button>
                        <button v-show="$store.state.selectedBox != 'deleted'" data-toggle="modal" data-target=".delete-modal" type="button" @click="deleted(item.id)"
                                class="btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 删除
                        </button>

                        <button v-show="$store.state.selectedBox == 'deleted'" data-toggle="modal"
                                data-target=".restore-modal"
                                type="button"
                                @click="restore(item.id)"
                                class="btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> 还原
                        </button>
                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default{
        mounted(){
        },

        methods: {
            updateSelected(id){
                this.$store.commit('updateSelectedPassword', id);
            },
            deleted(id){
                this.$store.commit('updateDeletePassword', id);
            },
            restore(id){
                this.$store.commit('updateDeletePassword', id);
            }
        }
    }
</script>