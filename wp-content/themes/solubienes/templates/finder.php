<?php
	function title() {
		echo <<<EOT
			<h2>Consigue tu casa soñada</h2>
EOT;
	}

	function zone() {
		echo <<<EOT
			<!--input type="text" placeholder="Ingresa la zona"-->
			<select>
				<option disabled selected value="0">Seleccione la zona</option>
				<option value="1">Zona 1</option>
				<option value="2">Zona 2</option>
				<option value="3">Zona 3</option>
			</select>
EOT;
	}
	
	function type() {
		echo <<<EOT
			<select>
				<option disabled selected value="0">Tipo</option>
				<option>Tipo 1</option>
				<option>Tipo 2</option>
			</select>
EOT;
	}

	function operation() {
		echo <<<EOT
			<select>
				<option disabled selected value="0">Operación</option>
				<option>Operación 1</option>
				<option>Operación 2</option>
			</select>
EOT;
	}

	function budget($elem = null) {
		if ($elem === null || $elem == 'title') {
			echo <<<EOT
			<h3 class="low">Presupuesto Máximo</h3>
EOT;
		}
		if ($elem === null || $elem == 'amount') {
			echo <<<EOT
			<h4 style="visibility:hidden">Máximo Bsf. <span id="max_amount_lbl" class="max-amount"></span></h4>
EOT;
		}
		if ($elem === null || $elem == 'slider') {
			echo <<<EOT
			<input id="budget_slider" data-slider-id='budget_slider' data-slider-step="100000" data-slider-max="200000000" data-slider-min="0" data-slider-value="0" type="text">
EOT;
		}
	}

	function submit() {
		echo <<<EOT
			<button type="submit"><i class="fa fa-search"></i>&nbsp;Buscar inmueble</button>
EOT;
	}


$margin_top = is_home() ? ' style="margin-top:150px"' : '';

?>
<?php if (isset($narrow_finder) && $narrow_finder) : //narrow ?>
<div class="finder narrow animated fadeInUp"<?php echo $margin_top; ?>> <!-- lightSpeedIn -->
	<!-- title -->
	<div class="row">
		<div class="col-md-12">
			<?php echo title() ?>
		</div>
	</div>

	<!-- zone -->
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<!--input type="text" placeholder="Ingresa la zona"-->
			<?php echo zone() ?>
		</div>
	</div>

	<div class="row">
		<!-- type -->
		<div class="col-md-6 col-sm-6">
			<?php echo type() ?>
		</div>
		<!-- operation -->
		<div class="col-md-6 col-sm-6">
			<?php echo operation() ?>
		</div>
	</div>

	<!-- max amount -->
	<div class="row">
		<div class="col-md-12">
			<?php echo budget() ?>
		</div>
	</div>

	<!-- search button -->
	<div class="row">
		<div class="col-md-12">
			<?php echo submit() ?>
		</div>
	</div>
</div>
<?php else : //wide ?>
<div class="finder wide animated fadeInUp"<?php echo $margin_top; ?>> <!-- lightSpeedIn -->
	<div class="row">
		<!-- zone -->
		<div class="col-md-6 col-sm-12">
			<?php echo zone() ?>
		</div>
		<!-- type -->
		<div class="col-md-3 col-sm-6">
			<?php echo type() ?>
		</div>
		<!-- operation -->
		<div class="col-md-3 col-sm-6">
			<?php echo operation() ?>
		</div>
	</div>

	<div class="row">
		<!-- max amount -->
		<div class="col-md-4 col-sm-6">
			<?php echo budget('title') ?>
			<?php echo budget('amount'); ?>
		</div>
		<!-- max amount slider -->
		<div class="col-md-5 col-sm-6" style="min-height:80px">
			<?php echo budget('slider'); ?>
		</div>
		<!-- search button -->
		<div class="col-md-3 col-sm-12">
			<?php echo submit() ?>
		</div>
	</div>
</div>
<?php endif; ?>