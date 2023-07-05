<!-- Модальное окно -->
<div class="modal fade" id="addHeaderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="header_name" class="form-label">Название заголовка</label>
                        <input type="text" class="form-control" id="header_name">
                    </div>
                    <div class="mb-3">
                        <label for="header_color">Цвет текста заголовка</label>
                        <input type="color" id="header_color" name="header_color" value="#e66465">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="add_header_name">Добавить</button>
            </div>
        </div>
    </div>
</div>