<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

/** Tell WordPress to run starkers_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'starkers_setup' );

if ( ! function_exists( 'starkers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_setup() {

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'starkers', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Menu de navegacion', 'starkers' ),
	) );
}
endif;

if ( ! function_exists( 'starkers_menu' ) ):
/**
 * Set our wp_nav_menu() fallback, starkers_menu().
 *
 * @since Starkers HTML5 3.0
 */
function starkers_menu() {
	echo '<nav><ul><li><a href="'.get_bloginfo('url').'">Home</a></li>';
	wp_list_pages('title_li=');
	echo '</ul></nav>';
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @since Starkers HTML5 3.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * @since Starkers HTML5 3.0
 * @deprecated in Starkers HTML5 3.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function starkers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'starkers_remove_gallery_css' );

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s says:', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( 'Your comment is awaiting moderation.', 'starkers' ); ?>
			<br />
		<?php endif; ?>

		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'starkers' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'starkers' ), ' ' );
			?>

		<?php comment_text(); ?>

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<p><?php _e( 'Pingback:', 'starkers' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'starkers'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment_close() {
	echo '</article>';
}

/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','starkers_fields');

/**
 * Register widgetized areas.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'starkers' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'starkers' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'starkers' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'starkers' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'starkers' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'starkers' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running starkers_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'starkers_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @updated Starkers HTML5 3.2
 */
function starkers_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'starkers_remove_recent_comments_style' );

if ( ! function_exists( 'starkers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on() {
	printf( __( 'Posted on %2$s by %3$s', 'starkers' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_date()
		),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'starkers' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'starkers_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
#Aqui creo una funcion que crea un Custom Post para organizar los Banners
function custom_post_type_creator_banners() {
	$labels = array(
	  'name'               => _x( 'Banners', 'Post Type General Name', 'text_domain' ),
	  'singular_name'      => _x( 'Banner', 'Post Type Singular Name', 'text_domain' ),
	  'menu_name'          => __( 'Banners', 'text_domain' ),
	  'parent_item_colon'  => __( 'Banner principal', 'text_domain' ),
	  'all_items'          => __( 'Banners', 'text_domain' ),
	  'view_item'          => __( 'Ver Banners', 'text_domain' ),
	  'add_new_item'       => __( 'Añadir Banner Nuevo', 'text_domain' ),
	  'add_new'            => __( 'Añadir', 'text_domain' ),
	  'edit_item'          => __( 'Editar Banner', 'text_domain' ),
	  'update_item'        => __( 'Actualizar', 'text_domain' ),
	  'search_items'       => __( 'Buscar Banner', 'text_domain' ),
	  'not_found'          => __( 'Banners no encontradas', 'text_domain' ),
	  'not_found_in_trash' => __( 'Banners no encontradas en Papelera', 'text_domain' ),
	  );
	$rewrite = array(
	  'slug'                => 'banners',
	  'with_front'          => true,
	  'pages'               => true,
	  'feeds'               => true,
	  );
	$args = array(
	  'label'               => __( 'Banners', 'text_domain' ),
	  'description'         => __( 'Información de Banners', 'text_domain' ),
	  'labels'              => $labels,
	  'supports'            => array( 'title', 'editor', 'comments', 'thumbnail'),
	  'taxonomies'          => array( 'category', 'post_tag' ),
	  'hierarchical'        => false,
	  'public'              => true,
	  'show_ui'             => true,
	  'show_in_menu'        => true,
	  'show_in_nav_menus'   => true,
	  'show_in_admin_bar'   => true,
	  'menu_position'       => 5,
  	  'menu_icon'           => site_url().'/wp-content/themes/Control%20Automotriz/images/slider-icon.png',
	  'can_export'          => true,
	  'has_archive'         => 'Banners',
	  'exclude_from_search' => false,
	  'query_var'           => 'Banners',
	  'rewrite'             => $rewrite,
	  'capability_type'     => 'post',
	  );
	register_post_type('banner', $args);
	}
	add_action('init', 'custom_post_type_creator_banners', 0);

#Aqui creo una funcion que crea un Custom Post para organizar los Slides
function custom_post_type_creator() {
$labels = array(
  'name'               => _x( 'Slides', 'Post Type General Name', 'text_domain' ),
  'singular_name'      => _x( 'Slide', 'Post Type Singular Name', 'text_domain' ),
  'menu_name'          => __( 'Slides', 'text_domain' ),
  'parent_item_colon'  => __( 'Slide principal', 'text_domain' ),
  'all_items'          => __( 'Slides', 'text_domain' ),
  'view_item'          => __( 'Ver Slides', 'text_domain' ),
  'add_new_item'       => __( 'Añadir Slide Nuevo', 'text_domain' ),
  'add_new'            => __( 'Añadir', 'text_domain' ),
  'edit_item'          => __( 'Editar Slides', 'text_domain' ),
  'update_item'        => __( 'Actualizar', 'text_domain' ),
  'search_items'       => __( 'Buscar Slides', 'text_domain' ),
  'not_found'          => __( 'Slides no encontrados', 'text_domain' ),
  'not_found_in_trash' => __( 'Slides no encontrados en Papelera', 'text_domain' ),
  );
$rewrite = array(
  'slug'                => 'slide',
  'with_front'          => true,
  'pages'               => true,
  'feeds'               => true,
  );
$args = array(
  'label'               => __( 'slide', 'text_domain' ),
  'description'         => __( 'Información de Slides', 'text_domain' ),
  'labels'              => $labels,
  'supports'            => array( 'title', 'editor', 'comments', 'thumbnail'),
  'taxonomies'          => array( 'category', 'post_tag' ),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'menu_position'       => 5,
  'menu_icon'           => site_url().'/wp-content/themes/Control%20Automotriz/images/slider-icon.png',
  'can_export'          => true,
  'has_archive'         => 'slides',
  'exclude_from_search' => false,
  'query_var'           => 'slide',
  'rewrite'             => $rewrite,
  'capability_type'     => 'post',
  );
register_post_type('slide', $args);
}
add_action('init', 'custom_post_type_creator', 0);

function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo home_url();
		echo '">';
		echo '<i class="icon-home icon-2x"></i>';
		echo '</a> <img src="http://construyendoideas.com/controlautomotriz/wp-content/themes/Control%20Automotriz/images/flecha-breadcrumb.png">';
		if (is_category() || is_single()) {
			the_category('title_li=');
			if (is_single()) {
				echo ' <img src="http://construyendoideas.com/controlautomotriz/wp-content/themes/Control%20Automotriz/images/flecha-breadcrumb.png"> ';
				the_title();  echo ' <img src="http://construyendoideas.com/controlautomotriz/wp-content/themes/Control%20Automotriz/images/flecha-breadcrumb.png"> ';
			}
		} elseif (is_page()) {
			echo the_title(); echo ' <img src="http://construyendoideas.com/controlautomotriz/wp-content/themes/Control%20Automotriz/images/flecha-breadcrumb.png"> ';
		}
	}
}
function pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text'    => __('Anterior'),
        'next_text'    => __('Siguiente'),
    ));
}
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit) {
  array_pop($words);
  //add a ... at last article when more than limit word count
  echo implode(' ', $words)."..."; } else {
  //otherwise
  echo implode(' ', $words); }
}

/* <?php
  $excerpt = get_the_excerpt();
  echo string_limit_words($excerpt,25);  El número 25 representa el número de palabras que se desea mostrar
?>...  */