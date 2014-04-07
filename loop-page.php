<?php
/**
 * The loop that displays a page.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <!--Cabecera de la pagina-->
  <div class="row grid">
    <div class="col_12 tpagina">
      <?php the_title(); ?>
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="ubicacion">
    <div class="row grid">
      <div class="col_12">
        <div class="breadcrumbs">
          <?php the_breadcrumb(); ?>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>


  
  <!-- Contenido de la pagina -->
  <div class="row grid">
    
    <section class="col_10" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<article class="contenido">
        <?php $thumb = get_post_thumbnail_id();  $img_url = wp_get_attachment_url( $thumb,'full' ); ?>
          <div id="i-destacada">
            <img id="destacada" src="<?php echo $img_url ?>">
          </div>
      	<?php the_content(); ?>
      </article>
    </section>

    <aside class="col_2">
    	<?php get_sidebar(); ?>
    </aside>
    
    <div class="clearfix"></div>
  </div>
  <!-- /Contenido de la pagina -->

<?php endwhile; ?>