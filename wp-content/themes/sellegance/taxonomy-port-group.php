<?php get_header(); ?>

<?php                            
$portcats = wp_get_object_terms( get_the_ID(), 'port-group' );
$portcatlist = array();
$portcatids = array();
								
if( count( $portcats ) > 0 ) {
	
	foreach ( $portcats as $portcat) {
		$portcatids[] = $portcat->term_id;
		$portcatlist[] = $portcat->slug;
		break;
	}

	$termargs = array();
	$termargs['include'] = $portcatids;
} else {
	$termargs = '';
}
							
$terms = get_terms( "port-group", $termargs );
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

?>

<div class="row">
	<div class="col-sm-12">
		<header class="page-header">
			<h1 class="entry-title title-page"><?php echo $term->name; ?></h1>
			<?php echo et_breadcrumbs(); ?>
		</header><!-- .page-header -->
	</div>
</div>

<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 
	<!-- woocommerce message -->

	<div class="row">
		<div class="col-sm-12">
			<?php  wc_print_notices(); ?>
		</div>
	</div>

<?php } ?>

<div class="row">
	<div id="primary" class="col-sm-12 full_width">
							
		<?php
						
		$pageid = get_the_ID();
		$layout = get_post_meta( $pageid, 'tdl_page_portfolio', true ) ? get_post_meta( $pageid, 'tdl_page_portfolio', true ) : 'normal';
		$args = array( 'post_type' => 'portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 );
								
		if( count( $portcats ) > 0 ) {
			$args['tax_query'] = array( array( 'taxonomy' => 'port-group', 'field' => 'slug', 'terms' => $portcatlist ) );
		}
								
		$portfolio = new WP_Query( $args );
		if( $portfolio->have_posts() ):
		?>

			<div id="portfolio" class="row">

				<?php
				while ( $portfolio->have_posts() ) : $portfolio->the_post();
					$getterms = get_the_terms(get_the_ID(), 'port-group');

					if ($getterms) {
						
						$portterms = array();
						
						foreach ($getterms as $getterm) {
							$portterms[] = 'pf-' . $getterm->slug;
						}
						
						$portterms = implode(" ", $portterms);
					}
					
					global $sellegance_opt;
					$height = $sellegance_opt['portfolio_related_height'];
									
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
					$thumb = et_resize( $thumb[0], 600, $height, true, false );

					?>

					<div id="portfolio-<?php the_ID(); ?>" class="portfolio-item <?php echo $portterms; ?> col-sm-4">
					<?php if ( has_post_thumbnail() ):?>
						<figure>
							<a class="link-to-post" href="<?php the_permalink(); ?>">
							<img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
							</a>
						</figure>
					 <?php endif; ?>

						<div class="portfolio-item-details">
							<span class="portfolio-item-category">
							<?php echo get_the_term_list( $post->ID, 'port-group', '', ', ', '' ); ?>
							</span>
							<h4 class="portfolio-item-title"><a class="link-to-post" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						</div>
					</div>

				<?php endwhile; ?>
								
			</div>

			<script type="text/javascript">
			var $ = jQuery.noConflict();
			
			$(window).load(function() { 
				   
				// cache container
				var $container = $('#portfolio');
				// initialize isotope
				$container.isotope({
					itemSelector : '.portfolio-item',
					animationEngine : 'best-available',							
					layoutMode : 'fitRows',

					animationOptions: {
						easing: 'easeInOutQuad',
						queue: false
					}
				});

			});
			</script>
		
			<?php if( $portfolio->found_posts > $number ) { ?>
				<div class="portfolio-pagination clearfix">
					<?php tdl_pagination( $portfolio->max_num_pages ); ?>
				</div>
			<?php } ?>
			
			<?php endif; wp_reset_postdata(); ?>

			<?php edit_post_link( __( 'Edit', 'sellegance' ), '<span class="edit-link">', '</span>' ); ?>        
		
	</div> <!-- #primary -->

</div> <!-- .row -->

<?php get_footer(); ?>