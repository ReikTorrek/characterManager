$(document).ready(function () {
    $(".clearBtn").click(function () {
        let id = $(this).data('id')
        $.ajax({
            url: "/modules/character/controller/ajax/deleteCharacter.php",
            method: "POST",
            data: { characterId: id },
            success: function(response) {
                $("#" + id).remove();
            },
            error: function(xhr, status, error) {
                // Обработка ошибки
                console.error("AJAX ошибка:", status, error);
            }
        });
    })
})