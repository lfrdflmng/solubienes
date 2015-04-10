<?php
 /*
 * Template Name: Blog-Single
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

if (isset($_GET['demo'])) goto demo;

$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

get_header(); ?>

	<!-- header -->
	<?php if (empty($feat_image)) : ?>
	<div class="container-fluid header bg-default blogsingle">
	<?php else : ?>
	<div class="container-fluid header blogsingle" style="background-image:url(<?php echo $feat_image; ?>)">
	<?php endif; ?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1><?php echo $post->post_title; ?></h1>
			</div>
		</div>
	</div>

	<div class="vertical-space-small"></div>

	<div class="section container">
		
		<div class="row">
			<div class="col-md-9">
				
				<article class="blog single">
					<h1><?php echo $post->post_title; ?></h1>
					<div class="content">
						<?php echo apply_filters('the_content', $post->post_content); ?>
					</div>
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
<?php get_footer(); die(); ?>











<?php
demo:
//DEMO LAYOUT
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
	<div class="container-fluid header bg-default blogsingle">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1>Blog</h1>
			</div>
		</div>
	</div>

	<div class="vertical-space-small"></div>

	<div class="section container">
		
		<div class="row">
			<div class="col-md-9">
				
				<article class="blog single">
					<h1>Lorem Ipsum dolor sit amet</h1>
					<div class="content">
						<?php randtext(); ?>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/img_placeholder.jpg" alt="">
						<p><?php randtext(); ?></p>
					</div>
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