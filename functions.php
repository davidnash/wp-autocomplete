<?php
function add_theme_scripts() {
    wp_enqueue_style('awesomepletecss', get_template_directory_uri() . '/awesomplete/awesomplete.css');
    wp_enqueue_script('awesompletejs', get_template_directory_uri() . '/awesomplete/awesomplete.js');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/wp-autocomplete.js', ['awesompletejs'] );

    // Allows us to output the ajax_url path for our script
    wp_localize_script('theme-js', 'wp_autocomplete', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function get_autocomplete() {
    if ( isset($_POST['user_input']) ) {
        $list = array( 'aa first item', 'aa second item', 'aa third item', 'aa fourth item' );
        echo json_encode( $list );
    }

    die(); // Stop WordPress from outputting 0
}
add_action('wp_ajax_autocomplete_data', 'get_autocomplete');
add_action('wp_ajax_nopriv_autocomplete_data', 'get_autocomplete');
