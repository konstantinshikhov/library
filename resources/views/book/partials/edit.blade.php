<span id="formResult"></span>
<form method="post"  id="authorForm" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="book_id" id="book_id" value="{{$book->id}}" />
    <input type="hidden"  id="action" value="edit" />
    <div class="form-group">
        <div class="row">
            <label class="control-label col-md-4">Название книги : </label>
            <div class="col-md-12">
                <input type="text" name="name" id="name" class="form-control" value="{{$book->name}}" />
            </div>
        </div>
    </div>
    <div class="form-group authors">
        <label class="control-label col-md-4">Авторы: </label>
        @foreach ($book->authors as $item)

        <div class="row group-authors mb-3">
            <div class="col-md-10">
                <select name="authors[]" class="form-control select-author" required>
                    @forelse($authors as $author)
                        <option value="{{$author->id}}" @if($author->id ==$item->id ) selected @endif>{{$author->surname.' '.$author->name.' '.$author->patronymic}}</option>
                    @empty
                        <option value="">Создайте сначала авторов</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger remove-author">-</button>
            </div>
        </div>

        @endforeach
    </div>
    <div class="row ">
        <button class="btn btn-success ml-3 mb-3" id="add-author">Добавить автора</button>
    </div>
    <div class="form-group">
        <label class="control-label col-md-12" >Краткое описание книги : </label>
        <div class="col-md-12">
            <textarea  name="description" id="description" class="form-control" >{{$book->description}}</textarea>
        </div>
    </div>
    <div class="form-group">

        <label class="control-label col-md-8" >Дата издания книги : </label>
        <div class="col-md-12">
            <input type="date" name="publish_at" id="publish_at" value="{{$book->publish_at->format('Y-m-d')}}" class="form-control" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4">Обложка книги : </label>
        <div class="col-md-8">
            <img src="{{ URL::to('/') }}/images/books/{{$book->image}} " width='70' class='img-thumbnail' />
            <input type="file" name="image" id="image" />
            <span id="storeImage"></span>
        </div>
    </div>
    <br />
    <div class="form-group" align="center">
        <input type="submit"  id="actionButton" class="btn btn-warning" value="Редактировать" />
    </div>
</form>

