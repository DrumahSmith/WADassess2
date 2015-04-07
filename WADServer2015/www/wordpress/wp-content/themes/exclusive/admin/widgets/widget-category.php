<?php 
class exclusive_categ extends WP_Widget
{
    function exclusive_categ(){
		$widget_ops = array('description' => 'Displays Categories Posts');
		$control_ops = array('width' => '', 'height' => '');
		parent::WP_Widget(false,$name='Categories Posts',$widget_ops,$control_ops);
	}

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title =  esc_html( $instance['title']);
		$categ_id = empty( $instance['categ_id'] ) ? '' : $instance['categ_id'];
		$post_count = empty( $instance['post_count'] ) ? '' : $instance['post_count'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title; ?>
		
        <style>
        .cat_widg img {
			float:left;
			margin: 0 10px 5px 0 !important;
         }	
		 .cat_widg p {
			margin: -4px 0px 0px !important;
         }
		 .cat_widg {
            padding: 10px 0;
			margin-bottom: 5px;
            border-bottom: 1px dotted #C5C9D8;
			float: left;
			width: 100%;
         }			
         .widget_exclusive_categ div:last-child div{
		    border-bottom:none !important;
         } 
         .cat_widg_cont {		 		  
           width: 100%;
		 }
		 .cat_widg_cont h3{
		   font-size: 19px !important;
		   margin-top: 0;
           line-height: 15px;
           margin-bottom: 15px !important;
		 }
		 .cat_widg_cont h3 a{
		   font-size:19px !important;
		 }
		 .widget-title{
		   margin-bottom: 0;
		 }
        </style>		
		<?php	
			
		$wp_query= null;
		$wp_query = new WP_Query();
		if(!isset($post_count))
			$post_count =0;
		$wp_query->query('posts_per_page='.$post_count.'&cat='.$categ_id);

			while ($wp_query->have_posts()) : $wp_query->the_post();

        ?>
		
			    	<div class="cat_widg_cont">
					  
					  <div class="cat_widg">	
						<?php
                         echo exclusive_display_thumbnail(110,110); 
						 ?><p><?php
                         echo exclusive_the_excerpt_max_charlength(70);                       
                        ?></p>	
					     <a href="<?php the_permalink(); ?>" style="text-decoration: underline;"><span><?php echo __('More','sp_webBusiness'); ?></span></a>
					   </div>
                      	<div style="clear:both;"></div>				   
					</div>
					
					<?php endwhile; 
		 
		          
		 
		
		echo $after_widget;
				
		}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['categ_id'] = wp_filter_post_kses( addslashes($new_instance['categ_id']));
		$instance['post_count'] = wp_filter_post_kses( addslashes($new_instance['post_count']));

		return $instance;
		
		}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
				//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'Categories Posts', 'categ_id'=>'0', 'post_count'=>'3' ) );

		$title = esc_attr( $instance['title'] );
		$categ_id = esc_attr( $instance['categ_id'] ); 
        $post_count = esc_attr( $instance['post_count'] )?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><input class="widefat" id="<?php echo  $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		
		<p><label for="<?php echo $this->get_field_id('categ_id'); ?>">Select Category:</label>
		<select name="<?php echo $this->get_field_name('categ_id'); ?>" id="<?php echo $this->get_field_id('categ_id') ?>" style="font-size:12px" class="inputbox">
          <option value="0">Select Category</option>
     <?php  $categories=get_categories();
            $category_count=count($categories);
            for($i=0;$i<$category_count;$i++) {
				if(isset($categories[$i])){
       ?>
          <option value="<?php echo $categories[$i]->term_id; ?>" <?php if($instance['categ_id']==$categories[$i]->term_id) echo  'selected="selected"'; ?>><?php echo $categories[$i]->name ?></option>
     <?php
				}
            } ?>
        </select></p>
		<p><label for="<?php echo $this->get_field_id('post_count'); ?>">Number of Posts:</label><input id="<?php echo  $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" type="text" value="<?php echo $post_count; ?>" size="6"/></p>
<?php		
}

}// end exclusive_categ class
add_action('widgets_init', create_function('', 'return register_widget("exclusive_categ");'))
?>