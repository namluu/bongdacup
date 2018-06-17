jQuery(document).ready(function($) {
    var $auto_url = $("#auto_url"),
        $url = $("#url");

    $auto_url.change(function() {
        if (this.checked) {
            $url.prop("readonly", true);
        } else {
            $url.prop("readonly", false);
        }
    });
});