<template>
    <button
        class="btn btn-default"
        v-on:click="favorite"
        v-bind:class="{'btn-success':favorited}"
        v-text="text"></button>
</template>

<script>
    export default {
        props:['question'],

        mounted:function() {
            this.$http.get('/api/user/favorited/'+this.question).then(response => {
                this.favorited = response.data.favorited
            })
        },

        data:function() {
            return {
                favorited:false
            }
        },

        computed: {
            text() {
                return this.favorited ? "已收藏" : "收藏"
            }
        },

        methods: {
            favorite:function() {
                this.$http.post('/api/user/favorite',{'question':this.question}).then(response => {
                    this.favorited = response.data.favorited;
                })
            }
        }
    }
</script>