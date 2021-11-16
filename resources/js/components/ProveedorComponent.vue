<template>
    <main class="main">
        <section class="content-header">
            <h1>
                Modulo
                <small>de Proveedores</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="active">Proveedores</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Listado Proveedores</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="pull-right">
                        <button type="button" @click="abrirModal('persona', 'registrar')" class="btn btn btn-primary">
                            <i class="fa fa-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <br /><br />
                    <div class="row">
                        <div class="col-xs-4 col-md-3">
                            <select class="form-control" v-model="criterio">
                                <option value="nombre">Nombre</option>
                                <option value="num_documento">Documento</option>
                                <option value="email">Email</option>
                                <option value="telefono">Teléfono</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" v-model="buscar" @keyup.enter="listarPersona(1, buscar, criterio)"
                                class="form-control" placeholder="Texto a buscar" />
                        </div>
                        <div class="col-xs-3">
                            <button type="submit" @click="listarPersona(1, buscar, criterio)" class="btn btn-primary">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>

                    <br>

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Tipo Documento</th>
                                    <th>Número</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Contacto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.id">
                                    <td>
                                        <button type="button" @click="abrirModal('persona','actualizar',persona)"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="persona.tipo_documento"></td>
                                    <td v-text="persona.num_documento"></td>
                                    <td v-text="persona.direccion"></td>
                                    <td v-text="persona.telefono"></td>
                                    <td v-text="persona.email"></td>
                                    <td v-text="persona.contacto"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                <!-- /.box-body -->
                <div class="box-footer"></div>
                <!-- /.box-footer-->
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </section>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal modal-primary" style="overflow: hidden" tabindex="-1" :class="{ mostrar: modal }"
            role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="cerrarModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nombre (*)</label>
                                    <input type="text" v-model="nombre" class="form-control"
                                        placeholder="Nombre de la empresa" />
                                    <label v-if="errors.nombre" class="text-danger">* {{errors.nombre[0]}}</label>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="email-input">Dirección</label>
                                    <input type="text" v-model="direccion" class="form-control"
                                        placeholder="Dirección" />
                                    <label v-if="errors.direccion" class="text-danger">* {{errors.direccion[0]}}</label>



                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="text-input">Tipo Documento</label>

                                    <select v-model="tipo_documento" class="form-control">
                                        <option value="C.I">C.I</option>
                                        <option value="RUC">RUC</option>
                                        <option value="PASS">PASS</option>
                                    </select>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="text-input">Número</label>
                                    <input type="text" v-model="num_documento" class="form-control"
                                        placeholder="Número de documento" />
                                        <label v-if="errors.num_documento" class="text-danger">* {{errors.num_documento[0]}}</label>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" v-model="email" class="form-control" placeholder="Email" />
                                    <label v-if="errors.email" class="text-danger">* {{errors.email[0]}}</label>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Teléfono</label>
                                    <input type="text" v-model="telefono" class="form-control" placeholder="Teléfono" />
                                    <label v-if="errors.telefono" class="text-danger">* {{errors.telefono[0]}}</label>



                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Contacto</label>
                                    <input type="text" v-model="contacto" class="form-control"
                                        placeholder="Nombre del contacto">
                                        <label v-if="errors.contacto" class="text-danger">* {{errors.contacto[0]}}</label>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Teléfono de
                                        contacto</label>
                                    <input type="text" v-model="telefono_contacto" class="form-control"
                                        placeholder="Teléfono del contacto">
                                        <label v-if="errors.telefono_contacto" class="text-danger">* {{errors.telefono_contacto[0]}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" @click="cerrarModal()">
                            Cerrar
                        </button>
                        <button type="button" v-if="tipoAccion == 1" class="btn btn-outline"
                            @click="registrarPersona()">
                            Guardar
                        </button>
                        <button type="button" v-if="tipoAccion == 2" class="btn btn-outline"
                            @click="actualizarPersona()">
                            Actualizar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
    </main>
</template>

<script>
    export default {

        data() {

            return {
                persona_id: 0,
                nombre: '',
                tipo_documento: 'RUC',
                num_documento: '',
                direccion: '',
                telefono: '',
                email: '',
                contacto: '',
                telefono_contacto: '',

                arrayPersona: [],
                modal: 0,
                tituloModal: "",
                tipoAccion: 0,
                errorPersona: 0,
                errorMostrarMsjPersona: [],
                pagination: {
                    total: 0,
                    current_page: 0,
                    per_page: 0,
                    last_page: 0,
                    from: 0,
                    to: 0,
                },
                errors: {},
                offset: 3,
                criterio: "nombre",
                buscar: "",
            };
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

                var to = from + this.offset * 2;
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
        },
        methods: {
            async listarPersona(page, buscar, criterio) {
                let me = this;
                var url =
                    '/proveedor?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                await axios
                    .get(url)
                    .then(function (response) {
                        var respuesta = response.data;
                        me.arrayPersona = respuesta.personas.data;
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
                me.listarPersona(page, buscar, criterio);
            },
            async registrarPersona() {

                let me = this;


                await axios.post("/proveedor/registrar", {
                    'nombre': this.nombre,
                    'tipo_documento': this.tipo_documento,
                    'num_documento': this.num_documento,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                    'email': this.email,
                    'contacto': this.contacto,
                    'telefono_contacto': this.telefono_contacto
                })
                    .then(response => {
                        console.log(response)
                        me.cerrarModal();
                        Swal.fire(
                            "Guardado!",
                            "El registro ha sido guardado con éxito.",
                            "success"
                        );
                        me.listarPersona(1, "", "nombre");
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Algo salio mas!",
                            footer: error.response.data.message,
                        });
                        if (error.response.data) {
                            this.errors = error.response.data.errors;
                        }


                    })



            },
            async actualizarPersona() {

                let me = this;

                try {
                    await axios.put("/proveedor/actualizar", {
                        'nombre': this.nombre,
                        'tipo_documento': this.tipo_documento,
                        'num_documento': this.num_documento,
                        'direccion': this.direccion,
                        'telefono': this.telefono,
                        'email': this.email,
                        'contacto': this.contacto,
                        'telefono_contacto': this.telefono_contacto,
                        'id': this.persona_id
                    })
                        .then(function (response) {
                            me.cerrarModal();
                            Swal.fire(
                                "Actualizado!",
                                "El registro ha sido actualizado con éxito.",
                                "success"
                            );
                            me.listarPersona(1, "", "nombre");
                        })
                } catch (error) {
                    console.log(error.response)
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

            cerrarModal() {
                this.modal = 0;
                this.tituloModal = "";
                this.nombre = "";
                this.tipo_documento = "C.I";
                this.num_documento = "";
                this.direccion = "";
                this.telefono = "";
                this.email = "";
                this.errorPersona = 0;
                this.errors = {};
            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "persona": {
                        switch (accion) {
                            case "registrar": {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Proveedor';
                                this.nombre = '';
                                this.tipo_documento = 'RUC';
                                this.num_documento = '';
                                this.direccion = '';
                                this.telefono = '';
                                this.email = '';
                                this.contacto = '';
                                this.telefono_contacto = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar": {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Proveedor';
                                this.tipoAccion = 2;
                                this.persona_id = data['id'];
                                this.nombre = data['nombre'];
                                this.tipo_documento = data['tipo_documento'];
                                this.num_documento = data['num_documento'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.email = data['email'];
                                this.contacto = data['contacto'];
                                this.telefono_contacto = data['telefono_contacto'];

                                break;
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            this.listarPersona(1, this.buscar, this.criterio);
        },
    };
</script>