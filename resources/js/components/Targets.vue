<template>
    <div>
        <div id="del-modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                </div>
            </div>
        </div>

        <div id="edit-modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <label>Название</label>
                        <input type="text" v-model="item.name">
                        <br>
                        <button type="button" class="btn btn-secondary" v-on:click="saveChange">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <br><br>
        <label>Создать цель знакоства.<br> После добавления она будет доступна пользователям</label> <br>
        <input type="text" id="name" name="name" v-model="name" placeholder="Введите цель">
        <button v-on:click="createTarget">Создать</button>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Изменить</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="target in targets">
                <td>{{target.name}}</td>
                <td>
                    <button class="btn" @click="editWindow(target)"><i class="fa fa-pencil"></i></button>
                </td>
                <td>
                    <button class="btn" @click="deleWindow(target.id)"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log("targets");
            this.getTargets();
        },
        data() {
            return {
                targets: "",
                name: "",
                id: "",
                value_input: "",
                item:""
            }
        },
        methods: {
            getTargets() {
                this.targets=null;
                axios.get('/targets')
                    .then((response) => {
                            this.targets = response.data;
                            console.log(this.targets)
                        }
                    )
            },
            editWindow(item) {
                this.id = item.id;
                this.value_input = item.name;
                this.item=item;
                console.log(this.id);
                $("#edit-modal").modal('show');
            },
            deleWindow(item) {
                this.id = item.id;
                this.name = item.name;
                console.log(this.id);
                $("#del-modal").modal('show');
            },
            createTarget() {
                var that = this;
                let formData = new FormData();
                formData.append('name', this.name);
                axios.post('/createtarget', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {

                        if (response.data == "ok") {
                            this.name = "";
                        }
                    })
                    .catch(function () {
                    });
                this.getTargets();
            },
            saveChange() {
                console.log("change");
                let formData = new FormData();
                formData.append('name', this.item.name);
                formData.append('id', this.id);
                axios.post('/edittarget', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {

                        if (response.data == "ok") {
                            this.name = "";
                        }
                    })
                    .catch(function () {
                    });
                this.getTargets();
                $("#edit-modal").modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>