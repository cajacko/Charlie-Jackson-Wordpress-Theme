<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Charlie Jackson
 */

	if($_GET['action'] == 'load_posts'){
		get_template_part('sections/post-loop');
		exit;
	} 
?>
	
	<!DOCTYPE html>
	<html lang="en-GB" id="html" data-home-url="<?php echo home_url( '/' ); ?>">
	
		<head>
		
			<!--Fixed head-->
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="author" content="Charlie Jackson">
			<meta property="og:description" content="Entrepreeur, developer and designer." />
			<meta id="less-vars">
			<link rel="author" href="http://charliejackson.com">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/font-awesome/css/font-awesome.min.css">
	
			<?php wp_head(); ?>
			
		</head>
	
		<body>
			<a id="top-of-page"></a>
			
			<?php if(is_front_page_showing()): ?>
				<?php get_template_part('sections/banner'); ?>
			<?php endif; ?>
			
			<header id="site-navigation" class="<?php if(is_front_page_showing()): echo 'absolute-nav'; else: echo 'fixed-nav'; endif; ?>">
				<?php get_template_part('sections/site-navigation'); ?>
			</header>
			
			<main<?php if(is_page('projects')): ?> id="page-projects"<?php endif; ?>>
				<div id="main-wrap" class="wrap clearfix">