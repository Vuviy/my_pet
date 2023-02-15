

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <a href="{{route('salary.create')}}" class="btn btn-success">Add</a>
    </div>

@stop

@section('content')
    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.js')}}"></script>


    {{-- Setup data for datatables --}}

    {{-- Minimal example / fill data using the component slot --}}

    <form action="{{url()->current()}}" method="GET">
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <p>Статус</p>
                <select name="status" class="form-control form-control-lg">
                    <option  @if(isset($_GET['status']) && $_GET['status'] == 'all') selected @endif value="all">Всі</option>
                    <option  @if(isset($_GET['status']) && $_GET['status'] == 'on') selected @endif value="on">Активні</option>
                    <option  @if(isset($_GET['status']) && $_GET['status'] == 'off') selected @endif value="off">Не активні</option>
                </select>
            </div>
            <div class="p-2 bd-highlight">
                <p>Країна</p>
                <select name="country" class="form-control form-control-lg">
                    <option value="all">Всі</option>
                    @foreach($countries as $country)
                        <option  @if(isset($_GET['country']) && $_GET['country'] == $country->id) selected @endif value="{{$country->id}}">
                            {{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2 bd-highlight">
                <p>Професія</p>
                <select name="profession" class="form-control form-control-lg">
                    <option value="all">Всі</option>
                    @foreach($professions as $profession)
                        <option  @if(isset($_GET['profession']) && $_GET['profession'] == $profession->id) selected @endif value="{{$profession->id}}">
                            {{$profession->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2 bd-highlight">
                <p>з</p>
                <input name="minAmount" type="number" value="@if(isset($_GET['minAmount']) && $_GET['minAmount'] != ''){{$_GET['minAmount']}}@endif">
            </div>
            <div class="p-2 bd-highlight">
                <p>по</p>
                <input name="maxAmount" type="number" value="@if(isset($_GET['maxAmount']) && $_GET['maxAmount'] != ''){{$_GET['maxAmount']}}@endif">
            </div>
            <button class="btn btn-primary filter" type="submit">Застосувати</button>
            <a href="{{route('salary.index')}}"  class="btn btn-outline-success h-25 ml-5">Скинути</a>
        </div>
    </form>

    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($salaries as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>

    <script>
        $('button[name="status"]').each(function (){
            $(this).on('click', function (){

                // console.log($(this).attr('data-id'))
                $.ajax({
                    method: "POST",
                    url: "salary/status/"+$(this).attr('data-id'),
                })
                    .done(function (msg){
                        let i = $('button[data-id='+ msg +']').children();
                        if(i.hasClass('text-red'))
                        {
                            i.removeClass('text-red').removeClass('fa-eye-slash').addClass('fa-eye');
                        } else
                        {
                            i.removeClass('fa-eye').addClass('text-red').addClass('fa-eye-slash');
                        }
                        // console.log($('button[data-id='+ msg +']').children())
                        // $("button[data-id=" + msg + "]").parent().parent().parent().remove();
                    })
            })
        });

        $('button[name="delete"]').each(function (){
            $(this).on('click', function (){
                if(confirm("ВИ точно хочете видалити це?")){
                    $.ajax({
                        method: "DELETE",
                        url: "salary/"+$(this).attr('data-id'),
                    })
                        .done(function (msg){
                            $("button[data-id=" + msg + "]").parent().parent().parent().remove();
                        })
                }
            })
        });
    </script>
@stop

