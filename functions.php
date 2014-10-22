<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'OPI Living' );
define( 'CHILD_THEME_URL', 'http://www.allstagesmarketing.com' );

/** Add support for custom background */
add_theme_support( 'custom-background' );

add_action('wp_head','print_print');
function print_print() { ?>
       <link rel="stylesheet" type="text/css" href="http://www.optimumperformanceinstitute.com/wp-content/themes/roanne-program/print.css" media="print" />
<?php } 

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 4 );
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Above',
'before_widget' => '<div class="after-content-left">',
'after_widget' => '</div>',
));
}
add_action('genesis_before_content_sidebar_wrap', 'insert_mysidebar');
function insert_mysidebar() {
if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Above') );
}

if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'After Content',
'before_widget' => '<div class="after-content-right">',
'after_widget' => '</div>',
));
}
add_action('genesis_before_content_sidebar_wrap', 'insert_myevents');
function insert_myevents() {
if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('After Content') );
}
/** Modify the speak your mind text */
add_filter( 'genesis_comment_form_args', 'custom_comment_form_args' );
function custom_comment_form_args($args) {
    $args['title_reply'] = 'Leave a Comment';
    return $args;
}
remove_action('genesis_footer', 'genesis_do_footer');
function do_custom_footer() {
	?>
    <div class="footer-credits">
    <p style="font-size:.9em;text-align:center;">Copyright © <?php echo date('Y'); ?> <a href="http://www.optimumperformanceinstitute.com/" title="THE OPTIMUM PERFORMANCE INSTITUTE - Young Adult Programs">The Optimum Performance Institute</a>. All rights reserved. <a href="http://www.allstagesmarketing.com/" title="Web Design">Web Design </a>by <a href="http://www.allstagesmarketing.com/" title="All Stages Marketing"> All Stages Marketing.</a></p></div>
<?php
}
add_action('genesis_footer', 'do_custom_footer');
add_action('genesis_after_post_content', 'do_links');
function do_links() {
	if(get_field('left_link')): ?> 
<?php foreach(get_field('left_link') as $post_object): ?>
   <a href="<?php echo get_permalink($post_object->ID); ?>" title="<?php echo get_the_title($post_object->ID) ?>" class="left">«  <?php echo get_the_title($post_object->ID) ?></a>
<?php endforeach;
        endif;
	if(get_field('right_link')):
		foreach(get_field('right_link') as $post_object): ?>
   <a href="<?php echo get_permalink($post_object->ID); ?>" title="<?php echo get_the_title($post_object->ID) ?>" class="right"><?php echo get_the_title($post_object->ID) ?>  »</a>
<?php endforeach;
        endif;
}