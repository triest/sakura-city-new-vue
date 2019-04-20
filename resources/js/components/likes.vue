<template>
    <div>
        <div v-if="auth==true">
            <p>Auch</p>
            <button v-on:click="newLike()">
                <img height="20" src="/images/heart.png">
            </button>
        </div>
        <div v-else>
            <p>Not auth</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                type: Object,
                required: false
            }
        },
        mounted() {
            console.log("likes");
            this.authOrNot();
        },
        data() {
            return {
                auth: false
            }
        },
        methods: {
            authOrNot() {
                if (this.user != null) {
                    this.auth = true;
                    console.log("auth user")
                }
                else {
                    this.auth = false;
                    console.log("not auth user")
                }
            },
            newLike() {
                console.log("new like")
            }

        }
    }
</script>

<style scoped>

</style>