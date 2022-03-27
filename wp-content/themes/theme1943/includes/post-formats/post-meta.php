<?php $post_meta = of_get_option('post_meta'); ?>
<?php if ($post_meta=='true' || $post_meta=='') { ?>
    <div class="post-meta">
		<?php _e('Submitted by', 'theme1943'); ?> <?php the_author_posts_link() ?> <?php _e('on', 'theme1943'); ?> <time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('D, d/m/Y - h:i') ?></time>
    </div><!--.post-meta-->
<?php } ?>