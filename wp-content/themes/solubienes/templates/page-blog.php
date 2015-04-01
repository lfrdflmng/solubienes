<?php
 /*
 * Template Name: Blog
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */
function randtext() {
	$str = <<<EOT
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
EOT;
	$len = round(rand(50, strlen($str)));
	echo $len . ' ' . substr($str, 0, $len);
}
get_header(); ?>

	<!-- header -->
	<div class="container-fluid header bg-default blogroll">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1>Blog</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 desc">
				<p>Lorem ipsum dolor sit amet</p>
			</div>
		</div>
	</div>

	<div class="vertical-space-small"></div>

	<div class="section container">
		
		<div class="row">
			<div class="col-md-9">
				
				<!-- to be looped -->
				<article class="blog preview">
					<a href="#">
						<div class="row">
							<div class="col-md-4">
								<figure class="thumb-img" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg)"></figure>
							</div>

							<div class="col-md-8">
								<h1>Lorem Ipsum</h1>
								<p><?php randtext(); ?></p>
								<span class="more" href="#">Leer más</span>
							</div>
						</div>
					</a>
				</article>
				<article class="blog preview">
					<a href="#">
						<div class="row">
							<div class="col-md-4">
								<figure class="thumb-img" style="background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg)"></figure>
							</div>

							<div class="col-md-8">
								<h1>Lorem Ipsum</h1>
								<p><?php randtext(); ?></p>
								<span class="more" href="#">Leer más</span>
							</div>
						</div>
					</a>
				</article>

			</div>

			<!-- sidebar -->
			<div class="col-md-3">
				<?php
					$narrow_finder = true;
					include('finder.php');
					include('recents.php');
				?>
			</div>
		</div>

	</div>
<?php
	$GLOBALS['script'] = <<<EOT
<script type="text/javascript">
	jQuery(document).ready(function($) {
		
	});
</script>
EOT;
?>
<?php get_footer(); ?>