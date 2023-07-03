$(document).ready(function () {
    $(".block_name").click(function () {
        let blockId = $(this).data('id');
        if ($("#" + blockId).is(':visible')) {
            $("#" + blockId).hide();
        }else {
            $("#" + blockId).show();
        }
    })
})