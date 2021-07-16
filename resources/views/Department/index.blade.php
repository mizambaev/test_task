@extends('layouts.app')

@section('title', 'Отдел')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModalCenter" style="float:right;">
                    Добавить отдел
                </button>
                <h1 class="h2">Отделы</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Кол-во сотрудников</th>
                            <th>Максимальная з/п</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody class="departmentList">
                        @foreach($departments as $key => $department)
                        <tr class="department-{{ $department->id }}">
                            <td>{{ ++$key }}</td>
                            <td>{{ $department->title }}</td>
                            <td>{{ $department->employee_count }}</td>
                            <td>{{ $department->employee_max_salary }}</td>
                            <td>
                                <div class="btn btn-primary editDepartment" data-id="{{ $department->id }}">Редактировать</div>
                                <div class="btn btn-danger deleteDepartment" data-id="{{ $department->id }}">Удалить</div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

    <!-- Modal ADD -->
    <div class="modal fade" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Добавить отдел</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/department" method="POST" id="addDepartment">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="title" placeholder="Наименование отдела" required>
                        </div>
                        <br>
                        <span class="error-msg" style="color: #721c24"></span>
                        <span class="success-msg" style="color: #155724"></span>
                        <br>
                        <input type="submit" class="btn btn-success" style="float: right" value="Добавить">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT -->
    <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Редактирование отдела</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="editDepartment">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="input-group">
                            <input type="text" class="form-control editD_title" name="title" placeholder="Наименование отдела" required>
                        </div>
                        <br>
                        <span class="error-msg" style="color: #721c24"></span>
                        <span class="success-msg" style="color: #155724"></span>
                        <br>
                        <input type="submit" class="btn btn-success" style="float: right" value="Обновить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
