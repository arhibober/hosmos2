			</div>
        </div>
    </div>
    
	<footer id="footer">
    
        <div id="back-top-wrapper">
            <p id="back-top">
                <a href="#top"><span></span></a>
            </p>
        </div>
    
        <div class="container_16 clearfix">
            <div class="grid_16">
                
                <div class="footer_area_1">
					<?php if ( ! dynamic_sidebar( 'Footer Area 1' ) ) : ?>
                        <!--Widgetized Footer-->
                    <?php endif ?>
                </div>
                
                <div class="footer_area_2">
					<?php if ( ! dynamic_sidebar( 'Footer Area 2' ) ) : ?>
                        <!--Widgetized Footer-->
                    <?php endif ?>
                </div>
                
                <div id="footer-text">
                
					<?php $myfooter_text = of_get_option('footer_text'); ?>
                    <?php if($myfooter_text){?>
						<?php echo of_get_option('footer_text'); ?>
                    <?php } else { ?>
                        <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> <b>&copy;</b> <?php echo date ('Y'); ?> <i>&bull;</i> <a href="<?php bloginfo('url'); ?>/privacy-policy/" title="Privacy Policy"><?php _e('Privacy Policy', 'theme1943'); ?></a> <?php if( is_front_page() ) { ?><!-- {%FOOTER_LINK} --><?php } ?>
                    <?php } ?>
                    <p>Website Template designed by <a href="http://www.templatemonster.com/" rel="nofollow">TemplateMonster.com</a></p>
                </div>
                
				<?php if ( of_get_option('footer_menu') == 'true') { ?>  
                    <nav class="footer">
						<?php wp_nav_menu( array(
							'container'       => 'ul', 
							'menu_class'      => 'footer-nav', 
							'depth'           => 0,
							'theme_location' => 'footer_menu' 
                          )); 
                        ?>
                    </nav>
                <?php } ?>
					
            </div>
        </div>
    </footer>
    
</div><!--#main-->
<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->
<?php if(of_get_option('ga_code')) { ?>
	<script type="text/javascript">
		<?php echo stripslashes(of_get_option('ga_code')); ?>
	</script>
  <!-- Show Google Analytics -->	
<?php } ?>
</body>
</html>