@extends('layouts.app')

@section('title',"Книги")

@section('content')
    <div class="container" style="max-width: 85%">
        <div class="row mb-6">
            <h3 class="text-center">Список всех книг</h3>
        </div>
        <hr>
        <form action="{{route('books.index')}}" method="GET" id="filter">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Название</label>
                    <input type="text" name="name" value="{{request()->get('name')}}">
                </div>
                <div class="col-md-4">
                    <label for="">Автор</label>
                    <input type="text" name="author" value="{{request()->get('author')}}">
                </div>
            </div>
            <div class="row mt-3 ml-2">
                <button class="btn btn-info">Фильтровать</button>
            </div>
            <hr>
        </form>
        <div align="right">
            <button type="button" name="create_book" id="create_book" class="btn btn-success btn-sm">Добавить книгу</button>
        </div>
        <br />
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                <tr>
                    <th width="10%">Рисунок</th>
                    <th width="15%">Название
                        <select name="order-by-name" form="filter" onchange="form.submit()">
                            <option value="ASC" @if(request()->get('order-by-name')=="ASC") selected @endif >А-Я</option>
                            <option value="DESC" @if(request()->get('order-by-name')=="DESC") selected @endif >Я-А</option>
                        </select>
                    </th>
                    <th width="30%">Описание</th>
                    <th width="30%">Авторы</th>
                    <th width="10%">Дата публикации</th>
                    <th width="20%">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($books as $book)
                    <tr>
                        <td><img src="{{ URL::to('/') }}/images/books/{{$book->image}} " width='70' class='img-thumbnail' />
                            {{$book->image}}</td>
                        <td>{{$book->name}}</td>
                        <td>{{$book->description}}</td>
                        <td>
                            <ul>
                            @forelse($book->authors as $author)
                                <li>{{$author->surname.' '.$author->name.' '.$author->patronymic}}</li>
                                @empty
                            @endforelse
                            </ul>
                        </td>

                        <td>{{$book->publish_at->format('d.m.Y')}}</td>
                        <td>
                            <button type="button" name="edit" id="{{$book->id}}" class="edit btn btn-primary btn-sm">Редактировать</button>
                            <button type="button" name="delete" id="{{$book->id}}" class="delete btn btn-danger btn-sm">Удалить</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Библиотека пуста</td></tr>
                @endforelse
                </tbody>

            </table>
            {{$books->links()}}
        </div>
        <br />

        <br />
    </div>

    @include('book.partials.modal', ['authors' => $authors])
@endsection

@push('scripts')
    <script src="/js/book.js"></script>
@endpush
