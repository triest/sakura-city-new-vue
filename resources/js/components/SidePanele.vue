<template>
    <div>
        <b><a href="/messages">Сообщения
            <div v-if="numberUnreaded>0">+{{numberUnreaded}}</div>
        </a>
        </b><br>
        <b><a href="/applications">Заявки на открытие анкеты
            <div v-if="numberApplication>0">+{{numberApplication}}</div>
        </a>
        </b>

        <b><a href="/editimages">Редактирование галлереи</a> </b><br>
        <b><a class="btn btn-primary" href="/power">Поднять анкету</a> </b><br><br>
        <b><a class="btn btn-info" href="/mypresents">Мои подарки</a> </b>
        <div v-if="numberApplicationPresents>0"><b>+{{numberApplicationPresents}}</b></div>
        <br><br>
        <div v-if="inseach==true">
            <b>Ваша анкета отображаеться в поиске</b>
        </div>
        <div v-else>
            <b>Ваша анкета Не отображаеться в поиске</b><br>
            <b><a type="btn primary" href="/power">Поместить анкету в поиск</a></b>
        </div>


    </div>
</template>

<script>
    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                numberUnreaded: 0,
                numberApplication: 0,
                numberApplicationPresents: 0,
                inseach: false
            }
                ;
        },
        mounted() {
            this.inSeach();
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    console.log('NewMessage');
                      axios.get('/getCountUnreaded')
                          .then((response) => {
                              this.numberUnreaded = response.data;
                          });
                    this.getNumberUnreadedMessages();
                });
            Echo.private(`requwests.${this.user.id}`)
                .listen('newApplication', (e) => {
                    console.log('NewRequwest');
                    axios.get('/getCountUnreadedRequwest')
                        .then((response) => {
                            this.numberApplication = response.data;
                        })
                });
            Echo.private(`gifs.${this.user.id}`)
                .listen('eventPreasent', (e) => {
                    this.getNumberUnreadedPresents();
                });


            axios.get('/getCountUnreaded')
                .then((response) => {
                    this.numberUnreaded = response.data;
                });
            axios.get('/getCountUnreadedRequwest')
                .then((response) => {
                    this.numberApplication = response.data;
                }),
                this.getNumberUnreadedPresents()

        },
        methods:
            {
                getNumberUnreadedMessages() {
                    axios.get('/getCountUnreaded')
                        .then((response) => {
                            this.numberUnreaded = response.data;
                        })
                },
                chechAnketExist() {

                },
                getNumberUnreadedPresents() {
                    axios.get('/getCountUnreadedPresents')
                        .then((response) => {
                            this.numberApplicationPresents = response.data;
                        })
                },
                inSeach() {
                    axios.get('/inseach')
                        .then((response) => {
                            if (response.data == "true") {
                                //console.log("true");
                                this.inseach = true;
                            }
                            else {
                                this.inseach = false;
                            }
                        })
                }

            }
    }
</script>


<style scoped>

</style>