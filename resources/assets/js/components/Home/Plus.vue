<template>
    <div>
        <button type="button" class="btn btn-success add-plus" @click="showTools()" aria-label="Left Align">
            <span :class="sign" aria-hidden="true"></span>
        </button>

    </div>
</template>

<script>
    export default{
        data(){
            return {
                sign: 'glyphicon glyphicon-plus'
            }
        },
        methods: {
            showTools(){
                this.sign = 'glyphicon glyphicon-remove';
            }
        }
    }
</script>