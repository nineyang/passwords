<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Hello , {{name}}</div>

                    <div class="panel-body">
                        Welcome to Remember Password!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name'],
        mounted() {

        }
    }
</script>
