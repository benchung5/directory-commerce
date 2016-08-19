<?php get_template_part( 'content', 'before' ); ?>	

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
				<div class="post clearfix dc-premium-listing" id="post-main-<?php the_ID(); ?>">
					<div class="entry">
                                            <div class="dc-prem-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
                                            </div>
                                            <div class="dc-prem-content">
                                                <div class="col-left">
                                                    <div class="dc-prem-address"><?php echo get_post_meta($post->ID, 'dc_address', true); ?><br> 
                                                        <?php echo get_post_meta($post->ID, 'dc_city', true); ?>, <?php echo get_post_meta($post->ID, 'dc_state', true); ?>, <?php echo get_post_meta($post->ID, 'dc_country', true); ?>
                                                    </div>
                                                    <div class="dc-prem-contactinfo">
                                                        <a href="<?php echo get_post_meta($post->ID, 'dc_firm_website', true); ?>"><?php echo dc_strip_http(get_post_meta($post->ID, 'dc_firm_website', true)) ; ?> </a><br>
                                                        Phone: <?php echo get_post_meta($post->ID, 'dc_firm_phone', true); ?><br>
                                                        Fax: <?php echo get_post_meta($post->ID, 'dc_firm_fax', true); ?><br>
                                                        Email: <a href="mailto:<?php echo get_post_meta($post->ID, 'dc_email', true); ?>?Subject=inquiry%20from%20lawworldwide.com"><?php echo get_post_meta($post->ID, 'dc_first_name', true); ?> <?php echo get_post_meta($post->ID, 'dc_last_name', true); ?></a>
                                                        <!--email link-->
                                                    </div>
                                                </div>
                                                <div class="col-right">
                                                    <div class="dc-singlep-listing-img"><?php dc_display_attachment_img($post->ID, array(260,400)) ?></div>
                                                </div>
                                                <div class="clear spacer"></div>
                                                <div class="clear spacer"></div>
                                                <div class="col-left">
                                                    <span class="recent-posts-title bevel">Details</span>
                                                    <ul class="dc-prem-details">
                                                        <li><span class="bold">Contact:</span> <?php echo get_post_meta($post->ID, 'dc_first_name', true); ?> <?php echo get_post_meta($post->ID, 'dc_last_name', true); ?></li>
                                                        <li><span class="bold">Contact Phone:</span> <?php echo get_post_meta($post->ID, 'dc_contact_phone', true); ?></li>
                                                        <li><span class="bold">Contact Fax:</span> <?php echo get_post_meta($post->ID, 'dc_contact_fax', true); ?></li>
                                                        <li><span class="bold">Number of Lawyers:</span> <?php echo get_post_meta($post->ID, 'dc_num_lawyers_this', true); ?></li>
                                                        <li><span class="bold">Representative Clients:</span> <?php echo get_post_meta($post->ID, 'dc_rep_clients', true); ?></li>
                                                        <li><span class="bold">Areas of Practice:</span> <?php echo get_post_meta($post->ID, 'dc_areas_practice', true); ?></li>
                                                    </ul>
                                                    
                                                </div>
                                                <div class="col-right">
                                                    <span class="recent-posts-title bevel">Details</span>
                                                    <p class="dc-prem-desc"><?php echo get_the_content(); ?></p>
                                                </div>
                                                <div class="clear spacer"></div>
						<?php wp_link_pages(); //pagination ?>
                                             </div>
					</div>
				</div>
<?php endwhile; endif; ?>


    <?php get_template_part( 'page', 'footer' ); ?>

<?php get_template_part( 'content', 'after' ); ?>
