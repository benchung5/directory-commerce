<?php

//Template fallback
add_filter( 'template_include', 'my_theme_redirect' );
 
//function my_callback( $original_template ) {
//  if ( some_condition() ) {
//    return SOME_PATH . '/some-custom-file.php';
//  } else {
//    return $original_template;
//  }
//}

function my_theme_redirect($original_template) {
    global $wp;
    $plugindir = dirname( __FILE__ );
    
    //if woocommerce page (this avoids the bug of woocommerce 
    //calling onepix_listing (below) on a woocommerce page)
    if (is_woocommerce()) {
            return $original_template;
          }

    //A Specific Custom Post Type
    if (isset($wp->query_vars["post_type"]) == 'onepix_listing') {
        $templatefilename = 'onepix_listing.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = $plugindir . '/themefiles/' . $templatefilename;
        }
        do_theme_redirect($return_template);

    //A Custom Taxonomy Page
    } elseif (isset($wp->query_vars["listing_type"]) == 'basic') {
        $templatefilename = 'taxonomy-listing_type-basic.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = $plugindir . '/themefiles/' . $templatefilename;
        }
        do_theme_redirect($return_template);
    }
    //A Custom Taxonomy Page
         elseif (isset($wp->query_vars["listing_type"]) == 'premium') {
        $templatefilename = 'taxonomy-listing_type-premium.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = $plugindir . '/themefiles/' . $templatefilename;
        }
        do_theme_redirect($return_template);
    } else {
        return $original_template;
      }
    //A Simple Page
//    elseif ($wp->query_vars["pagename"] == 'form-edit-listing') {
//        $templatefilename = 'form-edit-listing.php';
//        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
//            $return_template = TEMPLATEPATH . '/' . $templatefilename;
//        } else {
//            $return_template = $plugindir . '/themefiles/' . $templatefilename;
//        }
//        do_theme_redirect($return_template);
//    }
}

function do_theme_redirect($url) {
    global $post, $wp_query;
    if (have_posts()) {
        include($url);
        die();
    } else {
        $wp_query->is_404 = true;
    }
}

?>
