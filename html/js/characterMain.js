$(document).ready(function () {
    $(".block_name").click(function () {
        let blockId = $(this).data('id');
        if ($("#" + blockId).is(':visible')) {
            $("#" + blockId).hide();
        }else {
            $("#" + blockId).show();
        }
    })

    let panelVisible = false;

    $("#togglePanelBtn").click(function() {
        let panelWidth;
        if (panelVisible) {
            panelWidth = $("#myPanel").outerWidth();
            $("#togglePanelBtn").animate({ right: "-=" + panelWidth }, function() {
                $("#myPanel").removeClass("show");
            });
            $("#togglePanelBtn").text('<')
        } else {
            $("#myPanel").addClass("show");
            panelWidth = $("#myPanel").outerWidth();
            $("#togglePanelBtn").animate({ right: "+=" + panelWidth });
            $("#togglePanelBtn").text('>')
        }

        panelVisible = !panelVisible;
    });
})