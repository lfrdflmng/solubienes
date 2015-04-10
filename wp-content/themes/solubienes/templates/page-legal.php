<?php
 /*
 * Template Name: Legal
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

get_header(); ?>

	<!-- header -->
	<?php if (empty($feat_image)) : ?>
	<div class="container-fluid header bg-default legal">
	<?php else : ?>
	<div class="container-fluid header legal" style="background-image:url(<?php echo $feat_image; ?>)">
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
				
				<article class="legal">
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
<?php get_footer(); ?>