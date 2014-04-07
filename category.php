<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
  <!--Cabecera de la pagina-->
  <div class="row grid">
    <div class="col_12 tpagina">
      <?php $cat = single_cat_title("", false); echo $cat; ?>
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

	<div class="row grid" id="cabecera">
	  <div class="col_10">
	    <?php query_posts(array('post_type' => 'banner', 'category_name' => '"'.$cat.'"', 'showposts' => 1));
	    if (have_posts()) : while (have_posts()) : the_post();
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' );
		?>
			<img src="<?php echo $img_url ?>" />
	    <?php 
		    endwhile;
		    endif;
		    wp_reset_query();
	  	?>
	  </div>
	  <div class="col_2">
		<div id="owl-banner-comercial" class="owl-carousel owl-theme">
			<?php  query_posts(array('post_type' => 'banner', 'category_name' => 'b-comercial', 'showposts' => 6));
				if (have_posts()) : while (have_posts()) : the_post();
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' );
			?>
			<div class="item">
				<a href="<?php echo get('enlace'); ?>"><img src="<?php echo $img_url ?>"></a>
			</div>
			<?php 
				endwhile;
				endif;
				wp_reset_query();
			?>
		</div>
	  </div>
	  <div class="clearfix"></div>
	</div>
  <!--Fin de la cabecera de la pagina-->

  <!-- Contenido de la pagina -->
  <div class="row grid">
  	<section class="col_10">
        <?php            
        if (have_posts()) : while (have_posts()) : the_post();  
        $thumb = get_post_thumbnail_id(); 
        $img_url = wp_get_attachment_url( $thumb,'thumbnail' );  
        ?>
	    
	    <div class="col_4">
	    	<div class="producto">
	    		<div id="i-producto"> <!--Imagen del producto-->
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $img_url ?>" /></a>
	    		</div>
	    		<div id="t-producto"> <!--Titulo del producto-->
	    			<?php the_title(); ?>
	    		</div>
	    		<div id="l-producto"> <!--Link del producto-->
	    			<a id="mas" href="<?php the_permalink(); ?>"> Ver más </a>
	    		</div>
	    	</div>
	    </div>

		<?php
		endwhile;
		endif;
		wp_reset_query();
		?>

  	</section>
  	<aside class="col_2">
  		<?php get_sidebar(); ?>
  	</aside>
	<div class="col_12 center">
		<div class="pagination">
			<ul>
				<?php pagination(); ?>
			</ul>
		</div>
	</div>
  
    <div class="clearfix"></div>
  </div>
  <!-- /Contenido de la pagina -->
<?php get_footer(); ?>