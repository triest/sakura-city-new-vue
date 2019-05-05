<template>
    <div>
        <b>Я</b> <br>
        <label for="who_woman">Женщина</label>
        <input type="radio" id="who_woman" value="famele" v-model="who_met" checked>
        <label for="who_man">Мужчина</label>
        <input type="radio" id="who_man" value="male" v-model="who_met">
        <label for="contect_who">Неважно</label>
        <input type="radio" id="contect_who" value="contect_who" v-model="who_met">

        <b> Хочу познакомиться с</b>
        <label for="who_woman">женщиной</label>
        <input type="radio" id="with_woman" value="famele" v-model="with_met">
        <label for="who_man">мужчиной</label>
        <input type="radio" id="with_man" value="male" v-model="with_met">
        <label for="contect_who">неважно</label>
        <input type="radio" id="contect_with" value="contect_who" v-model="with_met">

        Возраст:
        от:
        <input type="number" v-model="min_age" id="min_age" min="18" value="18">

        до:
        <input type="number" v-model="max_age" id="max_age" min="18" value="18">

        <br><br>
        Цель знакомства:

        <li v-for="target in targets">
            <label>{{target.name}}</label>
            <input type="checkbox" v-bind:value="target.id" v-model="selected"
                   @click="check($event)">
        </li>
        <br><br>
        Интересы:
        <li v-for="target in interests">
            <label>{{target.name}}</label>
            <input type="checkbox" v-bind:value="target.id" v-model="interestsSelected"
                   @click="check($event)">
        </li>



        <button v-on:click="seach">Найти</button>

        <div v-for="anket in anketList">
            <a v-bind:href="'/anket/'+anket.id">
                <img :src="'images/small/'+anket.main_image" height="200">
                {{anket.name}}
            </a>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'edit',
        mounted() {
            console.log('index');
            this.getTargets();
            this.getInterest();
            //   this.seach();
        },
        data() {
            return {
                who_met: "famele",
                with_met: "male",
                targets: "",
                interests:"",
                checkedTargets: [],
                selected: [],
                max_age: '40',
                min_age: '18',
                anketList: '',
                interestsSelected:[]
            }
        },
        methods: {
            getTargets() {
                axios.get('/getargetslist')
                    .then((response) => {
                        //console.log(response.data)
                        this.targets = response.data;
                    });
            },
            getInterest() {
                axios.get('/getinterestslist')
                    .then((response) => {
                        //console.log(response.data)
                        this.interests = response.data;
                    });
            },
            check: function (e) {
                if (e.target.checked) {
                    console.log(e.target.value)
                }
            },
            seach() {
                console.log("seach");
                axios.get('/seach', {
                    params: {
                        who_met: this.who_met,
                        with_met: this.with_met,
                        targets: this.selected,
                        max_age: this.max_age,
                        min_age: this.min_age,
                        interests:this.interestsSelected
                    }
                }).then((response) => {
                    //console.log(response.data)
                    this.anketList = response.data;
                })
            }
        }
    }
</script>

<style>
    textarea {
        width: 90%; /* Ширина поля в процентах */
        height: 200px; /* Высота поля в пикселах */
        resize: none; /* Запрещаем изменять размер */
    }
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        width: 600px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .modal-default-button {
        float: right;
    }
    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>