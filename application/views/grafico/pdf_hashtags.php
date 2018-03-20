<!DOCTYPE html>
<html>
<head>
	<title>Historial</title>
</head>
<body>

	<table style="width:100%;text-align: center;margin-top: 0%;" border="0" align="center" cellspacing="1" align="center" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
		<tr>
			<td style="background-color: #3D9970 !important;color: #FFFFFF; font-weight: bold;font-size: 26px;">
				Historial de hashtags
			</td>
		</tr>
	</table>
	<br>
	<table style="width:100%;text-align: left;margin-top: 0%;" border="0" align="center" cellspacing="1" align="center" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
		<?php $item = 1; foreach ($hashtags as $key => $value) {
			$day_hashtags = $this->grafico->day_hashtags($value->name);
			?>
			<tr>
		 		<td style="font-size: 20px; color: #000000; font-weight: bold;">
		 			<?php echo $value->name." (".count($day_hashtags).")";?>
		 		</td>
		 	</tr>
			<?php
			 $i = 1;
			 foreach ($day_hashtags as $key => $row) { ?>
				<tr>
					<td style="background-color: #EAEAEA;">
						(<span style="color: #620000;font-weight: bold;"><?php echo $i;?></span>) 
						<?php echo $row->name;?>
					</td>
				</tr>
			<?php $i++; }?>
		<?php $item++; }?>
	</table>

</body>
</html>