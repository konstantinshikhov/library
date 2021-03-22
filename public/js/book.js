$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#create_book').click(function () {
        $('.modal-title').text("Добавить книгу");
        $('#action_button').val("Добавить");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });

    let book_id;
    $(document).on('click', '.delete', function () {
        book_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function () {
        $.ajax({
            url: "books/" + book_id,
            type: "DELETE",
            beforeSend: function () {
                $('#ok_button').text('Удаление...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    location.reload();
                }, 2000);
            }
        })
    });

    $('#add-author').on('click', function (event) {
        event.preventDefault();
        $('.group-authors:first').clone().appendTo(".authors");
    })

    $(document).on('click', '.remove-author', function (event) {
        event.preventDefault();
        let count = $('.group-authors').length;
        if (count > 1) {
            $(this).closest('.group-authors').remove();
        }
        return;
    })

    $(document).on('submit','#authorForm', function (event) {
        event.preventDefault();
        if ($('#action').val() == 'Add') {
            $.ajax({
                url: "books/ ",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#authorForm')[0].reset();
                        location.reload();
                    }
                    $('#formResult').html(html);
                }
            })
        }


        if ($('#action').val() == 'edit') {
            let book_id = $("#book_id").val();

            $.ajax({
                url:"book/update/"+book_id,
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if (data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#authorForm')[0].reset();
                        $('#storeImage').html('');
                        location.reload();
                    }
                    $('#formResult').html(html);
                }
            });
        }
    });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $('#formResult').html('');
        $.ajax({
            url:"/books/"+id+"/edit",
            type: "GET",
            success:function(html){
                 $("#modalBody").html(html);
                 $('.modal-title').text("Редактировать");
                 $('#action_button').val("Редактировать");

                $('#formModal').modal('show');
            }
        })
    });

});
