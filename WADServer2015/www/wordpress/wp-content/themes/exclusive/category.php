<?php get_header(); ?>
</div>	
</div>
<div id="content" class="page">
	<div class="container">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1"  class="widget-area" role="complementary">
				<div class="sidebar-container">
					<?php dynamic_sidebar( 'sidebar-1' );  ?>
				</div>
			</div>
			<?php } ?>


	<div id="blog" class="blog">
			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h2 class="styledHeading"><?php echo __('Archive for the','wd_exclusive'); ?>  &#8216;<?php single_cat_title(); ?>&#8217; <?php echo __('Category', 'wd_exclusive'); ?>:</h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h2 class="styledHeading"><?php echo __('Posts Tagged','wd_exclusive'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2 class="styledHeading"><?php echo __('Archive for','wd_exclusive'); ?> <?php the_time( get_option( 'date_format' )); ?>:</h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2 class="styledHeading"><?php echo __('Archive for','wd_exclusive'); ?> <?php the_time( get_option( 'date_format' )); ?>:</h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2 class="styledHeading"><?php echo __('Archive for','wd_exclusive'); ?> <?php the_time( get_option( 'date_format' )); ?>:</h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h2 class="styledHeading"><?php echo __('Author Archive','wd_exclusive'); ?></h2>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="styledHeading"><?php echo __('Blog Archives','wd_exclusive'); ?></h2>
		<?php } ?>
	
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		
		<div class="post">
			
				<a href="<?php the_permalink(); ?>">
					<h3><?php the_title(); ?></h3>
				</a>
			

			<?php exclusive_entry_cont(); ?>
			
		</div>
		
   <?php endwhile; ?>	
		<div class="navigation">
			<?php posts_nav_link(); ?>
		</div>
 <?php endif; ?>

   </div>
   <?php			
		 if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div id="sidebar2" class="widget-area" role="complementary">         
				 <div class="sidebar-container">
					 <?php dynamic_sidebar( 'sidebar-2' ); 
						   ?>
				 </div>
			</div><?php } ?>
		<div style="clear:both"></div>
	</div>
</div>
	
<?php get_footer(); ?>