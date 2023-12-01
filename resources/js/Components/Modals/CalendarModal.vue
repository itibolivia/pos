<template>


<!-- Modal -->
<div class="modal fade show" id="myModal" 
style="display: block; background-color: rgba(0, 0, 0, 0.5);
transform: scale(1); transition: transform 0.75s ease-in" 
tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Agenda Prospecto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
        @click="closeModal"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
          <label for="inputAddress">Prospecto</label>
          <select class="form-select" id="inputAddress"
          v-model="form.prospecto"
          v-bind:class="{ 'is-invalid' : $page.props.errors.prospecto}">
            <option v-for="(prospecto, id) in prospectos" :key="id" :value="id">
              {{ prospecto }}
            </option>
          </select>
          <div v-if="$page.props.errors.prospecto" class="text-danger">
              {{ $page.props.errors.prospecto }}
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Acción</label>
          <input type="text" class="form-control" id="inputAddress"
          v-model="form.accion"
          v-bind:class="{ 'is-invalid' : $page.props.errors.accion}">
          <div v-if="$page.props.errors.accion" class="text-danger">
              {{ $page.props.errors.accion }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputAddress2">Fecha</label>
              <input type="date" class="form-control" id="inputAddress2"
              v-model="form.fecha">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputAddress2">Hora</label>
              <input type="time" class="form-control" id="inputAddress2"
              v-model="form.hora">
            </div>
          </div>
        </div>
        
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
        @click="closeModal">Cerrar</button>
        <button type="button" class="btn btn-primary"
        @click.prevent="store(form)">Guardar</button>
      </div>
    </div>
  </div>
</div>

</template>

<script>

export default {
  name: "Modal",
  props:['prospectos', 'form'],
  components: {
  },
  methods:{
    closeModal(){
      this.$emit('closeModal')
    },
    store(form){
      this.$emit('saveAgenda',form)
    }
  }
}
</script>

<style scoped>
.top-100 {
  top: 100%;
}
.bottom-100 {
  bottom: 100%;
}

.max-h-select {
  max-height: 300px;
}
</style>
