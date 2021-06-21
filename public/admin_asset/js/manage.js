$(document).ready(function () {
    DOMAIN = 'http://bright.muktodharasoft.com/';
    fetch_category();
    function fetch_category() {
        $.ajax({
            url: DOMAIN + "categories",
            method: "GET",
            success: function (data) {
                // alert(data);
                $("#select_cat").append(data);

            }
        })
    }
});