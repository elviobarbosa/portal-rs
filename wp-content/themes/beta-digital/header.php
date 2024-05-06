<?php
$controller_file = 'app/utils/communs.php';
require_once $controller_file;

$isProtected = \Communs\Utils::isProtectedPage();
$user = wp_get_current_user();
$user_role = $user->roles[0];
if ($isProtected) {
	if (is_user_logged_in()) {
	} else {
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		wp_redirect(wp_login_url( $current_url ));
	}
}
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name=viewport content="width=device-width">
	<meta charset="UTF-8">
	<title><?php wp_title();?></title>
	<link rel="shortcut icon" href="<?php bloginfo('wpurl');?>/favicon.ico" />
	<?php wp_head() ?>
</head>

<body <?php post_class('front-page') ?>>

<div class="nav-container">
	<div class="container nav-container__container">
		<div class="nav-container__logo">
			<a href="<?php bloginfo('wpurl');?>"><img src="<?php echo IMGPATH ?>/portal-rs-logo.png"></a>
		</div>

		 
		<div class="nav-container__menu js-nav-menu">
			
			<?php 
		

			if ($user_role == 'beneficiario') {
				wp_nav_menu( 
				array( 
					'theme_location' 	=> 'beneficiario-menu',
					'menu_class'		=> 'menu',
					'container'			=> 'nav',
					'container_class' 	=> 'main-menu'
				) ); 
			}

			if ($user_role == 'padrinho') {
				wp_nav_menu( 
				array( 
					'theme_location' 	=> 'padrinho-menu',
					'menu_class'		=> 'menu',
					'container'			=> 'nav',
					'container_class' 	=> 'main-menu'
				) ); 
			}
			
			
			?>
		</div>
		<div class="nav-container__control">
			<div class="h-menu js-menu">
				<span class="h-menu__line"></span>
				<span class="h-menu__line"></span>
				<span class="h-menu__line"></span>
			</div>
		</div>
	</div>
 </div>
