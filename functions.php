<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
// supports
function emerico_setup() {
	load_theme_textdomain( 'emerico', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	register_nav_menus( array(
		'top' => __( 'top Navigation', 'emerico' ),
	) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 );
}
add_action( 'after_setup_theme', 'emerico_setup' );
// title setup
function emerico_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
        	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'emerico' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'emerico_wp_title', 10, 2 );

// Sidebars
function emerico_widgets_init() {
        register_sidebar( array(
		'name' => __( 'Header Top Sidebar', 'emerico' ),
		'id' => 'headertop',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'emerico' ),
		'before_widget' => ' <div class="user-login">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'emerico' ),
		'id' => 'sidebarmain',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'emerico' ),
		'before_widget' => ' <li class="widget widget_archive">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Home top left', 'emerico' ),
		'id' => 'hometopleft',
		'description' => __( 'Home top left', 'emerico' ),
		'before_widget' => '<div class="home-left">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Home top right', 'emerico' ),
		'id' => 'hometopright',
		'description' => __( 'Home top right', 'emerico' ),
		'before_widget' => '<div class="home-right">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

        register_sidebar( array(
		'name' => __( 'Home top bottom', 'emerico' ),
		'id' => 'homebottom',
		'description' => __( 'Home top bottom', 'emerico' ),
		'before_widget' => '<div class="home-bottom">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'emerico_widgets_init' );

// body classes
function emerico_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';
	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}
	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}
	if ( wp_style_is( 'emerico-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';
	if ( ! is_multi_author() )
		$classes[] = 'single-author';
	return $classes;
}
add_filter( 'body_class', 'emerico_body_class' );
/* excerpt overriding */
class Excerpt {
  public static $length = 55;
  public static $types = array(
      'short' => 20,
      'regular' => 55,
      'long' => 100
    );
  public static function length($new_length = 55) {
    Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'Excerpt::new_length');

    Excerpt::output();
  }
  public static function new_length() {
    if( isset(Excerpt::$types[Excerpt::$length]) )
      return Excerpt::$types[Excerpt::$length];
    else
      return Excerpt::$length;
  }
  public static function output() {
    the_excerpt();
  }
}
function new_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
function ink_excerpt($length = 55) {
  Excerpt::length($length);
}
/* end */
/* Discription navigation */
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
/* example
wp_nav_menu( array(
 'container' =>false,
 'menu_class' => 'nav',
 'echo' => true,
 'before' => '',
 'after' => '',
 'link_before' => '',
 'link_after' => '',
 'depth' => 0,
 'walker' => new description_walker())
 );*/

