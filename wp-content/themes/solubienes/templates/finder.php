<?php
	function form_open() {
		$url = home_url();
		echo <<<EOT
		<form method="get" action="{$url}">
			<input type="hidden" name="s" value="">
			<input type="hidden" name="post_type" value="solubienes">
EOT;
	}

	function title() {
		echo <<<EOT
			<h2>Consigue tu inmueble soñado</h2>
EOT;
	}

	function state() {
		$value = isset($_GET['estado']) ? $_GET['estado'] : '';
		$states = get_states_list(true, $value);

		echo <<<EOT
			<select name="estado">
				<option{$non_selected} value="">Estado</option>
				{$states}
			</select>
EOT;
	}

	function zone() {
		$value = isset($_GET['zona']) ? (' value="' . $_GET['zona'] . '"') : '';

		$non_selected = $value == '' ? ' selected' : '';

		echo <<<EOT
			<input type="text" name="zona" class="typeahead-zones" placeholder="Ingresa la zona"{$value}>
EOT;
	}
	
	function type() {
		$value = isset($_GET['tipo']) ? $_GET['tipo'] : '';
		$types = get_types_list(true, $value);

		$non_selected = $value == '' ? ' selected' : '';

		echo <<<EOT
			<select name="tipo">
				<option{$non_selected} value="">Tipo</option>
				{$types}
			</select>
EOT;
	}

	function operation() {
		$value = isset($_GET['operacion']) ? $_GET['operacion'] : '';
		$operations = get_operations_list(true, $value);

		$non_selected = $value == '' ? ' selected' : '';

		echo <<<EOT
			<select name="operacion">
				<option{$non_selected} value="">Operación</option>
				{$operations}
			</select>
EOT;
	}

	function budget($elem = null) {
		if ($elem === null || $elem == 'title') {
			$low = empty($_GET['precio_maximo']) ? 'low' : '';
			echo <<<EOT
			<h3 class="{$low}">Presupuesto Máximo</h3>
EOT;
		}
		if ($elem === null || $elem == 'amount') {
			$value = number_format(intval($_GET['precio_maximo']), 0, '', '.');
			$hidden = $value == 0 ? ' style="visibility:hidden"' : '';
			echo <<<EOT
			<h4{$hidden}>Máximo Bsf. <span id="max_amount_lbl" class="max-amount">{$value}</span></h4>
EOT;
		}
		if ($elem === null || $elem == 'slider') {
			$value = intval($_GET['precio_maximo']);
			echo <<<EOT
			<input id="budget_slider" name="precio_maximo" data-slider-id='budget_slider' data-slider-step="100000" data-slider-max="10000000" data-slider-min="0" data-slider-value="{$value}" type="text">
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
	<?php form_open(); ?>
		<!-- title -->
		<div class="row">
			<div class="col-md-12">
				<?php title(); ?>
			</div>
		</div>

		<!-- state -->
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php state(); ?>
			</div>
		</div>

		<!-- zone -->
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php zone(); ?>
			</div>
		</div>

		<div class="row">
			<!-- type -->
			<div class="col-md-6 col-sm-6">
				<?php type(); ?>
			</div>
			<!-- operation -->
			<div class="col-md-6 col-sm-6">
				<?php operation(); ?>
			</div>
		</div>

		<!-- max amount -->
		<div class="row">
			<div class="col-md-12">
				<?php budget(); ?>
			</div>
		</div>

		<!-- search button -->
		<div class="row">
			<div class="col-md-12">
				<?php submit(); ?>
			</div>
		</div>
	</form>
</div>
<?php else : //wide ?>
<div class="finder wide animated fadeInUp"<?php echo $margin_top; ?>> <!-- lightSpeedIn -->
	<?php form_open(); ?>
		<div class="row">
			<!-- state -->
			<div class="col-md-3 col-sm-6">
				<?php state(); ?>
			</div>
			<!-- zone -->
			<div class="col-md-3 col-sm-6">
				<?php zone(); ?>
			</div>
			<!-- type -->
			<div class="col-md-3 col-sm-6">
				<?php type(); ?>
			</div>
			<!-- operation -->
			<div class="col-md-3 col-sm-6">
				<?php operation(); ?>
			</div>
		</div>

		<div class="row">
			<!-- max amount -->
			<div class="col-md-4 col-sm-6">
				<?php budget('title'); ?>
				<?php budget('amount'); ?>
			</div>
			<!-- max amount slider -->
			<div class="col-md-5 col-sm-6" style="min-height:80px">
				<?php budget('slider'); ?>
			</div>
			<!-- search button -->
			<div class="col-md-3 col-sm-12">
				<?php submit(); ?>
			</div>
		</div>
	</form>
</div>
<?php endif; ?>