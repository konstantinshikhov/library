$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:'/authors',
            type:'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'surname', name: 'surname'},
            {data: 'patronymic', name: 'patronymic',orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    $("body").on("click","#createNewCompany",function(e){

        e.preventDefault;
        $('#authorCrudModal').html("Создать автора");
        $('#submit').val("Создать автора");
        $('#modal-id').modal('show');
        $('#author_id').val('');
        $('#authordata').trigger("reset");

    });

    $('body').on('click', '#submit', function (event) {
        event.preventDefault()
        var id = $("#author_id").val();
        var name = $("#name").val();
        var surname = $("#surname").val();
        var patronymic = $('#patronymic').val();

        $.ajax({
            url: 'authors',
            type: "POST",
            data: {
                id: id,
                name: name,
                surname: surname,
                patronymic:patronymic,
            },
            dataType: 'json',
            success: function (data) {

                $('#authordata').trigger("reset");
                $('#modal-id').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 1500
                })

                table.draw();
            },
            error: function (data) {
                let response = JSON.parse(data.responseText);
                var errorString = '<ul>';
                $.each( response.errors, function( key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';
                $('#modal-errors').show();
                $('#modal-errors').html(errorString);
                console.log('Error......',data);
            }
        });
    });

    $('body').on('click', '.deleteAuthor', function () {

        var author_id = $(this).data("id");
        if (author_id > 0) {
            confirm("Вы уверены что хотите удалить этого автора !");

            $.ajax({
                type: "DELETE",
                url: 'authors/'+author_id,
                success: function (data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'danger',
                        title: 'Danger',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

    });

    $('body').on('click', '.editAuthor', function (event) {
        event.preventDefault();
        var id = $(this).data('id');

        $.get('authors/'+ id+'/edit', function (data) {
            $('#authorCrudModal').html("Редактирование автора");
            $('#submit').val("Сохранить");
            $('#modal-id').modal('show');
            $('#author_id').val(data.id);
            $('#name').val(data.name);
            $('#surname').val(data.surname);
            $('#patronymic').val(data.patronymic)
        })
    });
})
