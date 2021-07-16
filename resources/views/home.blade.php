@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <h1 class="h2">Сетка</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <td></td>
                        @foreach($departments as $department)
                            <th>{{ $department->title }}</th>
                        @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)

                            <tr>
                                <td>{{ $employee->name .' '. $employee->surname }}</td>
                                @foreach($departments as $department)
                                <td>
                                    @if ($employee->department->contains('id', $department->id))
                                        +
                                    @endif
                                </td>
                                @endforeach
                        </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>
@endsection
