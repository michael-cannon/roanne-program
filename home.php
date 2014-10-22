<?php
/*
Template Name: home
 * WARNING: This file is part of the core Genesis framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * This file handles posts, but only exists for the sake of
 * child theme forward compatibility.
 *
 * @package Genesis
 */
add_action('wp_head', 'print_styles');
function print_styles() {
	wp_register_style( 'wt-rotator', get_stylesheet_directory_uri() . '/wt-rotator.css' );
	wp_enqueue_style( 'wt-rotator' );
}


add_action('wp_head', 'my_load_scripts');
function my_load_scripts() {
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'jquery.easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.min.js', array( 'jquery' ), '1.3', true );
	wp_enqueue_script( 'jquery.easing' );

	wp_register_script( 'jquery.wt-rotator', get_stylesheet_directory_uri() . '/js/jquery.wt-rotator.min.js', array( 'jquery.easing' ), '1.3', true );
	wp_enqueue_script( 'jquery.wt-rotator' );
}


add_action( 'wp_footer', 'my_raw_script', 99 );
function my_raw_script() {
	echo <<<JS
		<script type="text/javascript">
		jQuery(document).ready(
			function() {
				jQuery(".container1").wtRotator({
					width:904,
					height:386,
					thumb_width:16,
					thumb_height:18,
					button_width:16,
					button_height:18,
					button_margin:3,
					auto_start:true,
					delay:4000,
					play_once:false,
					transition:"fade",
					transition_speed:800,
					auto_center:false,
					easing:"",
					cpanel_position:"outside",
					cpanel_align:"BR",
					timer_align:"top",
					display_thumbs:false,
					display_dbuttons:false,
					display_playbutton:false,
					display_thumbimg:false,
					display_side_buttons:true,
					display_numbers:true,
					display_timer:false,
					mouseover_pause:true,
					cpanel_mouseover:false,
					text_mouseover:false,
					text_effect:"fade",
					text_sync:true,
					tooltip_type:"none",
					lock_tooltip:true,
					shuffle:false,
					block_size:75,
					vert_size:25,
					horz_size:50,
					block_delay:25,
					vstripe_delay:75,
					hstripe_delay:180
				});
			}
		);
				</script>
JS;
}


?>
<?php
add_action('genesis_before_content_sidebar_wrap', 'child_do_ex_content');
function child_do_ex_content() { ?>
<div class="container1">
	<div class="wt-rotator">
		<div class="screen">
			<noscript>
				<!-- placeholder 1st image when javascript is off -->
				<img src="<?php the_field('photo'); ?>" alt="OPI Living" />
			</noscript>
		</div>
		<div class="c-panel">
			<div class="thumbnails">
				<ul>
	<?php while (the_repeater_field('slideshow')): ?>

							   <li>
			  <a href="<?php echo get_sub_field('photo'); ?>" /></a>
			  <a href="<?php echo get_sub_field('page_link'); ?>" /></a>
				   <div style="top:280px; left:110px; width:520px; height:0; color:#333; background:none; font-size:20px; text-align:center;">
					<?php the_sub_field('description'); ?>
					</div>
</li>
	<?php endwhile; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
}


genesis();
