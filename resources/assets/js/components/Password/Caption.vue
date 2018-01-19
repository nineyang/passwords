<template>
    <div>
        <div class="col-sm-2 col-md-2" v-for="item in this.$store.state.passwordList">
            <div class="thumbnail">
                <div class="caption">
                    <h4 v-tooltip:right="item.title">{{item.title}}</h4>
                    <p v-tooltip:right="item.account">{{item.subAccount}}</p>

                    <p class="pull-right">
                        <button type="button" class="btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 编辑
                        </button>
                        <button type="button" class="btn btn-default btn-xs">
                            <a :href="item.url" target="_blank" style="text-decoration: none;color:#636b6f">
                                <span class="glyphicon glyphicon-share-alt"
                                      aria-hidden="true"></span> 跳转
                            </a>

                        </button>
                        <button type="button" class="btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 删除
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
    }
</script>