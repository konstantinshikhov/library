<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="authorCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="authordata">
                    @csrf
                    <div class="alert alert-danger " id="modal-errors" style="display: none;">

                    </div>
                    <input type="hidden" id="author_id" name="author_id" value="">
                    <div class="form-group">
                        <label for="name">Имя<sup>*</sup></label>
                        <input type="text" id="name" class="form-control" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="surname">Фамилия<sup>*</sup></label>
                        <input type="text" class="form-control" id="surname" name="surname" value="">
                    </div>
                    <div class="form-group">
                        <label for="patronymic">Отчество</label>
                        <input type="text" id="patronymic" class="form-control" name="patronymic" value="">
                    </div>
                    <br>

                    <input type="submit" value="Отправить" id="submit" class="btn btn-info float-right"
                           style="font-size: 0.8em;">

                </form>
            </div>

        </div>
    </div>
</div>
