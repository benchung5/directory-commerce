<?php

if (function_exists('register_uninstall_hook'))
    register_uninstall_hook(__FILE__, dc_uninstall_hook);

function dc_uninstall_hook()
{
    delete_option('dc_options_arr');
    
    //remove any additional options and custom tables;
    
}

?>
