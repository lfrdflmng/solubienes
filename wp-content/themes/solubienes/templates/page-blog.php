<?php
 /*
 * Template Name: Blog
 * @subpackage Solubienes
 * @since Solubienes 1.0
 */

if (isset($_GET['demo'])) goto demo;

$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

get_header(); ?>

	<!-- header -->
	<?php if (empty($feat_image)) : ?>
	<div class="container-fluid header bg-default blogroll">
	<?php else : ?>
	<div class="container-fluid header blogroll" style="background-image:url(<?php echo $feat_image; ?>)">
	<?php endif; ?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1><?php echo $post->post_title; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 desc">
				<p><?php echo get_post_meta($post->ID, 'subtitulo', true); ?></p>
			</div>
		</div>
	</div>

	<div class="vertical-space-small"></div>

	<div class="section container">
		
		<div class="row">
			<div class="col-md-9">
				
				<?php
					$args = array(
						'posts_per_page' => 10,
						'post_type' => 'post'
					);

					$items = get_posts( $args );

					foreach ($items as $item) :
						$img = get_blog_image($item, 'small');
				?>
				<article class="blog preview">
					<a href="<?php echo $item->guid; ?>">
						<div class="row">
							<div class="col-md-4">
								<figure class="thumb-img" style="background-image:url(<?php echo $img; ?>)"></figure>
							</div>

							<div class="col-md-8">
								<h1><?php echo $item->post_title; ?></h1>
								<p><?php print_blog_content($item, false); ?></p>
								<span class="more">Leer más</span>
							</div>
						</div>
					</a>
				</article>
				<?php endforeach; ?>

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