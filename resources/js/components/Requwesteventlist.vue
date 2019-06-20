<template>

</template>

<script>
    export default {
        props: {
            eventid: {
                type: '',
                required: true
            },
        },
        components: {},
        mounted() {
            console.log("requwesteventlist");
            this.getrequwests();
        },
        data() {
            return {}
        },
        methods: {
            getrequwests() {
                axios.get('/listrequwest', {
                        params: {
                            eventid: this.eventid
                        }
                    }
                )
                    .then((response) => {
                        console.log(response.data)
                    });
            }
        }
    }
</script>

<style scoped>

</style>