document.addEventListener('DOMContentLoaded', function() {
    console.log('wp-autocomplete.js loaded!');

    // Select the <input id="autocomplete-field" /> element in our index.php:
    var autocomplete_field = document.getElementById('autocomplete-field');

    // Basic Awesomplete demo
    new Awesomplete( autocomplete_field, {
        list: ["Ada", "Java", "JavaScript", "Node.js", "PHP", "Perl", "Python", "Ruby on Rails"]
    });
});
