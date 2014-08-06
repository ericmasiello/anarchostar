<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<!--[if lt IE9]>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.ie8.css" type="text/css" media="screen" />
    <![endif]-->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	

  <link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/favicon.ico">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory');?>/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory');?>/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory');?>/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory');?>/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_directory');?>/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory');?>/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory');?>/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory');?>/apple-touch-icon-152x152.png">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory');?>/favicon-196x196.png" sizes="196x196">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory');?>/favicon-160x160.png" sizes="160x160">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory');?>/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory');?>/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory');?>/favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#b91d47">
  <meta name="msapplication-TileImage" content="<?php bloginfo('template_directory');?>/mstile-144x144.png">
  <meta name="msapplication-config" content="<?php bloginfo('template_directory');?>/browserconfig.xml">


	<?php $heading_font = tia_get_option('tia_header_font'); ?>
	<?php $body_font = tia_get_option('tia_body_font'); ?>
	<?php if ($heading_font != "") { ?>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo(urlencode($heading_font)); ?>:regular,italic,bold,bolditalic" />
	<?php } ?>

	<?php if ($body_font != "" && $body_font != $heading_font) { ?>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo(urlencode($body_font)); ?>:regular,italic,bold,bolditalic" />
	<?php } ?>

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/scripts/jquery-1.11.1.min.js"></script>
	<?php

	include 'scripts/Mobile_Detect.php';
    $detect = new Mobile_Detect();
    $isMobile = $detect->isMobile();

	if ( is_home() || is_archive() ) {

        global $storyMarginTop;
        global $parallaxHeight;
        global $imgMarginTop;
        $parallaxHeight = tia_get_option('tia_default_height');
        $imgMarginTop = tia_get_option('tia_scrolling_img_margin_top');
        $storyMarginTop = tia_get_option('tia_story_margin_top');


        ?>
        <script type="text/javascript">
            window.ANARCHOSTAR = {
                height: <?php echo $parallaxHeight; ?>,
                storyBump: <?php echo $storyMarginTop; ?>,
                trainerBump: <?php echo $imgMarginTop; ?>,
                windowHeight: $(window).height(),
                isMobile: <?php if( empty( $isMobile ) ){ echo 'false'; } else { echo 'true'; } ?>
            };
        </script><?php
    } else {
        ?>
        <script type="text/javascript">
        window.ANARCHOSTAR = {
            height: 0,
            storyBump: 0,
            trainerBump: 0,
            windowHeight: $(window).height(),
            isMobile: <?php if( empty( $isMobile ) ){ echo 'false'; } else { echo 'true'; } ?>
        };
        </script><?php
    }

    ?>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/layout.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/mobile-nav.js"></script>

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
    <?php } ?>

    <!--/theme specific-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(tia_get_option('tia_theme_color')." ".tia_get_option('tia_theme_bkg')); ?>>
<div id="container" class="clearfix">

    <div id="headerBar" class="navbar navbar-default">
        <div id="header" class="navbar-inner navbar-header">
            <div class="container">
                <div id="logo">
                    <h1>
                        <a href="<?php bloginfo('url'); ?>">
                            <span class="logo"></span>
                            <span class="text"><?php bloginfo('name'); ?></span>
                        </a>
                    </h1>
                </div>

                <?php //include 'includes/parallax-nav.php'; ?>

                <div id="mainNav" class="nav-collapse collapse">
                    <?php wp_nav_menu( array('menu_class' => 'sf-menu', 'theme_location' => 'main', 'fallback_cb' => 'default_nav' )); ?>
                </div>
                <a href="#footerNav" class="mobile-nav-icon  js-menu-icon">
                  <span class="accessible-hidden">
                    Jump to Navigation
                  </span>
                </a>
            </div>
         </div>
     </div>
