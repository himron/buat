<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
     <title>
     <?php 
        wp_title( '|', true, 'right' );
      bloginfo( 'name' );
     ?>
     </title>
     <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
     <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
     <?php if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
    wp_head();
     ?>
	
	 
   <style type="text/css">
	  #header {
		 background : url(<?php header_image(); ?>);
		 }
		 .blogtitle a, .description {
		 color: <?php header_textcolor(); ?>
		 }
   </style>
   
    <php if (is_home()) {
	wp_enqueue_script('jquery');
	wp_enqueue_script('easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.1.js');
	wp_enqueue_script('carousal', get_stylesheet_directory_uri() . '/js/jcarousel.js');
}
   
</head>

<body>
   <div id="wrap">
        <div id="header">
			<h1 class="blogtitle"><?php bloginfo('name');?></h1>
			<p class="description"><?php bloginfo('description');?></p>
            <div id="menu">
                  <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				<div id="search">
					<form action="<?php bloginfo('url');?>" method="get">
					<input type="text" size="20" name="s"/>
					<input type="submit" value="search"/>
					</form>
				</div>
            </div>
		 </div>
       
		 <div id="maincontent">
			<div id="content">
			   <?php if ( have_posts() ) : ?>
			   <?php while ( have_posts() ) : the_post(); ?>
			   <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				  <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				  <p><?php the_content(); ?></p>
					 <div id="postmeta">Publish on <?php the_time('F jS, Y'); ?> under <?php the_category(', '); ?> by <?php the_author(); ?> | 
						<?php comments_popup_link('No Comments &raquo;', '1 Comment &raquo;', '% Comments &raquo;'); ?> 
						<?php edit_post_link('Edit','','|'); ?>
					 </div>
			   </div>
			<script type="text/javascript">
				jQuery(function() {
				jQuery(".mygallery").jCarouselLite({
				btnNext: ".nextb",
				btnPrev: ".prevb",
				visible: 1,
				speed: 2000,
				auto: 3000,
				easing: "backout"
				});
			});
			</script>
		/*untuk slider*/
		<div id="slidearea">
			<div id="gallerycover">
				<div class="mygallery">
				 <ul>
					<?php 
					$my_query = new WP_Query('showposts=5');
					while ($my_query->have_posts()) : $my_query->the_post();
					$do_not_duplicate = $post->ID;
					?>
					<li>
						<div class="mytext">
							<a href="<?php the_permalink() ?>">
							<?php 
							if ( has_post_thumbnail() ) {
							the_post_thumbnail();
							} else {
							echo '<img src="'.get_bloginfo('template_url').'/images/thumbnail.png" alt="'.get_the_title().'" class="wp-post-image"/>';
							}
							?>
							</a>
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<p><?php the_content_rss('more_link_text', TRUE, '', 30); ?> 
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">read more..</a></p>
        
							<div class="slimeta">
							<a href="#" class="prevb">&laquo; Previous</a><a href="#" class="nextb">Next &raquo;</a>
							</div>
						</div>     
					</li>
					<?php endwhile; ?>
				 </ul>
					<div class="clear"></div>        
				</div>
			</div>
		</div>
				  <?php comments_template(); ?>
			   <?php endwhile;?>
			<?php endif;?>
		</div>
			
        <div id="sidebar">
              <?php if ( is_active_sidebar( 'sidebar-lebar' ) ) : ?>  
                <div id="lebar">
                    <ul>          
                     <?php dynamic_sidebar( 'sidebar-lebar' ); ?>    
                    </ul>
                </div>
			   <?php endif; ?>
               <div id="kiri">
                    <ul>
                    <?php if ( ! dynamic_sidebar( 'sidebar-kiri' ) ) : ?>
                         <li id="search" class="widget-container widget_search">
						   <?php get_search_form(); ?>
                         </li>
                         <li id="archives" class="widget-container">
                         <h3 class="widget-title">Arsip</h3>
                              <ul>
                              <?php wp_get_archives( 'type=monthly' ); ?>
                              </ul>
                         </li>
                         <?php endif; ?>
                    </ul>
               </div>
                    
            <div id="kanan">
                <ul>
                  <?php if ( ! dynamic_sidebar( 'sidebar-kanan' ) ) : ?>
					<li id="meta" class="widget-container">
						<h3 class="widget-title">Meta</h3>
						<ul>
						<?php wp_register(); ?>
						<li>
						<?php wp_loginout(); ?>
						</li>
                        <?php wp_meta(); ?>
                         </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>        
   </div>
		<div style="clear:both;"></div>
			<div id="footer">
				  <p><a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a> 
				  &copy 2011 menggunakan <a href="http://wordpress.or.id">WordPress</a><br/>
				  <?php if (!is_home()) { wp_title(''); } ?></p>
			</div>

	<?php wp_footer();?>
   </body>
</html>
