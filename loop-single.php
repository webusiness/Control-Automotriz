<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php
		if ( is_singular('otros') ) { 
	?>
	<?php
		} else {
	?>
	<!-- Contenido de la pagina -->
	<div class="row grid">

	<section class="col_12" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="t-categoria">Vehiculos</div><br>

		<!--Banner superior -->
		<div id="owl-banner-alt" class="owl-carousel owl-theme center">
			<?php  query_posts(array('post_type' => 'banner', 'category_name' => 'b-alt', 'showposts' => 6));
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
		<!-- Fin del banner superior -->
		
		<article>
			<div id="galeria-vehiculo" class="col_5">
				<?php echo get('galeria'); ?>
			</div>

			<div class="col_7">
				<div class="titulo"> 
					<?php the_title(); ?>
				</div>
				<div class="contenido">
					<?php the_content(); ?>
					<div class="tab"></div>
					<ul class="tabs left">
						<li><a href="#tabr1">Especificaciones</a></li>
						<li><a href="#tabr2">Exterior</a></li>
						<li><a href="#tabr3">Interior</a></li>
						<li><a href="#tabr4">Cotízalo</a></li>
					</ul>
					<div id="tabr1" class="tab-content">
						<?php echo get('tab1'); ?>
					</div>
					<div id="tabr2" class="tab-content">
						<?php echo get('tab2'); ?>
					</div>
					<div id="tabr3" class="tab-content">
						<?php echo get('tab3'); ?>
					</div>
					<div id="tabr4" class="tab-content">
						<?php echo do_shortcode('[contact-form-7 id="188" title="Cotizar"]'); ?>
					</div>
				</div>
			</div>
		</article>

		<!-- Carrousel de productos relacionados -->
		<div class="col_12">
			<div class="titulo">
				Productos Relacionados
			</div>
			<div id="owl-relacionados">
			<!-- Obtiene la categoria actual para buscar y mostrar productos iguales -->
				<?php 
	                global $post;
	                $args = array( 'taxonomy' => 'product_cat',);
	                $terms = wp_get_post_terms($post->ID,'product_cat', $args);

	                $count = count($terms); 
	                if ($count > 0) {

	                foreach ($terms as $term) {
	                    $categoria = $term->name;
	                }
	            }
	            ?>


			<!-- Compara la categoria actual y las categorias existentes y muestra los proximos 8 vehiculos -->
				<?php  query_posts(array('category' => '"'.$categoria.'"', 'showposts' => 8));
				if (have_posts()) : while (have_posts()) : the_post();
				  $thumb = get_post_thumbnail_id();
				  $img_url = wp_get_attachment_url( $thumb,'full' );
				?>
				<div class="item">
			    	<div class="vehiculor">
			    		<div id="i-producto"> <!--Imagen del producto-->
							<a href="<?php the_permalink(); ?>"><img src="<?php echo $img_url ?>" /></a>
			    		</div>
			    		<div id="t-producto"> <!--Titulo del producto-->
			    			<?php the_title(); ?>
			    		</div>
			    	</div>
				</div>
				<?php 
				endwhile;
				endif;
				wp_reset_query();
				?>
			</div>		
		</div>
		<!-- Fin del carrousel de productos relacionados -->
	</section>

	<div class="clearfix"></div>
	</div>
	<!-- /Contenido de la pagina -->	
	<?php
		}
	?>
<?php endwhile; // end of the loop. ?>



	