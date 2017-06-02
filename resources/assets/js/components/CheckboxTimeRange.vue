<template>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="day.checked" >
                {{ day.dayName }}
            </label>
            <masked-input :disabled="!day.checked" class="form-control work-time" :value="day.start" v-model="day.start" :mask="[/\d/, /\d/, ':', /\d/, /\d/]" placeholder-char=" " :show-mask="true"></masked-input>
            —
            <masked-input :disabled="!day.checked" class="form-control work-time" :value="day.stop" v-model="day.stop" :mask="[/\d/, /\d/, ':', /\d/, /\d/]" placeholder-char=" " :show-mask="true"></masked-input>
        </div>
    </div>
</template>
<script>
    export default{
        name: 'day-range',
        props: {
            day: {
                type: Object,
                required: true
            },
        }

    }
</script>