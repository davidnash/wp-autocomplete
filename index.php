<?php get_header(); ?>

<?php
    // Show any errors we get from the database. By default WP_DEBUG is set to false and hides these
    $wpdb->show_errors();

    // Get all post titles from the posts table
    $query_string = "
        SELECT post_title
        FROM $wpdb->posts
        WHERE post_status = 'publish'
    ";

    $post_objects = $wpdb->get_results($query_string, OBJECT);

    // Output this so we know what to do with the data
    echo '<pre style="white-space: pre">get_results() returns: '.print_r($post_objects, true).'</pre>';

    // Put that data in a simple array
    $post_titles = array();
    foreach ( $post_objects as $po ) {
        $post_titles[] = $po->post_title;
    }

    // Output that array so we know it's working
    echo '<pre style="white-space: pre">debug: '.print_r($post_titles, true).'</pre>';

    // And now put it into a form we can use in the input data-list below
    $post_titles_list = implode(', ', $post_titles);
?>

<p>Choose from: <?php echo $post_titles_list; ?></p>

<input class="awesomplete"
       data-list="<?php echo $post_titles_list; ?>" />

<?php get_footer(); ?>
