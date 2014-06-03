<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php $heading_font = tia_get_option('tia_header_font'); ?>
	<?php $body_font = tia_get_option('tia_body_font'); ?>
	<?php if ($heading_font != "") { ?>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo(urlencode($heading_font)); ?>:regular,italic,bold,bolditalic" />
	<?php } ?>

	<?php if ($body_font != "" && $body_font != $heading_font) { ?>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo(urlencode($body_font)); ?>:regular,italic,bold,bolditalic" />
	<?php } ?>

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<?php

	if ( is_home() || is_archive() ) {

        global $storyMarginTop;
        global $parallaxHeight;
        global $imgMarginTop;
        $parallaxHeight = tia_get_option('tia_default_height');
        $imgMarginTop = tia_get_option('tia_scrolling_img_margin_top');
        $storyMarginTop = tia_get_option('tia_story_margin_top');
    }

	include 'scripts/Mobile_Detect.php';
	$detect = new Mobile_Detect();
    $isMobile = $detect->isMobile();
    ?>
    <script type="text/javascript">
        window.ANARCHOSTAR = {
            height: <?php echo $parallaxHeight; ?>,
            storyBump: <?php echo $storyMarginTop; ?>,
            trainerBump: <?php echo $imgMarginTop; ?>,
            windowHeight: $(window).height(),
            isMobile: <?php if( empty( $isMobile ) ){ echo 'false'; } else { echo 'true'; } ?>
        };
    </script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/layout.js"></script>

    <?php if (!$detect->isMobile()) { ?>

        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.localscroll-1.2.9-min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.scrollTo-1.4.6-min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.inview.js"></script>
        <script type="text/javascript">

        </script>

    <?php } else { ?>
        <style type="text/css" media="screen">
            #nav, .widget_tia_pixelscroll {display: none;}
            <?php if(tia_get_option('tia_mobile_backgrounds')) { ?>
            div.parallax-container[style] {background-image: none !important;}
            <?php } ?>
            .post, .page {background-attachment:scroll;}
        </style>
    <?php }

    if (!$detect->isMobile() && !tia_get_option('tia_scrollEasing_enabled') ) { ?>
	    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.nicescroll.min.js"></script>
	    <script type="text/javascript">
	        var nice = false;
	        $(document).ready(function(){
		        nice = $("html").niceScroll();
   		        var obj = window;
	        });
	    </script>
    <?php } ?>

    <!--/theme specific-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(tia_get_option('tia_theme_color')." ".tia_get_option('tia_theme_bkg')); ?>>
<div id="container" class="clearfix">
    <div id="headerBar" class="navbar navbar-default">
        <div id="header" class="navbar-inner navbar-header">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                    <?php $tia_logo = tia_get_option('tia_logo'); ?>
                    <div id="logo">
                    <?php if($tia_logo) : ?>
                            <a href="<?php bloginfo('url'); ?>"><img src="<?php echo $tia_logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
                    <?php else : ?>
                            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                    <?php endif; ?>
                    </div>

                    <?php include 'includes/parallax-nav.php'; ?>

                    <div id="mainNav" class="nav-collapse collapse">
                            <?php wp_nav_menu( array('menu_class' => 'sf-menu', 'theme_location' => 'main', 'fallback_cb' => 'default_nav' )); ?>
                    </div>
            </div>
         </div>
     </div>
