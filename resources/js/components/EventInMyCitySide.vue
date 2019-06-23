<template>
    <div>
        <div v-for="event in eventList">
            <b>{{event.name}}</b>
            <b>{{event.place}}</b>

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log("event in my my city side");
            this.getEvents();
        },
        data() {
            return {
                eventList: ""
            };
        },
        methods: {
            getEvents() {
                console.log("get events");
                axios.get('/eventsinmycity', {
                        /*   params: {
                               eventid: this.eventid,
                               useris: id,
                               action: 'accept',
                               reqid: req_id,
                           }*/
                    }
                )
                    .then((response) => {
                        this.eventList = response.data;
                    });
            }
        }

    }
</script>

<style scoped>

</style>