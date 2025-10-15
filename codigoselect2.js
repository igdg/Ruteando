var $el = $("#input-id"), // your input id for the HTML select input
    settings = $el.attr('data-krajee-select2');
settings = window[settings];
// reinitialize plugin
$el.select2(settings);