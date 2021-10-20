<template>
<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="row form-group">
          <input type="text" class="form-control" name="textfield" id="textfield" v-model="rec.textfield">
          <ul v-if="errors.textfield" class="list-unstyled">
            <li v-for="err in errors.textfield" class="element-error">{{ err }}</li>
          </ul>
        </div>
        <div class="row form-group">
          <select id="selectfiled" name="selectfiled" v-model="selectfiled" >
            <option value="value1">value1</option>
            <option value="value2">value2</option>
            <option value="value3">value3</option>
          </select>
          <ul v-if="errors.selectfiled" class="list-unstyled">
            <li v-for="err in errors.selectfiled" class="element-error">{{ err }}</li>
          </ul>
        </div>
        <div class="row form-group">
          <textarea class="form-control" name="textarea" id="textarea" v-model="textarea"></textarea>
          <ul v-if="errors.textarea" class="list-unstyled">
            <li v-for="err in errors.textarea" class="element-error">{{ err }}</li>
          </ul>
        </div>
        <div class="row form-group">
          <input type="file" name="filefield" id="filefield" @change="fileChange">
          <ul v-if="errors.filefield" class="list-unstyled">
            <li v-for="err in errors.filefield" class="element-error">{{ err }}</li>
          </ul>
        </div>
      </div>
      <div class="alert alert-success" v-if="success != ''">{{ success }}</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="clearModal" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="addRecord" >Save</button>
      </div>
    </div>
    
  </div>
</div>
</template>
<script >
    export default {
        props:['rec'],
        data() {
            return {
                textfield: '',
                selectfiled: '',
                success: '',
                errors: [],
                filefield: '',
                textarea: '',
                values: {},
                formFileds: new FormData
            }
        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            updateRecord() {

                var $inputs = $('.modal-body :input');
                const config = {
                    'csrf-token': $('meta[name="csrf-token"]').attr('content')
                };
                let values = this.formFileds;
                $inputs.each(function() {
                    if (this.type != 'file') {
                        values.append(this.name, $(this).val());
                    }
                });

                axios.post('http://localhost/adminpanel/elements', values, config)
                    .then((response) => {
                        this.$emit('recordupdated', response),
                            this.success = 'Record updated successfully.',
                            this.textfield = ''
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    })
            },
            fileChange(e) {
                let selecteFile = e.target.files[0];
                this.filefield = selecteFile;
                this.formFileds.append('filefield', selecteFile);
                console.log(this.formFileds);
            },
            clearModal() {
                this.textfield = '',
                    this.success = '',
                    this.errors = []
            }
        },
        mounted() {}
    } 
</script>