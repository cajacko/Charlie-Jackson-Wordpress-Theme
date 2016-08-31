<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Charlie Jackson
 */
?>

<?php
	
	/*
	if(!is_user_logged_in()) {
		wp_redirect( "http://uk.linkedin.com/in/charliejackson9");
		exit;
	}
	*/
	
?>

<!DOCTYPE html>
<html lang="en-GB">

	<head>
	
		<!--Fixed head-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Charlie Jackson">
		<link rel="author" href="http://charliejackson.com">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/font-awesome/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		
		<?php wp_head(); ?>
		
		<!--Google Analytics-->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', 'UA-36801934-1', 'auto');
			ga('send', 'pageview');		
		</script>
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>


	<body>
	
		<header id="site-header">
		
			<?php get_template_part( 'sections/site-navigation' ); ?>
			
			<?php get_template_part( 'sections/header-call-to-action' ); ?>
					
		</header>
		
		<main role="main" class="<?php charlie_jackson_main_classes(); ?>">