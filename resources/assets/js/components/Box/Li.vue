<template>
    <li role="presentation" class="" @click="getInfo()">
        <a href="#">
            <span :class="'glyphicon glyphicon-'+icon" aria-hidden="true"></span> {{title}}
            <span class="badge" v-show="passwords > 0">{{passwords}}</span>
        </a>
    </li>
</template>

<script>
    export default{
        props: ['title', 'icon', 'id', 'passwords'],
        methods: {
            getInfo()
            {
                let url = '/boxex/' + this.id + '/passwords';
                axios.get(url, {})
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