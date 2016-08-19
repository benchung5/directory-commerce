<?php
/*
Plugin Name: Directory Commerce
Plugin URI: http://1pixeldesign.com/wordpress-plugins/directory-commerce
Description: Create a directory listings site with woocommerce subscriptions gateway.
Version: 1.0
Author: Ben Chung
Author URI: http://directory-commerce.com
*/

/*  Copyright 2013  Ben Chung  (email : ben@benchung.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



// Call function when plugin is activated
register_activation_hook(__FILE__,'dc_install');

// Action hook to initialize the plugin
add_action('admin_init', 'dc_admin_init');

// Action hook to register our option settings
add_action( 'admin_init', 'dc_register_settings' );

// Action hook to add custom taxomomies
add_action( 'init', 'dc_add_custom_taxonomies', 0 );

// Add post type for adlistings
add_action('init', 'dc_create_post_type');

// Add post type for adlistings
add_action('init', 'dc_register_styles');

add_action('admin_init','my_meta_init');

// Action hook to add the post products menu item
add_action('admin_menu', 'dc_menu');

// Action hook to save the meta box data when the post is saved
add_action('save_post','dc_save_meta_box');

// Action hook to create the post products shortcode
add_shortcode('dc', 'dc_shortcode');

// Action hook to create plugin widget
add_action( 'widgets_init', 'dc_register_widgets' );

// Filter for custom post filler title text
add_filter( 'enter_title_here', 'enter_title_here', 1, 2 );

//Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
//add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );


//for testing
//function style_test() 
//{ 
//    $wp_styles = new WP_Styles();
//
//    echo '<pre>'; 
//        // $wp_styles->enqueue == completely empty
//        print_r( plugins_url('dc-style.css', __FILE__) ); 
//    echo '</pre>'; 
//} 
//add_action( 'wp_print_scripts', 'style_test', 0 );




//function register_plugin_styles() {
//   
//        // Respects SSL, Style.css is relative to the current file
//        wp_register_style( 'dc-stylesheet', plugins_url('directory-commerce/css/dc-style.css') );
//        //wp_register_style( 'dc-stylesheet', plugins_url('dc-style.css', __FILE__) );
//        wp_enqueue_style( 'dc-stylesheet' );
//}



function dc_install() {
    //setup our default option values
    $dc_options_arr = array(
        "bullet_point" => '&rsaquo;&rsaquo;'
    );

    //save our default option values
    update_option('dc_options', $dc_options_arr);
}

//create post meta boxes
function dc_register_styles() {

        // Respects SSL, Style.css is relative to the current file
        wp_register_style( 'dc-stylesheet', plugins_url('directory-commerce/css/dc-style.css') );
        //wp_enqueue_style( 'dc-stylesheet', plugins_url('directory-commerce/css/dc-style.css'), false, '1.0', 'all' ); // Inside a plugin
        wp_enqueue_style( 'dc-stylesheet' );
        
        
}


//create post meta boxes
function dc_admin_init() {
	// create our custom meta box
	add_meta_box('dc-meta',__('Listing Information','dc-plugin'), 'dc_meta_box','onepix_listing','normal','default');
        add_meta_box( 'banner-image', __( 'banner Image' ), array( 'banner_image_meta_box' ), 'banner', 'normal', 'high' );
        //add_meta_box( 'portrait-image', __( 'portrait Image' ), array( 'portrait_image_meta_box' ), 'portrait', 'normal', 'high' );

}
        
// Add custom post type
function dc_create_post_type() {
    register_post_type('onepix_listing', array(
        'labels' => array(
            'name' => __('Listings'),
            'singular_name' => __('Listing')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'listing', 'with_front' => FALSE),
            )
    );
    //must do this to get permalinks working
    flush_rewrite_rules();
}

// Add custom taxonomies
function dc_add_custom_taxonomies() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('listing_type', 'onepix_listing', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x('Listing Type', 'taxonomy general name'),
            'singular_name' => _x('Listing Type', 'taxonomy singular name'),
            'search_items' => __('Search Listing Types'),
            'all_items' => __('All Listing Types'),
            'parent_item' => __('Parent Listing Type'),
            'parent_item_colon' => __('Parent Listing Type:'),
            'edit_item' => __('Edit Listing Type'),
            'update_item' => __('Update Listing Type'),
            'add_new_item' => __('Add New Listing Type'),
            'new_item_name' => __('New Listing Type Name'),
            'menu_name' => __('Listing Type'),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'listings', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/listings/basic/Ottawa/"
        ),
    ));
}



//create the sub-menu
function dc_menu() {
	add_menu_page(__('Directory Commerce Settings Page','dc-plugin'), __('Directory Commerce','dc-plugin'), 'administrator', __FILE__, 'dc_settings_page');
}


//create shortcode
function dc_shortcode($atts, $content = null) {
	global $post;
	extract(shortcode_atts(array(
		"show" => ''
	), $atts));
	
	//load options array
	$dc_options = get_option('dc_options');
	
	If ($show == 'info') {
		$dc_show = $dc_options['bullet_point']. get_post_meta($post->ID,'dc_firm_info',true);
	}elseif ($show == 'id') {
		$dc_show = get_post_meta($post->ID,'dc_listing_id',true);
	}
	return $dc_show;
}



function my_meta_init()
{
	// add a meta box for custom post of type 
	foreach (array('events','page') as $type) 
	{
		add_meta_box('my_meta_3', 'My Custom Meta Box 3', 'my_meta_setup_3', $type, 'normal', 'high');
	}	
}


//build meta box
function dc_meta_box($post,$box) {
	
//information meta box---------------------------------------------------------------------------
        // retrieve our custom meta box values
	$dc_listing_id = get_post_meta($post->ID,'dc_listing_id',true);
        $dc_title = get_post_meta($post->ID,'dc_title',true);
        $dc_first_name = get_post_meta($post->ID,'dc_first_name',true);
        $dc_last_name = get_post_meta($post->ID,'dc_last_name',true);
        $dc_firm_name = get_post_meta($post->ID,'dc_firm_name',true);
        $dc_address = get_post_meta($post->ID,'dc_address',true);
        $dc_email = get_post_meta($post->ID,'dc_email',true);
        $dc_firm_website = get_post_meta($post->ID,'dc_firm_website',true);
        $dc_city = get_post_meta($post->ID,'dc_city',true);
        $dc_state = get_post_meta($post->ID,'dc_state',true);
        $dc_country = get_post_meta($post->ID,'dc_country',true);
        $dc_zip_postal= get_post_meta($post->ID,'dc_zip_postal',true);
        $dc_firm_phone= get_post_meta($post->ID,'dc_firm_phone',true);
        $dc_firm_fax= get_post_meta($post->ID,'dc_firm_fax',true);
        $dc_num_lawyers= get_post_meta($post->ID,'dc_num_lawyers',true);
        $dc_num_lawyers_this= get_post_meta($post->ID,'dc_num_lawyers_this',true);
        $dc_contact_name = get_post_meta($post->ID,'dc_contact_name',true);
        $dc_firm_info = get_post_meta($post->ID,'dc_firm_info',true);
        $dc_rep_clients= get_post_meta($post->ID,'dc_rep_clients',true);
        $dc_contact_phone= get_post_meta($post->ID,'dc_contact_phone',true);
        $dc_contact_fax= get_post_meta($post->ID,'dc_contact_fax',true);
        $dc_areas_practice= get_post_meta($post->ID,'dc_areas_practice',true);
        
	


	// display meta box form
	echo '<table class="dc-listing-table">';
	echo '<tr>';
	echo '<td class="label">' .__('Listing ID', 'dc-plugin'). ':</td><td class="field" ><input type="text" name="dc_listing_id" value="'.esc_attr($dc_listing_id).'" required></td>';
	echo '</tr><tr>';
	echo '<td>' .__('Title', 'dc-plugin'). ':</td><td><input type="text" name="dc_title" value="'.esc_attr($dc_title).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('First Name', 'dc-plugin'). ':</td><td><input type="text" name="dc_first_name" value="'.esc_attr($dc_first_name).'"></td>';
	echo '</tr><tr>';
        echo '<td>' .__('Last Name', 'dc-plugin'). ':</td><td><input type="text" name="dc_last_name" value="'.esc_attr($dc_last_name).'"></td>';
	echo '</tr><tr>';
        echo '<td>' .__('Email', 'dc-plugin'). ':</td><td><input type="text" name="dc_email" value="'.esc_attr($dc_email).'"></td>';
        echo '</tr><tr>';
        //echo '<td>' .__('Law Firm Name', 'dc-plugin'). ':</td><td><input type="text" name="dc_firm_name" value="'.esc_attr($dc_firm_name).'"></td>';
	//echo '</tr><tr>';
        echo '<td>' .__('Address', 'dc-plugin'). ':</td><td><input type="text" name="dc_address" value="'.esc_attr($dc_address).'"></td>';
	echo '</tr><tr>';
        echo '<td>' .__('Law Firm Website', 'dc-plugin'). ':</td><td><input type="text" name="dc_firm_website" value="'.esc_attr($dc_firm_website).'"></td>';
	echo '</tr><tr>';
        echo '<td>' .__('City', 'dc-plugin'). ':</td><td><input type="text" name="dc_city" value="'.esc_attr($dc_city).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('State', 'dc-plugin'). ':</td><td><input type="text" name="dc_state" value="'.esc_attr($dc_state).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Country', 'dc-plugin'). ':</td><td><input type="text" name="dc_country" value="'.esc_attr($dc_country).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Zip/Postal Code', 'dc-plugin'). ':</td><td><input type="text" name="dc_zip_postal" value="'.esc_attr($dc_zip_postal).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Firm Phone', 'dc-plugin'). ':</td><td><input type="text" name="dc_firm_phone" value="'.esc_attr($dc_firm_phone).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Firm Fax', 'dc-plugin'). ':</td><td><input type="text" name="dc_firm_fax" value="'.esc_attr($dc_firm_fax).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Number of Lawyers', 'dc-plugin'). ':</td><td><input type="text" name="dc_num_lawyers" value="'.esc_attr($dc_num_lawyers).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Number of Lawyers<br/>(This Office)', 'dc-plugin'). ':</td><td><input type="text" name="dc_num_lawyers_this" value="'.esc_attr($dc_num_lawyers_this).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Contact Firm Lawyer', 'dc-plugin'). ':</td><td><input type="text" name="dc_contact_name" value="'.esc_attr($dc_contact_name).'"></td>';
        echo '</tr><tr>';
        //echo '<td>' .__('Firm Description<br/>(This Office)', 'dc-plugin'). ':</td><td><textarea rows="8" name="dc_firm_info">'.esc_attr($dc_firm_info).'</textarea>';
        //echo '</tr><tr>';
        echo '<td>' .__('Representative Clients', 'dc-plugin'). ':</td><td><input type="text" name="dc_rep_clients" value="'.esc_attr($dc_rep_clients).'"></td>';
        echo '</tr><tr>';
        //echo '</tr><td class="spacer"><td><tr>';
        echo '<td>' .__('Areas of Practice', 'dc-plugin'). ':</td><td><input type="text" name="dc_areas_practice" value="'.esc_attr($dc_areas_practice).'"></td>';
//areas of practice
echo <<<_END

   <!-- 
        <table width="100%" height="523" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr>
          <td><input type="checkbox" value="ON" name="C2">Administrative
            </td>
          <td><input type="checkbox" value="ON" name="C27">Estates
            and Trusts</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C48">Military
            Law</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C3">Admiralty
            and Maritime</td>
          <td><input type="checkbox" value="ON" name="C28">European
            Community Law</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C49">Native
            Rights</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C4">Advertising</td>
          <td><input type="checkbox" value="ON" name="C29">Expert
            Witness</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C50">Packaging</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C5">Agency
            and Distributorship</td>
          <td><input type="checkbox" value="ON" name="C30">Family</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C51">Personal
            Property</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C6">Agricultural</td>
          <td><input type="checkbox" value="ON" name="C31">Financial
            Services</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C52">Practice
            Management</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C7">Alternative
            Dispute Resolution</td>
          <td><input type="checkbox" value="ON" name="C32">Foreign
            Investment</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C53">Privacy</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C8">Antitrust
            and Competition </td>
          <td><input type="checkbox" value="ON" name="C33">Franchising</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C54">Privatization</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C9">Appellate
            Practice</td>
          <td><input type="checkbox" value="ON" name="C34">General
            Practice</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C55">Product
            Liability</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C10">Art
            and Cultural Property</td>
          <td><input type="checkbox" value="ON" name="C35">Government</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C56">Property
            and Real Estate</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C11">Aviation</td>
          <td><input type="checkbox" value="ON" name="C36">Health</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C57">Securities</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C12">Banking</td>
          <td><input type="checkbox" value="ON" name="C37">Human
            Rights</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C58">Social
            Services</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C13">Bankruptcy
            and Insolvency</td>
          <td><input type="checkbox" value="ON" name="C38">Injunctions</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C59">Space</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C14">Capital
            Markets</td>
          <td><input type="checkbox" value="ON" name="C39">Immigration</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C60">Sports
            and Recreation</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C15">Civil
            Rights</td>
          <td><input type="checkbox" value="ON" name="C40">Insurance
            </td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C61">Taxation</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C16">Class
            Actions</td>
          <td><input type="checkbox" value="ON" name="C41">Insurance
            Defence</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C62">Telecommunication</td>
        </tr>
        <tr>
          <td width="33%" height="19"><input type="checkbox" value="ON" name="C17">Commercial
            and Contract</td>
          <td width="33%" height="19"><input type="checkbox" value="ON" name="C42">Intellectual
            Property</td>
          <td width="34%" height="19"><input type="checkbox" value="ON" name="C77">Technology
            and Cyber law</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C18">Computer
            law</td>
          <td><input type="checkbox" value="ON" name="C43">International
            </td>
          <td width="34%" height="19"><input type="checkbox" value="ON" name="C63">Tort
            and Personal Injury</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C19">Constitutional
            law</td>
          <td><input type="checkbox" value="ON" name="C44">International
            Trade</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C64">Toxic
            Torts</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C20">Construction
            law</td>
          <td><input type="checkbox" value="ON" name="C45">Joint
            Ventures</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C65">Trade
            Investment</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C21">Consumer
            law</td>
          <td><input type="checkbox" value="ON" name="C46">Land
            Use, Planning</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C66">Utilities</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C22">Controlled
            Substances</td>
          <td><input type="checkbox" value="ON" name="C47">Landlord
            Tenant</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C67">Women's
            Rights</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C23">Corporate
            and Business</td>
          <td><input type="checkbox" value="ON" name="C71">Litigation</td>
          <td width="34%" height="21"><input type="checkbox" value="ON" name="C68">Worker's
            Compensation</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C24">Credit</td>
          <td><input type="checkbox" value="ON" name="C72">Media</td>
          <td width="34%" height="21"><input class="other" type="text" size="20" name="T12">other</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C25">Criminal
            law</td>
          <td><input type="checkbox" value="ON" name="C73">Mediation/Arbitration</td>
          <td width="34%" height="21"><input class="other" type="text" size="20" name="T13">other</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="ON" name="C26">E-Commerce law</td>
          <td>Mergers and Acquisitions</td>
          <td width="34%" height="21"><input class="other" type="text" size="20" name="T13">other</td>
        </tr>
      </tbody></table>
-->
_END;
//end areas of practice
echo '</td></tr><tr>';
        echo '<td>' .__('Contact Phone', 'dc-plugin'). ':</td><td><input type="text" name="dc_contact_phone" value="'.esc_attr($dc_contact_phone).'"></td>';
        echo '</tr><tr>';
        echo '<td>' .__('Contact Fax', 'dc-plugin'). ':</td><td><input type="text" name="dc_contact_fax" value="'.esc_attr($dc_contact_fax).'"></td>';
//        echo '</tr><td>Portrait or Banner image:</td>';
//        echo '<td>';
//        set_image('banner', $post);
//        echo '</td></tr>';
        echo '</table>';
        
}

//handle attaching an image
function set_image($type, $post) {
    
    //image information meta box---------------------------------------------------------------------------
        
        global $post;
        
        $image_src = '';

        $image_id = get_post_meta( $post->ID, 'dc_image_id', true );
        $image_src = wp_get_attachment_url( $image_id );

        ?>
       <div class="dc-image-uploader">
        <img id="<?php echo $type; ?>_image" src="<?php echo $image_src ?>" style="max-width:100%;" />
        <input type="hidden" name="upload_image_id" id="upload_image_id" value="<?php echo $image_id; ?>" />
        <p>
                <a title="Set <?php echo $type; ?> image" href="#" id="set-<?php echo $type; ?>-image">Set <?php echo $type; ?> image</a>
                <a title="Remove <?php echo $type; ?> image" href="#" id="remove-<?php echo $type; ?>-image" style="<?php echo ( ! $image_id ? 'display:none;' : '' ); ?>"><?php _e( 'Remove banner image' ) ?></a>
        </p>
        
        <!-- for passing onto javascript -->
        <?php $the_type = $type; ?>

        <script type="text/javascript">
        jQuery(document).ready(function($) {

                // save the send_to_editor handler function
                window.send_to_editor_default = window.send_to_editor;
                
                //get image type from the php variable
                var image_type = "<?php echo $the_type; ?>";
                
                $('#set-' + image_type + '-image').click(function(){

                        // replace the default send_to_editor handler function with our own
                        window.send_to_editor = window.attach_image;
                        tb_show('', 'media-upload.php?post_id=<?php echo $post->ID ?>&amp;type=image&amp;TB_iframe=true');

                        return false;
                });

                $('#remove-' + image_type + '-image').click(function() {

                        $('#upload_image_id').val('');
                        $('img').attr('src', '');
                        $(this).hide();

                        return false;
                });

                // handler function which is invoked after the user selects an image from the gallery popup.
                // this function displays the image and sets the id so it can be persisted to the post meta
                window.attach_image = function(html) {

                        // turn the returned image html into a hidden image element so we can easily pull the relevant attributes we need
                        $('body').append('<div id="temp_image">' + html + '</div>');
                        
                        //find temp image
                        var img = $('#temp_image').find('img');
                        
                        //process temp image attributes
                        imgurl   = img.attr('src');
                        imgclass = img.attr('class');
                        imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);

                        //set hidden field with ID for persisting
                        $('#upload_image_id').val(imgid);
                        //show remove button
                        $('#remove-' + image_type + '-image').show();

                        //set source of our image and remove temp image
                        $('img#' + image_type + '_image').attr('src', imgurl);
                        try{tb_remove();}catch(e){};
                        $('#temp_image').remove();
                        
                        // restore the send_to_editor handler function
                        window.send_to_editor = window.send_to_editor_default;

                }

        });
        </script>
    </div>
   <?php 
}




//save meta box data
//function dc_save_meta_box($post_id $post) {
function dc_save_meta_box($post_id) {
    
	// if post is a revision skip saving our meta box data
	//if($post->post_type == 'revision') { return; } ben removed this as the
        //save_post action that this overrides no longer has a secont perameter
	
        // if post is a revision, etc... then skip saving our meta box data
//        $post = get_post($post_id);
//        if($post->post_type == 'revision') { return; }
        $post = get_post($post_id);
        if ( empty( $post_id ) || empty( $post ) || empty( $_POST ) ) return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( is_int( wp_is_post_revision( $post ) ) ) return;
        if ( is_int( wp_is_post_autosave( $post ) ) ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;
        if ( $post->post_type != 'onepix_listing' ) return;
        
	// process form data if $_POST is set
	if(isset($_POST['dc_listing_id']) && $_POST['dc_listing_id'] != '') {

            

            
            
		// save the meta box data as post meta using the post ID as a unique prefix
		update_post_meta($post_id,'dc_listing_id', esc_attr($_POST['dc_listing_id']));
                update_post_meta($post_id,'dc_title', esc_attr($_POST['dc_title']));
                update_post_meta($post_id,'dc_first_name', esc_attr($_POST['dc_first_name']));
                update_post_meta($post_id,'dc_last_name', esc_attr($_POST['dc_last_name']));
                update_post_meta($post_id,'dc_email', esc_attr($_POST['dc_email']));
                update_post_meta($post_id,'dc_firm_name', esc_attr($_POST['dc_firm_name']));
                update_post_meta($post_id,'dc_address', esc_attr($_POST['dc_address']));

                //add http:// to website address if non-existent
                $updated_firm_website = esc_attr($_POST['dc_firm_website']);
                if (strpos($updated_firm_website,'http://') === false){
                    $updated_firm_website = 'http://'.$updated_firm_website;
                }
                update_post_meta($post_id,'dc_firm_website', $updated_firm_website);
                
                update_post_meta($post_id,'dc_city', esc_attr($_POST['dc_city']));
                update_post_meta($post_id,'dc_state', esc_attr($_POST['dc_state']));
                update_post_meta($post_id,'dc_country', esc_attr($_POST['dc_country']));
                update_post_meta($post_id,'dc_zip_postal', esc_attr($_POST['dc_zip_postal']));
                update_post_meta($post_id,'dc_firm_phone', esc_attr($_POST['dc_firm_phone']));
                update_post_meta($post_id,'dc_firm_fax', esc_attr($_POST['dc_firm_fax']));
                update_post_meta($post_id,'dc_num_lawyers', esc_attr($_POST['dc_num_lawyers']));
                update_post_meta($post_id,'dc_num_lawyers_this', esc_attr($_POST['dc_num_lawyers_this']));
                update_post_meta($post_id,'dc_contact_name', esc_attr($_POST['dc_contact_name']));
//                update_post_meta($post_id,'dc_last_name', esc_attr($_POST['dc_last_name']));
                update_post_meta($post_id,'dc_firm_info',esc_attr($_POST['dc_firm_info']));
                update_post_meta($post_id,'dc_rep_clients',esc_attr($_POST['dc_rep_clients']));
                update_post_meta($post_id,'dc_contact_phone',esc_attr($_POST['dc_contact_phone']));
                update_post_meta($post_id,'dc_contact_fax',esc_attr($_POST['dc_contact_fax']));
                update_post_meta($post_id,'dc_areas_practice',esc_attr($_POST['dc_areas_practice']));
                update_post_meta( $post_id,'dc_image_id', $_POST['upload_image_id'] );

	}

}

/**
    * Set a more appropriate placeholder text for the New Listing title field
    */
function enter_title_here( $text, $post ) {
        if ( $post->post_type == 'onepix_listing' ) return __( 'Listing Title' );
        return $text;
}

// widgets -----------------------------------------------------------//
// -------------------------------------------------------------------//

//register our widget
function dc_register_widgets() {
	register_widget( 'dc_widget' );
}


//dc_widget class
class dc_widget extends WP_Widget {

	//process our new widget
	function dc_widget() {
		$widget_ops = array('classname' => 'dc_widget', 'description' => __('Display listings','dc-plugin') );
		parent::__construct('dc_widget', __('Listings Widget','dc-plugin'), $widget_ops);
	}
 
 	//build our widget settings form
	function form($instance) {
		$defaults = array( 'title' => __('Listings','dc-plugin'), 'number_listings' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags($instance['title']);
		$number_listings = strip_tags($instance['number_listings']);
		?>
			<p><?php _e('Title', 'dc-plugin') ?>: <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			<p><?php _e('Number of Listings', 'dc-plugin') ?>: <input name="<?php echo $this->get_field_name('number_listings'); ?>" type="text" value="<?php echo esc_attr($number_listings); ?>" size="2" maxlength="2" /></p>
		<?php
	}
 
  	//save our widget settings
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags(esc_attr($new_instance['title']));
		$instance['number_listings'] = intval($new_instance['number_listings']);
 
		return $instance;
	}
 
 	//display our widget
	function widget($args, $instance) {
		global $post;
		extract($args);
 
		echo $before_widget;
		$title = apply_filters('widget_title', $instance['title'] );
		$number_listings = empty($instance['number_listings']) ? '&nbsp;' : apply_filters('widget_number_listings', $instance['number_listings']);
 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		$dispListings = new WP_Query();
		$dispListings->query(array(
                        'post_type' => 'onepix_listing',
                        '$post_count' => $number_listings
                       ));
		while ($dispListings->have_posts()) : $dispListings->the_post(); 

			//load options Array
			$dc_options = get_option('dc_options');

			//load custom meta values
			$dc_firm_info = get_post_meta($post->ID,'dc_firm_info',true);
			
			?><p><a href="<?php the_permalink() ?>" rel="bannermark" title="<?php the_title_attribute(); ?> Firm Information"><?php the_title(); ?></a></p><?php
			
			//check if Show Info option is enabled
			If ($dc_options['show_lawfirm_info']) {
				echo '<p>' .__('Lawfirm', 'dc-plugin'). ': ' .$dc_firm_info .'</p>';
			}
			echo '<hr>';
			
		endwhile;

		echo $after_widget;
	}
}

// end widgets -----------------------------------------------------------//
// -----------------------------------------------------------------------//


//register plugin settings
function dc_register_settings() {
	//register our Array of settings
	register_setting( 'dc-settings-group', 'dc_options' );
}

//plugin settings page
function dc_settings_page() {
	//load our options Array
	$dc_options = get_option('dc_options');

	// if the show info option exists the checkbox needs to be checked
	If ($dc_options['show_lawfirm_info']) { 
		$checked = ' checked="checked" ';
	}
	
	$dc_bullet = $dc_options['$dc_bullet'];
	?>
    <div class="wrap">
    <h2><?php _e('Directory Commerce Options', 'dc-plugin') ?></h2>
    <br>
    <h3><?php _e('Premium Listings Optons', 'dc-plugin') ?></h3>
    <br>
    <form method="post" action="options.php">
        <?php settings_fields( 'dc-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row"><?php _e('Show Law Firm', 'dc-plugin') ?></th>
            <td><input type="checkbox" name="dc_options[show_lawfirm_info]" <?php echo $checked; ?> /></td>
            </tr>
            <tr valign="top">
            <th scope="row"><?php _e('Bullet Point', 'dc-plugin') ?></th>
            <td><input type="text" name="dc_options[$dc_bullet]" value="<?php echo $dc_bullet ; ?>" size="1" maxlength="1" /></td>
            </tr>
            <tr><th>Shortcodes</th></tr>
            <tr>
                <td><?php echo __('ID', 'dc-plugin') ?> : [dc show=id]</td>
            </tr>
            <tr>
            <td><?php echo __('Info', 'dc-plugin') ?> : [dc show=info]</td>
            </tr>
        </table>
        
        <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'dc-plugin') ?>" />
        </p>
    
    </form>
    </div>
<?php
}

//set up templates for the listings types
//include_once 'category-template.php';

//set up templates
include_once 'template-redirect.php';
//integrate woocommerce
include_once 'woocommerce-integration.php';
//helpers
include_once 'helper-functions.php';


?>