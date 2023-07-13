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
    let holdDelay = 250
    $('.field').on('mousedown touchstart', '.field_value', function () {
        let value = $(this).text();
        let spanData = $(this);
        let spanClass = spanData.attr('class');
        let spanColor = spanData.css('color');
        let spanId = spanData.data('id');

        let holdTimer;

        let inputField = $('<input>', {
            type: 'text',
            class: 'form-control small-input',
            value: value
        });

        inputField.addClass(spanClass);
        inputField.css('color', spanColor);

        holdTimer = setTimeout(function () {
            spanData.replaceWith(inputField);
            inputField.focus();
        }, holdDelay);

        inputField.on('focusout', function () {
            let inputValue = inputField.val();
            let spanField = $('<span>', {
                text: inputValue,
                class: spanClass,
                'data-id': spanId
            });

            spanField.css('color', spanColor);
            inputField.replaceWith(spanField);

            $.ajax({
                url: "/modules/character/controller/ajax/updateCustomFieldData.php",
                method: "POST",
                data: {
                    value: inputValue,
                    field_id: spanId
                },
                success: function(response) {
                    // Обработка успешного ответа от сервера
                },
                error: function(xhr, status, error) {
                    // Обработка ошибки
                    console.error("AJAX ошибка:", status, error);
                }
            });
        });

        $(document).on('mouseup touchend', function () {
            clearTimeout(holdTimer);
        });
    });

    $('.field').on('focusout', '.field_value input', function () {
        let inputValue = $(this).val();
        let spanData = $(this).parent();
        let spanClass = spanData.attr('class');
        let spanColor = spanData.css('color');
        let spanId = spanData.data('id');

        let spanField = $('<span>', {
            text: inputValue,
            class: spanClass,
            'data-id': spanId
        });

        spanField.css('color', spanColor);
        $(this).replaceWith(spanField);
    });

    $('.field_name').on('mousedown touchstart', function () {
        let value = $(this).text();
        let spanData = $(this);
        let spanClass = spanData.attr('class');
        let spanColor = spanData.css('color');
        let spanId = spanData.data('id');
        let spanDataValue = $('.field .field_value[data-id='+spanId+']').text();
        let spanDataColor = $('.field .field_value[data-id='+spanId+']').css('color');

        $("#block_name").val(value)
        $("#block_name_color").val(rgbToHex(spanColor))
        $("#block_data").val(spanDataValue)
        $("#block_data_color").val(rgbToHex(spanDataColor))
        $("#change_field").data('id', spanId)
        $("#change_field").data('header', spanData.data('header'))

        holdTimer = setTimeout(function () {
            // Открываем модальное окно
            $('#changeFieldModal').modal('show');
        }, holdDelay);
    }).on('mouseup touchend', function () {
        clearTimeout(holdTimer);
    });

    $("#change_field").click(function () {
        $.ajax({
            url: "/modules/character/controller/ajax/updateHeader.php",
            method: 'post',
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {
                id: $("#change_field").data('id'),
                header_id: $("#change_field").data('header'),
                name: $("#block_name").val(),
                color: $("#block_name_color").val(),
            },
            success: function(response) {
                response = JSON.parse(response);
                $('.field_name[data-id='+response.id+']').text(response.name)
                $('.field_name[data-id='+response.id+']').css('color', response.color)
            },
            error: function(xhr, status, error) {
                // Обработка ошибки
                console.error("AJAX ошибка:", status, error);
            }
        });

        $.ajax({
            url: "/modules/character/controller/ajax/updateAllFieldData.php",
            method: 'post',
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {
                field_id: $("#change_field").data('id'),
                data: $("#block_data").val(),
                color: $("#block_data_color").val(),
            },
            success: function(response) {
                response = JSON.parse(response);
                $('.field_value[data-id='+response.field_id+']').text(response.data)
                $('.field_value[data-id='+response.field_id+']').css('color', response.color)
            },
            error: function(xhr, status, error) {
                // Обработка ошибки
                console.error("AJAX ошибка:", status, error);
            }
        });
    })
})

function rgbToHex(rgb) {
    // Удаляем пробелы и разделительные символы
    rgb = rgb.replace(/\s/g, '');

    // Получаем значения красного, зеленого и синего цветов
    var r = parseInt(rgb.slice(4, 7));
    var g = parseInt(rgb.slice(9, 12));
    var b = parseInt(rgb.slice(14, 17));

    // Конвертируем значения в шестнадцатеричную запись
    var hex = '#' + ((r << 16) | (g << 8) | b).toString(16).padStart(6, '0');

    return hex;
}