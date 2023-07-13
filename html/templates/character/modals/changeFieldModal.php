<div class="modal fade" id="changeFieldModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Изменить поле</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="block_name" class="form-label">Название поля</label>
                        <input type="text" class="form-control" id="block_name">
                    </div>
                    <div class="mb-3">
                        <label for="block_name_color">Цвет текста поля</label>
                        <input type="color" id="block_name_color" name="block_name_color" value="#e66465">
                    </div>
                    <div class="mb-3">
                        <label for="block_data" class="form-label">значение поля</label>
                        <input type="text" class="form-control" id="block_data">
                    </div>
                    <div class="mb-3">
                        <label for="block_data_color">Цвет текста значения поля</label>
                        <input type="color" id="block_data_color" name="block_data_color" value="black">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="change_field">Изменить</button>
            </div>
        </div>
    </div>
</div>
<?php
