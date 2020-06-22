<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Empresa
                        <button type="button" @click="abrirModal('empresa','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEmpresa(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEmpresa(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>ID</th>
                                    <th>Ubicacion</th>
                                    <th>Actividad</th>
                                    <th>Tipo</th>
                                    <th>Representante legal</th>
                                    <th>Identificador NIC</th>
                                    <th>Identificador NIT</th>
                                    <th>Telefono</th>
                                    <th>Pagina web</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="empresa in arrayEmpresa" :key="empresa.id_empresa">
                                    <td>
                                        <button type="button" @click="abrirModal('empresa','actualizar',empresa)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        
                                        
                                    </td>

                                    <td v-text="empresa.id_empresa"></td>
                                    <td v-text="empresa.direccioncom"></td>
                                    <td v-text="empresa.actividad"></td>
                                    <td v-text="empresa.tipo"></td>
                                    <td v-text="empresa.representante_legal"></td>
                                    <td v-text="empresa.identificador_nic"></td>
                                    <td v-text="empresa.identificador_nit"></td>
                                    <td v-text="empresa.telefono"></td>
                                    <td v-text="empresa.pagina_web"></td>
                                    <td>
                                        <!-- <div v-if="articulo.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        -->
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="iddireccion">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="direcciones in arrayDireccion" :key="direcciones.id_direccion" :value="direcciones.id_direccion" v-text="direcciones.ubicacion"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Actividad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="actividad" class="form-control" placeholder="Actividad de la empresa">                                   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de Empresa</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="tipo" class="form-control" placeholder="Tipo de Empresa">                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Representante legal</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="representante_legal" class="form-control" placeholder="Representante legal">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Identificador NIC</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="identificador_nic" class="form-control" placeholder="Numero de NIC">                                        
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Identificador NIT</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="identificador_nit" class="form-control" placeholder="Numero de NIT">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono" class="form-control" placeholder="Numero de telefono">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Pagina Web</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="pagina_web" class="form-control" placeholder="Pagina web">
                                    </div>
                                </div>
                                <div v-show="errorEmpresa" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEmpresa" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEmpresa()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEmpresa()">Actualizar</button>
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
        data (){
            return {
                empresa_id: 0,
                iddireccion : 0,
                actividad : '',
                tipo : '',
                representante_legal : '',
                identificador_nic : '',
                identificador_nit : '',
                telefono : '',
                pagina_web : '',
                arrayEmpresa : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorEmpresa : 0,
                errorMostrarMsjEmpresa : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayDireccion :[]
            }
        },
        components: {
       
    },
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
        methods : {
            listarEmpresa (page,buscar,criterio){
                let me=this;
                var url= '/empresa?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayEmpresa = respuesta.empresa.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectDireccion(){
                let me=this;
                var url= '/direccion/selectDireccion';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayDireccion = respuesta.direcciones;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarEmpresa(page,buscar,criterio);
            },
            registrarEmpresa(){
                if (this.validarEmpresa()){
                    return;
                }
                
                let me = this;

                axios.post('/empresa/registrar',{
                    'id_direccion': this.iddireccion,
                    'actividad': this.actividad,
                    'tipo': this.tipo,
                    'representante_legal': this.representante_legal,
                    'identificador_nic': this.identificador_nic,
                    'identificador_nit': this.identificador_nit,
                    'telefono': this.telefono,
                    'pagina_web': this.pagina_web
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEmpresa(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarEmpresa(){
               if (this.validarEmpresa()){
                    return;
                }
                
                let me = this;

                axios.put('/empresa/actualizar',{
                    'id_direccion': this.iddireccion,
                    'actividad': this.actividad,
                    'tipo': this.tipo,
                    'representante_legal': this.representante_legal,
                    'identificador_nic': this.identificador_nic,
                    'identificador_nit': this.identificador_nit,
                    'telefono': this.telefono,
                    'pagina_web': this.pagina_web,
                    'id_empresa': this.empresa_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEmpresa(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarEmpresa(id){
               swal({
                title: 'Esta seguro de desactivar esta empresa?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/empresa/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEmpresa(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarEmpresa(id){
               swal({
                title: 'Esta seguro desea activar esta empresa?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/empresa/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEmpresa(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarEmpresa(){
                this.errorEmpresa=0;
                this.errorMostrarMsjEmpresa =[];

                if (this.iddireccion==0) this.errorMostrarMsjEmpresa.push("Seleccione una direccion.");
                if (!this.actividad) this.errorMostrarMsjEmpresa.push("La actividad de la empresa no puede estar vacío.");
                if (!this.tipo) this.errorMostrarMsjEmpresa.push("El tipo de empresa no puede estar vacío.");
                if (!this.representante_legal) this.errorMostrarMsjEmpresa.push("El representante legal de la empresa no puede estar vacío.");
                if (!this.identificador_nic) this.errorMostrarMsjEmpresa.push("El identificador NIC de la empresa no puede estar vacío.");
                if (!this.identificador_nit) this.errorMostrarMsjEmpresa.push("El identificador NIT de la empresa no puede estar vacío.");
                if (!this.telefono) this.errorMostrarMsjEmpresa.push("El telefono de la empresa no puede estar vacío.");
                if (!this.pagina_web) this.errorMostrarMsjEmpresa.push("La pagina web de la empresa no puede estar vacío.");

                if (this.errorMostrarMsjEmpresa.length) this.errorEmpresa = 1;

                return this.errorEmpresa;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.iddireccion= 0;
                this.actividad = '';
                this.tipo = '';
                this.representante_legal = '';
                this.identificador_nic = '';
                this.identificador_nit = '';
                this.telefono = '';
                this.pagina_web = '';
                this.errorEmpresa= 0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "empresa":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Empresa';
                                this.iddireccion= 0;
                                this.actividad = '';
                                this.tipo = '';
                                this.representante_legal = '';
                                this.identificador_nic = '';
                                this.identificador_nit = '';
                                this.telefono = '';
                                this.pagina_web = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Empresa';
                                this.tipoAccion=2;
                                this.empresa_id=data['id_empresa'];
                                this.iddireccion=data['id_direccion'];
                                this.actividad=data['actividad'];
                                this.tipo = data['tipo'];
                                this.representante_legal=data['representante_legal'];
                                this.identificador_nic=data['identificador_nic'];
                                this.identificador_nit=data['identificador_nit'];
                                this.telefono= data['telefono'];
                                this.pagina_web= data['pagina_web'];
                                break;
                            }
                        }
                    }
                }
                this.selectDireccion();
            }
        },
        mounted() {
            this.listarEmpresa(1,this.buscar,this.criterio);
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
        font-weight: bold;
    }
</style>
