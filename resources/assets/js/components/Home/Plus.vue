<template>
    <div class="add-plus">
        <div class="tools">
            <button v-show="sign == 'remove'" type="button" class="btn btn-default" aria-label="Left Align"
                    data-toggle="modal" data-target="#passwordModal" v-tooltip:top="'添加密码记录'">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>

            <button v-show="sign == 'remove'" type="button" class="btn btn-default" aria-label="Left Align"
                    v-tooltip:top="'生成密码工具'" data-toggle="modal" data-target=".rand-modal">
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
        }
    }
</script>