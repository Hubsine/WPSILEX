<?php
global $post;
	$postClass = 'blog-post post_grid';

?>

<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>" >

	<div class="blog_list">

		<?php 
				$the_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'post-thumb');
				$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
				$alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
				?>

		<?php if (has_post_thumbnail()): ?>
			<div class="post-images">
				<div class="entry_image single_image">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $the_thumb[0]; ?>" width="<?php echo $the_thumb[1]; ?>" height="<?php echo $the_thumb[2]; ?>" 
				alt="<?php if(count($alt)) echo $alt; ?>" title="<?php the_title_attribute(); ?>" /></a>
				</div>
			</div>  
		<?php endif ?> 
		<div class="entry_info">
			<div class="entry_date">
				<span><?php the_time('j'); ?></span><?php the_time('M'); ?>
			</div>    
		</div>
		<div class="entry_post post-information <?php if (!has_post_thumbnail()): ?>border-top<?php endif ?>">
			<?php if( has_category() ): ?>
				<div class="entry_cat"><?php the_category( ', ' ); ?></div>
			<?php endif; ?> 

			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>


			 <div class="entry-content">
			<?php the_content(__('', 'sellegance')); ?>
			</div><!-- .entry-content -->

			<div class="entry-meta-foot">
				<ul>
					<?php $tags_list = get_the_tag_list( '', __( ', ', 'sellegance' ) );
						  if ( $tags_list ) :?>
					<li class="tags"><?php printf( __( 'Tags: %1$s', 'sellegance' ), $tags_list ); ?></li>
					<?php endif; // End if $tags_list ?>

				 </ul>
		   </div>

			<div class="clear"></div>
		</div>

	</div>

</article>

