<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>
<!--Contenedor del banner-->
<div class="con-banner">
	<div id="owl-banner" class="owl-carousel owl-theme">
		<?php  query_posts(array('post_type' => 'banner', 'category_name' => 'b-principal', 'showposts' => 6));
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
<!--Contenedor del formulario de rss-->
<div class="con-form">
	<br>
	<form action="" autocomplete="on" metod="post">
		<div class="f-titulo"> Formulario de suscripción</div>
		<input id="f-nom" type="text" placeholder="Nombre" /><br>
		<input id="f-mail" type="text" placeholder="E-mail" /><br>
		<button type="submit" id="sub">Suscribirse</button>
	</form>
</div>