document.addEventListener('DOMContentLoaded', function() {
    // Awesomplete AJAX demo from https://leaverou.github.io/awesomplete#ajax-example
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "https://restcountries.eu/rest/v1/lang/en", true);
    ajax.onload = function() {
        var list = JSON.parse(ajax.responseText).map(function(i) { return i.name; });
        new Awesomplete(document.getElementById("autocomplete-field"),{ list: list });
    };
    ajax.send();
});
