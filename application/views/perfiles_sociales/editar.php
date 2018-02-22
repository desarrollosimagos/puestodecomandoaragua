<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Perfil Social </h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            
            <li class="active">
                <strong>Editar Perfil Social</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
        
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Editar Perfil Social</h5>
                    <!-- Campo oculto que almacena el url base del proyecto -->
					<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                </div>
                <div class="ibox-content">
                    <!-- Usamos el atributo 'novalidate' para que muestre los mensajes personalizados y no los que genera por defecto el navegador -->
                    <form role="form" id="form_perfil_social" name="form_perfil_social" method="post">
                        <div class="row">
							
							<!-- Sección de datos básicos -->
                            <div class="col-sm-4 b-r">
                                <h3 class="m-t-none m-b">Datos Básicos</h3>
                                <p>Rellena los campos requeridos (*).</p>
                                <div class="form-group">
                                    <label>Cédula *</label> 
                                    <input type="text" placeholder="Enter name" class="form-control" name="cedula" id="cedula" value="<?php echo $editar[0]->cedula; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Género</label>
                                    <input type="text" placeholder="Género" class="form-control" name="genero" id="genero" value="<?php echo $editar[0]->genero; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Nombre" class="form-control" name="nombre" id="nombre" value="<?php echo $editar[0]->nombre; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" placeholder="Apellido" class="form-control" name="apellido" id="apellido" value="<?php echo $editar[0]->apellido; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Fecha de nacimiento</label>
                                    <input type="text" placeholder="00/00/0000" class="form-control" name="fecha_nac" id="fecha_nac" value="<?php echo $editar[0]->fecha_nac; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dirección de nacimiento</label>
                                    <textarea class="form-control" placeholder="Dirección de nacimiento" id="direccion_nac" name="direccion_nac"><?php echo $editar[0]->direccion_nac; ?></textarea>
                                </div>
                            </div>
                            
                            <!-- Sección de datos de ubicación -->
                            <div class="col-sm-4 b-r">
                                <h3 class="m-t-none m-b">Datos de Ubicación</h3>
                                <div class="form-group">
                                    <label>Dirección de vivienda</label>
                                    <textarea class="form-control" placeholder="Dirección de vivienda" id="direccion_viv" name="direccion_viv"><?php echo $editar[0]->direccion_viv; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="text" placeholder="Teléfono" class="form-control" name="telefono" id="telefono" value="<?php echo $editar[0]->telefono; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Celular</label> 
                                    <input type="text" placeholder="Teléfono celular" class="form-control" name="celular" id="celular" value="<?php echo $editar[0]->celular; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="text" placeholder="Correo" class="form-control" name="correo" id="correo" value="<?php echo $editar[0]->correo; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" placeholder="Facebook" class="form-control" name="facebook" id="facebook" value="<?php echo $editar[0]->facebook; ?>">
                                </div>
                            </div>
                            
                            <!-- Sección de datos de votación -->
                            <div class="col-sm-4">
                                <h3 class="m-t-none m-b">Datos de Votación</h3>
                                <div class="form-group">
                                    <label>Centro de votación</label>
                                    <textarea readonly="true" class="form-control" placeholder="Centro de votación" id="centro_votacion" name="centro_votacion"><?php echo $editar[0]->centro_votacion; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Dirección del centro</label>
                                    <textarea readonly="true" class="form-control" placeholder="Dirección del centro de votación" id="direccion_centro_votacion" name="direccion_centro_votacion"><?php echo $editar[0]->direccion_centro_votacion; ?></textarea>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <br>
                            <p class="text-center">
								<input type="hidden" id="id_perfil" name="id_perfil" value="<?php echo $id_perfil; ?>">
								<input type="hidden" id="id_twitter" name="id_twitter" value="<?php echo $id_twitter; ?>">
								<input type="hidden" id="screen_name" name="screen_name" value="<?php echo $screen_name; ?>">
								<input type="hidden" id="ruta_origen" value="<?php echo $_GET['ruta']; ?>">
                                <button class="btn btn-sm btn-primary b-r" type="button" id="volver"><strong>Volver</strong></button>
                                <button class="btn btn-sm btn-primary" type="button" id="editar"><strong>Guardar</strong></button>
                            </p>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
        </div>

    </div>
    
</div>

<!-- Page-Level Scripts -->
<script src="<?php echo assets_url(); ?>script/edit_perfil.js"></script>
