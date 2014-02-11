<?php
/**
 * Template Name: Store Front
 *
 * This is a Page Template used to display all of the EDD downloads.
 */
?>
 
<?php get_header(); ?>
	
	<?php
	$current_page = get_query_var( 'paged' );
	$per_page = get_option( 'posts_per_page' );
	$offset = $current_page > 0 ? $per_page * ( $current_page-1 ) : 0;
	$product_args = array(
		'post_type'			=> 'download',
		'posts_per_page'	=> $per_page,
		'offset'			=> $offset
	);
	$products = new WP_Query( $product_args );
	?>
	<?php if ( $products->have_posts() ) : $i = 1; ?>
		<div class="store-info">
			<h1>This is a store title. Doesn't have to be long at all.</h1>
			<p>Now we just need to say something about the store or the products. Either way is fine.</p>
		</div>
		<div class="store-front clear-sdm">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				
				<div class="threecol product<?php if ( $i % 3 == 0 ) { echo ' last'; } ?>">
					<div class="product-image">
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'product-img' ); ?>
							</a>
						<?php } ?>
					</div>
					<div class="product-description">
						<a class="product-title" href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
						<p class="product-info">
							<?php the_excerpt(); ?>
						</p>
					</div>
					<a href="<?php the_permalink(); ?>">View Details</a>
				</div>
	
				<?php $i+=1; ?>
			<?php endwhile; ?>
		</div>			
		<div class="store-pagination">
			<?php 					
				$big = 999999999; // need an unlikely intege					
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, $current_page ),
					'total' => $products->max_num_pages
				) );
			?>
		</div>
	<?php else : ?>
	
		<h2 class="center"><?php _e( 'Not Found', 'sdm' ); ?></h2>
		<p class="center"><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'sdm' ); ?></p>
		<?php get_search_form(); ?>
	
	<?php endif; ?>

<?php get_footer(); ?>