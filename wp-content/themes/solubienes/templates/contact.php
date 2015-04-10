<?php
	if (!isset($form_title)) {
		$form_title = 'Solicita información';
	}
	if (!isset($form_msg)) {
		$form_msg = 'Hola, estoy interesado en esta propiedad y quiero recibir más información. Muchas gracias.';
	}
?>
<div class="card-placeholder">
	<div class="card">
		<div class="front">
			<div class="contact-form">
				<form class="contact-ajax-form" method="post" action="<?php echo get_template_directory_uri() . '/ajax/process_contact.php'; ?>">
					<h2><?php echo $form_title; ?></h2>
					<div class="input">
						<input type="text" name="nombre" placeholder="Nombre y Apellido" required>
					</div>
					<div class="input">
						<input type="tel" name="telefono" placeholder="Teléfono">
					</div>
					<div class="input">
						<input type="email" name="correo" placeholder="Correo" required>
					</div>
					<div class="input">
						<textarea name="mensaje" placeholder="Mensaje"><?php echo $form_msg; ?></textarea>
					</div>
					<div class="submit">
						<div class="agree_field">
							<input type="checkbox" name="agree" id="agree" value="agree"><label for="agree">I agree with the terms &amp; conditions</label>
						</div>
						<button type="submit">Enviar</button>
					</div>
				</form>
			</div>
		</div>

		<div class="back">
			<div class="sending">
				<div class="svg-icon-wrapper letter">
					<div class="letter-cover"></div>
				</div>
				<h1>Enviando...</h1>
			</div>
			<div class="sent hidden">
				<div class="icon-wrapper">
					<i class="icon-ok fa fa-check"></i>
				</div>
				<h1>Mensaje enviado</h1>
			</div>
			<div class="not-sent hidden">
				<div class="icon-wrapper">
					<i class="icon-bad fa fa-times-circle"></i>
				</div>
				<h1>Ha ocurrido un error.<br>Por favor intente luego</h1>
			</div>
		</div>
	</div>
</div>