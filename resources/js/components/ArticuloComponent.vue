<template>
    <main class="main">
        <!-- Breadcrumb -->
        <section class="content-header">
            <h1>
                Modulo
                <small>de Articulos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Articulos</li>
            </ol>
        </section>
        <section class="content">
            <!-- Ejemplo de tabla Listado -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Listado Articulos</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="pull-right">
                        <button type="button" @click="abrirModal('articulo','registrar')" class="btn btn-primary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                        <button type="button" @click="cargarPdf()" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>
                    </div> <br><br>
                    <div class="row">
                        <div class="col-xs-4 col-md-3">
                            <select class="form-control " v-model="criterio">
                                <option value="nombre">Nombre</option>
                                <option value="descripcion">Descripción</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" v-model="buscar" @keyup.enter="listarArticulo(1,buscar,criterio)"
                                class="form-control" placeholder="Texto a buscar">
                        </div>
                        <div class="col-xs-3">
                            <button type="submit" @click="listarArticulo(1,buscar,criterio)" class="btn btn-primary"><i
                                    class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>

                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th>Descripción</th>
                                    <th>producto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="articulo in arrayArticulo" :key="articulo.id">
                                    <td>
                                        <button type="button" @click="abrirModal('articulo','actualizar',articulo)"
                                            class="btn btn-primary btn-sm" title="Editar">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <template v-if="articulo.condicion">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                @click="desactivarArticulo(articulo.id)" title="Desactivar">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm"
                                                @click="activarArticulo(articulo.id)" title="Activar">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </template>
                                       <!-- &nbsp;<button type="button" class="btn btn-danger btn-sm"
                                            @click="eliminarArticulo(articulo.id)" title="Eliminar">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        -->
                                    </td>
                                    <td v-text="articulo.codigo"></td>
                                    <td v-text="articulo.nombre"></td>
                                    <td v-text="articulo.nombre_categoria"></td>
                                    <td v-text="articulo.precio_venta"></td>
                                    <td v-text="articulo.stock"></td>
                                    <td v-text="articulo.descripcion"></td>
                                    <td>
                                        <!--
                                            <div v-if="articulo.idmedia">
                                            <img :src="articulo.file_url" height="100px" width="100px">
                                        </div>
                                        <div v-else>
                                            <img :src="'https://res.cloudinary.com/drrzmfkvx/image/upload/v1634782978/logo/318277_80538-Sin_imagen_disponible_cul5ns.jpg'"
                                                height="100px" width="100px">
                                        </div>
                                       -->


                                    </td>

                                    <td>
                                        <div v-if="articulo.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page"
                                :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)"
                                    v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="box-footer">

                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
        </section>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal modal-primary" style="overflow: hidden;" tabindex="-1" :class="{'mostrar' : modal}"
            role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="cerrarModal()"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Categoría</label>
                                        <select class="form-control" v-model="idcategoria">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id"
                                                :value="categoria.id" v-text="categoria.nombre"></option>
                                        </select>
                                        <!--
                                            <label v-if="errors.idcategoria" class="text-danger">*
                                            {{errors.idcategoria[0]}}</label>
                                       -->
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Articulo</label>
                                        <input type="text" v-model="nombre" class="form-control"
                                            placeholder="Nombre de artículo">
                                        <label v-if="errors.nombre" class="text-danger">* {{errors.nombre[0]}}</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Precio Venta</label>
                                        <input type="number" v-model="precio_venta" class="form-control">

                                        <label v-if="errors.precio_venta" class="text-danger">*
                                            {{errors.precio_venta[0]}}</label>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Stock</label>
                                        <input type="number" v-model="stock" class="form-control" placeholder="">
                                        <label v-if="errors.stock" class="text-danger">* {{errors.stock[0]}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-16">
                                <div class="form-group">
                                    <label class="control-label">Descripción</label>
                                    <textarea name="" v-model="descripcion" class="form-control"
                                        placeholder="Ingrese descripción" cols="40" rows="3"></textarea>

                                    <label v-if="errors.descripcion" class="text-danger">*
                                        {{errors.descripcion[0]}}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Código</label>
                                        <input type="text" v-model="codigo" class="form-control"
                                            placeholder="Código de barras">
                                        <label v-if="errors.codigo" class="text-danger">* {{errors.codigo[0]}}</label>
                                    </div>

                                    <div class="form-group">
                                        <barcode :value="codigo" :options="{ format: 'EAN-13' }">
                                            Generando código de barras.
                                        </barcode>
                                    </div>


                                </div>
                                <!--
      <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="my-file">Select Image</label>
                                        <input type="file" accept="image/*" @change="previewImage"
                                            class="form-control-file" id="my-file">

                                        <ul class="mailbox-attachments clearfix">

                                            <li>

                                                <template v-if="preview">
                                                    <span class="mailbox-attachment-icon has-img"><img :src="preview"
                                                            height="100px" width="100"></span>

                                                    <div class="mailbox-attachment-info">
                                                        <a @click="reset" class="btn btn-danger btn-block btn-social "
                                                            target="_blank"> Quitar imagen</a>

                                                    </div>
                                                </template>
                                            </li>

                                        </ul>

                                        <div class="border p-2 mt-3">
                                            <p>Vist Previa:</p>

                                        </div>
                                    </div>
                                </div>
-->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-outline"
                            @click="registrarArticulo()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-outline"
                            @click="actualizarArticulo()">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin del modal-->
    </main>
</template>

<script>
    import VueBarcode from 'vue-barcode';
    export default {
        data() {
            return {
                articulo_id: 0,
                idcategoria: 0,
                nombre_categoria: '',
                codigo: '',
                nombre: '',
                precio_venta: 0,
                stock: 0,
                descripcion: '',
                arrayArticulo: [],
                preview: null,
                image: null,
                no_image: '',
                preview_list: [],
                image_list: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorArticulo: 0,
                errorMostrarMsjArticulo: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                errors: {},
                offset: 3,
                criterio: 'nombre',
                buscar: '',
                arrayCategoria: []
            }
        },
        components: {
            'barcode': VueBarcode
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
            async listarArticulo(page, buscar, criterio) {
                let me = this;
                var url = '/articulo?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                await axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayArticulo = respuesta.articulos.data;
                    me.pagination = respuesta.pagination;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            cargarPdf() {
                window.open('/articulo/listarPdf', '_blank');
            },
            async selectCategoria() {
                let me = this;
                var url = '/categoria/selectCategoria';
                await axios.get(url).then(function (response) {
                    console.log(response);
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias;
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
                me.listarArticulo(page, buscar, criterio);
            },
            async registrarArticulo() {
                let me = this;

                try {
                    await axios.post('/articulo/registrar', {
                        'idcategoria': this.idcategoria,
                        'codigo': this.codigo,
                        'nombre': this.nombre,
                        'stock': this.stock,
                        'precio_venta': this.precio_venta,
                        'descripcion': this.descripcion
                    }).then(function (response) {
                        me.cerrarModal();
                        me.cerrarModal();
                        Swal.fire(
                            'Guardado!',
                            'El registro ha sido guardado con éxito.',
                            'success'
                        );
                        me.listarArticulo(1, '', 'nombre');
                    })
                } catch (error) {
                    console.log(error.response.data);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Algo salio mas!",
                         footer: error.response.data.message,
                    });
                    if (error.response.data) {
                        this.errors = error.response.data.errors;
                    }
                }

            },
          async  actualizarArticulo() {
                let me = this;
                try {
                    await   axios.put('/articulo/actualizar', {
                    'idcategoria': this.idcategoria,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'stock': this.stock,
                    'precio_venta': this.precio_venta,
                    'descripcion': this.descripcion,
                    'id': this.articulo_id
                }).then(function (response) {
                    me.cerrarModal();
                    Swal.fire(
                        'Actualizado!',
                        'El registro ha sido actualizado con éxito.',
                        'success'
                    );
                    me.listarArticulo(1, '', 'nombre');
                })
                } catch (error) {
                    console.log(error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Algo salio mas!",
                         footer: error.response.data.message,
                    });
                    if (error.response.data) {
                        this.errors = error.response.data.errors;
                    }
                }
            },
            desactivarArticulo(id) {
                Swal.fire({
          title: "Esta seguro de desactivar esta categoría?",
          text: "No podra utilizar esta informacion",

          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "Aceptar",
        }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/articulo/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarArticulo(1, '', 'nombre');
                            
                Swal.fire(
                  "Desactivado!",
                  "El registro ha sido desactivado con éxito.",
                  "success"
                );
                        }).catch(function (error) {
                            console.log(error);
                             Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Algo salio mas!",
                   footer: error.response.data.message,
                });
                        });


                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {

                    }
                })
            },
            activarArticulo(id) {
                Swal.fire({
          title: "Esta seguro de activar esta categoría?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "Aceptar",
        }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/articulo/activar', {
                            'id': id
                        }).then(function (response) {
                            me.listarArticulo(1, '', 'nombre');
                             Swal.fire(
                  "Activado!",
                  "El registro ha sido activado con éxito.",
                  "success"
                );
                        }).catch(function (error) {
                            console.log(error);
                                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Algo salio mas!",
                   footer: error.response.data.message,
                });
                        });


                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {

                    }
                })
            },
           
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.idcategoria = 0;
                this.nombre_categoria = '';
                this.codigo = '';
                this.nombre = '';
                this.precio_venta = 0;
                this.stock = 0;
                this.descripcion = '';
                this.errorArticulo = 0;
            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "articulo":
                        {
                            switch (accion) {
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'Registrar Artículo';
                                        this.idcategoria = 0;
                                        this.nombre_categoria = '';
                                        this.codigo = '';
                                        this.nombre = '';
                                        this.precio_venta = 0;
                                        this.stock = 0;
                                        this.descripcion = '';
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                        //console.log(data);
                                        this.modal = 1;
                                        this.tituloModal = 'Actualizar Artículo';
                                        this.tipoAccion = 2;
                                        this.articulo_id = data['id'];
                                        this.idcategoria = data['idcategoria'];
                                        this.codigo = data['codigo'];
                                        this.nombre = data['nombre'];
                                        this.stock = data['stock'];
                                        this.precio_venta = data['precio_venta'];
                                        this.descripcion = data['descripcion'];
                                        break;
                                    }
                            }
                        }
                }
                this.selectCategoria();
            }
        },
        mounted() {
            this.listarArticulo(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
    .mostrar {
        display: list-item !important;

    }

    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
</style>