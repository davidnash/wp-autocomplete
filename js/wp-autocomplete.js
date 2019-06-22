document.addEventListener('DOMContentLoaded', function() {
    var ajax = new XMLHttpRequest();
    const min_letters = 2;  // how many letters before we start doing AJAX requests
    var autocomplete_field = document.getElementById('autocomplete-field');
    var awesomeplete_field = new Awesomplete(autocomplete_field);

    // When the user presses and releases a key, get the input value
    autocomplete_field.addEventListener('keyup', function() {
        var user_input = this.value;  // Use another variable for developer clarity

        // If there's enough letters in the field
        if ( user_input.length >= min_letters ) {
            // Do the AJAX request
            ajax.open("POST", wp_autocomplete.ajax_url);
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send('action=autocomplete_data&user_input=' + user_input );
        }
    });

    // When we get a response from AJAX
    ajax.onload = function() {
        var json_list = JSON.parse(ajax.responseText);  // Parse the JSON from functions.php
        awesomeplete_field.list = json_list;  // Update the Awesomplete list
        awesomeplete_field.evaluate();  // And tell Awesomplete that we've done so
    };
});
