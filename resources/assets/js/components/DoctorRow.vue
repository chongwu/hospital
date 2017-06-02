<template>
    <tr>
        <td>{{ index+1 }}</td>
        <td>{{ doctor.user.name }}</td>
        <td>{{ doctor.user.email }}</td>
        <td>{{ doctor.type.type }}</td>
        <td><p v-for="scheduleItem in filteredSchedule">{{ scheduleItem.dayName + ' с ' + scheduleItem.start + ' до ' + scheduleItem.stop}}</p></td>
        <td>
            <button v-on:click="$emit('edit-doctor')" class="btn btn-primary">Измеить</button>
            <button v-on:click="$emit('delete-doctor')" class="btn btn-danger">Удалить</button>
        </td>
    </tr>
</template>
<script>
    export default{
        name: 'doctor-row',
        props: {
            index: {
                type: Number,
                required: true
            },
            doctor: {
                type: [Object],
                required: true
            }
        },
        computed: {
            filteredSchedule: function () {
                return _.filter(JSON.parse(this.doctor.schedule), function(el){ return el.checked});
            }
        }
    }
</script>