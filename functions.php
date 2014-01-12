<?php

wp_deregister_script( 'jquery' );
wp_enqueue_script( 'jquery', 'http://code.jquery.com/jquery-latest.js' );

// Add the effects
wp_enqueue_script( 'jquery-ui-effects-core', 'http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.core.js', array( 'jquery' ) );
wp_enqueue_script( 'jquery-ui-effects-slide', 'http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.slide.js', array( 'jquery', 'jquery-ui-effects-core' ) );

function register_my_menus()
{
    register_nav_menu('header-menu',__( 'Header Menu' ));
}

add_action( 'init', 'register_my_menus' );

function glider_widgets_init() {

	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
	) );
}
add_action( 'widgets_init', 'glider_widgets_init' );

?>