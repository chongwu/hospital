<template>
    <div>
        <div class="form-group">
            <input id="new-type" type="text" class="form-control" v-model="newType" placeholder="Новая специализация" v-on:keyup.enter="addNewType"/>
            <a id="add-type" class="btn btn-primary" v-on:click.prevent="addNewType">Добавить</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th width="181px"></th>
                </tr>
            </thead>
            <tbody>
                <tr
                        is="type-row"
                        v-for="(row, index) in rows"
                        :key="row.id"
                        :index="index"
                        :item="row"
                        v-on:edit-type="editRow(row)"
                        v-on:delete-type="deleteRow(row)"
                ></tr>
            </tbody>
        </table>
        <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Изменение специализации</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateRow(fillItem.id)">
                            <div class="form-group">
                                <label for="edit-type">Специализация врача:</label>
                                <input id="edit-type" type="text" name="type" class="form-control" v-model="fillItem.type"/>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Изменить</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import TypeRow from './TypeRow.vue';
    export default {
        name: 'type-table',
        components: {
            typeRow: TypeRow
        },
        methods: {
            addNewType(){
                axios.post('/doctor-types', {type: this.newType}).then(response => {
                    this.rows.push(response.data);
                    this.newType = '';
                });
            },
            editRow(row){
                this.fillItem = {id: row.id, type: row.type};
                $('#edit-modal').modal('show');
            },
            updateRow(rowId){
                axios.put('doctor-types/'+rowId, {type: this.fillItem.type})
                    .then(response => {
                        this.rows.splice(this.rows.indexOf(_.find(this.rows, {id: rowId})), 1, response.data);
                        this.fillItem = {id : '', type: ''};
                        $('#edit-modal').modal('hide');
                    });
            },
            deleteRow(row){
                axios.delete('doctor-types/'+row.id).then(response => {
                    this.rows.splice(this.rows.indexOf(row), 1);
                });
            }
        },
        mounted(){
            axios.get('/doctor-types/get-all').then(response => {
                this.rows = response.data;
            })
        },
        data() {
            return {
                newType: '',
                rows: [],
                fillItem: {id: '', type: ''}
            }
        }
    }
</script>
<style>
    #new-type{
        float: left;
        width: 70%;
    }
    #add-type {
        margin-left: 10px;
    }
</style>
