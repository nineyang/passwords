<template>
    <li role="presentation" :class="this.$store.state.selectedBox == id ? 'active' : ''" @click="getInfo()">
        <a href="#">
            <span :class="'glyphicon glyphicon-'+icon" aria-hidden="true"></span> {{title}}
            <span class="badge" v-show="this.$store.state.passwordCount[id] > 0">{{this.$store.state.passwordCount[id]}}</span>
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
                        // 更新selected
                        this.$store.commit('updateSelectedBox', this.id);
                        // 更新list
                        this.$store.commit('updatePasswordList', response.data.data);
                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data.message);
                        }
                    });
            }
        },
        created(){
            this.$store.commit({
                type: 'updatePasswordAccount',
                id: this.id,
                count: this.passwords
            });
        },
    }
</script>