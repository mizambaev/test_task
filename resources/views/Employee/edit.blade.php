@extends('layouts.app')

@section('title', 'Добавить сотрудника')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <h1 class="h2">Добавить сотрудника</h1>
                <form action="/employee/{{$employee->id}}" method="POST" id="editEmployee">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$employee->name}}" name="name" placeholder="Имя*" required>
                        <span class="error-msg error-msg-name" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$employee->surname}}" name="surname" placeholder="Фамилия*" required>
                        <span class="error-msg error-msg-surname" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$employee->patronymic}}" name="patronymic" placeholder="Отчество">
                        <span class="error-msg error-msg-patronymic" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <select class="form-select" name="gender" aria-label="Пол">
                            <option @if($employee->gender == '') selected @endif value="">Пол</option>
                            <option @if($employee->gender == 'Муж') selected @endif value="Муж">Муж</option>
                            <option @if($employee->gender == 'Жен') selected @endif value="Жен">Жен</option>
                        </select>
                        <span class="error-msg error-msg-gender" style="color: #721c24"></span>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$employee->salary}}" name="salary" placeholder="Заработная плата">
                        <span class="error-msg error-msg-salary" style="color: #721c24"></span>
                    </div>
                    <br>
                    @foreach($departments as $department)
                        <div class="form-check">
                            <?php $i = false;?>
                            @foreach($employee->department as $item)
                                @if($item->id == $department->id)
                                    <?php $i = true;?>
                                @endif
                            @endforeach
                            <input @if($i) checked @endif class="form-check-input" name="department_id[]" type="checkbox"  value="{{ $department->id }}" id="flexCheckDefault" @if($i) checked @endif>

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
