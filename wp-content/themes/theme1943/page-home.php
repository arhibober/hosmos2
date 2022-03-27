<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>

    <div class="clearfix">
        <div class="grid_16">
        	
            <div class="grid_5 alpha">
				<?php if ( ! dynamic_sidebar( 'Content Area 1' ) ) : ?>
                    <!--Widgetized 'Content Area' for the home page-->
                <?php endif ?>
            </div>
            
            <div class="grid_3 suffix_1">
				<?php if ( ! dynamic_sidebar( 'Content Area 2' ) ) : ?>
                    <!--Widgetized 'Content Area' for the home page-->
                <?php endif ?>
            </div>
            
            <div class="grid_7 omega">
				<?php if ( ! dynamic_sidebar( 'Content Area 3' ) ) : ?>
                    <!--Widgetized 'Content Area' for the home page-->
                <?php endif ?>
            </div>
            
        
        </div>
    </div>

<?php get_footer(); ?>