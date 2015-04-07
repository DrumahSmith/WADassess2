<?php 

global $query_string, $exclusive_general_settings_page;

//for update general_settings

foreach ($exclusive_general_settings_page->options_generalsettings as $value)
 {
    if (get_theme_mod( $value['var_name'] ) === FALSE)
	{
		$$value['var_name'] = $value['std']; 
	}
	else 
	{
		$$value['var_name'] = get_theme_mod( $value['id'] ); 
	}
}
		
query_posts($query_string .'&posts_per_page=999');
get_search_query();
get_header();

?>
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
			<?php }  ?>
	<div id="blog" class="blog search">
		<div>
			<h3 ><?php echo __('Search', 'wd_exclusive'); ?></h3>
			<div class="search-result-info">		
				<p><?php echo __('Count', 'wd_exclusive'); ?> <?php echo count($wp_query->get_posts()) ; ?> </p>
			</div>
		</div>
		<?php /*print page content*/ 
		if( have_posts() ) { 
			while( have_posts()){ 
				the_post(); ?>
				 <div class="single-post">
					
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
					
					
					<?php exclusive_entry_cont_for_searc(); ?>
					<div class="clear"></div>
				</div>
	  <?php } ?>
	     	<div class="page-navigation">
				<?php posts_nav_link(); ?>
			</div>
	  
	<?php	}
?>
	</div>
<?php
			if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div id="sidebar2" class="widget-area" role="complementary">         
				 <div class="sidebar-container">
					 <?php dynamic_sidebar( 'sidebar-2' ); ?>
				 </div>
			</div><?php } ?>
	   <div style="clear:both"></div>
	</div>
</div>

<?php get_footer(); ?>
