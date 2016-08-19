<?php

//custom checkout fields-------------------------------------------------------\\
//------------------------------------------------------------------------------\\


//check if cart has premium listing in it.
function is_premium() {
    $is_premium = false;
    global $woocommerce;
    foreach ($woocommerce->cart->cart_contents as $key => $values) {
        //store product id's in array (this case it's just the one)
        $premiumlisting_prodID = array(430); //array(1111,2232,4235);

        if (in_array($values['product_id'], $premiumlisting_prodID)) {
            $is_premium = true;
            break;
        }
    }
    return $is_premium;
}

//override existing fields
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    
     // alter "Company Name" field
     $fields['billing']['billing_company'] = array(
        'label' => __('Law Firm Name', 'woocommerce'),
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true
    );

    return $fields;
}

//added for custom multiselect for areas of practice
add_filter('woocommerce_form_field_multiselect', 'custom_multiselect_handler', 10, 3);

//function custom_multiselect_handler( $key, $args, $value ) {
function custom_multiselect_handler( $value, $key, $args ) {

    $options = '';

    if ( ! empty( $args['options'] ) ) {

//        $field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';
//
//        if ( $args['label'] )
//                $field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
//        $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" multiple="multiple" class="state_select" ' . ' placeholder="' . $args['placeholder'] . '">
//                <option value="">'.__( 'Select a state&hellip;', 'woocommerce' ) .'</option>';
//
//        foreach ( $args['options'] as $mkey => $mvalue )
//                $field .= '<option value="' . $mkey . '" '. selected( $value, $key, false ) .'>'.__( $mvalue, 'woocommerce' ) .'</option>';
//
//        $field .= '</select>';
//        $field .= '</p>' . $after;
        
            $options = '';

    if ( ! empty( $args['options'] ) ) {
        foreach ( $args['options'] as $option_key => $option_text ) {
            $options .= '<option value="' . $option_key . '" '. selected( $value, $option_key, false ) . '>' . $option_text .'</option>';
        }

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .'" id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            <select name="' . $key . '[]' .'" id="' . $key . '" class="state_select" multiple="multiple">
                ' . $options . '
            </select>
        </p>' . $after;
    }
        
        return $field;
        
    }

}

function display_multiselect ($selected_values, $name) {
    
        //convert back into an array
        $selected_values = explode( ', ', $selected_values );
    
        //grab the default "areas of practice" options
        $values = areas_practice_options();
        
        $options = "";
        //select the options using the converted incoming post meta
        if ( ! empty( $selected_values ) ) {
        foreach ( $values as $option_key => $option_value ) {
            
            $selected = false;
            
            foreach ( $selected_values as $selected_key => $selected_value ) {
                if ($option_key == $selected_value){
                    //if selected...
                    $options .= '<option value="' . $option_key . '" '. selected( $option_key, $selected_value, false ) . '>' . $option_value .'</option>';
                
                    $selected = true;
                    
                } 
            }
            //if not selected, display them normally
            if ($selected == false) {
                
                $options .= '<option value="' . $option_key . '" '. selected( $option_key, $selected_value, false ) . '>' . $option_value .'</option>';
            }
        }

        $field = '<select name="' . $name . '[]' .'" id="' . $name . '" class="state_select" multiple="multiple">' . $options . '</select>';
        
        echo $field;
    }
}
    
function areas_practice_options (){
        

        $options = array(
            'Administrative' => __('Administrative ', 'woocommerce' ),
            'Admiralty and Maritime' => __('Admiralty and Maritime', 'woocommerce' ),
            'Advertising' => __('Advertising', 'woocommerce' ),
            'Agency and Distributorship' => __('Agency and Distributorship', 'woocommerce' ),
            'Agricultural' => __('Agricultural', 'woocommerce' ),
            'Alternative Dispute Resolution' => __('Alternative Dispute Resolution', 'woocommerce' ),
            'Antitrust and Competition' => __('Antitrust and Competition', 'woocommerce' ),
            'Appellate Practice' => __('Appellate Practice', 'woocommerce' ),
            'Art and Cultural Property' => __('Art and Cultural Property', 'woocommerce' ),
            'Aviation Health Securities' => __('Aviation Health Securities', 'woocommerce' ),
            'Banking Human Rights ' => __('Banking Human Rights ', 'woocommerce' ),
            'Bankruptcy and Insolvency ' => __('Bankruptcy and Insolvency ', 'woocommerce' ),
            'Capital Markets ' => __('Capital Markets', 'woocommerce' ),
            'Civil Rights' => __('Civil Rights ', 'woocommerce' ),
            'Class Actions' => __('Class Actions ', 'woocommerce' ),
            'Commercial and Contract ' => __('Commercial and Contract ', 'woocommerce' ),
            'Computer law' => __('Computer law ', 'woocommerce' ),
            'Constitutional lawe' => __('Constitutional law', 'woocommerce' ),
            'Construction law' => __('Construction law', 'woocommerce' ),
            'Consumer law' => __('Consumer law', 'woocommerce' ),
            'Controlled Substances' => __('Controlled Substances', 'woocommerce' ),
            'Credit Media' => __('Credit Media', 'woocommerce' ),
            'Criminal law' => __('Criminal law', 'woocommerce' ),
            'E-Commerce law' => __('E-Commerce law', 'woocommerce' ),
            'Estates and Trusts' => __('Estates and Trusts', 'woocommerce' ),
            'European Community Law' => __('European Community Law', 'woocommerce' ),
            'Expert Witness' => __('Expert Witness', 'woocommerce' ),
            'Family' => __('Family', 'woocommerce' ),
            'Financial Services' => __('Financial Services', 'woocommerce' ),
            'Foreign Investment' => __('Foreign Investment', 'woocommerce' ),
            'Franchising' => __('Franchising', 'woocommerce' ),
            'General Practice' => __('General Practice', 'woocommerce' ),
            'Government' => __('Government', 'woocommerce' ),
            'Health' => __('Health', 'woocommerce' ),
            'Human Rights' => __('Human Rights', 'woocommerce' ),
            'Injunctions' => __('Injunctions', 'woocommerce' ),
            'Immigration' => __('Immigration', 'woocommerce' ),
            'Insurance ' => __('Insurance ', 'woocommerce' ),
            'Insurance Defence' => __('Insurance Defence', 'woocommerce' ),
            'Intellectual Property' => __('Intellectual Property', 'woocommerce' ),
            'International' => __('International', 'woocommerce' ),
            'International Trade' => __('International Trade', 'woocommerce' ),
            'Joint Ventures' => __('Joint Venturese', 'woocommerce' ),
            'International Trade' => __('International Trade', 'woocommerce' ),
            'Land Use, Planning' => __('Land Use, Planning', 'woocommerce' ),
            'Landlord Tenant' => __('Landlord Tenant', 'woocommerce' ),
            'Litigation' => __('Litigation', 'woocommerce' ),
            'Media' => __('Media', 'woocommerce' ),
            'Mediation/Arbitration' => __('Mediation/Arbitration', 'woocommerce' ),
            'Mergers and Acquisitions' => __('Mergers and Acquisitions', 'woocommerce' ),'Landlord Tenant' => __('Landlord Tenant', 'woocommerce' ),
            'Military Law' => __('Military Law', 'woocommerce' ),
            'Native Rights' => __('Native Rights', 'woocommerce' ),
            'Packaging' => __('Packaging', 'woocommerce' ),
            'Personal Property' => __('Personal Property', 'woocommerce' ),
            'Practice Management' => __('Practice Management', 'woocommerce' ),
            'Privacy' => __('Privacy', 'woocommerce' ),
            'Privatization' => __('Privatization', 'woocommerce' ),
            'Product Liability' => __('Product Liability', 'woocommerce' ),
            'Property and Real Estate' => __('Property and Real Estate', 'woocommerce' ),
            'Securities' => __('Securities', 'woocommerce' ),
            'Social Services' => __('Social Services', 'woocommerce' ),
            'Space' => __('Space', 'woocommerce' ),
            'Sports and Recreation' => __('Sports and Recreation', 'woocommerce' ),
            'Taxation' => __('Taxation', 'woocommerce' ),
            'Telecommunication' => __('Telecommunication', 'woocommerce' ),
            'Technology and Cyber law' => __('Technology and Cyber law', 'woocommerce' ),
            'Tort and Personal Injury' => __('Tort and Personal Injury', 'woocommerce' ),
            'Toxic Torts' => __('Toxic Torts', 'woocommerce' ),
            'Trade Investment' => __('Trade Investment', 'woocommerce' ),'Taxation' => __('Taxation', 'woocommerce' ),
            'Utilities' => __('Utilities', 'woocommerce' ),
            'Women\'s Rights' => __('Women\'s Rights', 'woocommerce' ),
            'Worker\'s Compensation' => __('Worker\'s Compensation', 'woocommerce' ),
            'other' => __('other', 'woocommerce' ),
        );
        
        return $options;
}

//Add the custom fields to the checkout form after order notes
add_action('woocommerce_after_order_notes', 'add_custom_checkout_field');

function add_custom_checkout_field( $checkout ) {
    
    echo '<div id="custom_listing_fields"><h3>'.__('Listing information').'</h3>';
    
    if (is_premium()) {
        
            woocommerce_form_field( 'dc_title', array(
        'type'          => 'text',
        'class'         => array('field-title form-row-wide'),
        'label'         => __('Title'),
        'placeholder'       => __('Mr'),
        ), $checkout->get_value( 'dc_title' ));
    
        woocommerce_form_field( 'dc_firm_website', array(
        'type'          => 'text',
        'class'         => array('field-website form-row-wide'),
        'label'         => __('Law Firm Website'),
        'placeholder'       => __('www.yoursite.com'),
        ), $checkout->get_value( 'dc_firm_website' ));
        
        woocommerce_form_field( 'dc_firm_phone', array(
        'type'          => 'text',
        'class'         => array('field-firm-phone form-row-wide'),
        'label'         => __('Law Firm Phone'),
        ), $checkout->get_value( 'dc_firm_phone' ));
        
        woocommerce_form_field( 'dc_firm_fax', array(
        'type'          => 'text',
        'class'         => array('field-fax form-row-wide'),
        'label'         => __('Law Firm Fax'),
        ), $checkout->get_value( 'dc_firm_fax' ));
        
        woocommerce_form_field( 'dc_num_lawyers', array(
        'type'          => 'text',
        'class'         => array('field-num-lawyers form-row-first'),
        'label'         => __('nubmer of Lawyers'),
        ), $checkout->get_value( 'dc_num_lawyers' ));
        
        woocommerce_form_field( 'dc_num_lawyers_this', array(
        'type'          => 'text',
        'class'         => array('field-num-lawyers-this form-row-last'),
        'label'         => __('Number in This office'),
        ), $checkout->get_value( 'dc_num_lawyers_this' ));
        
        woocommerce_form_field( 'dc_firm_info', array(
        'type'          => 'textarea',
        'class'         => array('field-description form-row-wide'),
        'label'         => __('Frim Description (This Office)'),
        ), $checkout->get_value( 'dc_firm_info' ));
        
        woocommerce_form_field( 'dc_rep_clients', array(
        'type'          => 'text',
        'class'         => array('field-reps form-row-wide'),
        'label'         => __('Representative Clients'),
        ), $checkout->get_value( 'dc_rep_clients' ));
        
//        woocommerce_form_field( 'my_checkbox1', array( 
//        'type' => 'checkbox', 
//        'class' => array('input-checkbox'), 
//        'label' => __('checkbox'), 
//        'required' => false, 
//        'value'  => true, 
//        ), $checkout->get_value( 'my_checkbox1' ));
        
        woocommerce_form_field( 'dc_areas_practice', array(
        'type'          => 'multiselect',
        'class'         => array('s4 field-areas form-row-wide'),
        'label'         => __('Areas of Practice'),
        'options'       => areas_practice_options (),
        ), $checkout->get_value( 'dc_areas_practice' ));
        
        woocommerce_form_field( 'dc_contact_phone', array(
        'type'          => 'text',
        'class'         => array('field-phone form-row-wide'),
        'label'         => __('Contact Phone'),
        ), $checkout->get_value( 'dc_contact_phone' ));
        
        woocommerce_form_field( 'dc_contact_fax', array(
        'type'          => 'text',
        'class'         => array('field-cont-fax form-row-wide'),
        'label'         => __('Contact Fax'),
        ), $checkout->get_value( 'dc_contact_fax' ));

    }
    else {
        
        woocommerce_form_field( 'dc_title', array(
        'type'          => 'text',
        'class'         => array('field-title form-row-wide'),
        'label'         => __('Title'),
        'placeholder'       => __('Mr'),
        ), $checkout->get_value( 'dc_title' ));
    
        woocommerce_form_field( 'dc_firm_website', array(
        'type'          => 'text',
        'class'         => array('field-website form-row-wide'),
        'label'         => __('Law Firm Website'),
        'placeholder'       => __('www.yoursite.com'),
        ), $checkout->get_value( 'dc_firm_website' ));
        
    }

    echo '</div>';
   
}


//store custom field data in Listing post---------------------------------------\\
//------------------------------------------------------------------------------\\

/**
 * Update the order meta with our custom fields values
 **/
add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');

function my_custom_checkout_field_update_order_meta( $order_id ) {

    $order = new WC_Order( $order_id );
    $items = $order->get_items();
    foreach ( $items as $item ) {
//        $product_name = $item['name'];
        $product_id = $item['product_id'];
//        $product_variation_id = $item['variation_id'];
    }
    
    $listing_type = 'null';
    if($product_id == 424) $listing_type = 'basic';
    if($product_id == 430) $listing_type = 'premium';

    // Create post object
    $my_post = array(
    'post_title'    => $_POST['billing_company'],
    'post_content'  => $_POST['dc_firm_info'],
    'post_status'   => 'publish',
//    'post_author'   => 1,
    'post_type'      => 'onepix_listing', //You may want to insert a regular post, page, link, a menu item or some custom post type
    //'tax_input' => array( 'listing_type' => array($listing_type) ) // support for custom taxonomies. 24=basic 25=premium
    );

    // Insert the post into the database and return the ID
    $post_ID = wp_insert_post($my_post);
    
    //this sets the taxonomy term
    wp_set_object_terms($post_ID, $listing_type, 'listing_type', true);
    
    if ($_POST['dc_areas_practice']) $areas_practice = implode(", ",$_POST['dc_areas_practice']);
    
    //must insert the custom post meta this way:
    if ($order_id) update_post_meta($post_ID, 'dc_listing_id', esc_attr($order_id));
    if ($_POST['dc_title']) update_post_meta($post_ID, 'dc_title', esc_attr($_POST['dc_title']));
    if ($_POST['billing_first_name']) update_post_meta($post_ID, 'dc_first_name', esc_attr($_POST['billing_first_name']));
    if ($_POST['billing_last_name']) update_post_meta($post_ID, 'dc_last_name', esc_attr($_POST['billing_last_name']));
    if ($_POST['billing_email']) update_post_meta($post_ID, 'dc_email', esc_attr($_POST['billing_email']));
    if ($_POST['billing_address_1']) update_post_meta($post_ID, 'dc_address', esc_attr($_POST['billing_address_1']));
    //add http:// to website address if non-existent
    $updated_firm_website = esc_attr($_POST['dc_firm_website']);
    if (strpos($updated_firm_website,'http://') === false){
        $updated_firm_website = 'http://'.$updated_firm_website;
    }
    if ($_POST['dc_firm_website']) update_post_meta($post_ID, 'dc_firm_website', $updated_firm_website );
    if ($_POST['billing_city']) update_post_meta($post_ID, 'dc_city', esc_attr($_POST['billing_city']));
    if ($_POST['billing_state']) update_post_meta($post_ID, 'dc_state', esc_attr($_POST['billing_state']));
    if ($_POST['billing_country']) update_post_meta($post_ID, 'dc_country', esc_attr($_POST['billing_country']));
    if ($_POST['billing_postcode']) update_post_meta($post_ID, 'dc_zip_postal', esc_attr($_POST['billing_postcode']));
    if ($_POST['dc_firm_phone']) update_post_meta($post_ID, 'dc_firm_phone', esc_attr($_POST['dc_firm_phone']));
    if ($_POST['dc_firm_fax']) update_post_meta($post_ID, 'dc_firm_fax', esc_attr($_POST['dc_firm_fax']));
    if ($_POST['dc_num_lawyers']) update_post_meta($post_ID, 'dc_num_lawyers', esc_attr($_POST['dc_num_lawyers']));
    if ($_POST['dc_num_lawyers_this']) update_post_meta($post_ID, 'dc_num_lawyers_this', esc_attr($_POST['dc_num_lawyers_this']));
    if ($_POST['dc_rep_clients']) update_post_meta($post_ID, 'dc_rep_clients', esc_attr($_POST['dc_rep_clients']));
    //if ($_POST['dc_areas_practice']) update_post_meta($post_ID, 'dc_areas_practice', esc_attr($_POST['dc_areas_practice']));
    if ($areas_practice) update_post_meta($post_ID, 'dc_areas_practice', esc_attr($areas_practice));
    if ($_POST['dc_contact_phone']) update_post_meta($post_ID, 'dc_contact_phone', esc_attr($_POST['dc_contact_phone']));
    if ($_POST['dc_contact_fax']) update_post_meta($post_ID, 'dc_contact_fax', esc_attr($_POST['dc_contact_fax']));

    // can use:
//    billing_country
//    billing_first_name
//    billing_last_name
//    billing_company
//    billing_address_1
//    billing_city
//    billing_state
//    billing_postcode
//    billing_email
//    billing_phone
    

}

//update listing meta ---------------------------------------------------------------//
//------------------------------------------------------------------------------------//

// add the action
add_action( 'update_listing_meta_hook', 'update_listing_meta' );

function update_listing_meta ($post_ID ) {
    
    $post = array(
        'ID'           => $post_ID,
        'post_title' => $_POST['dc_firm_name'],
        'post_content' => $_POST['dc_firm_info']
        );
    // Update the post into the database
    wp_update_post( $post );
        
//    echo $post_ID;
//    echo '<br>';
//    echo 'title:' . esc_attr($_POST['dc_title']);
//    echo '<br>';
//    echo $_POST['dc_first_name'];
//    echo '<br>';
//    echo get_post_meta( get_the_ID(), 'dc_first_name', true);
//    echo '<br>';
    
    
    if ($_POST['dc_areas_practice']) $areas_practice = implode(", ",$_POST['dc_areas_practice']);

    //update the post meta
    if ($_POST['dc_firm_info']) update_post_meta( $post_ID, 'dc_firm_info', esc_attr($_POST['dc_firm_info']));
    if ($_POST['dc_contact_fax']) update_post_meta($post_ID, 'dc_contact_fax', esc_attr($_POST['dc_contact_fax']));
    
    if ($_POST['dc_title']) update_post_meta($post_ID, 'dc_title', esc_attr($_POST['dc_title']));
    
    if ($_POST['dc_first_name']) update_post_meta($post_ID, 'dc_first_name', esc_attr($_POST['dc_first_name']));
    if ($_POST['dc_last_name']) update_post_meta($post_ID, 'dc_last_name', esc_attr($_POST['dc_last_name']));
    if ($_POST['dc_email']) update_post_meta($post_ID, 'dc_email', esc_attr($_POST['dc_email']));
    if ($_POST['dc_address']) update_post_meta($post_ID, 'dc_address', esc_attr($_POST['dc_address']));
    //add http:// to website address if non-existent
    $updated_firm_website = esc_attr($_POST['dc_firm_website']);
    if (strpos($updated_firm_website,'http://') === false){
        $updated_firm_website = 'http://'.$updated_firm_website;
    }
    if ($_POST['dc_firm_website']) update_post_meta($post_ID, 'dc_firm_website', $updated_firm_website );
    if ($_POST['dc_city']) update_post_meta($post_ID, 'dc_city', esc_attr($_POST['dc_city']));
    if ($_POST['dc_state']) update_post_meta($post_ID, 'dc_state', esc_attr($_POST['dc_state']));
    if ($_POST['dc_country']) update_post_meta($post_ID, 'dc_country', esc_attr($_POST['dc_country']));
    if ($_POST['dc_zip_postal']) update_post_meta($post_ID, 'dc_zip_postal', esc_attr($_POST['dc_zip_postal']));
    if ($_POST['dc_firm_phone']) update_post_meta($post_ID, 'dc_firm_phone', esc_attr($_POST['dc_firm_phone']));
    if ($_POST['dc_firm_fax']) update_post_meta($post_ID, 'dc_firm_fax', esc_attr($_POST['dc_firm_fax']));
    if ($_POST['dc_num_lawyers']) update_post_meta($post_ID, 'dc_num_lawyers', esc_attr($_POST['dc_num_lawyers']));
    if ($_POST['dc_num_lawyers_this']) update_post_meta($post_ID, 'dc_num_lawyers_this', esc_attr($_POST['dc_num_lawyers_this']));
    if ($_POST['dc_rep_clients']) update_post_meta($post_ID, 'dc_rep_clients', esc_attr($_POST['dc_rep_clients']));
    //if ($_POST['dc_areas_practice']) update_post_meta($post_ID, 'dc_areas_practice', esc_attr($_POST['dc_areas_practice']));
    if ($areas_practice) update_post_meta($post_ID, 'dc_areas_practice', esc_attr($areas_practice));
    if ($_POST['dc_contact_phone']) update_post_meta($post_ID, 'dc_contact_phone', esc_attr($_POST['dc_contact_phone']));
    if ($_POST['dc_contact_fax']) update_post_meta($post_ID, 'dc_contact_fax', esc_attr($_POST['dc_contact_fax']));
    

}

    
//image file upload-----------------------------------------------------------//
//------------------------------------------------------------------------------------//


// display image
add_action( 'custom_file_upload_hook', 'custom_file_upload' );

function custom_file_upload($post_ID) {

    //if ($_FILES)
    if (isset($_POST['html-upload']) && !empty($_FILES)) {
        foreach ($_FILES as $file => $array) {
            $newupload = insert_attachment($file, $post_ID);
            //print_r($newupload);        
            // $newupload returns the attachment id of the file that
            // was just uploaded. Do whatever you want with that now.
        }
        unset($_FILES);


        //check errors
        $id = media_handle_upload('async-upload', $post_id); //post id of Client Files page
        unset($_FILES);
        if (is_wp_error($id)) {
            $errors['upload_error'] = $id;
            $id = false;
        }

        if ($errors) {
            
        }
    }
}

function insert_attachment($file_handler,$post_id) {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

	update_post_meta($post_id,'_thumbnail_id',$attach_id);
	update_post_meta($post_id,'upload_image_id',$post_id);
        
        //echo 'image attached to post: ' . $post_id;

        return $attach_id;
}

//for displaying the attachment link (profile area)
function display_img($attachments){
            foreach ($attachments as $attachment) {
            ?>
            <div class="profile-image">
    <!--    display image-->
            <?php the_attachment_link($attachment->ID, false); ?>
            </div>
            <?php
        }
} 


//for testing purposes----------------------------------------------------------------//
//------------------------------------------------------------------------------------//


// add the action for testing order fcompletion
//add_action( 'woocommerce_order_details_after_order_table', 'order_details_test_output' );
//
//
//function order_details_test_output($order) {
//   //print the current WC_Order
//    
//
//    $items = $order->get_items();
//    foreach ( $items as $item ) {
////        $product_name = $item['name'];
//        $product_id = $item['product_id'];
////        $product_variation_id = $item['variation_id'];
//    }
//    
//   print_r($product_id);
//   echo "<br><br>";
//}

?>