<?php

function custom_file_upload2() {
    print_r('test works!');
    
    
    if( empty( $_FILES ) ) {
    global $pagenow;
    $url = admin_url( $pagenow );
    ?>
    <!-- The data encoding type, enctype, MUST be specified as below -->
    <form enctype="multipart/form-data" action="<?php echo $url; ?>" method="POST">
        <!-- MAX_FILE_SIZE must precede the file input field -->
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <!-- Name of input element determines name in $_FILES array -->
        Send this file: <input name="userfile" type="file" />
        <input type="submit" value="Send File" />
    </form>
    <?php
    } else {
        $imageupload = new File_Upload();
        $attachment_id = $imageupload->create_attachment();
        var_dump( $attachment_id );
    }
    
    
    
    
    class File_Upload {

        /**
         * Index key from upload form
         * @var string
         */
        public $index_key = '';

        /**
         * Copy of superglobal array $_FILES
         * @var array
         */
        public $files = array();

        /**
         * Constructor
         * Setup files array and guess index key
         */
        public function __construct() {

            if (isset($_FILES) && !empty($_FILES)) {
                $this->files = $_FILES;
                $this->guess_index_key();
            }
        }

        /**
         * Set/overwrites the index key
         * Converts $name with type casting (string)
         *
         * @param   string  $name   Name of the index key
         * @return  string  ::name  Name of the stored index key
         */
        public function set_field_name_for_file($name = '') {
            $this->index_key = (!empty($name) ) ? (string) $name : '';
            return $this->index_key;
        }

        /**
         * Converts uploaded file into WordPress attachment
         *
         * @return  boolean     Whether if the attachment was created (true) or not (false)
         */
        public function create_attachment() {

            // move the uploaded file from temp folder and create basic data
            $imagedata = $this->handle_uploaded_file();

            // if moving fails, stop here
            /*
             * For Production
             * Set and return an error object with WP_Error()
             */
            if (empty($imagedata))
                return false;

            /*
             * For Production
             * Check if $imagedata contains the expected (and needed)
             * values. Every method could fail and return malicious data!!
             */
            $filename = $imagedata['filename'];

            // create the attachment data array
            $attachment = array(
                'guid' => $imagedata['url'] . '/' . $filename,
                'post_mime_type' => $imagedata['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // insert attachment (posttype attachment)
            $attach_id = wp_insert_attachment($attachment, $filename);

            // you must first include the image.php file
            // for the function wp_generate_attachment_metadata() to work
            require_once( ABSPATH . 'wp-admin/includes/image.php' );

            /*
             * For Production
             * Check $attach_data, wp_generate_attachment_metadata() could fail
             * Check if wp_update_attachment_metadata() fails (returns false),
             * return an error object with WP_Error()
             */
            $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
            wp_update_attachment_metadata($attach_id, $attach_data);

            return $attach_id;
        }

        /**
         * Handles the upload
         *
         * @return  array   $return_data    Array with informations about the uploaded file
         */
        protected function handle_uploaded_file() {

            // get the basic data
            $return_data = wp_upload_dir();

            // get temporary filepath and filename from $_FILES ($this->files)
            $tmp_file = ( isset($this->files[$this->index_key]) && !empty($this->files[$this->index_key]) ) ?
                    (string) $this->files[$this->index_key]['tmp_name'] : '';

            $tmp_name = ( isset($this->files[$this->index_key]) && !empty($this->files[$this->index_key]) ) ?
                    (string) $this->files[$this->index_key]['name'] : '';

            // stop if something went wrong
            if (empty($tmp_file))
                return false;

            // set filepath
            $filepath = $return_data['filepath'] = $return_data['path'] . '/' . basename($tmp_name);

            // move uploaded file from temp dir to upload dir
            move_uploaded_file($tmp_file, $filepath);

            // set filename
            $filename = $return_data['filename'] = basename($filepath);

            // set filetype
            /*
             * For Production
             * You should really, really check the file extension and filetype on 
             * EVERY upload. If you do not, it is possible to upload EVERY kind of 
             * file including malicious code.
             */
            $type = wp_check_filetype($filename, null);
            $return_data['file_ext'] = ( isset($type['ext']) && !empty($type['ext']) ) ?
                    $type['ext'] : '';

            $return_data['type'] = ( isset($type['type']) && !empty($type['type']) ) ?
                    $type['type'] : '';

            // return the results
            return $return_data;
        }

        /**
         * Try to fetch the first index from $_FILES
         *
         * @return  boolean     Whether if a key was found or not
         */
        protected function guess_index_key() {

            $keys = array_keys($_FILES);

            if (!empty($keys)) {
                $this->index_key = $keys[0];
                return true;
            }

            return false;
        }

    }
    

}
?>
