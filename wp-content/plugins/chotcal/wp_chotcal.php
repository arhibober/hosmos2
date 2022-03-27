<?php

/* 
Plugin Name: wp_chotcal
Plugin URI: http://www.jourdets.com/codage/fr_calendar.html
Description: wp_chotcal is a booking calendar for B&B ( chambres d'hôtes )
Version: 1.1 
Author: <a href="http://www.jourdets.com">Les Jourdets</a>
Author URI: http://www.jourdets.com
*/  
require_once('php/messages.php'); 
require_once('php/fonctions.php');

global $inst_wp_chotcal; 

if ( !class_exists("wp_chotcal") ) {  
	
class wp_chotcal extends WP_Widget
	{  
	/*** Constructor ***/  
	var $adminOptionsName = 'wp_chotcalAdminOptions'; 
	var $version = '1.1';
	var $mois_de_annee = array(MSG_jan,MSG_feb,MSG_mar,MSG_apr,MSG_may,MSG_jun,MSG_jul,MSG_aug,MSG_sep,MSG_oct,MSG_nov,MSG_dec);
	
	protected $widget = array(
		'name' => MSG_widgetname,
		// this description will display within the administrative widgets area
		// when a user is deciding which widget to use.
		'description' => MSG_widgetdesc,
		
		// determines whether or not to use the sidebar _before and _after html
		'do_wrapper' => true, 
		
		// string : if you set a filename here, it will be loaded as the view
		// when using a file the following array will be given to the file :
		// array('widget'=>array(),'params'=>array(),'sidebar'=>array(),
		// alternatively, you can return an html string here that will be used
		'view' =>  false,
		
		'fields' => array(
			// You should always offer a widget title
			array(
				'name' => MSG_widget_title1,
				'desc' => MSG_widget_title2,
				'id' => 'title',
				'type' => 'text',
				'std' => 'Widget Title'
				),
			array(
		    	'name'    => MSG_nchds1,
				'desc'    => MSG_nchds2,
		    	'id'      => 'nchdis',
		    	'type'    => 'select',
		    	'options' => array( '1' => '1', '2' => '2', '3' => '3' )
				),
			array(
		    	'name'    => MSG_wpage1,
				'desc'    => MSG_wpage2,
		    	'id'      => 'pagonly',
		    	'type'    => 'select',
		    	'options' => array(  ) // vide
				),
			array(
		    	'name'    => MSG_wroom1,
				'desc'    => MSG_wroom2,
		    	'id'      => 'roomdisplay',
		    	'type'    => 'select',
		    	'options' => array(  ) // vide
				) /* ,
			array(
				'name' => 'chambre 1',
				'desc' => '',
				'id' => 'ch1',
				'type' => 'checkbox'
				),
			array(
				'name' => 'chambre 2',
				'desc' => '',
				'id' => 'ch2',
				'type' => 'checkbox'
				),
			array(
				'name' => 'chambre 3',
				'desc' => '',
				'id' => 'ch3',
				'type' => 'hidden'
				),
			array(
				'name' => 'chambre 4',
				'desc' => '',
				'id' => 'ch4',
				'type' => 'hidden'
				),
			array(
				'name' => 'chambre 5',
				'desc' => '',
				'id' => 'ch5',
				'type' => 'hidden'
				) */
			)
		);
			
	function wp_chotcal()  
		{  
		// error_log('wp_chotcal()');
        $widget_ops = array('classname' => 'widget_chotcal', 'description'=>$this->widget['description'] );
        $this->WP_Widget('widget_chotcal', $this->widget['name'], $widget_ops);
   
    	add_shortcode('chotcal',array(&$this, 'pageCalendar')); 

		add_action('wp_print_styles',  array(&$this, 'initPageStyles'));
		add_action('admin_print_styles',  array(&$this, 'initAdminStyles'));
		// add_action('widgets_init',  array(&$this, 'registerWidget'));
		
		add_action('admin_enqueue_scripts', array(&$this, 'initScripts') );
		add_action('wp_enqueue_scripts', array(&$this, 'initScripts') );
		
		register_activation_hook(__FILE__, array(&$this, 'wp_chotcal_install'));  
		register_deactivation_hook(__FILE__, array(&$this, 'wp_chotcal_uninstall')); 
		
		// add_action('admin_menu', array(&$this, 'adminMenus'));
		$this->init();
		}  
		
	function registerWidget() 
		{
		register_widget("wp_chotcal");
		}
		
	function getAdminOptions()   
    	{  
        $wp_chotcalAdminOptions = array(  // default options
            'nbch' => 2  ,
       		'nom' => array ( 'chambre 1','chambre 2','chambre 3','chambre 4','chambre 5' ),
        	'abr' => array ( 'c1','c2','c3','c4','c5' ),
        	'col' => array ( 'FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF' )
            );  
        $wp_chotcalOptions = get_option($this->adminOptionsName);  
        if ( !empty($wp_chotcalOptions) )  
        	{  
            foreach ($wp_chotcalOptions as $key => $option)  
            	{
                $wp_chotcalAdminOptions[$key] = $option;  
            	}
        	}  
        update_option($this->adminOptionsName, $wp_chotcalAdminOptions);  
        return $wp_chotcalAdminOptions;  
    	}  

/**************************/
    	
    function init()   
    	{  
        $this->getAdminOptions();  
        // $locale = setlocale(LC_TIME, "en_EN","en","english");
      
    	}  
    
/*** Installation du plugin wp_chotcal ***/  
    	
    function wp_chotcal_install()  
    	{  
        global $wpdb;  
           
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); 

        //création des tables  
        $table_name = $wpdb->prefix.'chotcal_calendrier';  
        $sql = "CREATE TABLE `$table_name` (  
        	`id` int(1) NOT NULL AUTO_INCREMENT,
  			`jour` date NOT NULL,
  			`njours` int(1) NOT NULL DEFAULT '1',
  			`nch` int(1) NOT NULL DEFAULT '0',
  			`infos` longtext CHARACTER SET latin1 NOT NULL,
  			PRIMARY KEY (`id`)
             ) ;";  
        
        dbDelta($sql);  
        
        $table_name = $wpdb->prefix.'chotcal_fermetures';  
        $sql = "CREATE TABLE `$table_name` (  
        	`id` int(1) NOT NULL AUTO_INCREMENT,
  			`ffrom` date NOT NULL,
  			`fto` date NOT NULL,
  			`nch` int(1) NOT NULL DEFAULT '255',
  			PRIMARY KEY (`id`)
             ) ;";  
        
        dbDelta($sql);  
           
        $option['wp_chotcal_version'] = $this->version;  
        add_option('wp_chotcal_version',$option);  
        
    	/*
       		add_menu_page('wp_chotcal',MSG_menu1, 'administrator', 'chotcal_1' , array(&$this, 'managePage'));
       		add_submenu_page('chotcal_1', 'wp_chotcal', MSG_smenu1,'administrator', 'chotcal_1' , array(&$this, 'managePage'));
       		add_submenu_page('chotcal_1', 'wp_chotcal', MSG_smenu2,'administrator', 'chotcal_2' , array(&$this, 'optionsPage'));
       		add_submenu_page('chotcal_1', 'wp_chotcal', MSG_smenu3,'administrator', 'chotcal_3' , array(&$this, 'vacancesPage'));
*/
        
        
        $this->getAdminOptions();  
    	}   
/*** Désinstallation du plugin wp_chotcal ***/  
    	
    function wp_chotcal_uninstall()  
    {  
        global $wpdb;  
        
        
        // drop des tables  
        $table_name = $wpdb->prefix.'chotcal_calendrier';   
        $sql = "DROP TABLE `$table_name`";  
        $wpdb->query($sql);  
        $table_name = $wpdb->prefix.'chotcal_fermetures';  
        $sql = "DROP TABLE `$table_name`";  
        $wpdb->query($sql); 
        
        delete_option('wp_chotcal_version');  
        delete_option($this->adminOptionsName);  
        
        remove_menu_page('chotcal_1');
        remove_menu_page('chotcal_1','chotcal_1');
        remove_menu_page('chotcal_1','chotcal_2');
        remove_menu_page('chotcal_1','chotcal_3');
    }  
    
/*************************/
    	
    function adminMenus() 
    	{
    	// error_log('adminMenus()');
    	if (function_exists('add_menu_page')) 
     		{
       		add_menu_page('wp_chotcal',MSG_menu1, 'administrator', 'chotcal_1' , array(&$this, 'managePage'));
     		}
   		if (function_exists('add_submenu_page')) 
     		{
       		add_submenu_page('chotcal_1', 'wp_chotcal', MSG_smenu1,'administrator', 'chotcal_1' , array(&$this, 'managePage'));
       		add_submenu_page('chotcal_1', 'wp_chotcal', MSG_smenu2,'administrator', 'chotcal_2' , array(&$this, 'optionsPage'));
       		add_submenu_page('chotcal_1', 'wp_chotcal', MSG_smenu3,'administrator', 'chotcal_3' , array(&$this, 'vacancesPage'));
       		}
        }  
    
/****************/
    
    function optionsPage() 
    	{  
    	
        $options = $this->getAdminOptions();  
        if (isset($_POST['update_wp_options'])) 
        	{
    	
         	if (isset($_POST['nbch'])) 
                $options['nbch'] = $_POST['nbch'];   
                
            $nch = (int)$options['nbch'];
                
            for ( $i = 0 ; $i < 5 ; $i++ )
            	{
            	$j = $i+1;
            	$ind = 'nom'.$j;
            	if (isset($_POST[$ind])) 
                	$options['nom'][$i] = $_POST[$ind];
                $jnd = 'abr'.$j;
            	if (isset($_POST[$jnd])) 
                	$options['abr'][$i] = $_POST[$jnd];  
                $knd = 'col'.$j;
            	if (isset($_POST[$knd])) 
                	$options['col'][$i] = $_POST[$knd];   

            	}  
            	
            update_option($this->adminOptionsName,$options);  
            
            print '<div class="updated"><p><strong>';  
            print MSG_pmaj;
            print '</strong></p></div>';    
        	}  
        include('php/options.php'); // include du formulaire HTML  
    	} 
    	
/****************/
    	
    function filter_field($field)
    	{
    	$ffield = $field;
    	
    	$options = $this->getAdminOptions();  
    	
    	if ( $field['id'] == 'pagonly' )
    		{
    		$ffield['options'][0] = MSG_allpages;
    		$pages = get_pages();
  			foreach ( $pages as $pagg ) {
				$ffield['options'][$pagg->ID] = $pagg->post_title;
  				}
    		// print_r($ffield['options']);
    		}
    	else if ( $field['id'] == 'roomdisplay' )
    		{
    		$ffield['options'][0] = MSG_allrooms;
  			for ( $i = 1 ; $i <= (int)$options['nbch'] ; $i++ )
  				{
				$ffield['options'][$i] = $options['nom'][$i-1];
  				}
    		// print_r($ffield['options']);
    		}
    	/*** in check boxes
        for ( $j = 1 ; $j <= 5 ; $j++ )
           	{	
            $id = 'ch'.$j;
            $name = 'nom'.$j;
            if ( $field['id'] == $id )
            	{
            	if ( $j > (int)$options['nbch'] )
            		$ffield['type'] = 'hidden';
            	else	
            		{
            		$ffield['name'] = MSG_dchamb1.' '.$options[$name];
            		$ffield['type'] = 'checkbox';
            		if ( $j == (int)$options['nbch'] )
            			$ffield['desc'] = MSG_dchamb2;
            		}
            	
            	}
            }
        ***/
    	return $ffield;
    	}
    	
   	
/****************/
    	
    function managePage()
    	{
    	$html = '';  
    	$chotcal_context = "manage";
		include('php/page.php'); 
		echo $html;
    	}
    	
/****************/
    	
    function vacancesPage()
    	{
    	$html = '';  
		include('php/fermetures.php'); 
		echo $html;
    	}
    	
/***************/
    	    	
	function initScripts()
		{ 
  		$file = plugins_url( "wp_chotcal/jscolor/jscolor.js", dirname(__FILE__) );
  		wp_register_script('wp_chotcal_jscolor', $file);
  		wp_enqueue_script('wp_chotcal_jscolor');
  		$file = plugins_url( "wp_chotcal/js/jquery-ui-1.8.18.custom.min.js", dirname(__FILE__) );
  		wp_register_script('wp_chotcal_jquery_js', $file, array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse'));
  		wp_enqueue_script('wp_chotcal_jquery_js'); 
		}
		
/***************/
    	
    function initPageStyles()
    	{
    	$file = plugins_url( "wp_chotcal/css/wp_chotcal.css", dirname(__FILE__) );
    	wp_register_style('wp_chotcal_css', $file);  
    	wp_enqueue_style( 'wp_chotcal_css');
    	$file = plugins_url( "wp_chotcal/css/jquery-ui-1.8.18.custom.css", dirname(__FILE__) );
    	wp_register_style('wp_chotcal_jquery_css',$file);  
    	wp_enqueue_style( 'wp_chotcal_jquery_css');
    	}
    	
/****************/
    	
 	function initAdminStyles()
    	{
    	$file = plugins_url( "wp_chotcal/css/wp_chotcal.css", dirname(__FILE__) );
    	wp_register_style('wp_chotcal_css', $file);  
    	wp_enqueue_style( 'wp_chotcal_css');
    	$file = plugins_url( "wp_chotcal/css/jquery-ui-1.8.18.custom.css", dirname(__FILE__) );
    	wp_register_style('wp_chotcal_jquery_css',$file);  
    	wp_enqueue_style( 'wp_chotcal_jquery_css');
    	}	
    	
/*** Affichage du calendrier sur la page via les shortcodes ***/
	
    function pageCalendar($attributes, $initialContent = '')  
    	{
        $html = '';  
        $chotcal_context = "page";
		include('php/page.php');  
        return $html;  
        } 
        
       

/** * Widget HTML */
        
	function html($widget, $params, $sidebar)
	{
		// print_r($widget); 
		// print_r($params); 

		
			$nchdis = empty($params['nchdis']) ? 
        		$this->nmonths_to_display : 
        		(int)$params['nchdis'];
        	
			$html = '';   
       	include('php/page_widget.php');  
        print $html;
		
	}
	
/*** Widget View
	 * 
	 * This method determines what view method is being used and gives that view
	 * method the proper parameters to operate. This method does not need to be
	 * changed.
	 *
	 */
	function widget($sidebar, $params)
	{
		if ( $params['pagonly'] == 0 || is_page((int)$params['pagonly']) ) { // page du widget ?
		//initializing variables
		$this->widget['number'] = $this->number;
		
		// print_r($params);

        $title = empty($params['title']) ? 
        	$this->widget['name'] : 
        	apply_filters('widget_title', $params['title']);
        	
		$do_wrapper = (!isset($this->widget['do_wrapper']) || $this->widget['do_wrapper']);
		
		if ( $do_wrapper ) 
			echo $sidebar['before_widget'];
			
		echo $sidebar['before_title'] . $title . $sidebar['after_title']; 
		
		//loading a file that is isolated from other variables
		if (file_exists($this->widget['view']))
			$this->getViewFile($widget, $params, $sidebar);
			
		if ($this->widget['view'])
			echo $this->widget['view'];
			
		else $this->html($this->widget, $params, $sidebar);
			
		if ( $do_wrapper ) 
			echo $sidebar['after_widget'];
		}
	}
	
	/**
	 * Get the View file
	 * 
	 * Isolates the view file from the other variables and loads the view file,
	 * giving it the three parameters that are needed. This method does not
	 * need to be changed.
	 *
	 * @param array $widget
	 * @param array $params
	 * @param array $sidebar
	 */
	function getViewFile($widget, $params, $sidebar) {
		require $this->widget['view'];
	}

	/**
	 * Administration Form
	 * 
	 * This method is called from within the wp-admin/widgets area when this
	 * widget is placed into a sidebar. The resulting is a widget options form
	 * that allows the administration to modify how the widget operates.
	 * 
	 * You do not need to adjust this method what-so-ever, it will parse the array
	 * parameters given to it from the protected widget property of this class.
	 *
	 * @param array $instance
	 * @return boolean
	 */
	function form($instance)
	{
		//reasons to fail
		if (empty($this->widget['fields'])) return false;
		
		$defaults = array(
			'id' => '',
			'name' => '',
			'desc' => '',
			'type' => '',
			'options' => '',
			'std' => '',
		);
		
		
		
		do_action('wp_chotcal_before');
		foreach ($this->widget['fields'] as $field)
		{
			//making sure we don't throw strict errors
			$field = wp_parse_args($field, $defaults);

			$field = $this->filter_field($field); // names from options
			if ( $field['type'] == 'hidden' ) continue;
			
			$meta = false;
			if (isset($field['id']) && array_key_exists($field['id'], $instance))
				@$meta = attribute_escape($instance[$field['id']]);

			if ($field['type'] != 'custom' && $field['type'] != 'metabox'  ) 
				{
				echo '<p><label for="',$this->get_field_id($field['id']),'">';
				}
			if (isset($field['name']) && $field['name']) echo $field['name'],':';

			switch ($field['type'])
			{
				case 'hidden' :
					break;
				case 'text':
					echo '<input type="text" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '" value="', ($meta ? $meta : @$field['std']), '" class="vibe_text" />', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'textarea':
					echo '<textarea class="vibe_textarea" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '" cols="60" rows="4" style="width:97%">', $meta ? $meta : @$field['std'], '</textarea>', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'select':
					echo '<select class="vibe_select" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '">';

					foreach ($field['options'] as $value => $option)
					{
 					   $selected_option = ( $value ) ? $value : $option;
					    echo '<option', ($value ? ' value="' . $value . '"' : ''), ($meta == $selected_option ? ' selected="selected"' : ''), '>', $option, '</option>';
					}

					echo '</select>', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'radio':
					foreach ($field['options'] as $option)
					{
						echo '<input class="vibe_radio" type="radio" name="', $this->get_field_name($field['id']), '" value="', $option['value'], '"', ($meta == $option['value'] ? ' checked="checked"' : ''), ' />', 
						$option['name'];
					}
					echo '<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'checkbox':
					echo '<input type="hidden" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '" /> ', 
						 '<input class="vibe_checkbox chotcal-checkbox" type="checkbox" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '"', $meta ? ' checked="checked"' : '', ' /> ', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'custom':
					echo $field['std'];
					break;
			}

			if ($field['type'] != 'custom' && $field['type'] != 'metabox') 
			{
				echo '</label></p>';
			}
		}
		do_action('wp_chotcal_after');
		return true;
	}

	/** Update the Administrative parameters */
	function update($new_instance, $old_instance)
	{
		// processes widget options to be saved
		$instance = wp_parse_args($new_instance, $old_instance);
		return $instance;
	}
}
}

// Start this plugin once all other plugins are fully loaded
add_action( 'init', 'initChotCal' ); 
function initChotCal() 
	{ 
	global $inst_wp_chotcal; 
	$inst_wp_chotcal = new wp_chotcal();   
	}

// register wp_chotcal widget
add_action('widgets_init',  array(&$inst_wp_chotcal, 'registerWidget'));

 if ( class_exists("wp_chotcal") )  
    {  
    $inst_wp_chotcal = new wp_chotcal();  
    }  

add_action('admin_menu', array(&$inst_wp_chotcal, 'adminMenus'));



?>