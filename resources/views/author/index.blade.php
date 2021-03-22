@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mb-6">
            <h3 class="text-center">Список всех авторов</h3>
        </div>
        <div class="row justify-content-center">

            <div class="col-md-12">
                <p class="text-right">
                    <a href="javascript:void(0)" class="btn btn-success" id="createNewCompany">Добавить автора</a>
                </p>
                <div class="card">

                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Отчество</th>
                            <th width="200px">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    @include('author.partials.modal')
@endsection

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="/js/author.js"></script>

@endpush
