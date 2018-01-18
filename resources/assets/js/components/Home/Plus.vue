<template>
    <div class="add-plus">
        <div class="tools">
            <button v-show="sign == 'remove'" type="button" class="btn btn-default" aria-label="Left Align"
                     data-toggle="modal" data-target="#passwordModal">
                <span class="glyphicon glyphicon-plus" aria-hidden="true" data-toggle="tooltip"
                      data-placement="top"
                      title="添加密码记录"></span>
            </button>

            <button v-show="sign == 'remove'" type="button" class="btn btn-default" aria-label="Left Align"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="生成密码工具">
                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
            </button>
        </div>

        <button type="button" class="btn btn-success add-plus-button" @click="showTools()" aria-label="Left Align">
            <span :class="'glyphicon glyphicon-' + sign" aria-hidden="true"></span>
        </button>

    </div>
</template>

<script>
    export default{
        data(){
            return {
                sign: 'plus'
            }
        },
        methods: {
            showTools(){
                this.sign = this.sign === 'remove' ? 'plus' : 'remove';
            }
        },
        mounted(){
            Vue.nextTick(() => {
                $('[data-toggle="tooltip"]').tooltip();
            });
        }
    }
</script>