<?php get_template_part( 'content', 'before' ); 

//state from slug
$state_code = $_GET['state'];
$state_name = dc_state_code_to_name( $state_code );
//if the query doesn't have a valid state, redirect.
    if ($state_name == null) 
            {
                echo "Sorry, we can't find the state you're looking for " . '<a href="lawworldwide.com/law-firm-listings/">Return to listings</a><br><br>' ;
            }
    else {

?>

<div class="firms-page-header">
    <h1 class="firms-page-title"><?php echo $state_name ?></h1>
    <h3>Lawyers | Law Firms | Attorneys</h3>
</div>


<!--premium listings          -->
    <?php
    $prem_args = array(
        'post_type' => 'onepix_listing',
        'tax_query' => array(
            array(
                'taxonomy' => 'listing_type',
                'field' => 'slug',//select texonomy term by 'id' or 'slug'
                'terms' => 'premium'
            )
        ),
        'meta_key' => 'dc_state',
        'meta_value' => $state_code
    );
    $query = new WP_Query($prem_args);
    if ($query->have_posts()) { ?>
        
        <div class="dc-premium-listings">
        
        <?php
        while ($query->have_posts()) : $query->the_post();
        // action hook for insterting content above #post
        ?>

        <div id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> > 
            <div class="listing-entry">
                <div class="dc-p-listing-img"><a href="<?php echo the_permalink();?>"><?php dc_display_attachment_img($post->ID, array(260,400)) ?></a></div>
                <a target="_blank" href="<?php echo the_permalink();?>"><?php echo get_the_title();?></a><br/>
                <div class="x-small-text"><span>Website: </span><a href="<?php echo get_post_meta($post->ID, 'dc_firm_website', true); ?>"><?php echo dc_strip_http(get_post_meta($post->ID, 'dc_firm_website', true)) ; ?> </a><span>Address: </span><?php echo get_post_meta($post->ID, 'dc_address', true); ?> | <?php echo get_post_meta($post->ID, 'dc_city', true); ?>, <?php echo get_post_meta($post->ID, 'dc_state', true); ?>, <?php echo get_post_meta($post->ID, 'dc_city', true); ?></span></div>
                <?php echo dc_shorten(get_the_content(), 130) ?>
            </div><!-- .entry-content -->
        </div><!-- #post -->
        <div class="clear"></div>
        <?php
        endwhile; ?>
        </div>

        <?php } else {
        } ?>
<!-- end premium listings          -->




<div class="dc-basic-listings">
    <?php
    $prem_args = array(
        'post_type' => 'onepix_listing',
        'tax_query' => array(
            array(
                'taxonomy' => 'listing_type',
                'field' => 'slug',//select texonomy term by 'id' or 'slug'
                'terms' => 'basic'
            )
        ),
        'meta_key' => 'dc_state',
        'meta_value' => $state_code
    );
    $query = new WP_Query($prem_args);
    while ($query->have_posts()) : $query->the_post();
        // action hook for insterting content above #post
        ?>

        <div class="no-break" id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> > 
            <div class="listing-entry">
                <?php if (get_post_meta($post->ID, 'dc_firm_website', true)) { ?>
                    <a target="_blank" href="<?php echo get_post_meta($post->ID, 'dc_firm_website', true); ?>"><?php echo get_the_title();?></a>
                <?php } else { // elseif no website entered?>
                    <a href="#"><?php echo get_the_title();?></a>
                <?php } ?>
                    <br/><span class="small-text"><?php echo get_post_meta($post->ID, 'dc_address', true); ?> | <?php echo get_post_meta($post->ID, 'dc_city', true); ?>, <?php echo get_post_meta($post->ID, 'dc_state', true); ?>, <?php echo get_post_meta($post->ID, 'dc_country', true); ?></span></span>
            </div><!-- .entry-content -->
        </div><!-- #post -->
<?php 
endwhile;
?>
</div>

<?php        } //else
//end category loop
?>

<?php get_template_part( 'page', 'footer' ); ?>

<?php get_template_part( 'content', 'after' ); ?>




