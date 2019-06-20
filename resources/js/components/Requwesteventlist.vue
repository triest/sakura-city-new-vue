<template>
<div>
    <b>T</b>
</div>
</template>

<script>
    export default {
        props: {
            eventid: {
                type: Number,
                required: true
            },
        },
        components: {},
        mounted() {
            console.log("requwesteventlist1");
            this.getrequwests();
            console.log(this.eventid)
        },
        data() {
            return {}
        },
        methods: {
            getrequwests() {
                axios.get('/eventrequwestlist', {
                        params: {
                            eventid: this.eventid
                        }
                    }
                )
                    .then((response) => {

                    });
            }
        }
    }
</script>

<style scoped>

</style>