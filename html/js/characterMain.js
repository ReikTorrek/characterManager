$(document).ready(function () {
    $("#myPanel").animate({right: '-300px'})
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
            $("#myPanel").animate({right: '-300px'})
            $("#togglePanelBtn").text('<')
        } else {
            $("#myPanel").addClass("show");
            panelWidth = $("#myPanel").outerWidth();
            $("#togglePanelBtn").animate({ right: "+=" + panelWidth });
            $("#myPanel").animate({right: '+1px'})
            $("#togglePanelBtn").text('>')
        }

        panelVisible = !panelVisible;
    });

    $(".dice-icon span").click(function() {
        let selectedDice = $(this).text();
        $.ajax({
            url: "/modules/diceRoller/controller/ajax/rollDice.php",
            method: "POST",
            data: { dice: selectedDice },
            success: function(response) {
                $(".dice-icon[data-dice="+ selectedDice +"]").append("<p>" + response + "</p>")
                let currSumm = parseInt($("#dice-summ-" + selectedDice).text());
                currSumm += parseInt(response);
                $("#dice-summ-" + selectedDice).text(currSumm)
                // Обработка успешного ответа от сервера
            },
            error: function(xhr, status, error) {
                // Обработка ошибки
                console.error("AJAX ошибка:", status, error);
            }
        });
    });
    $("#clearBtn").click(function () {
        $(".dice-icons .dice-icon").find("p").remove()
        $(".dice-icons .dice-icon").find("div").text(0)
    })
    let holdTimer;
    let holdDelay = 500
    $('.field span').on('mousedown touchstart', function () {
        let value = $(this).text();
        let spanData = $(this);
        holdTimer = setTimeout(function () {
            let spanClass = spanData.attr('class')
            let spanColor = spanData.css('color')
            spanData.replaceWith('<div class="input-group mb-3 w-25">\n' +
                '  <input type="text" class="form-control" id="changer" ">\n' +
                '  <div class="input-group-append">\n' +
                '    <button class="btn btn-outline-secondary" id="save" type="button">Сохранить</button>\n' +
                '  </div>\n' +
                '</div>')
            let changer = $("#changer")
            changer.val(value)
        }, holdDelay)
    }).on('mouseup touchend', function () {
        clearTimeout(holdTimer)
    })
    $("#save").click(function () {
        alert('bum!')
    })
})