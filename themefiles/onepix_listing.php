<?php
/*
 */ //this is the template for the entire onepix_listing post type
    // from here it decides if the page is accessed by country, or if it's a single basic 
    // or premium listing 
    // calling the header.php
    get_header();
     
?>


<?php 


// If single country page
if ( isset( $_GET['country'] )) {

        //get our countries template
        include_once( __DIR__.'/country-template-part.php');

}
// If single state page
elseif ( isset( $_GET['state'] )) {

        //get our cities template
        include_once( __DIR__.'/state-template-part.php');

}
// If single country page
elseif ( isset( $_GET['city'] )) {

        //get our cities template
        include_once( __DIR__.'/city-template-part.php');

}
// below are not ineffect but optional
elseif( has_term( 'premium', 'listing_type' ) ) {
        //get our countries template
        include_once( __DIR__.'/premium-template-part.php');
} 
elseif( has_term( 'basic', 'listing_type' ) ) {
echo 'Single basic listing';
} 
else {
echo 'this is not a listing type';
} ?>

<!-- #container -->

<?php 
    // calling footer.php
    get_footer();
?>
