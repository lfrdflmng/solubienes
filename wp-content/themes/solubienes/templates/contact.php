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
				<form method="post">
					<h2><?php echo $form_title; ?></h2>
					<div class="input">
						<input type="text" placeholder="Nombre y Apellidos" required>
					</div>
					<div class="input">
						<input type="tel" placeholder="Teléfono">
					</div>
					<div class="input">
						<input type="email" placeholder="Correo" required>
					</div>
					<div class="input">
						<textarea placeholder="Mensaje"><?php echo $form_msg; ?></textarea>
					</div>
					<div class="submit">
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
		</div>
	</div>
</div>