<template>
  <main class="main">
    <!-- Breadcrumb -->
    <section class="content-header">
      <h1>
        Informacion
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">Informacion</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="#" alt="User profile picture">

              <h3 class="profile-username text-center">Nina Mcintire</h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Informacion</a></li>

              <li><a href="#settings" data-toggle="tab">Datos Empresa</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

                <div class="pull-right">
                  <button type="button" class="btn btn-primary btn-secondary">
                    <i class="fa fa-edit"></i> Descagar informacion
                  </button>
                </div>
                <br><br>

                <div class="form-group row">
                  <div class="col-md-6">
                    <div>
                      <tr>
                        <th>
                          <select class="form-control" v-model="criterio">
                            <option value="nombre">Nombre</option>
                            <option value="descripcion">Descripción</option>
                          </select>
                        </th>
                        <th>
                          <input type="text" v-model="buscar" @keyup.enter="listarRol(1,buscar,criterio)"
                            class="form-control" placeholder="Texto a buscar">

                        </th>
                        <th>
                          <button type="submit" @click="listarRol(1,buscar,criterio)" class="btn btn-primary"><i
                              class="fa fa-search"></i> Buscar</button>

                        </th>
                      </tr>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="rol in arrayRol" :key="rol.id">

                      <td v-text="rol.nombre"></td>
                      <td v-text="rol.descripcion"></td>
                      <td>
                        <div v-if="rol.condicion">
                          <span class="badge badge-success">Activo</span>
                        </div>
                        <div v-else>
                          <span class="badge badge-danger">Desactivado</span>
                        </div>

                      </td>
                    </tr>
                  </tbody>
                </table>
                <nav>
                  <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                      <a class="page-link" href="#" @click.prevent="
                    cambiarPagina(pagination.current_page - 1, buscar, criterio)
                  ">Ant</a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" :key="page"
                      :class="[page == isActived ? 'active' : '']">
                      <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)"
                        v-text="page"></a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                      <a class="page-link" href="#" @click.prevent="
                    cambiarPagina(pagination.current_page + 1, buscar, criterio)
                  ">Sig</a>
                    </li>
                  </ul>
                </nav>
              </div>


              <div class="tab-pane" id="settings">
                <form action="" enctype="multipart/form-data" class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre Empresa</label>

                    <div class="col-sm-10">
                      <input type="text" v-model="nombre_empresa" class="form-control"
                        placeholder="Nombre de la empresa">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" v-model="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="direccion" placeholder="Direccion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Telefono</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="telefono" placeholder="Telefono">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">

                      <img id="img1" src="#" height="100px" width="100px" border="solid 1px">
                      <input id="inputFile1" type="file" name="image" @change="getImage" accept="image/*">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button"  v-if="tipoAccion == 1" class="btn btn-primary"  @click="registrarDatos()">Registrar Datos</button>

                      <button type="button"  v-if="tipoAccion == 2" class="btn btn-primary"  @click="actualizarDatos()">Actualizar Datos</button>
                    </div>
                  </div>
                </form>
               

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

  </main>
</template>

<script>
  export default {
    data() {
      return {
        rol_id: 0,
        nombre: '',
        descripcion: '',
        arrayRol: [],
        datos_id: 1,
        nombre_empresa: '',
        email: '',
        direccion: '',
        telefono: '',
        imagen: null,
        datos: [],
        modal: 0,
        tituloModal: '',
        tipoAccion: 0,
        pagination: {
          'total': 0,
          'current_page': 0,
          'per_page': 0,
          'last_page': 0,
          'from': 0,
          'to': 0,
        },
        offset: 3,
        criterio: 'nombre',
        buscar: ''
      }
    },
    computed: {
      isActived: function () {
        return this.pagination.current_page;
      },
      //Calcula los elementos de la paginación
      pagesNumber: function () {
        if (!this.pagination.to) {
          return [];
        }

        var from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }

        var to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }

        var pagesArray = [];
        while (from <= to) {
          pagesArray.push(from);
          from++;
        }
        return pagesArray;

      }
    },
    methods: {


      getImage(event) {
        //Asignamos la imagen a  nuestra data
        this.imagen = event.target.files[0];
      },
      datos_empresa() {
        let me = this;
        var url = '/datos';
        axios.get(url).then(function (response) {
         
         
          if(response.data.id = 1){
            console.log('existem datos');
            console.log(response)
            me.tipoAccion = 2;
            var respuesta = response.data[0];
          me.datos = respuesta.data;

          me.nombre_empresa = respuesta['nombre_empresa'];
          me.email = respuesta['email'];
          me.direccion = respuesta['direccion'];
          me.telefono = respuesta['telefono'];
          } else {
            me.tipoAccion= 1;
          }

        })
          .catch(function (error) {
            console.log(error);
          });

      },
     registrarDatos() {

//Creamos el formData
var data = new FormData();
//Añadimos la imagen seleccionada
data.append('avatar', this.imagen);
data.append('nombre_empresa', this.nombre_empresa);
data.append('email', this.email);
data.append('direccion', this.direccion);
data.append('telefono', this.telefono);

data.append('_method', 'POST');

//Añadimos el método PUT dentro del formData
// Como lo hacíamos desde un formulario simple _(no ajax)_

 axios.post('/datos/registrar', data)
  .then(function (response) {
    console.log(response)
  })


},

      actualizarDatos() {

        //Creamos el formData
        var data = new FormData();
        //Añadimos la imagen seleccionada
        data.append('avatar', this.imagen);
        data.append('nombre_empresa', this.nombre_empresa);
        data.append('email', this.email);
        data.append('direccion', this.direccion);
        data.append('telefono', this.telefono);
        data.append('id', this.datos_id);



        //Añadimos el método PUT dentro del formData
        // Como lo hacíamos desde un formulario simple _(no ajax)_
        data.append('_method', 'PUT');
        axios.post('/datos/actualizar', data)
          .then(function (response) {
            console.log(response)
          })


      },
      listarRol(page, buscar, criterio) {
        let me = this;
        var url = '/info?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
        axios.get(url).then(function (response) {
          var respuesta = response.data;
          console.log(response.data)
          me.arrayRol = respuesta.roles.data;
          me.pagination = respuesta.pagination;
        })
          .catch(function (error) {
            console.log(error);
          });

      },



      cambiarPagina(page, buscar, criterio) {
        let me = this;
        //Actualiza la página actual
        me.pagination.current_page = page;
        //Envia la petición para visualizar la data de esa página
        me.listarRol(page, buscar, criterio);
      },
      updateAvatar() {
        //Creamos el formData
        var data = new FormData();
        //Añadimos la imagen seleccionada
        data.append('avatar', this.imagen);
        data.append('nombre_empresa', this.nombre_empresa);
        data.append('email', this.email);
        data.append('direccion', this.direccion);
        data.append('telefono', this.telefono);
        data.append('id', this.datos_id);
        //Añadimos el método PUT dentro del formData
        // Como lo hacíamos desde un formulario simple _(no ajax)_
        data.append('_method', 'PUT');
        // console.log(data.append)
        //Enviamos la petición
        axios.post('/datos/uploda_img', data
        )
          .then(response => {
            console.log(response.data)
          })
      }
    },
    mounted() {
      this.listarRol(1, this.buscar, this.criterio);
      this.datos_empresa();
    }
  }
</script>
<style>
  .modal-content {
    width: 100% !important;
    position: absolute !important;
  }

  .mostrar {
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a !important;
  }

  .div-error {
    display: flex;
    justify-content: center;
  }

  .text-error {
    color: red !important;
    font-weight: bold;
  }
</style>