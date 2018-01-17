<template>
    <li role="presentation" :class="this.$store.state.defaultSelected == id ? 'active' : ''" @click="getInfo()">
        <a href="#">
            <span :class="'glyphicon glyphicon-'+icon" aria-hidden="true"></span> {{title}}
            <span class="badge" v-show="passwords > 0">{{passwords}}</span>
        </a>
    </li>
</template>

<script>
    export default{
        props: ['title', 'icon', 'id', 'passwords'],
        data(){
            return {
                active: null
            }
        },
        methods: {
            getInfo()
            {
                let url = '/boxes/' + this.id + '/passwords';
                axios.get(url, {})
                    .then(response => {
                        this.$store.state.defaultSelected = this.id;
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