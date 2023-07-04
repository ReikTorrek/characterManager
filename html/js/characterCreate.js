$(document).ready(function () {
    $("#add_header_name").on('click', function () {
        $.ajax({
            url: '/modules/character/controller/ajax/addHeader.php',
            method: 'post',
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {
                name: $("#header_name").val(),
                color: $("#header_color").val(),
                sort: $('.block_name').length + 1,
            },
            success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                data = JSON.parse(data);
                const character = $("#character");
                character.append(
                    '<h2 class="block_name" data-id="'+data.id+'" style="color: '+data.color+'">'+data.name+'</h2>'
                );
                character.append(
                    '<div id="'+data.id+'"></div>'
                );

                const characterData = $("#"+data.id);
                characterData.append(
                    '<button type="button" class="btn btn-success mb-3 add_field" data-id = "'+data.id+'" data-bs-toggle="modal" data-bs-target="#addFieldModal">Добавить поле</button>'
                )
            }
        });
    })
    $("#create__field").on('click', function () {
        $.ajax({
            url: '/modules/character/controller/ajax/addHeader.php',
            method: 'post',
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {
                name: $("#block_name").val(),
                color: $("#block_name_color").val(),
                header_id: $(".add_field").last().data('id'),
                sort: null
            },
            success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                data = JSON.parse(data);
                $.ajax({
                    url: '/modules/character/controller/ajax/addField.php',
                    method: 'post',
                    dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                    data: {
                        field_id: data.id,
                        data: $("#block_data").val(),
                        color: $("#block_data_color").val(),
                    },
                    success: function(fieldData){   /* функция которая будет выполнена после успешного запроса.  */
                        fieldData = JSON.parse(fieldData);
                        const addFieldButton = $(".add_field[data-id="+data.header_id+"]");
                        //let characterDataId = addFieldButton.id;
                        console.log(data.header_id)
                        const characterData = $("#"+data.header_id);
                        addFieldButton.remove();
                        characterData.append(
                            '<dl id="'+data.id+'"></dl>'
                        );
                        characterData.append(
                            '<button type="button" class="btn btn-success mb-3 add_field" data-id = "'+data.header_id+'" data-bs-toggle="modal" data-bs-target="#addFieldModal">Добавить поле</button>'
                        )
                        const field = $("#"+data.id);
                        field.append(
                            '<dt style="color: '+data.color+'">'+data.name+'</dt>'
                        )
                        field.append(
                            '<dd style="color: '+fieldData.color+'">'+fieldData.data+'</dd>'
                        )
                    }
                });
            }
        });
    })

    $("#create_character").on('click', function () {
        const headers = $("h2");
        let headerIds = [];
        for (let i = 0; i < headers.length; i ++) {
            headerIds.push(headers[i].dataset.id)
        }
        console.log(headerIds);
        $.ajax({
            url: '/modules/character/controller/ajax/createCharacter.php',
            method: 'post',
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {
                name: $("#name").val(),
                headerIds: headerIds
            },
            success: function(data){   /* функция которая будет выполнена после успешного запроса.  */

            }
        });
    })
})

window.onbeforeunload = function() {
    return "Есть несохранённые изменения. Всё равно уходим?";
};