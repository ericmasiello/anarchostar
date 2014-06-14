<?php $postType = 'post'; ?>

<?php

function applyDefaultAndUnitToOffsetValues( $val ){

    $cssUnitPattern = '/((px|em|ex|pt|in|pc|mm|cm|\%)?)$/i';

    if( $val == "" ){

        $val = "0px";
    }

    /*
     * Make sure the image and text block offset values
     * have an appropriate CSS unit e.g. px, %, etc
     */

    preg_match_all($cssUnitPattern, $val, $out );

    if( $out[0][0] == "" ){

        $val = $val . "px";
    }

    return $val;
}

//first get the current category ID
$cat_id = get_query_var('cat');
//then i get the data from the database
$cat_data = get_option("category_$cat_id");
//and then i just display my category image if it exists
if ( empty($cat_data['background-color']) != true ){ ?>
        <style type="text/css">
            body {

                background-color: <?php echo $cat_data['background-color']; ?> !important;
            }
        </style>
<?php
}


global $storyMarginTop;

$i = 1; // Start a counter outside of the loop

while ( have_posts() ) : the_post(); // Start the loop

    $cssUnitPattern = '/((px|em|ex|pt|in|pc|mm|cm|\%)?)$/i';

    //Grab post options
    $lightbox_img = get_post_meta($post->ID, "_tia_lightbox_image_value", true); // to be killed
    $alignment = get_post_meta($post->ID, "_tia_align_right_value", true); // to be killed
    $postAlignment = get_post_meta($post->ID, "_tia_post_alignment_value", true);
    $imgOffsetY = get_post_meta($post->ID, "_tia_offset_y_scrolling_image", true);
    $imgOffsetX = get_post_meta($post->ID, "_tia_offset_x_scrolling_image", true);

    $textOffsetY = get_post_meta($post->ID, "_tia_offset_y_block_text", true);
    $textOffsetX = get_post_meta($post->ID, "_tia_offset_x_block_text", true);


    $noTextBackground = get_post_meta($post->ID, "_tia_no_text_background_value", true);
    $lb_height = get_post_meta($post->ID, "_tia_lb_height_value_value", true);
    $lb_bgcolor = get_post_meta($post->ID, "_tia_lb_bgcolor_value", true);
    $blockTextColor = get_post_meta($post->ID, "_tia_block_text_color_value", true);
    $overrideAnchorColor = get_post_meta($post->ID, "_tia_override_anchor_color_value", true);
    $lb_bgrepeat = get_post_meta($post->ID, "_tia_lb_repeat_value", true);
    $bg_alignment = get_post_meta($post->ID, "_tia_bg_alignment_value", true);
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
    $setParallaxHeight=tia_get_option('tia_default_height');
    $theContentEnabled=tia_get_option('tia_theContent_enabled');

    $soundCloudPost = get_post_meta($post->ID, "_sc_post_url", true);

    $imgOffsetY = applyDefaultAndUnitToOffsetValues($imgOffsetY);
    $imgOffsetX = applyDefaultAndUnitToOffsetValues($imgOffsetX);
    $textOffsetY = applyDefaultAndUnitToOffsetValues($textOffsetY);
    $textOffsetX = applyDefaultAndUnitToOffsetValues($textOffsetX);

                
    if ( $overrideAnchorColor ) { ?> <style>#content #block<?php echo $i; ?> a {color: <?php echo $overrideAnchorColor; ?>;}</style> <?php }

	if( has_post_thumbnail() ) : ?>
        
        <div id="block<?php echo $i; ?>" <?php post_class('parallax-container'); ?>  style="background-image: url(<?php echo $src[0]; ?>); overflow: hidden; min-height:<?php echo $setParallaxHeight; ?>px;<?php if ($lb_bgcolor==true){echo " background-color:".$lb_bgcolor.";";} ?><?php if ($lb_bgrepeat==true){echo " background-repeat:repeat;";} else {echo " background-repeat:no-repeat;";} ?><?php if ($bg_alignment==true){echo " background-position:".$bg_alignment.";";} ?>">

            <style type="text/css">

                @media screen and (min-height: 800px) and (min-width: 768px) {
                    #block<?php echo $i; ?> .blockText {

                        margin-left: <?php echo $textOffsetX; ?>;
                        margin-top: <?php echo $textOffsetY; ?>;
                    }

                    #block<?php echo $i; ?> .bg1 {

                        margin-left: <?php echo $imgOffsetX; ?>;
                        margin-top: <?php echo $imgOffsetY; ?>;
                    }
                }

            </style>

            <div class="story story<?php if($postAlignment) { echo $postAlignment; }?>">
                <div class="story-container">
        	    <?php

                // Loops through each feature image and grabs thumbnail URL
                if (class_exists('MultiPostThumbnails')) {
                    $m=1;
                    while ($m <= 1) {

                        //-'.$m; <- // sets image name as feature-image-1, feature-image-2 etc. place m back in and add the number one in the function later
                        $image_name = 'extra-scrolling-image';

                        if ( MultiPostThumbnails::has_post_thumbnail( $postType, $image_name ) ) {

                            $image_id = MultiPostThumbnails::get_post_thumbnail_id( $postType, $image_name, $post->ID );  // use the MultiPostThumbnails to get the image ID
                            //$image_thumb_url = wp_get_attachment_image_src( $image_id,'small-thumb');  // define thumb src based on image ID
                            $image_feature_url = wp_get_attachment_image_src( $image_id,'extra-scrolling-image' ); // define full size src based on image ID
                            $attr = array(
                             'class' => "",      // set custom class
                             'src' => $image_feature_url[0], // sets the url for the full image size
                            );
                            // Use wp_get_attachment_image instead of standard MultiPostThumbnails to be able to tweak attributes
                            $extraImage = wp_get_attachment_image( $image_id, 'extra-scrolling-image', false, $attr );  ?>

                            <div class="<?php echo 'bg'.$m ?>" style="background-image: url(<?php echo $image_feature_url[0]; ?>); min-height:<?php echo $setParallaxHeight; ?>px; height:<?php echo $setParallaxHeight; ?>px;">
                                &nbsp;
                            </div>
                        <?php } // endif
                        $m++;
                    } // end while

                } else {

                    if($lightbox_img) { ?>
                        <div class="bg" style="background-image: url(<?php echo $lightbox_img; ?>); min-height:<?php echo $setParallaxHeight; ?>px; height:<?php echo $setParallaxHeight; ?>px;">
                        &nbsp;</div>
                    <?php }
                } ?>

        	    <div class="<?php if($postAlignment) { echo $postAlignment; } elseif ($alignment) { echo ' float-right'; } else { echo ' float-left';} ?> blockText">
            	    <h1><?php if(tia_get_option('tia_title_links_disabled')){ ?><?php the_title(); ?><?php } else { ?> <a href="<?php the_permalink() ?>" rel="bookmark" <?php if($noTextBackground){echo'style="color:', $blockTextColor, '"';} ?>><?php the_title(); ?></a> <?php } ?></h1>

				    <?php if(!tia_get_option('tia_author_credit_disabled')){ ?>
					    <div class="meta clearfix" <?php if($noTextBackground){echo'style="color:', $blockTextColor, '"';} ?>>Posted by <?php the_author_posts_link();  ?> </div>
				    <?php } ?>

				    <?php if($theContentEnabled) {

					    the_content('',TRUE);

    			    } else {

    				    the_excerpt('',TRUE);
    			    }

    				more_link();

    		  	    if( $soundCloudPost ): ?>
    		  	        <div class="sc-container"><a href="<?php echo $soundCloudPost; ?>" class="sc-player"><?php echo $soundCloudPost; ?></a></div>
                    <?php endif; ?>

                    <!--<p class="postmetadata"> <?php bloginfo('name'); ?> | <?php the_category(', ') ?><?php edit_post_link(' | Edit', ''); ?>  </p>-->
                </div>
                </div> <!-- /.story-container -->
            </div> <!-- /.story-->
        </div> <!-- ./block -->

        <?php $i++; ?>

    <?php else : ?>

        <div id="block<?php echo $i; ?>" <?php $i++; ?> <?php post_class('parallax-container'); ?>  style="background-image: url(<?php echo $src[0]; ?>); overflow: hidden; min-height:<?php echo $setParallaxHeight; ?>px;<?php if ($lb_bgcolor==true){echo " background-color:".$lb_bgcolor.";";} ?>">
            <div class="story">
            	<div class="<?php if($postAlignment) { echo $postAlignment; } ?> blank blockText" style="<?php if($noTextBackground){echo'background:none;';}  if($blockTextColor){echo ' color:', $blockTextColor;} ?>">
            		<h1><?php if(tia_get_option('tia_title_links_disabled')){ ?><?php the_title(); ?><?php } else { ?> <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> <?php if($noTextBackground){echo'style="color:', $blockTextColor, '"';} ?></a> <?php } ?></h1>
						
                    <?php if(!tia_get_option('tia_author_credit_disabled')){ ?>
                        <div class="meta clearfix">Posted by <?php the_author_posts_link();  ?> </div>
                    <?php }

                    if($theContentEnabled)	{
                        the_content('',TRUE);
                        more_link();
                    } else {
                        the_excerpt('',TRUE);
                        more_link();
                    } ?>
                    <!-- <p class="postmetadata"> <?php bloginfo('name'); ?> | <?php the_category(', ') ?><?php edit_post_link(' | Edit', ''); ?>  </p> -->
			    </div>
			 </div> <!-- /.story -->
          </div> <!-- /.block -->
    <?php endif;

    if( $soundCloudPost ):

        //print_r( $soundCloudPost );
        //die();

        ?><!-- <div class="sc-container"><a href="<?php echo $soundCloudPost; ?>" class="sc-player"><?php echo $soundCloudPost; ?></a></div> --><?php
    endif;

endwhile;

if ( empty($cat_data['soundcloud-playlist-url']) != true ){ ?>
    <div class="footer">
        <div class="container">
            <a class="sc-player" href="<?php echo $cat_data['soundcloud-playlist-url']; ?>"></a>
        </div>
    </div>
<?php
}

include( TEMPLATEPATH . '/includes/pagination.php');