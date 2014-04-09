<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>

<div class="tcontactf"></div>
	<footer>
		<div class="row grid">
			<div class="col_4">
				<div class="t-footer">Dirección:</div>
				<div>21Av. 34-62 z.12 Guatemala col. Santa Eliza</div>
				<div class="t-footer">Telefóno:</div>
				<div>(502) 24770218</div>
			</div>
			<div class="col_4">
				<div class="t-footer">E-mail:</div>
				<div>infocontrolautomotriz@gmail.com</div>
				<div class="t-footer">Siguenos:</div>
				<div><img src="<?php bloginfo('template_directory'); ?>/images/fb.png" width="20px" height="20px"> /controlautomotriz</div>
				<div>&nbsp</div>
				<div><img src="<?php bloginfo('template_directory'); ?>/images/tw.png" width="20px" height="20px"> @conrtolautomotriz</div>
			</div>
			<div class="col_4">
				<span>Powered By:</span> Webusiness
			</div>
			<div class="clearfix"></div>
		</div>
	</footer>

<?php wp_footer(); ?>
<script type="text/javascript">
	$.noConflict();
	jQuery( document ).ready(function( $ ) { /* Inicio de todas las funciones Javascript y jQuery */
		//Sort random function
		function random(owlSelector){
		owlSelector.children().sort(function(){
		    return Math.round(Math.random()) - 0.5;
		}).each(function(){
		  $(this).appendTo(owlSelector);
		});
		}
		$("#owl-cabecera").owlCarousel({
			navigation : false, // Show next and prev buttons
			slideSpeed : 150,
			paginationSpeed : 300,
			singleItem:true,
			pagination:false,
			autoPlay : true,
			navigation : false
  		});
  		$("#owl-banner").owlCarousel({
			navigation : false, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			pagination:false,
			autoPlay : true,
			navigation : false,
			beforeInit : function(elem){
			//Parameter elem pointing to $("#owl-demo")
			random(elem);
		}
	  	});
	  	$("#owl-banner-alt").owlCarousel({
			navigation : false, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			pagination:false,
			autoPlay : true,
			navigation : false,
			beforeInit : function(elem){
			//Parameter elem pointing to $("#owl-demo")
			random(elem);
		}
		});
		$("#owl-relacionados").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 4,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3],
		pagination:false,
		navigation : false,
		
		beforeInit : function(elem){
		  //Parameter elem pointing to $("#owl-demo")
		  random(elem);
		}
		});
		$("#owl-banner-comercial").owlCarousel({
		navigation : true, // Show next and prev buttons
		slideSpeed : 600,
		paginationSpeed : 800,
		singleItem:true,
		pagination:false,
		autoPlay : true,
		autoPlay: 9000,
		navigation : false,

		beforeInit : function(elem){
		  //Parameter elem pointing to $("#owl-demo")
		  random(elem);
		}
		});
		$("#owl-inicio").owlCarousel({
		    navigation: true,
		    pagination:false,
		    autoPlay : true,
		    autoPlay: 9000,
		    items : 3,
		    navigationText: [
		      "<i class='icon-chevron-left icon-white'></i>",
		      "<i class='icon-chevron-right icon-white'></i>"
		      ],
		    beforeInit : function(elem){
		      //Parameter elem pointing to $("#owl-demo")
		      random(elem);
		    }
		});
		$("#owl-banner-portada").owlCarousel({
			navigation : true, // Show next and prev buttons
			slideSpeed : 600,
			paginationSpeed : 800,
			singleItem:true,
			pagination:false,
			autoPlay : true,
			autoPlay: 9000,
			navigation : false,

			beforeInit : function(elem){
			  //Parameter elem pointing to $("#owl-demo")
			  random(elem);
			}
		});
		$("#owl-demo").owlCarousel({
		    navigation: true,
		    items : 4,
		    pagination:false,
		    navigationText: [
		      "<i class='icon-chevron-left icon-white'></i>",
		      "<i class='icon-chevron-right icon-white'></i>"
		      ],
		    beforeInit : function(elem){
		      //Parameter elem pointing to $("#owl-demo")
		      random(elem);
		    }
		});
		// Load the classic theme
		Galleria.loadTheme('http://construyendoideas.com/controlautomotriz/wp-content/themes/Control%20Automotriz/js/galleria.classic.js');


	});
</script>





</body>
</html>