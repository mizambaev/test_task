<!DOCTYPE html>
<!-- saved from url=(0053)https://getbootstrap.com/docs/4.0/examples/dashboard/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>@yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
    <style type="text/css">/* Chart.js */
        @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>

<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">Test task</a>
</nav>

@include('inc.header')

@yield('content')

<!-- Bootstrap core JavaScript --
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- ajax -->
<script>
    $(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Добавление отдела \ Add department
        $('#addDepartment').on('submit', function (e){
            e.preventDefault();
            var  form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    form.find('span.error-msg').text('');
                },
                success: function (response) {
                    if(!response.success){
                        form.find('span.error-msg').text(response.errors.title);
                        form.find('span.success-msg').text(response.errors.title);
                    }else{
                        form[0].reset();
                        form.find('span.success-msg').text(response.title+ ' добавлен!');
                        let count = $(".departmentList tr").length;
                        $('.departmentList').append('<tr class="department-'+ response.id +'">'+
                                                        '<td>'+ (count + 1) +'</td>'+
                                                        '<td>'+ response.title +'</td>'+
                                                        '<td>0</td>' +
                                                        '<td></td>' +
                                                        '<td>'+
                                                            '<div class="btn btn-primary">Редактировать</div>' +
                                                            '<div class="btn btn-danger" data-id="'+ response.id +'">Удалить</div>' +
                                                        '</td>' +
                                                    '</tr>');
                    }
                }
            })
        })

        // Удаление отдела \ Delete department
        $('.deleteDepartment').on('click', function (e){
            e.preventDefault();
            var  event = $(this);
            $.ajax({
                url: '/department/'+event.data('id'),
                method: 'DELETE',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(!response.success){
                        alert(response.error_msg);
                    }else{
                        event.parent().parent().remove();
                    }
                }
            })
        })

        // Информация для редактирования отдела \ Department Editing Information
        $('.editDepartment').on('click', function (e){
            e.preventDefault();
            var  event = $(this);
            $.ajax({
                url: '/department/'+event.data('id')+'/edit',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(!response.success){
                        alert('Отдел не найден!');
                    }else{
                        $('#editModalCenter form').attr('action', '/department/'+ response.data.id);
                        $('.editD_title').val(response.data.title);

                        setTimeout(function () {
                            $('#editModalCenter').modal('show');
                        }, 500);
                    }
                }
            })
        })

        // Обновление отдела \ Update department
        $('#editDepartment').on('submit', function (e){
            e.preventDefault();
            var form = $(this);
            var title = form.find('.editD_title').val()
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    form.find('span.error-msg').text('');
                },
                success: function (response) {
                    if(!response.success){
                        form.find('span.error-msg').text(response.errors.title);
                    }else{
                        $('.department-'+ response.id+' td:nth-child(2)').text(response.title);

                        setTimeout(function () {
                            $('#editModalCenter').modal('hide');
                        }, 500);
                    }
                }
            })
        })

        // Добавление сотрудника \ Add employee
        $('#addEmployee').on('submit', function (e){
            e.preventDefault();
            var  form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    form.find('span.error-msg').text('');
                },
                success: function (response) {
                    if(!response.success){
                        $.each(response.errors, function(key, value) {
                            form.find('span.error-msg-'+key).text(value);
                        });
                    }else{
                        console.log(response);

                        setTimeout(function () {
                            window.location.replace("/employee");
                        }, 500);
                    }
                }
            })
        })

        // Обновление сотрудника \ Edit employee
        $('#editEmployee').on('submit', function (e){
            e.preventDefault();
            var  form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    form.find('span.error-msg').text('');
                },
                success: function (response) {
                    console.log(response);
                    if(!response.success){
                        $.each(response.errors, function(key, value) {
                            form.find('span.error-msg-'+key).text(value);
                        });
                    }else{
                        alert('Данные обновлены!');
                    }
                }
            })
        })

        // Удаление сотрудника \ Delete employee
        $('.deleteEmployee').on('click', function (e){
            e.preventDefault();
            var  event = $(this);
            $.ajax({
                url: '/employee/'+event.data('id'),
                method: 'DELETE',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(!response.success){
                        alert('Сотрудник не найден');
                    }else{
                        event.parent().parent().remove();
                        alert('Сотрудник удален');
                    }
                }
            })
        })
    })
</script>

</body></html>
