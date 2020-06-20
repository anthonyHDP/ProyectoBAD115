<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Administrador</li>
                <li class="breadcrumb-item">Mantenimiento</li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Usuarios
                        <button type="button" @click="abrirModal('usuario', 'registrar')"  class="btn btn-success btn-nuevo">
                            <i class="icon-plus"></i> <span style="margin-left:2%">Nuevo</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-4" v-model="criterio">
                                      <option value="username">Nombre Usuario</option>
                                      <option value="codigo_empleado">Codigo Empleado</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarUsuario(1, buscar, criterio)" class="form-control col-md-5" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarUsuario(1, buscar, criterio)" class="btn btn-primary btn-buscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center">ID</th>
                                    <th>Codigo empleado</th>
                                    <th>Nombre de usuario</th>
                                    <th>Rol asignado</th>
                                    <th>Activo</th>
                                    <th>Primer acceso</th>
                                    <th>Ultimo acceso</th>
                                    <th style="text-align: center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="usuario in arrayUsuario" :key="usuario.id_usuario">
                                    <td v-text="usuario.id_usuario" style="text-align: center"></td>
                                    <td v-text="usuario.codigo_empleado"></td>
                                    <td v-text="usuario.username"></td>
                                    <td v-text="usuario.nombre_rol"></td>
                                    <td v-if="usuario.activo == '1'">Sí</td>
                                    <td v-if="usuario.activo == '0'">No</td>
                                    <td v-if="usuario.first_session != null" v-text="usuario.first_session"></td>
                                        <td v-else>N/A</td>
                                    <td v-if="usuario.last_session != null" v-text="usuario.last_session"></td>
                                        <td v-else>N/A</td>
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModal('usuario', 'actualizar', usuario)" class="btn btn-warning btn-sm btn-circle-text-white">
                                          <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button" @click="abrirModalEliminar(usuario)" class="btn btn-danger btn-sm btn-circle">
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
                                <div v-if="tipoAccion == 1" class="form-group">
                                    <label for="text">Buscar empleado por codigo</label>
                                    <div class="row" style="margin-left:0.45%">
                                        <input v-model="codigo_empleado" maxlength="6" type="text" class="form-control col-md-3" placeholder="Ej. AA1000">
                                        <button id="btn_empleado" @click="selectEmpleado(codigo_empleado)" type="button" class="btn btn-success btn-buscar"><i class="fa fa-search"></i></button>
                                        <input id="empleado_input_e" type="text" class="form-control col-sm-7" style="font-style:italic; margin-left:5.5%; border:0; border-radius:6px; background: #eee" :value="nombres+' '+apellidos+'      '+codigo_empleado_res" disabled>      
                                        <span class="help-block" style="font-size:80%; margin-top:1%">(*) Debe consultar el codigo de empleado y si existe, se asociara ese empleado al usuario</span>
                                    </div>
                                </div>
                                <div v-if="tipoAccion == 2" class="form-group">
                                    <label for="text">Empleado</label>
                                    <input type="text" class="form-control" style="font-style:italic; border:0; border-radius:6px; background: #eee" :value="nombres+' '+apellidos+'      '+codigo_empleado_res" disabled>
                                </div>
                                <div v-if="tipoAccion == 2" class="form-group">
                                    <label for="text">Username</label>
                                    <input type="text" class="form-control" style="font-style:italic; border:0; border-radius:6px; background: #eee" :value="username" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="rol">Rol</label>
                                    <select id="rol_input_e" v-model="id_rol" class="form-control">
                                        <option value="0" selected>-- Seleccione rol --</option>
                                        <option v-for="rol in arrayRol" :key="rol.id_rol" :value="rol.id_rol" v-text="rol.nombre"></option>
                                    </select>
                                </div>
                               <!--  <div class="form-group">
                                    <label for="username">Nombre de usuario</label>
                                    <input type="text" v-model="username" class="form-control" placeholder="Ingrese el nombre de usuario">
                                </div> -->
                                <div v-if="tipoAccion == 1" class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password_input_e" type="text" v-model="password" maxlength="20" class="form-control" placeholder="Ingrese la contraseña">
                                </div>
                                
<!--                                 <div class="form-group">
                                    <label for="empleado">Empleado</label>
                                    <select v-model="codigo_empleado" class="form-control">
                                        <option value="" selected>-- Seleccione empleado --</option>
                                        <option v-for="empleado in arrayEmpleado" :key="empleado.codigo_empleado" :value="empleado.codigo_empleado" v-text="empleado.nombres+' '+empleado.apellidos"></option>
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label for="activo">Activo</label>
                                    <input v-if="activo==1" checked style="margin-left:5%" type="checkbox" v-model="activo" :value="activo" class="form-check-input" placeholder="Ingrese estado del usuario">
                                    <input v-if="activo==0" style="margin-left:5%" type="checkbox" v-model="activo" :value="activo" class="form-check-input" placeholder="Ingrese estado del usuario">
                                </div>
                                <div v-show="errorUsuario" class="form-group div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjUsuario" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>                               
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-circle-text-white" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarUsuario()" class="btn btn-primary btn-circle">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarUsuario()"  class="btn btn-primary btn-circle">Actualizar</button>
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
                            <h4 class="modal-title">Eliminar Usuario</h4>
                            <button type="button" class="close" @click="cerrarModalEliminar()" aria-label="Close">
                              <span aria-hidden="true" style="color:white">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar el Usuario: <span v-text="username"></span>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-circle-text-white" @click="cerrarModalEliminar()">Cerrar</button>
                            <button type="button" class="btn btn-danger btn-circle" @click="eliminarUsuario(id_usuario)">Eliminar</button>
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
                id_usuario: 0,
                id_rol: 0,
                nombre_rol: '',
                codigo_empleado: '',
                codigo_empleado_res: '',
                username: '',
                password: '',
                activo: 0,
                first_session: '',
                last_session: '',
                intentios_fallidos: '',
                arrayUsuario : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorUsuario: 0,
                errorMostrarMsjUsuario: [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'username',
                buscar : '',
                modalEliminar: 0,
                arrayEmpleado: [],
                nombre: '',
                nombres: '',
                apellidos: '',
                empleado: []
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
            listarUsuario (page,buscar,criterio){
                let me=this;
                var url= '/usuario?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta  = response.data;
                    me.arrayUsuario = respuesta.usuarios.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRol(){
                let me=this;
                var url= '/rol/selectRoles';
                axios.get(url).then(function (response) {
                    var respuesta  = response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectEmpleado(codigo_empleado){
                let me=this;
                var url= '/empleado/selectEmpleado?codigo_empleado='+codigo_empleado;
                axios.get(url).then(function (response) {
                    var respuesta  = response.data;
                    me.nombres = '';
                    me.apellidos = '';
                    me.codigo_empleado_res = '';
                    console.log("TIPO EMPLEADO[0]: "+ typeof response.data.empleado[0]);
                    console.log("RESPONSE "+response);
                    console.log("DATA: "+response.data);
                    console.log("EMPLEADO: "+response.data.empleado[0]);
                    if(me.tipoAccion == 1){
                        if(response.data.empleado[0] !== null && typeof response.data.empleado[0] !== 'undefined'){
                            console.log('BANDERA: '+response.data.bandera);
                            if(response.data.bandera != 0){
                                me.nombres = respuesta.empleado[0].primer_nombre+" "+respuesta.empleado[0].segundo_nombre;
                                me.apellidos = respuesta.empleado[0].primer_apellido+" "+respuesta.empleado[0].segundo_apellido;
                                me.codigo_empleado_res = codigo_empleado;
                                document.getElementById("empleado_input_e").style.border = "1px solid #ccc";
                            }else{
                                $('#empleado_input_e').val("El empleado ya es usuario");
                            }
                        } else {
                            console.log("NO EXISTE");
                            //$('#btn_empleado').trigger('click');
                            $('#empleado_input_e').val("El empleado no existe");
                        }
                    } else {
                        me.nombres = respuesta.empleado[0].primer_nombre+" "+respuesta.empleado[0].segundo_nombre;
                        me.apellidos = respuesta.empleado[0].primer_apellido+" "+respuesta.empleado[0].segundo_apellido;
                        me.codigo_empleado_res = codigo_empleado;
                    }
                    
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
                me.listarUsuario(page,buscar,criterio);
            },

            //ELIMINAR ROL
            eliminarUsuario(id_usuario){
                let me=this;
                axios.put('/usuario/eliminar', {
                    'id_usuario': this.id_usuario
                })
                .then(function (response) {
                    me.cerrarModalEliminar();
                    me.listarUsuario(1, '', 'username');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            
            //ABRIR MODAL ELIMINAR
            abrirModalEliminar(data = []){
                this.modalEliminar = 1;
                this.username = data['username'];
                this.id_usuario = data['id_usuario'];
            },

            //CERRAR MODAL
            cerrarModalEliminar(){
                this.modalEliminar = 0;
                this.username = '';
                this.id_usuario = 0;
            },

            //REGISTRAR OBJETO
            registrarUsuario(){
                if (this.validarUsuario()){
                    return;
                }

                let me=this;
                axios.post('/usuario/registrar', {
                    'nombres': this.nombres,
                    'apellidos': this.apellidos,
                    'username': this.username,
                    'id_rol': this.id_rol,
                    'codigo_empleado': this.codigo_empleado_res,
                    'password': this.password,
                    'activo': this.activo
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1, '', 'username');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            //ACTUALIZAR OBJETO
            actualizarUsuario(){
                if (this.validarUsuario()){
                    return;
                }

                let me=this;
                axios.put('/usuario/actualizar', {
                    'id_usuario': this.id_usuario,
                    'nombres': this.nombres,
                    'apellidos': this.apellidos,
                    'username': this.username,
                    'id_rol': this.id_rol,
                    'codigo_empleado': this.codigo_empleado_res,
                    'password': this.password,
                    'activo': this.activo
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1, '', 'username');
                }).catch(function (error) {
                    console.log(error);
                });
            },           

            //VALIDACION DE CAMPOS
            validarUsuario(){

                var empleado_input = document.getElementById("empleado_input_e");
                var rol_input = document.getElementById("rol_input_e");
                var password_input =  document.getElementById("password_input_e");

                this.errorMostrarMsjUsuario = [];
                this.errorUsuario = 0;

                if(empleado_input != null){
                    if (!this.codigo_empleado_res){
                    empleado_input.style.border = "1px solid red";
                    this.errorMostrarMsjUsuario.push("Debe asociar un empleado valido");
                    }else{
                        empleado_input.style.border = "1px solid #ccc";
                    }
                }
                
                if (!this.id_rol || rol_input.value.length == 0 || rol_input.value === 0 || rol_input.value === '0'){
                    rol_input.style.border = "1px solid red";
                    this.errorMostrarMsjUsuario.push("El usuario debe tener un Rol");
                }else{
                    rol_input.style.border = "1px solid #ccc";
                }

                if(password_input!=null){
                   if (!this.password){
                    password_input.style.border = "1px solid red";
                    this.errorMostrarMsjUsuario.push("El usuario debe tener una contrasenia");
                    }else{
                        password_input.style.border = "1px solid #ccc";
                    } 
                }
                

                if (this.errorMostrarMsjUsuario.length) this.errorUsuario = 1;

                return this.errorUsuario;
            },

            //ABRIR MODAL REGISTRAR/ACTUALIZAR
            abrirModal(modelo, accion, data = []){
            switch(modelo)
            {
                case "usuario":
                    {
                        switch(accion){
                            case 'registrar':
                                {
                                    this.modal = 1;
                                    this.tituloModal = 'Registrar Usuario';
                                    this.tipoAccion = 1;
                                    this.nombres = '';
                                    this.apellidos = '';
                                    this.username = '';
                                    this.id_rol = 0;
                                    this.codigo_empleado = '';
                                    this.password = '';
                                    this.activo = 0;
                                    break
                                }
                            case 'actualizar':
                                {
                                    this.modal = 1;
                                    this.tituloModal = 'Actualizar Usuario';
                                    this.tipoAccion = 2;
                                    this.id_usuario = data['id_usuario'];
                                    /* this.nombres = data['nombres'];
                                    this.apellidos = data['apellidos']; */
                                    this.username = data['username'];
                                    this.id_rol = data['id_rol'];
                                    this.codigo_empleado = data['codigo_empleado'];
                                    this.password = data['password'];
                                    this.activo = parseInt(data['activo']);
                                    /* console.log(data['activo']+' '+typeof(data['activo'])); */
                                    console.log(data['first_session']);
                                    this.selectEmpleado(data['codigo_empleado']);
                                    break
                                }
                        }
                    }
                this.selectRol();   
                // this.selectEmpleado(); 
            }
        },

        //CERRAR MODAL
        cerrarModal(){
            this.modal = 0;
            this.nombres = '',
            this.apellidos = '',
            this.username = '',
            this.id_rol = 0,
            this.codigo_empleado = '',
            this.password = '',
            this.activo = 0,
            this.empleado = [],
            this.tituloModal = '';
            this.errorMostrarMsjUsuario = [];
            this.errorUsuario = 0;
            this.codigo_empleado_res = '';
            if(document.getElementById("empleado_input_e")!=null) document.getElementById("empleado_input_e").value = "";
            if(document.getElementById("empleado_input_e")!=null) document.getElementById("empleado_input_e").style.border = "1px solid #ccc";
            document.getElementById("rol_input_e").style.border = "1px solid #ccc";
            if(document.getElementById("password_input_e")!=null) document.getElementById("password_input_e").style.border = "1px solid #ccc";
        },

        },
        mounted() {
            this.listarUsuario(1, this.buscar, this.criterio);
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
