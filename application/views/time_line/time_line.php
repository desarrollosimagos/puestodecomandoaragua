<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Twitter details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li>
                <a href="<?php echo base_url().$ruta_origen; ?>">Atrás</a>
            </li>
            <li class="active">
                <strong>Twitter details</strong>
            </li>
        </ol>
    </div>
</div>

<!-- Campo oculto que almacena el url base del proyecto -->
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

<!-- Cuerpo de la sección de perfil de twitter -->
<div class="wrapper wrapper-content animated fadeInUp">
	
	<div class="row animated fadeInRight">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<!--<div class="text-center float-e-margins p-md">
					<span>Turn on/off color/background or orientation version: </span>
					<a href="#" class="btn btn-xs btn-primary" id="lightVersion">Light version</a>
					<a href="#" class="btn btn-xs btn-primary" id="darkVersion">Dark version</a>
					<a href="#" class="btn btn-xs btn-primary" id="leftVersion">Left version</a>
				</div>-->
				<div class="ibox-title">
                    <h5>Tweet: <?php echo $data_inbox[0]->text; ?> </h5>
                    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                </div>
				<div class="ibox-content" id="ibox-content">
					
					<div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">
						
						<div class="vertical-timeline-block">
							<div class="vertical-timeline-icon navy-bg">
								<i class="fa fa-inbox"></i>
							</div>

							<div class="vertical-timeline-content">
								<h2>Inicio</h2>
								<p>
									Ingresado en la bandeja de entrada.
								</p>
								<!--<a href="#" class="btn btn-sm btn-primary"> More info</a>-->
								<?php $fecha_inbox = explode(" ", $data_inbox[0]->created_at); ?>
								<?php $f_inbox = $fecha_inbox[0] ?>
								<?php $h_inbox = $fecha_inbox[1] ?>
								<span class="vertical-date">
									<?php echo $f_inbox; ?> <br/>
									<small><?php echo $h_inbox; ?></small>
								</span>
							</div>
						</div>
						
						<?php $icon = array('lazur-bg', 'blue-bg', 'yellow-bg', 'red-bg', 'navy-bg'); ?>
						<?php $i = 0; ?>
						<?php foreach($time_line as $time_line){ ?>
							
							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon <?php echo $icon[$i]; ?>">
									<i class="fa fa-inbox"></i>
								</div>

								<div class="vertical-timeline-content">
									<h2><?php echo $time_line->name." ".$time_line->lastname." (".$time_line->username.")"; ?></h2>
									<p>
										<?php echo $time_line->mensaje; ?>
									</p>
									<p>
										<?php echo $time_line->accion; ?>
									</p>
									<!--<a href="#" class="btn btn-sm btn-primary"> More info</a>-->
									<?php $fecha_time_line = explode(" ", $time_line->fecha); ?>
									<?php $f_time_line = $fecha_time_line[0] ?>
									<?php $h_time_line = $fecha_time_line[1] ?>
									<span class="vertical-date">
										<?php echo $f_time_line; ?> <br/>
										<small><?php echo $h_time_line; ?></small>
									</span>
								</div>
							</div>
							
						<?php $i++; } ?>
						
					</div>

				</div>
				
			</div>
			
		</div>
		
	</div>
	
</div>
<!-- Cierre del cuerpo de la sección de perfil de twitter -->

<!-- Page-Level Scripts -->
<!--<script src="<?php echo assets_url(); ?>script/twitter_view.js"></script>-->
