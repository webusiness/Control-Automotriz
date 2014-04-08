<?php
/**
 * The template for displaying 404 pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div class="row grid">
	<div class="col_12">
		<div class="error-titulo">
			<h1><?php _e( 'Not Found', 'starkers' ); ?></h1>
		</div>
		<div class="error-contenido">
			<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'starkers' ); ?></p>
		</div>
	</div>
	<div class="clearflix"></div>
</div>
		<?php get_search_form(); ?>

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
<?php get_footer(); ?>