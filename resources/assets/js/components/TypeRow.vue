<template>
    <tr>
        <td>{{ index+1 }}</td>
        <td>{{ item.type }}</td>
        <td>
            <button v-on:click="$emit('edit-type')" class="btn btn-primary">Измеить</button>
            <button v-on:click="$emit('delete-type')" class="btn btn-danger">Удалить</button>
        </td>
    </tr>
</template>
<script>
    export default{
        name: 'type-row',
        props: {
            index: {
                type: Number,
                required: true
            },
            item: {
                type: [Object],
                required: true
            }
        }
    }
</script>
