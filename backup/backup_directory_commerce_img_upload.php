<?php

//handle attaching an image
function set_image($type, $post) {
    
    //image information meta box---------------------------------------------------------------------------
        
        global $post;
        
        $image_src = '';

        $image_id = get_post_meta( $post->ID, '_image_id', true );
        $image_src = wp_get_attachment_url( $image_id );

        ?>
       <div class="image-uploader">
        <img id="<?php echo $type; ?>_image" src="<?php echo $image_src ?>" style="max-width:100%;" />
        <input type="hidden" name="upload_<?php echo $type; ?>_image_id" id="upload_<?php echo $type; ?>_image_id" value="<?php echo $image_id . $type; ?>" />
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
                //var image_type = $('#upload_image_type').val();
                
                //alert(image_type);
                
                $('#set-' + image_type + '-image').click(function(){

                        // replace the default send_to_editor handler function with our own
                        window.send_to_editor = window.attach_image;
                        tb_show('', 'media-upload.php?post_id=<?php echo $post->ID ?>&amp;type=image&amp;TB_iframe=true');

                        return false;
                });

                $('#remove-' + image_type + '-image').click(function() {

                        $('#upload_' + image_type + 'image_id').val('');
                        $('#' + image_type + '_image').attr('src', '');
                        $(this).hide();

                        return false;
                });

                // handler function which is invoked after the user selects an image from the gallery popup.
                // this function displays the image and sets the id so it can be persisted to the post meta
                window.attach_image = function(html) {
                        
                        
                        alert(this.parents("#image-uploader"));

                        // turn the returned image html into a hidden image element so we can easily pull the relevant attributes we need
                        $('body').append('<div id="temp_image">' + html + '</div>');
                        
                        //find temp image
                        var img = $('#temp_image').find('img');
                        
                        //process temp image attributes
                        imgurl   = img.attr('src');
                        imgclass = img.attr('class');
                        imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);

                        //set hidden field with ID for persisting
                        $('#upload_' + image_type + '_image_id').val(imgid);
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
?>
