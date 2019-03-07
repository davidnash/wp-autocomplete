<?php
function add_theme_scripts() {
    wp_enqueue_style('awesomepletecss', get_template_directory_uri() . '/awesomplete/awesomplete.css');
    wp_enqueue_script('awesompletejs', get_template_directory_uri() . '/awesomplete/awesomplete.js');
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');
