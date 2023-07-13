$(document).ready(function () {
    $(".exportBtn").click(function () {
        let id = $(this).data('id')
        $.ajax({
            url: "/modules/character/controller/ajax/exportCharacter.php",
            method: "POST",
            data: { id: id },
            success: function(response) {

            },
            error: function(xhr, status, error) {
                // Обработка ошибки
                console.error("AJAX ошибка:", status, error);
            }
        });
    })
})