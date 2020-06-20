<template>
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Administrador</li>
                <li class="breadcrumb-item">Mantenimiento</li>
                <li class="breadcrumb-item">Permisos de acceso</li>
                <li class="breadcrumb-item active">Privilegios</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Privilegios
                        <button @click="abrirModal('privilegio', 'registrar')" type="button" class="btn btn-success btn-nuevo">
                            <i class="icon-plus"></i> <span style="margin-left:2%">Nuevo</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="accion">Acción</option>
                                      <option value="entidad">Entidad</option>
                                      <option value="todos">Todos</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPrivilegios(1, buscar, criterio)" class="form-control col-md-5" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPrivilegios(1, buscar, criterio)" class="btn btn-primary btn-buscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>             
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center">ID</th>
                                    <th>Nombre</th>
                                    <th>Acción</th>
                                    <th>Entidad de contexto</th>
                                    <th style="text-align: center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="privilegio in arrayPrivilegio" :key="privilegio.id_privilegio">
                                    <td v-text="privilegio.id_privilegio" style="text-align: center"></td>
                                    <td v-text="privilegio.nombre"></td>
                                    <td v-text="privilegio.accion"></td>
                                    <td v-text="privilegio.entidad"></td>
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModal('privilegio', 'actualizar', privilegio)" class="btn btn-warning btn-sm btn-circle-text-white">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="abrirModalEliminar(privilegio)" class="btn btn-danger btn-sm btn-circle">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary" role="document" style="border-radius: 4px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true" style="color:white">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding:4%">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                                <div class="form-group">
                                    <label for="accion">Acción</label>
                                    <select v-model="accion" class="form-control" name="accion">
                                        <option value="" selected>-- Seleccione acción permitida --</option>
                                        <option value="CREAR">Crear</option>
                                        <option value="ACTUALIZAR">Actualizar</option>
                                        <option value="ELIMINAR">Eliminar</option>
                                        <option value="CONSULTAR">Consultar</option>
                                        <option value="*">Todas las operaciones</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="entidad">Entidad de Contexto</label>
                                    <select v-model="entidad" class="form-control" name="entidad">
                                        <option value="" selected>-- Seleccione entidad de contexto --</option>
                                        <option value="COSTOS-GEN">Centro de costos general</option>
                                        <option value="COSTOS-ORG">Centro de costos organizacional</option>
                                        <option value="EMPLEADO">Empleado</option>
                                        <option value="INGR-DEDU">Ingresos y descuentos</option>
                                        <option value="MENU">Menu</option>
                                        <option value="ORGANIZACION">Organización</option>
                                        <option value="PERIODO">Periodo</option>
                                        <option value="PLANILLA">Planilla</option>
                                        <option value="PRIVILEGIO">Privilegio</option>
                                        <option value="PROFESION">Profesion</option>
                                        <option value="PUESTO">Puesto</option>
                                        <option value="ROL">Rol</option>
                                        <option value="SALARIO">Catalogo salarial</option>
                                        <option value="USUARIO">Usuario</option>
                                    </select>
                                </div>                                    
                                <div v-show="errorPrivilegio" class="form-group div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPrivilegio" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-circle-text-white" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarPrivilegio()" class="btn btn-primary btn-circle">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarPrivilegio()"  class="btn btn-primary btn-circle">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" :class="{'mostrar' : modalEliminar}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Privilegio</h4>
                            <button type="button" class="close" @click="cerrarModalEliminar()" aria-label="Close">
                              <span aria-hidden="true" style="color:white">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar el Privilegio: <span v-text="nombre"></span>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-circle-text-white" @click="cerrarModalEliminar()">Cerrar</button>
                            <button type="button" class="btn btn-danger btn-circle" @click="eliminarProvilegio(id_privilegio)">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
        </main>
</template>

<script>
    export default {
        data(){
            return{
                id_privilegio:0,
                nombre:'',
                accion:'',
                entidad:'',
                arrayPrivilegio: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorPrivilegio: 0,
                errorMostrarMsjPrivilegio: [],
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
                buscar: '',
                modalEliminar: 0
            }
        },

        //LOGICA DE PAGINACION
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },

        //METODOS UTILIZADOS PARA ACCIONAR BOTONES Y VISUALIZAR MODALS
        methods: {

            //LISTAR OBJETOS
            listarPrivilegios(page, buscar, criterio){
                if(criterio=='todos'){ criterio='nombre'; buscar='';}

                let me=this;
                var url= '/privilegio?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url)
                .then(function (response) {
                    var respuesta= response.data;
                    me.arrayPrivilegio = respuesta.privilegios.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            //PAGINACION: CAMBIO DE PAGINA
            cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPrivilegios(page, buscar, criterio);
            },

            //REGISTRAR OBJETO
            registrarPrivilegio(){
                if (this.validarPrivilegio()){
                    return;
                }

                let me=this;
                axios.post('/privilegio/registrar', {
                    'nombre': this.accion+" "+this.entidad,
                    'accion': this.accion,
                    'entidad': this.entidad
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarPrivilegios(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            //ACTUALIZAR OBJETO
            actualizarPrivilegio(){
                if (this.validarPrivilegio()){
                    return;
                }

                let me=this;
                axios.put('/privilegio/actualizar', {
                    'nombre': this.accion+" "+this.entidad,
                    'accion': this.accion,
                    'entidad': this.entidad,
                    'id_privilegio': this.id_privilegio
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarPrivilegios(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            //VALIDACION DE CAMPOS
            validarPrivilegio(){
                this.errorPrivilegio = 0;
                this.errorMostrarMsjPrivilegio = [];

                if (!this.accion) this.errorMostrarMsjPrivilegio.push("La acción del privilegio no puede estar vacío.");
                if (!this.entidad) this.errorMostrarMsjPrivilegio.push("La entidad de contexto del privilegio no puede estar vacío.");

                if (this.errorMostrarMsjPrivilegio.length) this.errorPrivilegio = 1;

                return this.errorPrivilegio;
            },

            //CERRAR MODAL
            cerrarModal(){
                this.modal = 0;
                this.nombre = '';
                this.accion = '';
                this.entidad = '';
                this.tituloModal = '';
                this.errorMostrarMsjPrivilegio = [];
                this.errorRol = 0;
            },

            //ABRIR MODAL REGISTRAR/ACTUALIZAR
            abrirModal(modelo, accion, data = []){
            switch(modelo)
            {
                case "privilegio":
                    {
                        switch(accion){
                            case 'registrar':
                                {
                                    this.modal = 1;
                                    this.nombre = '';
                                    this.accion = '';
                                    this.entidad = '';
                                    this.tituloModal = 'Registrar Privilegio';
                                    this.tipoAccion = 1;
                                    break
                                }
                            case 'actualizar':
                                {
                                    this.modal = 1;
                                    this.accion = data['accion'];
                                    this.entidad = data['entidad'];
                                    this.id_privilegio = data['id_privilegio'];
                                    this.tituloModal = 'Actualizar Privilegio';
                                    this.tipoAccion = 2;
                                    break
                                }
                        }
                    }
            }
        },

        //ELIMINAR PRIVILEGIO
        eliminarProvilegio(id_privilegio){
            let me=this;
            axios.put('/privilegio/eliminar', {
                'id_privilegio': this.id_privilegio
            })
            .then(function (response) {
                me.cerrarModalEliminar();
                me.listarPrivilegios(1, '', 'nombre');
            }).catch(function (error) {
                console.log(error);
            });
        },
        
        //ABRIR MODAL ELIMINAR
        abrirModalEliminar(data = []){
            this.modalEliminar = 1;
            this.nombre = data['nombre'];
            this.id_privilegio = data['id_privilegio'];
        },

        //CERRAR MODAL
        cerrarModalEliminar(){
            this.modalEliminar = 0;
            this.nombre = '';
            this.id_privilegio = 0;
        },

    },

    //PARTE DEL CICLO DE VIDA DE VUE
    mounted() {
        this.listarPrivilegios(1, this.buscar, this.criterio);
    }
    }
</script>

<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: normal !important;
        font-style:italic;
    }
    .btn-circle{
        border-radius: 4px;
    }
    .btn-circle-text-white{
        border-radius: 4px; color:white;
    }
    .btn-nuevo{
        margin-left:1%;
        margin-top:0.2% !important; 
        border-radius: 6px; 
        color:white !important;
    }
    .btn-buscar{
        border-top-right-radius:4px;
        border-bottom-right-radius:4px;
    }
</style>
