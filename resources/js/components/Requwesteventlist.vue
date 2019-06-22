<template>
    <div>
        <b>Td</b>
        <div v-for="requwest in requwestlist">
            <div class="col-lg-4 col-md-3 col-sm-5 col-xs-9 box-shadow">
                <div class="card  border-dark" style="width: 18rem; background-color: #eeeeee;
             border: 1px solid transparent;
             border-color: #666869;
">
                    <div class="card-body">

                        <p>{{requwest.id}}</p>
                        <div id="app">
                            <a @click="myFunction(requwest.id)">
                                <img :src="'/images/upload/'+requwest.main_image" height="150">
                            </a>
                            <a @click="myFunction(requwest.id)">
                                <p>{{requwest.name}}</p></a>,
                                {{requwest.age}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            return {
                requwestlist: null
            }
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
                        this.requwestlist = response.data;
                    });
            },
            myFunction: function (id) {
                console.log(id);
                window.open("/anket/" + id, "_blank");
            }
        }
    }
</script>

<style scoped>

</style>