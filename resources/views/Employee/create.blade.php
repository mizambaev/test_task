@extends('layouts.app')

@section('title', 'Добавить сотрудника')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <h1 class="h2">Добавить сотрудника</h1>
                <form action="/employee" method="POST" id="addEmployee">
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Имя*" required>
                        <span class="error-msg error-msg-name" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" name="surname" placeholder="Фамилия*" required>
                        <span class="error-msg error-msg-surname" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" name="patronymic" placeholder="Отчество">
                        <span class="error-msg error-msg-patronymic" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <select class="form-select" name="gender" aria-label="Пол">
                            <option selected value="">Пол</option>
                            <option value="Муж">Муж</option>
                            <option value="Жен">Жен</option>
                        </select>
                        <span class="error-msg error-msg-gender" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" name="salary" placeholder="Заработная плата">
                        <span class="error-msg error-msg-salary" style="color: #721c24"></span>
                    </div>
                    <br>
                    @foreach($departments as $department)
                    <div class="form-check">
                        <input class="form-check-input" name="department_id[]" type="checkbox" value="{{ $department->id }}" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $department->title }}
                        </label>
                    </div>
                    @endforeach
                    <span class="error-msg error-msg-department_id" style="color: #721c24"></span>
                    <br>
                    <div class="input-group">
                        <input type="submit" class="btn btn-success" name="salary" placeholder="Сохранить">
                    </div>

                </form>
            </main>
        </div>
    </div>
@endsection
