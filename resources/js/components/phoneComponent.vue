<template>
    <div>

    </div>
</template>


<script>

    //'./components/delModal.vue'

    export default {
        props: {},
        components: {},
        mounted() {

        },
        data() {
            return {
                phoneOpen: false,
                phone: ''
            }
        },
        methods: {}
    }
</script>

<style scoped>
    .delmodal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: table;
        transition: opacity .3s ease;

    }


</style>