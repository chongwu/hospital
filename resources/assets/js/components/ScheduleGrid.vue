<template>
    <div class="schedule-grid">
        <h4>Расписание</h4>
        <time-range
                v-for="day in schedule"
                :day="day"
                :key="day.dayName"
        ></time-range>
    </div>
</template>
<script>
    import timeRange from './CheckboxTimeRange.vue'
    export default{
        name: 'schedule-grid',
        components: {
            'time-range': timeRange
        },
        props: {
            schedule: {
                type: Array,
                required: true
            }
        }
    }
</script>