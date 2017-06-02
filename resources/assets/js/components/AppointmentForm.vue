<template>
    <div class="container">
        <h1>Форма записи на прием к врачу</h1>
        <form method="post" role="form">
            <div class="form-group">
                <label for="type" class="control-label">Врач</label>
                <select
                        name="type"
                        id="type"
                        v-model="wantDoctor"
                        @change="setDisabledRules"
                        class="form-control"
                >
                    <option disabled value="">Выберите доктора</option>
                    <option v-for="doctor in doctors" :value="doctor">
                        {{ doctor.user.name + ' - ' + doctor.type.type}}
                    </option>
                </select>
            </div>
            <div v-show="wantDoctor" class="form-group">
                <label class="control-label">Дата приема</label>
                <datepicker
                        class="form-control"
                        placeholder="Дата приема"
                        language="ru" required
                        :format="'dd.MM.yyyy'"
                        :monday-first="true"
                        :disabled="disabledRules"
                        v-model="wantDate"
                        @input="checkFreeTime"
                ></datepicker>
            </div>
            <div v-show="appointments.length > 0" class="form-group">
                <appointment
                        v-for="appointment in appointments"
                        :appointment="appointment"
                        :key="appointment.start"
                        @make-appointment="makeAppointment"
                ></appointment>
            </div>
        </form>
    </div>
</template>
<script>
    import moment from 'moment';
    import Appointment from './Appointment.vue';
    export default{
        name: 'appointment-form',
        components: {
            appointment: Appointment
        },
        props: {
            appointmentTime: {
                type: Number,
                required: false,
                default: 20
            }
        },
        mounted() {
            axios.get('/doctors/get-all').then(response => {
                this.doctors = response.data;
            });
        },
        methods: {
            setDisabledRules(){
                this.wantDate = '';
                this.disabledRules = {days: [6, 0]}; //По умолчанию заблокированы в календаре выходные дни
                this.appointments = [];
                let disabledDays = _.map(
                    _.filter(JSON.parse(this.wantDoctor.schedule), function (el) {return !el.checked;}),
                    function (el) {
                        return el.id;
                    });
                this.disabledRules.days = this.disabledRules.days.concat(disabledDays);
            },

            checkFreeTime() {
                this.appointments = [];

                axios.post('/appointments/get-all', {date: moment(this.wantDate).format('YYYY-MM-DD'), doctorId: this.wantDoctor.id})
                    .then(response => {
                        let doctorAppointments = response.data;

                        let dayShedule = _.find(JSON.parse(this.wantDoctor.schedule), {id: parseInt(moment(this.wantDate).format('e'))});
                        let maxAppointment = Math.floor(moment(moment(this.wantDate).format('YYYY-MM-DD') + ' ' + dayShedule.stop).diff(moment(moment(this.wantDate).format('YYYY-MM-DD') + ' ' + dayShedule.start), 'minutes')/this.appointmentTime);

                        if(doctorAppointments.length < maxAppointment) {
                            for(let i=0; i<maxAppointment ; i++){
                                let start = moment(dayShedule.start, 'HH:mm').add(i*this.appointmentTime, 'minutes');
                                let findedAppointment = _.find(doctorAppointments, { start: moment(this.wantDate).format('YYYY-MM-DD') + ' ' + start.format('HH:mm:ss')});
                                this.appointments.push({
                                    start: start.format('HH:mm'),
                                    free: !findedAppointment,
                                    info: findedAppointment
                                });
                            }
                        }
                        else {
                            alert('Запись к врачу завершена! Выберите пожалуйста другой день недели.')
                        }
                    }
                );
            },

            makeAppointment(appointment) {
                axios.post(
                    '/appointments',
                    {
                        start: moment(this.wantDate).format('YYYY-MM-DD') + ' ' + moment(appointment.start, 'HH:mm').format('HH:mm:ss'),
                        doctorId: this.wantDoctor.id
                    }
                ).then(response => {
                    appointment.free = false;
                    appointment.info = response.data
                })
            }
        },
        data() {
            return {
                doctors: [],
                wantDoctor: '',
                wantDate: '',
                disabledRules: {days: [6, 0]},
                appointments: []
            }
        }
    }
</script>