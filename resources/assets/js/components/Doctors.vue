<template>
    <div class="container">
        <h1>Врачи</h1>
        <form method="post" role="form">
            <div class="form-group">
                <label for="name" class="control-label">Ф.И.О.</label>
                <input type="text" class="form-control" name="name" id="name" v-model="name" placeholder="Ф.И.О." required>
            </div>
            <div class="form-group">
                <label for="email" class="control-label">E-Mail</label>
                <input type="email" class="form-control" name="email" id="email" v-model="email" placeholder="E-Mail" required>
            </div>
            <div class="form-group">
                <label for="type" class="control-label">Тип</label>
                <select name="type" id="type" v-model="type" class="form-control">
                    <option disabled value="">Выберите тип</option>
                    <option v-for="type in types" :value="type.id">
                        {{ type.type}}
                    </option>
                </select>
            </div>

            <schedule-grid :schedule="schedule"></schedule-grid>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" v-on:click.prevent="addDoctor" :disabled="(!email || !name || !type)">Добавить</button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>№</th>
                <th>Ф.И.О.</th>
                <th>E-mail</th>
                <th>Тип</th>
                <th>Расписание</th>
                <th width="181px"></th>
            </tr>
            </thead>
            <tbody>
            <tr
                    is="doctor-row"
                    v-for="(doctor, index) in doctors"
                    :key="doctor.id"
                    :index="index"
                    :doctor="doctor"
                    v-on:edit-doctor="editDoctor(doctor)"
                    v-on:delete-doctor="deleteDoctor(doctor)"
            ></tr>
            </tbody>
        </table>
        <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Изменение Данных о враче</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" v-on:submit.prevent="updateDoctor(fillItem.id)">
                            <div class="form-group">
                                <label for="edit-name" class="control-label">Ф.И.О.</label>
                                <input type="text" class="form-control" name="edit-name" id="edit-name" v-model="fillItem.name" placeholder="Ф.И.О." required>
                            </div>
                            <div class="form-group">
                                <label for="edit-email" class="control-label">E-Mail</label>
                                <input type="email" class="form-control" name="edit-email" id="edit-email" v-model="fillItem.email" placeholder="E-Mail" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-type" class="control-label">Тип</label>
                                <select name="edit-type" id="edit-type" v-model="fillItem.type" class="form-control">
                                    <option disabled value="">Выберите тип</option>
                                    <option v-for="type in types" v-bind:value="type.id">
                                        {{ type.type}}
                                    </option>
                                </select>
                            </div>

                            <schedule-grid :schedule="fillItem.schedule"></schedule-grid>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" :disabled="(!fillItem.email || !fillItem.name || !fillItem.type)">Изменить</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import scheduleGrid from './ScheduleGrid.vue';
    import doctorRow from './DoctorRow.vue';
    export default{
        name: 'doctors',
        components: {
            'schedule-grid': scheduleGrid,
            'doctor-row': doctorRow
        },
        methods:{
            initForm(){
                this.email = '';
                this.name = '';
                this.type = '';
                this.schedule = [
                    {id: 1, dayName: 'Понедельник', checked:false, start:'08:00', stop:'18:00'},
                    {id: 2, dayName: 'Вторник', checked:false, start:'08:00', stop:'18:00'},
                    {id: 3, dayName: 'Среда', checked:false, start:'08:00', stop:'18:00'},
                    {id: 4, dayName: 'Четверг', checked:false, start:'08:00', stop:'18:00'},
                    {id: 5, dayName: 'Пятница', checked:false, start:'08:00', stop:'18:00'}
                ];
            },
            addDoctor() {
                axios.post('/doctors', {email: this.email, name:this.name, type: this.type, schedule: this.schedule})
                    .then(response => {
                        this.doctors.push(response.data);
                        this.initForm();
                    })
            },
            editDoctor(doctor) {
                this.fillItem = {id: doctor.id, email: doctor.user.email, name: doctor.user.name, type: doctor.doctor_type_id, schedule: JSON.parse(doctor.schedule)};
                $('#edit-modal').modal('show');
            },
            updateDoctor(doctorId){
                axios.put('/doctors/'+doctorId, {email: this.fillItem.email, name:this.fillItem.name, type: this.fillItem.type, schedule: this.fillItem.schedule}).then(response => {
                    this.doctors.splice(this.doctors.indexOf(_.find(this.doctors, {id: doctorId})), 1, response.data);
                    this.fillItem = {id: '', email: '', name: '', type: '', schedule: []};
                    $('#edit-modal').modal('hide');
                });
            },
            deleteDoctor(doctor) {
                axios.delete('/doctors/'+doctor.id).then(response => {
                    this.doctors.splice(this.doctors.indexOf(doctor), 1);
                })
            }
        },
        mounted() {
            this.initForm();
            axios.get('/doctors/get-all').then(response => {
               this.doctors = response.data;
            });
            axios.get('/doctor-types/get-all').then(response => {
                this.types = response.data;
            })
        },
        data() {
            return {
                email: '',
                name: '',
                type: '',
                schedule: [],
                doctors: [],
                types: [],
                fillItem: {id: '', email: '', name: '', type: '', schedule: []}
            }
        }
    }
</script>