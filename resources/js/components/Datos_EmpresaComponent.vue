<template>
            <main class="main">
        <section class="content-header">
      <h1>
        Datos Empresa
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
 
        <li class="active">Datos Empresa</li>
      </ol>
    </section>

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
           
              <li><a href="#settings" data-toggle="tab">Configuracion</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <h1>infromacion</h1>

                <table>
                  <tr>
                    <th>hola</th>
                  </tr>
                  <tbody>
              <tr v-for="datos in array_datos" :key="datos.id">
                  <td v-text="datos.nombre_empresa"></td>

                    </tr>
                  </tbody>
                </table>

                  <form class="form-horizontal ">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Empresa</label>

                    <div class="col-sm-10">
                      <input type="text" name="nombre_empresa" class="form-control"  placeholder="Nombre de la empresa">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="direccion" id="inputName" placeholder="Direccion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Telefono</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="telefono" id="inputExperience" placeholder="Telefono">
                   </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">

                      <img id="img1" src="" height="100px" width="100px" border="solid 1px">
                      <input id="inputFile1" name="file" value="agregar" type="file">

                      
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
             

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Empresa</label>

                    <div class="col-sm-10">
                      <input type="text" name="nombre_empresa" class="form-control"  placeholder="Nombre de la empresa">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="direccion" id="inputName" placeholder="Direccion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Telefono</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="telefono" id="inputExperience" placeholder="Telefono">
                   </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">

                      <img id="img1" src="" height="100px" width="100px" border="solid 1px">
                      <input id="inputFile1" name="file" value="agregar" type="file">

                      
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
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
  export default{
    data(){
      return{
        datos_id: 0,
        nombre_empresa='',
        email ='',
        direccion='',
        telefono='',
        array_datos=[]
      }
    },
created (){
let me = this;
        console.log('hoa')
        var url = '/datos/'
        this.axios.get(url)
        .then( res =>{
          console.log('homa')
          console.log(res);
        })
        .catch(err =>{
          console.log(err)
        })
},
    methods: {
     async datosEmpresa(){
        let me = this;
        console.log('hoa')
        var url = '/datos'
      await  axios.get(url)
        .then( (res) =>{
          console.log('homa')
          console.log(res.data.datos);
          var respuesta = res.data;
          me.array_datos = respuesta.datos.data

        })
        .catch( (err) =>{
          console.log(err)
        })
      }
    },

    mounted() {
      this.datosEmpresa(1);
    }

    
  }
</script>
 
  
    <script>
    function init() {
  var inputFile = document.getElementById('inputFile1');
  inputFile.addEventListener('change', mostrarImagen, false);
}

function mostrarImagen(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(event) {
    var img = document.getElementById('img1');
    img.src= event.target.result;
  }
  reader.readAsDataURL(file);
}

window.addEventListener('load', init, false);
    </script>