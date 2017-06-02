<template>
    <div class="col-lg-4 col-md-3 col-sm-2 appointment-card">
        <h2 class="appointment-time" :class="{'text-muted': !appointment.free}">{{ appointment.start }}</h2>
        <div v-if="appointment.free">
            <button class="btn btn-sm btn-block btn-success" @click.prevent="$emit('make-appointment', appointment)">Записаться на прием</button>
        </div>
        <div v-else>
            Записан пациент - {{ appointment.info.visitor.user.name }}
        </div>
    </div>
</template>
<script>
    export default{
        name: 'appointment',
        props: {
            appointment: {
                type: Object,
                required: true
            }
        }
    }
</script>
<style>
    .appointment-card {
        min-height: 110px;
        border: 1px solid #cccccc;
    }
    .appointment-time {
        text-align: center;
    }
</style>