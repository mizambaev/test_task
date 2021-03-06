@extends('layouts.app')

@section('title', 'Сотрудники')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <h1 class="h2">Сотрудники</h1>
                <a href="/employee/create" class="btn btn-primary" style="float: right">Добавить сотрудника</a>
                <br>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Отчество</th>
                            <th>Пол</th>
                            <th>Заработная плата</th>
                            <th>Отделы</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $key => $employee)
                            <tr class="department-{{ $employee->id }}">
                                <td>{{ ++$key }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->surname }}</td>
                                <td>{{ $employee->patronymic }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->salary }}</td>
                                <td>{{ $employee->department->implode('title', ', ') }}</td>
                                <td>
                                    <a href="/employee/{{ $employee->id }}/edit" class="btn btn-primary">Редактировать</a>
                                    <div class="btn btn-danger deleteEmployee" data-id="{{ $employee->id }}">Удалить</div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>
@endsection
