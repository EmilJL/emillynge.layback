<?php get_header(); ?>
	
<?php if ( have_posts() ) : ?>

	<div class="container">

		<div class="row">
		
			<div class="col-xs col-sm col-md col-lg">
				
				<div class="main-list">

					<?php while ( have_posts() ) : the_post(); ?>
					
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
							<h3 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<?php if ( has_post_thumbnail() ) : ?>
							    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							        <?php the_post_thumbnail(); ?>
							    </a>
							<?php endif; ?>
						
							<div class="post-date">
								<?php echo ucfirst(get_the_date('l j. F Y')); ?>
							</div>

							<div class="post-excerpt">
								<?php the_excerpt(); ?>
							</div>

						</div>

					<?php endwhile; ?>

				</div>

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>
<?php endif; ?>

<?php get_footer(); ?>