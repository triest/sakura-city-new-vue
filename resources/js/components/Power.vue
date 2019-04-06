<template>

    <div>
        <b>Текущее состояние счета: {{money.money}}</b>
        <br>
        <b> Поместить анкету в шапку сайта(сменяемое меню) на
            <input name="days" id="days" type="number" min="0"
                   :max="max2" :value="max2" ref="inputDaysNumber"></b>
        <div v-if="money.money>=priceToTop">
            <button class="btn-primary" v-on:click="toTop()">Поднять</button>
        </div>
        <div v-else>
            Недостаточно денег. Пополните счет.
        </div>
        <b>Поднять анкету на первое место за {{priceToTop.price}} рублей</b>
        <div v-if="money.money>=priceFirstPlase">
            <button v-on:click="toFirstPlase()">Поднять</button>
        </div>
        <div v-else>
            Недостаточно денег. Пополните счет.
        </div>

        <br>
        <div v-if="inseach==true">
            <h2>Ваша анкета отображаеться в поиске</h2>
        </div>
        <div v-else>
            <b>Ваша анкета Не отображаеться в поиске</b><br>

            <b> Поместить анкету в поиск сайта на
                <input name="days_seach" id="days_seach" type="number" min="0"
                       :max="max2" :value="max2" ref="inputDaysNumber"></b>
          

            <div v-if="money.money>=priseSeach">

                <button class="btn-primary" v-on:click="toSeach()">Поместить</button>
            </div>
            <div v-else>
                Недостаточно денег. Пополните счет.
            </div>

        </div>

    </div>
</template>

<!--Модальное -->


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
                money: "",
                prices: "",
                priceToTop: "",
                inputDays: "",
                priceFirstPlase: "",
                priseSeach: "",
                inseach: false,
                ButthonToSeashEnable: false
                //  max_days_seach: ''
            };
        },
        computed: {
            max2: function () {
                return this.money.money / this.priceToTop.price
                //  return this.money.money / 1
            },
            maxSeach: function () {
                if (this.priseSeach < this.money) {
                    this.ButthonToSeashEnable = true;
                }
                else {
                    this.ButthonToSeashEnable = true;
                }

                return this.money / this.priseSeach
            }


        },
        mounted() {
            this.getMoneut(),
                this.getPrices(),
                this.inSeach(),
                this.getPrices()
        },
        methods:
            {
                getMoneut() {
                    console.log("getMoney");
                    axios.get('/getMoney')
                        .then((response) => {
                            this.money = response.data;
                        });
                },
                getPrices() {
                    var returnedData = "";
                    axios.get('/getpricestotop')
                        .then((response) => {
                            this.priceToTop = response.data;
                        });
                    axios.get('/getpricetofirstplace')
                        .then((response) => {
                            this.priceFirstPlase = response.data;
                        });
                    axios.get('/getpricetoseach')
                        .then((response) => {
                            this.priseSeach = response.data;
                        });


                },
                toTop() {

                    axios.get('/totop', {
                        params: {
                            days: this.$refs.inputDaysNumber.value
                        }
                    })
                        .then((response) => {
                            if (!response.data) {

                            }
                            else {
                                this.isOpen = false;

                            }
                        });
                    this.getMoneut()
                },
                inSeach() {
                    axios.get('/inseach')
                        .then((response) => {
                            this.inseach = response.data;
                            if (this.inseach == "true") {
                                this.inseach = true;
                                this.inSeachDate();
                            }
                            else {
                                this.inseach = false;
                            }
                        })
                },
                inSeachDate() {
                    axios.get('/inseachdate')
                        .then((response) => {
                            this.begin_seach = response.begin;
                            this.end_seach = response.end;
                        })
                },
                toSeach() {
                    axios.get('/toseach', {
                        params: {
                            days: this.$refs.inputDaysNumber.value
                        }
                    })
                        .then((response) => {
                            if (!response.data) {

                            }
                            else {
                                this.isOpen = false;

                            }
                        });
                    this.getMoneut()
                }
            }
    }
</script>

<style scoped>

</style>