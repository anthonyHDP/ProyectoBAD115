<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Empleados</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Empleados
                        <button type="button" @click="abrirModal('empleado','registrar')" class="btn btn-secondary" >
                            <i class="icon-plus" ></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="primer_nombre,segundo_nombre">Nombres de Empleado</option>
                                      <option value="primer_apellido,segundo_apellido">Apellidos de Empleado</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEmpleado(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEmpleado(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center">ID</th>
                                    <th>Codigo Empleado</th>
                                    <th>Primer Nombre</th>
                                    <th>Segundo Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Segundo Apellido</th>
                                    <th>Email-Personal</th>
                                    <th>Email-Institucional</th>
                                    <th>Estado</th>
                                    <th style="text-align: center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <tr v-for="empleado in arrayEmpleado" :key="empleado.codigo_empleado">
                                    <td v-text="empleado.codigo_empleado" style="text-align: center"></td>
                                    <td v-text="empleado.primer_nombre"></td>
                                    <td v-text="empleado.segundo_nombre"></td>
                                    <td v-text="empleado.primer_apellido"></td>
                                    <td v-text="empleado.segundo_apellido"></td>
                                    <td v-text="empleado.email_personal"></td>
                                    <td v-text="empleado.email_institucional"></td>

                                    <td v-if="empleado.activo == '1'">Sí</td>
                                    <td v-if="empleado.activo == '0'">No</td>
                                    
                                    <td style="text-align: center;">
                                        <button type="button" @click="abrirModal('empleado', 'actualizar', usuario)" class="btn btn-warning btn-sm btn-circle-text-white">
                                          <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button" @click="abrirModalEliminar(empleado)" class="btn btn-danger btn-sm btn-circle">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                  <!--
                                <tr v-for="empleado in arrayEmpleado" :key="empleado.codigo_empleado">

                                    <td style="text-aling:center;">
                                        <button type="button" @click="abrirModal('empleado','actualizar',empleado)" class="btn btn-warning btn-sm"  >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="empleado.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarEmpleado(empleado.codigo_empleado)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>   
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarEmpleado(empleado.codigo_empleado)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template> 
                                    </td>
                                    <td v-text="empleado.codigo_empleado"></td>
                                    <td v-text="empleado.primer_nombre"></td>
                                    <td v-text="empleado.segundo_nombre"></td>
                                    <td v-text="empleado.primer_apellido"></td>
                                    <td v-text="empleado.segundo_apellido"></td>
                                    <td v-text="empleado.email_personal"></td>
                                    <td v-text="empleado.email_institucional"></td>
                                    
                                    <td>
                                        <div v-if="empleado.condicion">
                                              <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                              <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                    </td>
                                </tr>
                                -->
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page>1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page-1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page==isActived? 'active' :'']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                        
                                <li class="page-item" v-if="pagination.current_page<pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page+1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            
            <div class="modal fade" tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y:auto;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true" style="Color:white">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding:4%">
                            <div class="row">
                                <div class="col-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home_direccion-tab" data-toggle="pill" href="#v-pills-home_direccion" role="tab" aria-controls="v-pills-home_direccion" aria-selected="true">Ingreso de Direccion de Empleado</a>
                                    <a class="nav-link" id="v-pills-profile_contacto-tab" data-toggle="pill" href="#v-pills-profile_contacto" role="tab" aria-controls="v-pills-profile_contacto" aria-selected="false">Ingreso de Contactos Telefonicos</a>
                                    <a class="nav-link" id="v-pills-messages_identificacion-tab" data-toggle="pill" href="#v-pills-messages_identificacion" role="tab" aria-controls="v-pills-messages_identificacion" aria-selected="false">Ingreso de Documentos de Identificacion</a>
                                    <a class="nav-link" id="v-pills-settings_empleado-tab" data-toggle="pill" href="#v-pills-settings_empleado" role="tab" aria-controls="v-pills-settings_empleado" aria-selected="false">Ingreso de Datos de Empleados</a>
                                     <a class="nav-link" id="v-pills-settings_codigo_jefe-tab" data-toggle="pill" href="#v-pills-settings_codigo_jefe" role="tab" aria-controls="v-pills-settings_codigo_jefe" aria-selected="false">Asignacion de Jefe</a>
                                    <a class="nav-link" id="v-pills-settings_contrato-tab" data-toggle="pill" href="#v-pills-settings_contrato" role="tab" aria-controls="v-pills-settings" aria-selected="false">Contrato de Trabajo</a>
                                   
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home_direccion" role="tabpanel" aria-labelledby="v-pills-home_direccion-tab">
                                     
                                     
                                     <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ubicacion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="ubicacion" class="form-control" placeholder="Ingrese su Ubicacion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Numero de Vivienda</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="numero_vivienda" class="form-control" placeholder="Ingrese el numero de vivienda">
                                    </div>
                                </div>   
                                    <div class="form-group row">
                                    <div class="col-md-6 form-control-label">
                                    <label for="direcciones">Departamento</label>
                                    <select v-model="codigo_departamento" class="form-control">
                                        <option value="0" selected>-- Seleccione el Departamento --</option>
                                        <option v-for="direccion_departamentos in arraycodigo_departamento" :key="direccion_departamentos.codigo_departamento" :value="direccion_departamentos.codigo_departamento" v-text="direccion_departamentos.nombre"></option>
                                    </select>
                                    
                                </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 form-control-label">
                                    <label for="direcciones">Municipio</label>
                                    <select v-model="codigo_municipio" class="form-control">
                                        <option value="0" selected>-- Seleccione el Municipio --</option>
                                        <option v-for="direccion_municipios in arraycodigo_municipio" :key="direccion_municipios.codigo_municipio" :value="direccion_municipios.codigo_municipio " v-text="direccion_municipios.nombre"></option>
                                    </select>
                                    
                                </div>
                                </div>
                                
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile_contacto" role="tabpanel" aria-labelledby="v-pills-profile_contacto-tab">
                                  
                                

                                    <div class="form-group row">
                                          <label class="col-md-8 form-control-label" for="text-input"><b>Datos de Contactos Telefonicos</b></label>
                                    <div class="col-md-6 form-control-label">
                                    <label for="tipos_contacto_telefonico">Tipo de contacto</label>
                                    <select v-model="id_tipo_contacto_telefonico" class="form-control">
                                        <option value="0" selected>-- Seleccione el tipo de contacto Telefonico --</option>
                                        <option v-for="contactos in arrayid_tipo_contacto_telefonico" :key="contactos.id_tipo_contacto_telefonico" :value="contactos.id_tipo_contacto_telefonico" v-text="contactos.titulo"></option>
                                    </select>
                                    
                                </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Numero Telefonico</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="numero" class="form-control" placeholder="Ingrese Numero Telefonico">
                                    </div>
                                </div>
                                 

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages_identificacion" role="tabpanel" aria-labelledby="v-pills-messages_identificacion-tab">
                                        
                                        <div class="form-group row">
                                          <label class="col-md-8 form-control-label" for="text-input"><b>Datos de Identificacion</b></label>
                                    <div class="col-md-7 form-control-label">
                                    <label for="tipos_Identificacion">Tipo de Identificacion</label>
                                    <select v-model="id_tipo_identificacion" class="form-control">
                                        <option value="0" selected>-- Seleccione el tipo de Indentificacion --</option>
                                        <option v-for="identificaciones in arrayid_tipo_identificacion" :key="identificaciones.id_tipo_identificacion" :value="identificaciones.id_tipo_identificacion" v-text="identificaciones.titulo"></option>
                                    </select>
                                    
                                </div>
                                 </div>
                               
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Detalles-Indetificacion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="detalles" class="form-control" placeholder="Ingrese Detalles de Identificacion">
                                    </div>
                                </div>
                                
                                 
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings_empleado" role="tabpanel" aria-labelledby="v-pills-settings_empleado-tab">
                                        <div class="form-group row">
                                  <label class="col-md-5 form-control-label" for="text-input"><b>Datos Relevantes del Empleado</b></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Nombres</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="primer_nombre" class="form-control" placeholder="Primer nombre">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="segundo_nombre" class="form-control" placeholder="Segundo nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text_input">Apellidos</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="primer_apellido" class="form-control" placeholder="Primer Apellido">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="segundo_apellido" class="form-control" placeholder="Segundo Apellido">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Correo Personal</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="email_personal" class="form-control" placeholder="Ingrese Correo Personal">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text_input">Correo Institucional</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="email_institucional" class="form-control" placeholder="Ingrese Correo Institucional">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text_input">Fecha Nacimiento</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="fecha_nacimiento" class="form-control" placeholder="Ingresela en el formato dd-mm-yyy">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text_input">Identificador ISSS</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="identificador_isss" class="form-control" placeholder="Ingrese el identificador de ISSS">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text_input">Identificador NUP</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="identificador_nup" class="form-control" placeholder="Ingrese el identificador de NUP">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text_input">Identificador NIT</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="identificador_nit" class="form-control" placeholder="Ingrese el identificador de NIT">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                <div class="col-md-6 form-control-label">
                                    <label for="generos">Genero</label>
                                    
                                    <select v-model="id_genero" class="form-control">
                                        <option value="0" selected>-- Seleccione el Genero --</option>
                                        <option v-for="generos in arraygenero" :key="generos.id_genero" :value="generos.id_genero" v-text="generos.titulo"></option>
                                    </select>
                                    
                                </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-md-6 form-control-label">
                                    <label for="text_input"> Profesion</label>
                                    <select v-model="codigo_profesion" class="form-control">
                                        <option value="0" selected>-- Seleccione Profesion --</option>
                                        <option v-for="profesiones in arraycodigo_profesion" :key="profesiones.codigo_profesion" :value="profesiones.codigo_profesion" v-text="profesiones.titulo"></option>
                                    </select>
                                 </div>
                                </div>
                                 
                                <div class="form-group row">
                                <div class="col-md-6 form-control-label">
                                    <label for="text_input">Estado Civil</label>
                                    <select v-model="id_estado_civil" class="form-control">
                                        <option value="0" selected>-- Seleccione el Estado Civil --</option>
                                        <option v-for="Estados_Civiles in arrayid_estado_civil" :key="Estados_Civiles.id_estado_civil" :value="Estados_Civiles.id_estado_civil" v-text="Estados_Civiles.titulo"></option>
                                    </select>
                                 </div>
                                </div>
                               
                                
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-settings_codigo_jefe" role="tabpanel" aria-labelledby="v-pills-profile_settings_codigo_jefe-tab">
                                <!--
                                <div class="form-group row">
                                 <div class="col-md-6 form-control-label">
                                    <label for="text_input"> Asignacion de Jefe</label>
                                    <select v-model="codigo_empleado" class="form-control">
                                        <option value="text" selected>-- Seleccione Jefe --</option>
                                        <option v-for="empleados_jefe in arraycodigo_empleado" :key="empleados_jefe.codigo_empleado" :value="empleados_jefe.codigo_empleado" 
                                        v-text="empleados_jefe.codigo_empleado"></option>
                                    </select>
                                 </div>
                                </div>
                                -->
                                     
                                <div v-if="tipoAccion == 1" class="form-group">
                                    <label for="text">Buscar empleado por codigo-Asignacion-Jefe</label>
                                    <div class="row" style="margin-left:0.45%">
                                        <input v-model="codigo_empleado" maxlength="6" type="text" class="form-control col-md-3" placeholder="Ej. AA1000">
                                        <button id="btn_empleado" @click="selectEmpleado(codigo_empleado)" type="button" class="btn btn-success btn-buscar"><i class="fa fa-search"></i></button>
                                        <input id="empleado_input_e" type="text" class="form-control col-sm-7" style="font-style:italic; margin-left:5.5%; border:0; border-radius:6px; background: #eee" :value="nombres+' '+apellidos+'      '+codigo_empleado_res" disabled>      
                                        <span class="help-block" style="font-size:80%; margin-top:1%">(*) Debe consultar el codigo de empleado y si existe, se asociara el jefe al Empleado a registrar</span>
                                    </div>
                                </div>
                                <div v-if="tipoAccion == 2" class="form-group">
                                    <label for="text">Empleado</label>
                                    <input type="text" class="form-control" style="font-style:italic; border:0; border-radius:6px; background: #eee" :value="nombres+' '+apellidos+'      '+codigo_empleado_res" disabled>
                                </div>
                                  <!--
                                  <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Asignacion de Jefe</label>
                                            <div class="col-md-9">
                                                <input type='input' v-model="codigo_jefe" class="form-control" placeholder="Ingrese el id de su Jefe">
                                            </div>
                                    </div>
                                     
                                     -->

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings_contrato" role="tabpanel" aria-labelledby="v-pills-settings_contrato-tab">
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Tipo de Contrato</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="email_personal" class="form-control" placeholder="Ingrese Tipo de Contrato">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text_input">Fecha de Inicio de Contrato</label>
                                            <div class="col-md-9">
                                                <input type="date" v-model="email_institucional" class="form-control" placeholder="Ingrese Fecha Inicial">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text_input">Fecha de Finalizacion de Contrato</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="fecha_nacimiento" class="form-control" placeholder="Ingrese Fecha de Finalizacion">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text_input">Duracion de Contrato</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="identificador_isss" class="form-control" placeholder="Ingrese La Duracion de Contrato">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text_input">Salario de Empleado</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="identificador_nup" class="form-control" placeholder="Ingrese el Salario">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="activo">Vigencia de Contrato</label>
                                            
                                            
                                        </div>
                                
                                    </div>
                                     
                                    </div>
                                </div>
                                </div>
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                
                                <div v-show="errorEmpleado" class="form-group row div-error">
                                       <div class="text-center text-error">

                                           <div v-for="error in errorMostrarMsjEmpleado" :key="error" v-text="error">

                                           </div>

                                       </div> 
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEmpleado()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEmpleado()">Actualizar</button>
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
        data(){
          return {
  
              
              primer_nombre: '',
              segundo_nombre:'',
              primer_apellido: '',
              segundo_apellido:'',
              email_personal:'',
              email_institucional:'',
              fecha_nacimiento:'',
              identificador_isss:'',
              identificador_nup:'',
              identificador_nit:'',
              codigo_empleado_res: '',
              ubicacion:'',
              numero:'',
              numero_vivienda:'',
              detalles:'',
              codigo_profesion:0,
              codigo_empleado:'',
              codigo_jefe:'',
              id_direccion:0,
              numero_documento_identificacion:0,
              id_estado_civil:0,
              id_genero:0,
              id_contacto_telefonico:0,
              id_tipo_contacto_telefonico:0,
              codigo_municipio:0,
              codigo_departamento:0,
              id_tipo_identificacion:0,
              arraycodigo_profesion:[],
              arraycodigo_empleado:[],
              arrayid_direccion:[],
              arrayEmpleado:[],
              arrayid_estado_civil:[],
              arraygenero:[],
              arrayid_tipo_contacto_telefonico:[],
              arraycodigo_municipio:[],
              arraycodigo_departamento:[],
              arrayid_tipo_identificacion:[],
              modal:0,
              tituloModal:'',
              tipoAccion: 0,
              errorEmpleado: 0,
              errorMostrarMsjEmpleado:[],
              Empleado_id:0,
              pagination:{
                  'total':0,        
                  'current_page':0,
                  'per_page':0,     
                  'last_page':0,    
                  'from':0,         
                  'to':0           
              },
              offset:3,
              criterio:'nombre',
              buscar:''
            
          }   
        },
        computed: {
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from=this.pagination.current_page-this.offset;
                if(from<1){
                    from=1;
                }

                var to=from+(this.offset*2);
                if(to>=this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArray=[];
                while(from <=to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;

            }


        },
        methods:{
            listarEmpleado(page,buscar,criterio){
                let me=this;
                var url='/empleado?page='+ page +'&buscar='+ buscar +'&criterio='+criterio;
                axios.get(url).then(function (response) {
                     var respuesta=response.data;
                     me.arrayEmpleado=respuesta.empleados.data;
                     me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                        console.log(error);
                });
            },
            
            
            selectEmpleado(){
                let me=this;
                var url= '/empleados/selectEmpleado';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arraycodigo_empleado = respuesta.empleados_jefe;
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
                                me.nombres = respuesta.empleado[0].primer_nombre+" "+respuesta.empleado[0].segundo_nombre;
                                me.apellidos = respuesta.empleado[0].primer_apellido+" "+respuesta.empleado[0].segundo_apellido;
                                me.codigo_empleado_res = codigo_empleado;
                                document.getElementById("empleado_input_e").style.border = "1px solid #ccc";
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
            
            selectProfesion(){
                let me=this;
                var url= '/profesiones/selectProfesion';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arraycodigo_profesion = respuesta.profesiones;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            
            selectDireccionMunicipio(){
                let me=this;
                var url= '/direccion_municipio/selectDireccionMunicipio';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arraycodigo_municipio = respuesta.direccion_municipios;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            selectDireccionDepartamento(){
                let me=this;
                var url= '/direccion_departamento/selectDireccionDepartamento';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arraycodigo_departamento = respuesta.direccion_departamentos;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            selectEstadoCivil(){
                let me=this;
                var url= '/estados_civiles/selectEstadoCivil';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayid_estado_civil = respuesta.Estados_Civiles;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            selectGenero(){
                let me=this;
                var url= '/generos/selectGenero';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arraygenero = respuesta.generos;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            selectContacto(){
                let me=this;
                var url= '/tipo_contacto_telefonico/selectContacto';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayid_tipo_contacto_telefonico = respuesta.contactos;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            selectIdentificacion(){
                let me=this;
                var url= '/tipos_identificacion/selectIdentificacion';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayid_tipo_identificacion = respuesta.identificaciones;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },

            cambiarPagina(page,buscar,criterio){
                  let me = this;
                  //Actualizar la Pagina Actual
                  me.pagination.current_page=page; 
                  //Envia la Peticion para visualizar la data de esa Pagina
                  me.listarEmpleado(page,buscar,criterio);
            },
             desactivarEmpleado(id){
                    const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta seguro de desactivar esta Empleado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                            let me=this; 
                    axios.put('/empleado/desactivar',{
                        'id':id
                    }).then(function (response) {
                            me.listarEmpleado(1,'','primer_nombre');
                            swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El Registro ha sido desactivado con Exito.',
                            'success'
                            )
                        })
                        .catch(function (error) {
                                console.log(error);
                        });
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Operacion Cancelada',
                    'La Operacion ah sido Cancelada con Exito :)',
                    'error'
                    )
                }
                })
             },
             activarEmpleado(id){
                    const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta seguro de Activar esta Empleado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                            let me=this; 
                    axios.put('/empleado/activar',{
                        'id':id
                    }).then(function (response) {
                            me.listarEmpleado(1,'','primer_nombre');
                            swalWithBootstrapButtons.fire(
                            'Ativado!',
                            'El Registro ha sido activado con Exito.',
                            'success'
                            )
                        })
                        .catch(function (error) {
                                console.log(error);
                        });
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Operacion Cancelada',
                    'La Operacion ah sido Cancelada con Exito :)',
                    'error'
                    )
                }
                })
             },
             validarEmpleado(){
               var empleado_input = document.getElementById("empleado_input_e");
               var rol_input = document.getElementById("rol_input_e");
               var password_input =  document.getElementById("password_input_e");
               this.errorEmpleado=0;
               this.errorMostrarMsjEmpleado=[]; 
               if(!this.primer_nombre)this.errorMostrarMsjEmpleado.push("El Nombre de la Empleado no puede estar Vacio");
               
               if(this.errorMostrarMsjEmpleado.length) this.errorEmpleado=1;

               return this.errorEmpleado;

             },
             registrarEmpleado(){
                if(this.validarEmpleado()){
                  return;

                }
                let me=this; 
               axios.post('/empleado/registrar',{
                   'primer_nombre':this.primer_nombre,
                   'segundo_nombre':this.segundo_nombre,
                   'primer_apellido':this.primer_apellido,
                   'segundo_apellido':this.segundo_apellido,  
                   'email_personal':this.email_personal,
                   'email_institucional':this.email_institucional,
                   'fecha_nacimiento':this.fecha_nacimiento,
                   'identificador_isss':this.identificador_isss,
                   'identificador_nup':this.identificador_nup,
                   'identificador_nit':this.identificador_nit,
                   'codigo_profesion':this.codigo_profesion,
                   'id_direccion':this.id_direccion,
                   'numero_documento_identificacion':this.numero_documento_identificacion,
                   'id_estado_civil':this.id_estado_civil,
                   'id_genero':this.id_genero,
                   'id_contacto_telefonico':this.id_contacto_telefonico,
                   'id_tipo_contacto_telefonico':this.id_tipo_contacto_telefonico,
                   'ubicacion':this.ubicacion,
                   'numero_vivienda':this.numero_vivienda,
                   'numero':this.numero,
                   'detalles':this.detalles,
                   'codigo_municipio':this.codigo_municipio,
                   'codigo_departamento':this.codigo_departamento,
                   'id_tipo_identificacion':this.id_tipo_identificacion,
                   //'codigo_empleado':this.codigo_empleado,
                   'codigo_jefe':this.codigo_empleado_res
                   
                   
                         
               }).then(function (response) {
                     me.cerrarModal();
                     me.listarEmpleado(1,'','primer_nombre');
                })
                .catch(function (error) {
                        console.log(error);
                });

            }, 
            actualizarEmpleado(){
                if(this.validarEmpleado()){
                   return;

                 }
                let me=this; 
               axios.put('/empleado/actualizar',{
                   'primer_nombre':this.primer_nombre,
                   'segundo_nombre':this.segundo_nombre,
                   'primer_apellido':this.primer_apellido,
                   'segundo_apellido':this.segundo_apellido,  
                   'email_personal':this.email_personal,
                   'email_institucional':this.email_institucional,
                   'fecha_nacimiento':this.fecha_nacimiento,
                   'identificador_isss':this.identificador_isss,
                   'identificador_nup':this.identificador_nup,
                   'identificador_nit':this.identificador_nit,
                   'codigo_profesion':this.codigo_profesion,
                   'id_direccion':this.id_direccion,
                   'numero_documento_identificacion':this.numero_documento_identificacion,
                   'id_estado_civil':this.id_estado_civil,
                   'id_genero':this.id_genero,
                   'id_contacto_telefonico':this.id_contacto_telefonico,
                   'id_tipo_contacto_telefonico':this.id_tipo_contacto_telefonico,
                   'ubicacion':this.ubicacion,
                   'numero_vivienda':this.numero_vivienda,
                   'numero':this.numero,
                   'detalles':this.detalles,
                   'codigo_municipio':this.codigo_municipio,
                   'codigo_departamento':this.codigo_departamento,
                   'id_tipo_identificacion':this.id_tipo_identificacion,
                   'codigo_empleado':this.codigo_empleado,
                   'codigo_jefe':this.codigo_jefe
                   

               }).then(function (response) {
                     me.cerrarModal();
                     me.listarEmpleado(1,'','primer_nombre');
                })
                .catch(function (error) {
                        console.log(error);
                });
            },
            cerrarModal(){
               this.modal=0;
               this.id_direccion='';
               this.tituloModal='';
               this.primer_nombre='';
               this.segundo_nombre='';
               this.primer_apellido='';
               this.segundo_apellido='';
               this.codigo_empleado_res = '';
               this.codigo_jefe='';
               this.empleado=[];
                if(document.getElementById("empleado_input_e")!=null) document.getElementById("empleado_input_e").value = "";
                if(document.getElementById("empleado_input_e")!=null) document.getElementById("empleado_input_e").style.border = "1px solid #ccc";
                document.getElementById("rol_input_e").style.border = "1px solid #ccc";
                if(document.getElementById("password_input_e")!=null) document.getElementById("password_input_e").style.border = "1px solid #ccc";
                },
            abrirModal(modelo,accion,data=[]){
                switch(modelo){
                    case "empleado":
                    {
                        switch(accion){
                                 case 'registrar':
                                     {
                                          this.modal=1; 
                                          this.tituloModal='Registrar Empleado';
                                          this.primer_nombre='';
                                          this.segundo_nombre='';
                                          this.primer_apellido='';
                                          this.segundo_apellido='',
                                          this.email_personal='';
                                          this.email_institucional='';
                                          this.fecha_nacimiento='';
                                          this.identificador_isss='';
                                          this.identificador_nup='';
                                          this.identificador_nit='';
                                          this.codigo_profesion=0;
                                          this.id_direccion=0;
                                          this.numero_documento_identificacion=0;
                                          this.id_estado_civil=0;
                                          this.id_genero=0;
                                          this.id_contacto_telefonico=0;
                                          this.ubicacion='';
                                          this.numero_vivienda='';
                                          this.numero='';
                                          this.detalles='';
                                          this.codigo_municipio=0;
                                          this.codigo_departamento=0;
                                          this.id_tipo_identificacion=0;
                                          this.id_tipo_contacto_telefonico=0;
                                         
                                          
                  
                  

                                          this.tipoAccion= 1;
                                          break;
                                     }
                                 case 'actualizar':
                                     {
                                         //console.log(data);
                                         this.modal=2;
                                         this.tituloModal='Actualizar Empleado';
                                         this.tipoAccion=2;
                                         this.primer_nombre=data['primer_nombre'];
                                         this.segundo_nombre=data['segundo_nombre'];
                                         this.primer_apellido=data['primer_apellido'];
                                         this.segundo_apellido=data['segundo_apellido'];
                                         this.email_personal=data['email_personal']
                                         this.email_institucional=data['email_institucional'];
                                         this.fecha_nacimiento=data['fecha_nacimiento'];
                                         this.identificador_isss=data['identificador_isss'];
                                         this.identificador_nup=data['identificador_nit'];
                                         this.identificador_nit=data['identificador_nit'];
                                         this.codigo_profesion=data['codigo_profesion'];
                                         this.id_direccion=data['id_direccion'];
                                         this.numero_documento_identificacion=data['numero_documento_identificacion'];
                                         this.id_estado_civil=data['id_estado_civil'];
                                         this.id_genero=data['id_genero'];
                                         this.id_contacto_telefonico=data['id_contacto_telefonico'];
                                         this.ubicacion=data['ubicacion'];
                                         this.numero_vivienda=data['numero_vivienda'];
                                         this.detalles=data['detalles'];
                                         this.codigo_municipio=data['codigo_municipio'];
                                         this.codigo_departamento=data['codigo_departamento'];
                                         this.id_tipo_identificacion=data['id_tipo_identificacion'];
                                         this.id_tipo_contacto_telefonico=data['id_tipo_contacto_telefonico']
                                         this.codigo_empleado=data['codigo_empleado'];
                                         this.codigo_jefe=data['codigo_jefe']
                                         
                                         

                                         break;
                                     }
                        } 

                    }
                }
                this.selectProfesion();
                this.selectDireccionMunicipio();
                this.selectDireccionDepartamento();
                this.selectEstadoCivil();
                this.selectGenero();
                this.selectContacto();
                this.selectIdentificacion();
                this.selectEmpleado();
                
            }
        },
        mounted() {
            this.listarEmpleado(1,this.buscar,this.criterio);
        }
    }
</script>

<style >
       .modal-content{
           width: 100% !important;
           position:absolute !important;
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
           color:red !important;
           font-weight: bold;
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