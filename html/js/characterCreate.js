$(document).ready(function () {
    $("#character").on('click', '.add_field', function () {
        let dataId = $(this).data('id');
        $("#create__field").removeAttr('data-id');
        $("#create__field").data('id', dataId);
    })

    $("#character").on('click', '.add_field_child', function () {
        let dataId = $(this).data('id');
        $("#create__field_child").removeAttr('data-id');
        $("#create__field_child").data('id', dataId);
    })

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
                let character = $("#character");
                character.append(
                    '<h2 class="block_name" data-id="'+data.id+'" style="color: '+data.color+'">'+data.name+'</h2>'
                );
                character.append(
                    '<div id="'+data.id+'"></div>'
                );

                let characterData = $("#"+data.id);
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
                header_id: $("#create__field").data('id'),
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
                        let addFieldButton = $(".add_field[data-id="+data.header_id+"]");
                        let characterData = $("#"+data.header_id);
                        addFieldButton.remove();
                        characterData.append(
                            '<div id="'+data.id+'"></div>'
                        );
                        characterData.append(
                            '<button type="button" class="btn btn-success mb-3 add_field_child mr-2" data-id = "'+data.id+'" data-bs-toggle="modal" data-bs-target="#addFieldChildModal">Добавить подполе</button>'
                        )
                        characterData.append(
                            '<button type="button" class="btn btn-success mb-3 add_field" data-id = "'+data.header_id+'" data-bs-toggle="modal" data-bs-target="#addFieldModal">Добавить поле</button>'
                        )
                        let field = $("#"+data.id);
                        field.append(
                            '<span style="color: '+data.color+'">'+data.name+'</span>: '
                        )
                        field.append(
                            '<span style="color: '+fieldData.color+'">'+fieldData.data+'</span>'
                        )
                    }
                });
            }
        });
    })
    
    $("#create__field_child").click(function () {
        $.ajax({
            url: '/modules/character/controller/ajax/addHeader.php',
            method: 'post',
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: {
                name: $("#block_child_name").val(),
                color: $("#block_child_name_color").val(),
                header_id: $("#create__field_child").data('id'),
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
                        data: $("#block_child_data").val(),
                        color: $("#block_child_data_color").val(),
                    },
                    success: function(fieldData){   /* функция которая будет выполнена после успешного запроса.  */
                        fieldData = JSON.parse(fieldData);
                        let addFieldButton = $(".add_field_child[data-id="+data.header_id+"]");
                        let characterData = $("#"+data.header_id);
                        addFieldButton.remove();
                        characterData.append(
                            '<div id="'+data.id+'" class="ml-3"></div>'
                        );
                        characterData.append(
                            '<button type="button" class="btn btn-success mb-3 add_field_child mr-2" data-id = "'+data.header_id+'" data-bs-toggle="modal" data-bs-target="#addFieldChildModal">Добавить подполе</button>'
                        )
                        let field = $("#"+data.id);
                        field.append(
                            '<span style="color: '+data.color+'">'+data.name+'</span>: '
                        )
                        field.append(
                            '<span style="color: '+fieldData.color+'">'+fieldData.data+'</span>'
                        )
                    }
                });
            }
        });
    })

    $("#create_character").on('click', function () {
        let headers = $("h2");
        let headerIds = [];
        for (let i = 0; i < headers.length; i ++) {
            headerIds.push(headers[i].dataset.id)
        }
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

/*window.onbeforeunload = function() {
    return "Есть несохранённые изменения. Всё равно уходим?";
};*/

$("#unset_character").on('click', function () {
    let headers = $("h2");
    let headerIds = [];
    for (let i = 0; i < headers.length; i ++) {
        headerIds.push(headers[i].dataset.id)
    }
    $.ajax({
        url: '/modules/character/controller/ajax/unsetCharacter.php',
        method: 'post',
        dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
        data: {
            headerIds: headerIds
        },
        success: function () {
            $("#character").empty();
        }
    });
})

window.addEventListener("unload", function() {
    let headers = $("h2");
    let headerIds = [];
    for (let i = 0; i < headers.length; i ++) {
        headerIds.push(headers[i].dataset.id)
    }
    $.ajax({
        url: '/modules/character/controller/ajax/unsetCharacter.php',
        method: 'post',
        dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
        data: {
            headerIds: headerIds
        },
    });
});