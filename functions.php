<?php
function add_theme_scripts() {
    wp_enqueue_style('awesompletecss', get_template_directory_uri() . '/awesomplete/awesomplete.css');
    wp_enqueue_script('awesompletejs', get_template_directory_uri() . '/awesomplete/awesomplete.js');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/wp-autocomplete.js', ['awesompletejs'] );

    // Allows us to output the ajax_url path for our script
    wp_localize_script('theme-js', 'wp_autocomplete', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function get_autocomplete() {
    global $wpdb; // WordPress's database object

    if ( isset($_POST['user_input']) ) {
        $input = $wpdb->esc_like(stripslashes($_POST['user_input']));

        // Match strings that start with what user typed:
        $input_starts_with = $input . '%';

        // Or perhaps match strings that end with what the user typed:
        $input_ends_with = '%' . $input;

        // Or match if the user's input is anywhere in the string
        $input_contains = '%' . $input . '%';

        // Get the post title and the slug (ie post_name, gotta love WordPress!)
        $sql = "select ID, post_title
            from $wpdb->posts
            where post_title like %s
            and post_status='publish'";

        $sql = $wpdb->prepare($sql, $input_contains);  // Replaces the %s in $sql with $input_contains
        $results = $wpdb->get_results($sql);  // Get the rows from the database

        // Build an array of matching post URLs and titles
        $post_data = array();
        foreach ($results as $r) {
            $post_data[] = array(
                'value' => get_permalink($r->ID),  // Note: This is another database call
                'label' => addslashes($r->post_title),
            );
        }

        echo json_encode($post_data);
    }

    die(); // Stop WordPress from outputting 0
}
add_action('wp_ajax_autocomplete_data', 'get_autocomplete');
add_action('wp_ajax_nopriv_autocomplete_data', 'get_autocomplete');
