<?php
/*
Template Name: Archives
*/
get_header(); ?>

     <?php
            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
            $setParallaxHeight=tia_get_option('tia_default_height');
            $lb_bgcolor = get_post_meta($post->ID, "_tia_lb_bgcolor_value", true);
            $lb_bgrepeat = get_post_meta($post->ID, "_tia_lb_repeat_value", true);
            $bg_alignment = get_post_meta($post->ID, "_tia_bg_alignment_value", true);
        ?>
        <style type="text/css">
            body {
                background-image: url(<?php echo $src[0]; ?>);
                min-height:<?php echo $setParallaxHeight; ?>px;
                <?php if ($lb_bgcolor==true){echo " background-color:".$lb_bgcolor.";";} ?>
                <?php if ($lb_bgrepeat==true){echo " background-repeat:repeat, repeat;";} else {echo " background-repeat:repeat, no-repeat;";} ?>
                <?php if ($bg_alignment==true){echo " background-position:".$bg_alignment.";";} ?>
            }
        </style>

    <div <?php post_class('parallax-container'); ?>>
        <div class="inside clearfix">
            <div id="content" class="posts clearfix">
                <div class="post">
                    <?php the_post(); ?>
                    <h1 class="giga"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <ul class="list--unstyled  list--column-3">
                        <?php wp_list_categories('use_desc_for_title=0&title_li='); ?>
                    </ul>

                </div> <!-- /.post -->
            </div> <!-- / .posts -->
        </div> <!-- /.inside -->
    </div> <!-- /.parallax-container -->

<?php get_footer(); ?>