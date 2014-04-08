<?php
/*
Template Name: inicio
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  
  <!-- Slide de portada -->
  <div id="owl-cabecera" class="owl-carousel owl-theme">
  <?php  query_posts(array('post_type' => 'slide', 'showposts' => 8));
    if (have_posts()) : while (have_posts()) : the_post();
      $thumb = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' );
  ?>
    <div class="item">
      <img src="<?php echo $img_url ?>">
    </div>
  <?php 
    endwhile;
    endif;
    wp_reset_query();
  ?>
  </div>
  <!-- /Slide de portada -->
  <!-- Carrousel de Carros en venta -->
  <div class="row grid">
    <div class="col_12">
      <span id="towl-inicio">Carros en venta</span>
      <div id="owl-inicio" class="owl-carousel owl-theme">
      <?php  query_posts(array('post_type' => 'post', 'showposts' => 6));
        if (have_posts()) : while (have_posts()) : the_post();
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url( $thumb,'full' );
      ?>
      <div class="item">
        <div class="producto">
          <div id="i-producto"> <!--Imagen del producto-->
          <a href="<?php the_permalink(); ?>"><img src="<?php echo $img_url ?>" /></a>
          </div>
          <div id="t-producto-alt"> <!--Titulo del producto-->
            <?php the_title(); ?>
          </div>
          <div id="des-producto">
            <?php
              $excerpt = get('descorta');
              echo string_limit_words($excerpt,15);
            ?>
          </div>
          <div id="l-producto-alt"> <!--Link del producto-->
            <a href="<?php the_permalink(); ?>"> Ver más </a>
          </div>
        </div>
      </div>
      <?php 
        endwhile;
        endif;
        wp_reset_query();
      ?>
      </div>

    <!-- Banner de portada -->
      <div class="con-banner-inicio">
        <div id="owl-banner-portada" class="owl-carousel owl-theme">
        <?php  query_posts(array('post_type' => 'banner', 'category_name' => 'banner-de-inicio', 'showposts' => 6));
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
    <!-- /Banner de portada -->

    </div>
    <div class="clearflix"></div>
  </div>
  <!-- /Carrousel de Carros en venta -->


  <!-- Contenido de la pagina -->
  <div class="row grid">
    <section class="col_10">
      <?php query_posts(array('post_type' => 'product', 'showposts' => 6, 'orderby' => 'rand'));          
      if (have_posts()) : while (have_posts()) : the_post();  
      $thumb = get_post_thumbnail_id(); 
      $img_url = wp_get_attachment_url( $thumb,'thumbnail' );  
      ?>
      
      <div class="col_4">
        <div class="producto">
          <div id="p-imagen"> <!--Imagen del producto-->
          <a href="<?php the_permalink(); ?>"><img id="p-img" src="<?php echo $img_url ?>" /></a>
          </div>
          <div id="p-titulo"> <!--Titulo del producto-->
            <?php
              $excerpt = the_title();
              echo string_limit_words($excerpt,3); /* Toma la descripcion y la recorta a no mas de 15 palabras */
            ?>
          </div>
          <div id="p-des"> <!--Descripcion del producto-->
            <?php
              $excerpt = get_the_excerpt();
              echo string_limit_words($excerpt,15); /* Toma la descripcion y la recorta a no mas de 15 palabras */
            ?>
            <?php /* echo $product->get_sku(); */ ?>
          </div>
          <div id="p-presio"> <!--Presio del producto-->
            <?php echo $product->get_price_html(); ?>
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
    <div class="clearfix"></div>
  </div>
  <!-- /Contenido de la pagina -->

  <!-- Carrousel de Productos -->
  <div id="con-footer-inicio">
    <div class="grid">
      <div class="col_12">
        <div id="tproductos">
          Filtros y Lubricantes
        <div id="owl-demo" class="owl-carousel owl-theme">
          <?php  query_posts(array('post_type' => 'product', 'orderby' => 'rand', 'showposts' => 8));
          if (have_posts()) : while (have_posts()) : the_post();
            $thumb = get_post_thumbnail_id();
            $img_url = wp_get_attachment_url( $thumb,'full' );
          ?>

            <div class="item">
                <div class="productor">
                  <div id="p-imagen"> <!--Imagen del producto-->
                  <a href="<?php the_permalink(); ?>"><img id="p-img" src="<?php echo $img_url ?>" /></a>
                  </div>
                  <div id="p-titulo"> <!--Titulo del producto-->
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
      </div>
      <div class="clearflix"></div>
    </div>
  </div>
  <!-- /Carrousel de Productos -->

<?php endwhile; ?>

<?php get_footer();?>