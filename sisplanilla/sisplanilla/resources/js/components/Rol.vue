<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Administrador</li>
                <li class="breadcrumb-item">Mantenimiento</li>
                <li class="breadcrumb-item">Permisos de acceso</li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Roles
                        <button type="button" @click="abrirModal('rol', 'registrar')"  class="btn btn-success btn-nuevo">
                            <i class="icon-plus"></i> <span style="margin-left:2%">Nuevo</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarRol(1, buscar, criterio)" class="form-control col-md-5" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarRol(1, buscar, criterio)" class="btn btn-primary btn-buscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center">ID</th>
                                    <th>Nombre</th>
                                    <th>Privilegios</th>
                                    <th style="text-align: center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rol in arrayRol" :key="rol.id_rol">
                                    <td v-text="rol.id_rol" style="text-align: center"></td>
                                    <td v-text="rol.nombre"></td>
                                    <td style="font-size: 80%">
                                        <p style="margin-bottom: 0%" v-for="(rp, index) in arrayRolesPrivilegios" :key="index + rp.id_privilegio">
                                            <span v-if="rol.id_rol == rp.id_rol" v-text="'• '+rp.nombre"></span>
                                        </p>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModalVincular(rol.id_rol, rol.nombre)" class="btn btn-info btn-sm btn-circle-text-white">
                                          <i class="icon-plus"></i> <i class="icon-minus"></i>
                                        </button>
                                        <button type="button" @click="abrirModal('rol', 'actualizar', rol)" class="btn btn-warning btn-sm btn-circle-text-white">
                                          <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button" @click="abrirModalEliminar(rol)" class="btn btn-danger btn-sm btn-circle">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar, criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar, criterio)" v-text="page"></a>
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
                                    <label for="nombre">Nombre</label>
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese el nombre del rol">
                                </div>
                                <div v-show="errorRol" class="form-group div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjRol" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>                               
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-circle-text-white" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarRol()" class="btn btn-primary btn-circle">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarRol()"  class="btn btn-primary btn-circle">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal -->
            <!--Inicio del modal vincular/desvincular privilegios-->
            <div class="modal fade" :class="{'mostrar': modalVincular}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Asignar Privilegios a: {{nombre}}</h4>
                            <button type="button" @click="cerrarModalVincular()" class="close" aria-label="Close">
                              <span aria-hidden="true" style="color:white">×</span>
                            </button>
                        </div>
                        <div id="modal-vinculacion" class="modal-body" style="padding:4%;max-height:400px;overflow-y:scroll;">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                                <div>
                                    <div v-for="(p, i) in arrayPrivilegios" :key="i" class="form-group">
                                        <div v-if="privilegioAnterior(p.id_privilegio)">
                                            <h6 style="color:white;border-radius:10px;background-color:#91bdcc; padding-left: 2%; padding-top: 2%; padding-bottom: 2%;" v-text="p.entidad"></h6>
                                        </div>
                                        <input @click="agregarVinculacion(id_rol, p.id_privilegio)" v-bind:checked="buscarEnRolActual(id_rol, p.id_privilegio)" style="margin-left:3%" type="checkbox" class="form-check-input input-checked_rp">
                                        <label style="margin-left:9%" v-text="p.nombre"></label>
                                    </div>    
                                </div>                              
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-circle-text-white" @click="cerrarModalVincular()">Cerrar</button>
                            <button @click="guardarListaRP()" type="button" class="btn btn-primary btn-circle">Guardar vinculación de privilegios</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal -->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" :class="{'mostrar' : modalEliminar}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Rol</h4>
                            <button type="button" class="close" @click="cerrarModalEliminar()" aria-label="Close">
                              <span aria-hidden="true" style="color:white">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar el Rol: <span v-text="nombre"></span>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-circle-text-white" @click="cerrarModalEliminar()">Cerrar</button>
                            <button type="button" class="btn btn-danger btn-circle" @click="eliminarRol(id_rol)">Eliminar</button>
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
        data (){
            return {
                id_rol: 0,
                nombre : '',
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorRol: 0,
                errorMostrarMsjRol: [],
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
                modalEliminar: 0,
                arrayRolesPrivilegios: [],
                modalVincular: 0,
                //PARA ALMACENAR LAS VINCULACIONES SELECCIONADAS
                arrayVinculacionCheck: [],
                arrayVinculacionOriginal: [],
                arrayPrivilegios: []
            }
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

            //LISTA DE ROLES CON PRIVILEGIOS ASIGNADOS
            listarRol (page,buscar,criterio){
                let me=this;
                var url= '/rol?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles.data;
                    me.pagination = respuesta.pagination;
                    me.arrayRolesPrivilegios = respuesta.roles_privilegios;
                    me.arrayPrivilegios = respuesta.privilegios;
                    console.log(respuesta);
                    console.log(respuesta.roles_privilegios);
                    //console.log("PRIVILEGIOS: "+JSON.stringify(me.arrayPrivilegios));
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            //PAGINACION
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarRol(page,buscar,criterio);
            },

            //VERIFICAR LA VINCULACION NO ASIGNADA ANTERIOR PARA ESTABLECER TITULO DE ENTIDAD
            privilegioAnterior(id){
                var ban = 0;
                var index = -1;
                var verificarEntidad = this.arrayPrivilegios.find(function(item, i){
                    if(item.id_privilegio === id){
                        index = i;
                    }
                });
                //console.log(index);
                if(index === '0' || index === 0){
                    ban = 1;
                    //console.log(this.arrayRolesPrivilegios[index-1]+" "+this.arrayRolesPrivilegios[index]['entidad']);
                } else {
                    if(this.arrayPrivilegios[index-1]['entidad'] !== this.arrayPrivilegios[index]['entidad']){
                    ban = 1;
                    //console.log('PONER NUEVO TITULO['+index+']: '+this.arrayRolesPrivilegios[index-1]['entidad']+" "+this.arrayRolesPrivilegios[index]['entidad']);
                    } else {
                        ban = 0;
                        //console.log('SEGUIR['+index+']: '+this.arrayRolesPrivilegios[index-1]['entidad']+" "+this.arrayRolesPrivilegios[index]['entidad']);
                    }
                }
                return ban;
            },

            //IMPRIMIR CHECKBOX SEGUN ROL Y ENTIDAD ANTERIOR
            rolAnterior(id){
                var ban = 0;
                var index = -1;
                this.arrayRolesPrivilegios.find(function(item, i){
                    if(item.id === id){
                        index = i;
                    }
                });
                
                //console.log(index);
                if(index === '0' || index === 0){
                    ban = 1;
                    //console.log(this.arrayRolesPrivilegios[index-1]+" "+this.arrayRolesPrivilegios[index]['entidad']);
                } else {
                    if(this.arrayRolesPrivilegios[index-1]['entidad'] !== this.arrayRolesPrivilegios[index]['entidad']){
                    ban = 1;
                    //console.log('PONER NUEVO TITULO['+index+']: '+this.arrayRolesPrivilegios[index-1]['entidad']+" "+this.arrayRolesPrivilegios[index]['entidad']);
                    } else if(this.arrayRolesPrivilegios[index-1]['id_rol'] === this.arrayRolesPrivilegios[index]['id_rol']){
                        ban = 1;
                        //console.log('SEGUIR['+index+']: '+this.arrayRolesPrivilegios[index-1]['entidad']+" "+this.arrayRolesPrivilegios[index]['entidad']);
                    } else {
                        ban = 0;
                    }
                }
                return ban;
            },

            //VERIFICAR SI EXISTE
            buscarEnRolActual(id_rol, id_privilegio){
                var ban = false;
                var verificarVinculacion = this.arrayRolesPrivilegios.find(function(item, i){
                    //console.log('NUEVA COMPARACION');
                    //console.log('*ID ROL: '+item.id_rol+', *ID PRIVILEGIO: '+item.id_privilegio);
                    //console.log('ID ROL: '+id_rol+', ID PRIVILEGIO: '+id_privilegio);
                    if(parseInt(item.id_rol) === parseInt(id_rol) && parseInt(item.id_privilegio) === parseInt(id_privilegio)){
                        ban = true;

                    }
                });

                console.log(ban);
                return ban;
            },

            //DETECTA CUANDO SE PRESIONA EL INPUT
            agregarVinculacion(id_rol, id_privilegio){
                var array = this.arrayVinculacionCheck;
                var ban = 0;
                var index = 0;
                for(let vin in array){
                    if(parseInt(array[vin].id_rol) === parseInt(id_rol) && parseInt(array[vin].id_privilegio) === parseInt(id_privilegio)){
                    ban = 1;
                    index = vin;
                    }
                }
                if(ban === 1){
                    this.arrayVinculacionCheck.splice(index, 1);
                } else {
                    this.arrayVinculacionCheck.push({id_rol:id_rol, id_privilegio:id_privilegio});
                }

            },

            //Guardar vinculacion de privilegios a un rol
            guardarListaRP(){
                let me=this;
                console.log('ORIGINAL: '+JSON.stringify(this.arrayVinculacionOriginal));
                console.log('CHECK: '+JSON.stringify(this.arrayVinculacionCheck));
                axios.post('/rolprivilegio/registrar', {
                    'lista_original': JSON.stringify(this.arrayVinculacionOriginal),
                    'lista_diferencia':  JSON.stringify(this.arrayVinculacionCheck)
                })
                .then(function (response) {
                    me.cerrarModalVincular();
                    me.listarRol(me.pagination.current_page, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            //ABRIR MODAL DE VINCULACION DE PRIVILEGIO
            abrirModalVincular(id_rol, nombre){
                this.modalVincular = 1;
                this.id_rol = id_rol;
                this.nombre = nombre;
                var array = this.arrayRolesPrivilegios;
                for(var vin in array){
                    
                    if(parseInt(array[vin].id_rol) === parseInt(id_rol)){
                        //console.log(array[vin].id_rol);
                        this.arrayVinculacionCheck.push({id_rol:array[vin].id_rol, id_privilegio:array[vin].id_privilegio});
                        this.arrayVinculacionOriginal.push({id_rol:array[vin].id_rol, id_privilegio:array[vin].id_privilegio});
                    }
                }
                //console.log('ARRo: '+this.arrayVinculacionCheck[0].id_rol);
                //this.arrayVinculacionOriginal = this.arrayVinculacionCheck;
                //console.log('ARRA: '+JSON.stringify(this.arrayVinculacionCheck));
                $('body, html').scrollTop(0); //Subir Scroll
            },

            //CERRAR MODAL DE VINCULACION DE PRIVILEGIO
            cerrarModalVincular(){
                this.modalVincular = 0;
                //console.log('ARRe: '+JSON.stringify(this.arrayVinculacionCheck));
                this.arrayVinculacionOriginal.length = 0;
                this.arrayVinculacionCheck.length = 0;
                this.id_rol = 0;
                this.nombre = 0;
                $('#modal-vinculacion').scrollTop(0); //Volver scroll hasta arriba en modal
                $('.input-checked_rp').prop("checked", false); //Limpiar checkbox
            },

            //ELIMINAR ROL
            eliminarRol(id_rol){
                console.log(id_rol);
                console.log(this.id_rol);
                let me=this;
                axios.put('/rol/eliminar', {
                    'id_rol': this.id_rol
                })
                .then(function (response) {
                    me.cerrarModalEliminar();
                    me.listarRol(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            
            //ABRIR MODAL ELIMINAR
            abrirModalEliminar(data = []){
                this.modalEliminar = 1;
                this.nombre = data['nombre'];
                this.id_rol = data['id_rol'];
                $('body, html').scrollTop(0); //Subir Scroll
            },

            //CERRAR MODAL
            cerrarModalEliminar(){
                this.modalEliminar = 0;
                this.nombre = '';
                this.id_rol = 0;
            },

            //REGISTRAR OBJETO
            registrarRol(){
                if (this.validarRol()){
                    return;
                }

                let me=this;
                axios.post('/rol/registrar', {
                    'nombre': this.nombre,
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarRol(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            //ACTUALIZAR OBJETO
            actualizarRol(){
                if (this.validarRol()){
                    return;
                }

                let me=this;
                axios.put('/rol/actualizar', {
                    'nombre': this.nombre,
                    'id_rol': this.id_rol
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarRol(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },            

            //VALIDACION DE CAMPOS
            validarRol(){
                this.errorRol = 0;
                this.errorMostrarMsjRol = [];

                if (!this.nombre) this.errorMostrarMsjRol.push("El nombre del rol no puede estar vacío.");

                if (this.errorMostrarMsjRol.length) this.errorRol = 1;

                return this.errorRol;
            },

            //ABRIR MODAL REGISTRAR/ACTUALIZAR
            abrirModal(modelo, accion, data = []){
                $('body, html').scrollTop(0); //Subir Scroll
            switch(modelo)
            {
                case "rol":
                    {
                        switch(accion){
                            case 'registrar':
                                {
                                    this.modal = 1;
                                    this.nombre = '';
                                    this.tituloModal = 'Registrar Rol';
                                    this.tipoAccion = 1;
                                    break
                                }
                            case 'actualizar':
                                {
                                    this.modal = 1;
                                    this.nombre = data['nombre'];
                                    this.id_rol = data['id_rol'];
                                    this.tituloModal = 'Actualizar Rol';
                                    this.tipoAccion = 2;
                                    break
                                }
                        }
                    }
            }
        },

        //CERRAR MODAL
        cerrarModal(){
            this.modal = 0;
            this.nombre = '';
            this.tituloModal = '';
            this.errorMostrarMsjRol = [];
            this.errorRol = 0;
        },

        },
        mounted() {
            this.listarRol(1, this.buscar, this.criterio);
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
