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
                        <i class="fa fa-align-justify"></i> Items de Menu
                        <button type="button" @click="abrirModal('item_menu','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="titulo">Nombre Item Menu</option>
                                      <option value="">Descripción</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarItemMenu(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarItemMenu(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>id Item Menu</th>
                                    <th>Nombre Item Menu</th>
                                    <th>Url</th>
                                    <th>Item menu padre</th>
                                    <th>Menu al que pertenece</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item_menu in arrayItemMenu" :key="item_menu.id_item_menu">
                                    <td>
                                        <button type="button" @click="abrirModal('item_menu','actualizar',item_menu)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="item_menu.activo">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarItemMenu(item_menu.id_item_menu)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarItemMenu(item_menu.id_item_menu)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="item_menu.id_item_menu"></td>
                                    <td v-text="item_menu.titulo"></td>
                                    <td v-text="item_menu.url_menu"></td>
                                    <td v-text="item_menu.titulo_padre"></td>
                                    <td v-text="item_menu.titulo_menu"></td>
                                    
                                    <td>
                                        <div v-if="item_menu.activo">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Menu</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_menu">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="menu in arrayMenu" :key="menu.id_menu" :value="menu.id_menu" v-text="menu.titulo"></option>

                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Menu padre</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_item_superior">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="item_menu in arrayItemPadre" :key="item_menu.id_item_menu" :value="item_menu.id_item_menu" v-text="item_menu.titulo"></option>

                                        </select>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="titulo" class="form-control" placeholder="Nombre del item de menu">    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Url</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="url_menu" class="form-control" placeholder="Ingrese la url">
                                    </div>
                                </div>

                                <div v-show="errorItemMenu" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjItemMenu" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarItemMenu()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarItemMenu()">Actualizar</button>
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
                id_item_menu : 0,
                item_menu_id : 0,
                id_padre : 0,
                id_menu: 0,
                id_item_superior: 0,
                titulo: '',
                url_menu: '',
                arrayItemMenu : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorItemMenu : 0,
                errorMostrarMsjItemMenu : [],
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
                arrayMenu : [],
                arrayItemPadre : []
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
            listarItemMenu (page,buscar,criterio){
                let me=this;
                var url= '/itemmenu?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    //console.log(response);
                    Promise.resolve (this);
                    var respuesta= response.data;
                    me.arrayItemMenu = respuesta.items_menu.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMenu(){
                let me=this;
                var url= '/menu/selectMenus';
                axios.get(url).then(function (response) {
                    //console.log(response);

                    var respuesta= response.data;
                    me.arrayMenu = respuesta.menus;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },

            selectItemPadre(){
                let me=this;
                var url= '/itemmenu/selectItemsPadre';
                axios.get(url).then(function (response) {
                    //console.log(response);

                    var respuesta= response.data;
                    me.arrayItemPadre = respuesta.items_padre;
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
                me.listarItemMenu(page,buscar,criterio);
            },
            registrarItemMenu(){
                if (this.validarItemMenu()){
                    return;
                }
                
                let me = this;

                axios.post('/itemmenu/registrar',{
                    'id_padre': this.id_padre,
                    'id_menu': this.id_menu,
                    'titulo': this.titulo,
                    'url_menu': this.url_menu
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarItemMenu(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarItemMenu(){
               if (this.validarItemMenu()){
                    return;
                }
                
                let me = this;

                axios.put('/itemmenu/actualizar',{
                    'id_item_superior': this.id_item_superior,
                    'id_menu': this.id_menu,
                    'titulo': this.titulo,
                    'url_menu': this.url_menu,
                    'id_item_menu': this.item_menu_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarItemMenu(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarItemMenu(item_menu_id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Esta seguro de desactivar este item de menu?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/itemmenu/desactivar',{
                            'id_item_menu': item_menu_id
                        }).then(function (response) {
                            me.listarItemMenu(1,'','titulo');
                        
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
            activarItemMenu(item_menu_id){
               const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Esta seguro de activar este item de menu?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/itemmenu/activar',{
                            'id_item_menu': item_menu_id
                        }).then(function (response) {
                            me.listarItemMenu(1,'','titulo');
                        
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
            validarItemMenu(){
                this.errorItemMenu=0;
                this.errorMostrarMsjItemMenu =[];

                if (this.id_menu==0) this.errorMostrarMsjItemMenu.push("Seleccione un menu");
                if (!this.titulo) this.errorMostrarMsjItemMenu.push("El nombre del item de menu no puede estar vacío.");
                

                if (this.errorMostrarMsjItemMenu.length) this.errorItemMenu = 1;

                return this.errorItemMenu;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.id_padre=0;
                this.id_menu=0;
                this.titulo='';
                this.url_menu='';
                this.errorItemMenu=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "item_menu":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Item Menu';
                                this.tipoAccion = 1;
                                this.id_padre=0;
                                this.id_menu=0;
                                this.titulo='';
                                this.url_menu='';
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Menu';
                                this.tipoAccion=2;
                                this.item_menu_id =data['id_item_menu'];
                                this.id_item_superior=data['id_item_superior'];
                                this.id_menu=data['id_menu'];
                                this.titulo= data['titulo'];
                                this.url_menu=data['url_menu'];
                                break;
                            }
                        }
                    }
                }
                this.selectMenu();
                this.selectItemPadre();
            }
        },
        mounted() {
            this.listarItemMenu(1,this.buscar,this.criterio);
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
