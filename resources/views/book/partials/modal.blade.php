<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавление новой книги</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                <span id="formResult"></span>
                <form method="post" action="{{route('books.store')}}" id="authorForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-4">Название книги : </label>
                            <div class="col-md-12">
                                <input type="text" name="name" id="name" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group authors">
                        <label class="control-label col-md-4">Авторы: </label>
                        <div class="row group-authors mb-3">
                            <div class="col-md-10">
                            <select name="authors[]" class="form-control select-author" required>
                                @forelse($authors as $author)
                                <option value="{{$author->id}}">{{$author->surname.' '.$author->name.' '.$author->patronymic}}</option>
                                    @empty
                                    <option value="">Создайте сначала авторов</option>
                                @endforelse
                            </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger remove-author">-</button>
                            </div>
                        </div>

                    </div>
                    <div class="row ">
                        <button class="btn btn-success ml-3 mb-3" id="add-author">Добавить автора</button>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12" >Краткое описание книги : </label>
                        <div class="col-md-12">
                            <textarea  name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="control-label col-md-8" >Дата издания книги : </label>
                        <div class="col-md-12">
                            <input type="date" name="publish_at" id="publish_at" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Обложка книги : </label>
                        <div class="col-md-8">
                            <input type="file" name="image" id="image" />
                            <span id="store_image"></span>
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Подтверждение</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Вы уверены что хотите удалить эту книгу?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Да</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>
