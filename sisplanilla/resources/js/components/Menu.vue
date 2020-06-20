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
                        <i class="fa fa-align-justify"></i> Menus
                        <button type="button" @click="abrirModal('menu','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="titulo">Nombre Menu</option>
                                      <option value="vista">Descripción</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarMenu(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMenu(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>id Menu</th>
                                    <th>Nombre Menu</th>
                                    <th>Rol</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="menu in arrayMenu" :key="menu.id_menu">
                                    <td>
                                        <button type="button" @click="abrirModal('menu','actualizar',menu)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="menu.activo">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMenu(menu.id_menu)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarMenu(menu.id_menu)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="menu.id_menu"></td>
                                    <td v-text="menu.titulo"></td>
                                    <td v-text="menu.nombre_rol"></td>
                                    <td v-text="menu.vista"></td>
                                    <td>
                                        <div v-if="menu.activo">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Rol</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_rol">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="rol in arrayRol" :key="rol.id_rol" :value="rol.id_rol" v-text="rol.nombre"></option>

                                        </select>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="titulo" class="form-control" placeholder="Nombre del menu">    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Vista</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="vista" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>

                                <div v-show="errorMenu" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMenu" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarMenu()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMenu()">Actualizar</button>
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
                menu_id: 0,
                id_rol : 0,
                titulo : '',
                vista : '',
                arrayMenu : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMenu : 0,
                errorMostrarMsjMenu : [],
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
                arrayRol : []
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
            listarMenu (page,buscar,criterio){
                let me=this;
                var url= '/menu?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMenu = respuesta.menus.data;
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
                    //console.log(response);

                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
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
                me.listarMenu(page,buscar,criterio);
            },
            registrarMenu(){
                if (this.validarMenu()){
                    return;
                }
                
                let me = this;

                axios.post('/menu/registrar',{
                    'id_rol': this.id_rol,
                    'titulo': this.titulo,
                    'vista': this.vista
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMenu(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarMenu(){
               if (this.validarMenu()){
                    return;
                }
                
                let me = this;

                axios.put('/menu/actualizar',{
                    'id_rol': this.id_rol,
                    'titulo': this.titulo,
                    'vista': this.vista,
                    'id_menu': this.menu_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMenu(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarMenu(menu_id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Esta seguro de desactivar este menu?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/menu/desactivar',{
                            'id_menu': menu_id
                        }).then(function (response) {
                            me.listarMenu(1,'','titulo');
                        
                            swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro ha sido desactivado con éxito.',
                            'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                        
                        

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El registro no ha sido desactivado',
                        'error'
                        )
                    }
                    })
                 
            },
            activarMenu(menu_id){
               const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Esta seguro de activar este menu?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/menu/activar',{
                            'id_menu': menu_id
                        }).then(function (response) {
                            me.listarMenu(1,'','titulo');
                        
                            swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El registro ha sido activado con éxito.',
                            'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                        
                        

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El registro no ha sido activado.',
                        'error'
                        )
                    }
                    })
                 
            },
            validarMenu(){
                this.errorMenu=0;
                this.errorMostrarMsjMenu =[];

                if (this.id_rol==0) this.errorMostrarMsjMenu.push("Seleccione un rol");
                if (!this.titulo) this.errorMostrarMsjMenu.push("El nombre del menu no puede estar vacío.");
                if (!this.vista) this.errorMostrarMsjMenu.push("La descripcion no puede estar vacía.");

                if (this.errorMostrarMsjMenu.length) this.errorMenu = 1;

                return this.errorMenu;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.id_rol=0;
                this.titulo='';
                this.vista='';
                this.errorMenu=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "menu":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Menu';
                                this.tipoAccion = 1;
                                this.id_rol=0;
                                this.titulo='';
                                this.vista='';
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Menu';
                                this.tipoAccion=2;
                                this.menu_id=data['id_menu'];
                                this.id_rol = data['id_rol'];
                                this.titulo= data['titulo'];
                                this.vista = data['vista'];
                                break;
                            }
                        }
                    }
                }
                this.selectRol();
            }
        },
        mounted() {
            this.listarMenu(1,this.buscar,this.criterio);
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
