<?php
function elegance_widgets_init() {
	
	// Extra Area 1
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Extra Area 1',
		'id' 						=> 'extra-area-1',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<strong>',
		'after_title' => '</strong>',
	));
	
	// Extra Area 2
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Extra Area 2',
		'id' 						=> 'extra-area-2',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<strong>',
		'after_title' => '</strong>',
	));
	
	// Extra Area 3
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Extra Area 3',
		'id' 						=> 'extra-area-3',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<strong>',
		'after_title' => '</strong>',
	));
	
	// Extra Area 4
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Extra Area 4',
		'id' 						=> 'extra-area-4',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<strong>',
		'after_title' => '</strong>',
	));
	
	// Extra Area 5
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Extra Area 5',
		'id' 						=> 'extra-area-5',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<b>',
		'after_title' => '</b>',
	));
	
	// Content Area 1
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Content Area 1',
		'id' 						=> 'content-area-1',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
	// Content Area 2
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Content Area 2',
		'id' 						=> 'content-area-2',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
	// Content Area 3
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Content Area 3',
		'id' 						=> 'content-area-3',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 						=> 'main-sidebar',
		'description'   => __( 'Located at the right side of pages.'),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	// Footer Area 1
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> 'Footer Area 1',
		'id' 						=> 'footer-area-1',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s"">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	// Footer Area 2
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> 'Footer Area 2',
		'id' 						=> 'footer-area-2',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s"">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' );
?>