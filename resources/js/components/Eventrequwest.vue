<template>
    <div>

        <button class="btn-default" v-on:click="makeRequwest()">Отправить заявку на мероприятие
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            event: {
                type: Object,
                required: false
            },
        },
        mounted() {
            console.log("event req");
            console.log(this.event.id);
            this. checkRequwet();
        },
        methods: {
            makeRequwest() {
                console.log("make req");
                axios.get('/event/makerequwest', {
                    params: {
                        id: this.event.id
                    }
                })
                    .then((response) => {
                        //console.log(response.data);

                    });
                this.checkRequwet()
            },
            checkRequwet() {
                axios.get('/event/checkrequwest', {
                    params: {
                        id: this.event.id
                    }
                })
                    .then((response) => {
                        console.log(response.data);
                    })
            }
        }
    }
</script>

<style scoped>

</style>