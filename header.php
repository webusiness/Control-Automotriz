<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
 
    global $page, $paged;
 
    wp_title( '|', true, 'right' );
 
    bloginfo( 'name' );
 
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
 
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
 
    ?></title>

<!-- Links -->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!-- /Links -->

<!-- CSS -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/kickstart.css" media="all" /> <!-- KICKSTART -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/owl.carousel.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/owl.theme.css">
<!-- /CSS -->

<?php wp_head(); ?>

<!-- Javascripts -->
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.6.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/kickstart.js"></script> <!-- KICKSTART -->
<script src="<?php bloginfo('template_directory'); ?>/js/owl.carousel.js"></script>
<!-- /Javascripts -->

<!-- CSS media query -->
<link rel="stylesheet" media="(max-width: 480px)" href="<?php bloginfo('template_directory'); ?>/css/responsive.css" />
 
</head>

<body <?php body_class(); ?>>
 
    <header>

        <div class="row grid">
            <div class="col_3 left">
                <img src="<?php bloginfo('template_directory'); ?>/images/logo.png">
            </div>
            <div class="col_9 right">
                <div class="perfil">
                    <div class="total-productos">
                        <img src="<?php bloginfo('template_directory'); ?>/images/carretilla.png">
                        <?php
                            global $woocommerce; ?>
                            <a href=""> <?php echo sprintf(_n('%d Producto en la carretilla', '%d Productos en la carretilla', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
                        ?></a> <!-- Funcion global que imprime a travez de un echo la cantidad de productos en la carretilla -->
                    </div>
                    <div class="buscar">
                        <form role="search" method="get" id="search" action="<?php echo home_url( '/' ); ?>">
                            <input type="text" placeholder="Buscar..." />
                        </form>
                    </div>
                    <!-- <div class="login">Mi cuenta | Salir</div> -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="navegacion">
            <div class="row grid">
                <div class="col_12">
                    <nav>
                        <?php wp_nav_menu( 
                        array( 
                        'container' => 'nav', 
                        'fallback_cb' => 
                        'starkers_menu',
                        'menu_class' => 'menu',
                        'theme_location' => 'primary'
                        ) ); ?>
                    </nav>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </header>