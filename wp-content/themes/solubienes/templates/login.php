<!-- Login modal -->
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               Tu Cuenta
            </h4>
        </div>
        <div class="modal-body">
                     

			<div id="login-register-password">

				<?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { ?>

				<!--ul class="tabs_login">
					<li class="active_login"><a href="#tab1_login">Login</a></li>
					<li><a href="#tab2_login">Register</a></li>
					<li><a href="#tab3_login">Forgot?</a></li>
				</ul-->
				<div class="tab_container_login">
					<!-- login -->
					<div id="tab1_login" class="tab_content_login">
						<form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="wp-user-form">
							<div class="username">
								<div class="row">
									<div class="col-sm-5">
										<label for="user_login">Nombre de usuario: </label>
									</div>
									<div class="col-sm-7">
										<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" id="user_login" tabindex="11" />
									</div>
								</div>
							</div>
							<div class="password">
								<div class="row">
									<div class="col-sm-5">
										<label for="user_pass">Contraseña: </label>
									</div>
									<div class="col-sm-7">
										<input type="password" name="pwd" value="" id="user_pass" tabindex="12" />
									</div>
								</div>
							</div>
							<div class="login_fields">
								<div class="rememberme">
									<label for="rememberme">
										<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Recordarme
									</label>
								</div>
								<div class="text-center">
									<?php do_action('login_form'); ?>
									<input type="submit" name="user-submit" value="Iniciar sesión" tabindex="14" class="user-submit" />
									<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
									<input type="hidden" name="user-cookie" value="1" />
								</div>
							</div>
						</form>
						<div class="text-center">
							<a href="#tab2_login" class="tab-changer">Crear un cuenta</a>
							<a href="#tab3_login" class="tab-changer">Se me olvidó la contraseña</a>
						</div>
					</div>

					<!-- register -->
					<div id="tab2_login" class="tab_content_login" style="display:none;">
						<h3>Crea tu cuenta</h3>
						<p>Ingresa los datos para crear tu cuenta.</p>
						<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
							<div class="username">
								<div class="row">
									<div class="col-sm-5">
										<label for="user_login">Nombre de usuario: </label>
									</div>
									<div class="col-sm-7">
										<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" id="user_login" tabindex="101" />
									</div>
								</div>
							</div>
							<div class="password">
								<div class="row">
									<div class="col-sm-5">
										<label for="user_email">Tu correo: </label>
									</div>
									<div class="col-sm-7">
										<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" id="user_email" tabindex="102" />
									</div>
								</div>
							</div>
							<br>
							<div class="login_fields text-center">
								<?php do_action('register_form'); ?>
								<input type="submit" name="user-submit" value="Registrar" class="user-submit" tabindex="103" />
								<?php $register = $_GET['register']; if($register == true) { echo '<p>Check your email for the password!</p>'; } ?>
								<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
								<input type="hidden" name="user-cookie" value="1" />
							</div>
						</form>
						<div class="text-center">
							<a href="#tab1_login" class="tab-changer">Ya tengo un cuenta</a>
						</div>
					</div>

					<!-- forgot -->
					<div id="tab3_login" class="tab_content_login" style="display:none;">
						<h3>Recuperar Contraseña</h3>
						<p>Ingresa la dirección de correo electrónico que usaste para registrarte.</p>
						<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
							<div class="username">
								<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
								<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
							</div>
							<br>
							<div class="login_fields text-center">
								<?php do_action('login_form', 'resetpass'); ?>
								<input type="submit" name="user-submit" value="Recuperar contraseña" class="user-submit" tabindex="1002" />
								<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
								<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
								<input type="hidden" name="user-cookie" value="1" />
							</div>
						</form>
						<div class="text-center">
							<a href="#tab2_login" class="tab-changer">Crear un cuenta</a>
							<a href="#tab1_login" class="tab-changer">Ya tengo un cuenta</a>
						</div>
					</div>
				</div>

				<?php } else { // is logged in ?>

				<div class="sidebox">
					<div class="row">
						<div class="col-sm-3">
							<div class="usericon">
								<?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 60); ?>
							</div>
						</div>
						<div class="col-sm-9">
							<h3>Hola, <?php echo $user_identity; ?></h3>
					
							<div class="userinfo">
								<!--p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p-->
								<p>
									<a href="<?php echo wp_logout_url('index.php'); ?>">Cerrar sesión</a> | 
									<?php if (current_user_can('manage_options')) { 
										echo '<a href="' . admin_url() . '">Administrar</a>'; } else { 
										echo '<a href="' . admin_url() . 'profile.php">Mi Perfil</a>'; } ?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<?php } ?>

			</div>


		</div>
         <!--div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">Close
            </button>
            <button type="button" class="btn btn-primary">
               Submit changes
            </button>
         </div-->
      </div>
    </div>
</div><!-- /Login modal -->



		
<!-- information modal -->
<div class="modal fade" id="login_inf_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               Solubienes
            </h4>
        </div>
        <div class="modal-body">

			<?php $register = $_GET['register']; $reset = $_GET['reset'];  if ($register == true) { ?>

				<h3>Listo.</h3>
				<p>Busca la contraseña en tu correo.</p>

			<?php } elseif ($reset == true) { ?>

				<h3>Listo.</h3>
				<p>Revisa tu correo para cambiar la contraseña.</p>

			<?php } /*else {*/ ?>

				<!--p>Si ya estás registrado, inicia sesión <a href="#" class="tab-changer">aquí</a></p-->

			<?php /*}*/ ?>

		</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
</div><!-- /Login modal -->
<?php if ($register || $reset) : ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#login_inf_modal').modal('show');
	});
</script>
<?php endif; ?>