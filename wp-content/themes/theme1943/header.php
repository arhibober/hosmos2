<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
<head>
	<title><?php if ( is_category() ) {
		echo __('Category Archive for &quot;', 'theme1943'); single_cat_title(); echo __('&quot; | ', 'theme1943'); bloginfo( 'name' );
	} elseif ( is_tag() ) {
		echo __('Tag Archive for &quot;', 'theme1943'); single_tag_title(); echo __('&quot; | ', 'theme1943'); bloginfo( 'name' );
	} elseif ( is_archive() ) {
		wp_title(''); echo __(' Archive | ', 'theme1943'); bloginfo( 'name' );
	} elseif ( is_search() ) {
		echo __('Search for &quot;', 'theme1943').wp_specialchars($s).__('&quot; | ', 'theme1943'); bloginfo( 'name' );
	} elseif ( is_home() || is_front_page()) {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo __('Error 404 Not Found | ', 'theme1943'); bloginfo( 'name' );
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		echo wp_title( ' | ', false, right ); bloginfo( 'name' );
	} ?></title>
	<meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if(of_get_option('favicon') != ''){ ?>
	<link rel="icon" href="<?php echo of_get_option('favicon', "" ); ?>" type="image/x-icon" />
	<?php } else { ?>
	<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon" />
	<?php } ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
  <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
    	<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
    </div>
  <![endif]-->
  
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/grid.css" />
    
    <link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Cantarell:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>
    
    <!-- for Opera only -->
    <script type="text/javascript">
		if(window.opera) {
			document.write("<link href='http://fonts.googleapis.com/css?family=Cantarell:400,700' rel='stylesheet' type='text/css'>");
		}
    </script>
    
	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
  <!--[if lt IE 9]>
  <style type="text/css">
    .border {
      behavior:url(<?php bloginfo('stylesheet_directory'); ?>/PIE.php)
      }
  </style>
  <![endif]-->
  
  <script type="text/javascript">
  	// initialise plugins
		jQuery(function(){
			// main navigation init
			jQuery('ul.sf-menu').superfish({
				delay:       <?php echo of_get_option('sf_delay'); ?>, 		// one second delay on mouseout 
				animation:   {opacity:'<?php echo of_get_option('sf_f_animation'); ?>'<?php if (of_get_option('sf_sl_animation')=='show') { ?>,height:'<?php echo of_get_option('sf_sl_animation'); ?>'<?php } ?>}, // fade-in and slide-down animation
				speed:       '<?php echo of_get_option('sf_speed'); ?>',  // faster animation speed 
				autoArrows:  false,   // generation of arrow mark-up (for submenu) 
				dropShadows: false
			});
			
		});
		
		// Init for audiojs
		audiojs.events.ready(function() {
			var as = audiojs.createAll();
		});
		
		// Init for si.files
		SI.Files.stylizeAll();
  </script>
  
  <script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".nivo-controlNav").hover(function(){
		  jQuery(this).stop().animate({top: "406px"}, 700 );
		},function(){
		  jQuery(this).stop().animate({top: "462px"}, 700 );
		});
	});
  </script>
  
  <script type="text/javascript">
		jQuery(window).load(function() {
			// nivoslider init
			jQuery('#slider').nivoSlider({
				effect: '<?php echo of_get_option('sl_effect'); ?>',
				slices:<?php echo of_get_option('sl_slices'); ?>,
				boxCols:<?php echo of_get_option('sl_box_columns'); ?>,
				boxRows:<?php echo of_get_option('sl_box_rows'); ?>,
				animSpeed:<?php echo of_get_option('sl_animation_speed'); ?>,
				pauseTime:<?php echo of_get_option('sl_pausetime'); ?>,
				directionNav:<?php echo of_get_option('sl_dir_nav'); ?>,
				directionNavHide:<?php echo of_get_option('sl_dir_nav_hide'); ?>,
				controlNav:'.nivo-controlNav',
				controlNavThumbs: true,
				captionOpacity:<?php $sl_caption_opacity = of_get_option('sl_caption_opacity'); if ($sl_caption_opacity != '') { echo of_get_option('sl_caption_opacity'); } else { echo '0'; } ?>
			});
		});
	</script>
  
  
  <style type="text/css">
		
		<?php $background = of_get_option('body_background');
			if ($background != '') {
				if ($background['image'] != '') {
					echo 'body { background-image:url('.$background['image']. '); background-repeat:'.$background['repeat'].'; background-position:'.$background['position'].';  background-attachment:'.$background['attachment'].'; }';
				}
				if($background['color'] != '') {
					echo 'body { background-color:'.$background['color']. '}';
				}
			};
		?>
		
		<?php $header_styling = of_get_option('header_color'); 
			if($header_styling != '') {
				echo '#header {background-color:'.$header_styling.'}';
			}
		?>
		
		<?php $links_styling = of_get_option('links_color'); 
			if($links_styling) {
				echo 'a{color:'.$links_styling.'}';
				echo '.button {background:'.$links_styling.'}';
			}
		?>

  </style>
</head>

<body <?php body_class(); ?>>

<div id="main"><!-- this encompasses the entire Web site -->

    <header id="header">
        <div class="container_16 clearfix">
            <div class="grid_16">
            
                <div class="logo">
					<?php if(of_get_option('logo_type') == 'text_logo'){?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
                            <h1><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
                        <?php } else { ?>
                            <h2><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h2>
                        <?php } ?>
					<?php } else { ?>
                        <?php if(of_get_option('logo_url') != ''){ ?>
                            <a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
                        <?php } else { ?>
                            <a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
                        <?php } ?>
                    <?php }?>
                    <p class="tagline"><?php bloginfo('description'); ?></p>
                </div>
        
                <nav class="menu_left">
					<?php wp_nav_menu( array(
						'container'       => 'ul', 
						'menu_class'      => 'sf-menu', 
						'menu_id'         => 'topnav_left',
						'depth'           => 0,
						'theme_location' => 'header_menu_left' 
                      )); 
                    ?>
                </nav>
        
                <nav class="menu_right">
					<?php wp_nav_menu( array(
						'container'       => 'ul', 
						'menu_class'      => 'sf-menu', 
						'menu_id'         => 'topnav_right',
						'depth'           => 0,
						'theme_location' => 'header_menu_right' 
                      )); 
                    ?>
                </nav>
        
				<?php if ( of_get_option('g_search_box_id') == 'yes') { ?>  
                    <form method="get" id="searchform" action="<?php echo get_option('home'); ?>/">
                        <input type="text" name="s"  class="input-search"/>
                        <input type="submit" value="<?php _e('Go!', 'theme1943'); ?>" id="submit">
                    </form>
                <?php } ?>
        
            </div>
        </div><!--.container_16-->
    </header>
    
	<?php if( is_front_page() ) { ?>
        <section id="slider-wrapper">
			<?php include_once(TEMPLATEPATH . '/slider.php'); ?>
        </section><!--#slider-->
    <?php } ?>
    
    <?php if( is_front_page() ) { ?>
        <div class="extra_area_1">
            <div class="container_16 clearfix">
                <div class="grid_16">
					
                    <div class="line_ver_1">
                    	<div class="line_ver_2">
                        	<div class="line_ver_3">
                            	
                                <div class="col_1">
									<?php if ( ! dynamic_sidebar( 'Extra Area 1' ) ) : ?>
                                        <!--Widgetized 'Extra Area 1' for the home page-->
                                    <?php endif ?>
                                </div>
                                
                                <div class="col_2">
									<?php if ( ! dynamic_sidebar( 'Extra Area 2' ) ) : ?>
                                        <!--Widgetized 'Extra Area 1' for the home page-->
                                    <?php endif ?>
                                </div>
                                
                                <div class="col_3">
									<?php if ( ! dynamic_sidebar( 'Extra Area 3' ) ) : ?>
                                        <!--Widgetized 'Extra Area 1' for the home page-->
                                    <?php endif ?>
                                </div>
                                
                                <div class="col_4">
									<?php if ( ! dynamic_sidebar( 'Extra Area 4' ) ) : ?>
                                        <!--Widgetized 'Extra Area 1' for the home page-->
                                    <?php endif ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    <?php } ?>
    
    <?php if( is_front_page() ) { ?>
        <div class="extra_area_2">
        	<div class="inner">
                <div class="container_16 clearfix">
                    <div class="grid_16">
                        
                        <div class="box_2">
                            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                                <?php the_content(); ?>
                            <?php endwhile; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    
    <?php if( is_front_page() ) { ?>
        <div class="extra_area_3">
        	<div class="inner">
                <div class="container_16 clearfix">
                    <div class="grid_16">
                        
                        <div class="box_3">
							<?php if ( ! dynamic_sidebar( 'Extra Area 5' ) ) : ?>
                                <!--Widgetized 'Extra Area 1' for the home page-->
                            <?php endif ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
	<div id="ic">More Website Templates @ TemplateMonster.com - January28, 2013!</div>  
	<div class="primary_content_wrap">
    	<div class="container_16 clearfix">
        	<div class="wrapper">