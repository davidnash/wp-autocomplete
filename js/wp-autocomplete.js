document.addEventListener('DOMContentLoaded', function() {
    // Make sure we're getting the variable/URL from wp_localize_script in functions.php
    console.log( 'ajax_url: ' + wp_autocomplete.ajax_url );

    var ajax = new XMLHttpRequest();

    // Open our autocomplete URL
    ajax.open("POST", wp_autocomplete.ajax_url);  // From functions.php and wp_localize_script()

    // Tell it what sort of data we're sending
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Create some sample "input"
    var user_input = encodeURI('this is a test');

    // And send it
    ajax.send('action=autocomplete_data&user_input=' + user_input);

    // Output whatever we get back from the AJAX request
    ajax.onload = function() {
        console.log(ajax.responseText);
    }
});
