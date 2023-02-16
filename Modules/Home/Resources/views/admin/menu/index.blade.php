

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <a href="{{route('menu.create')}}" class="btn btn-success">Add</a>
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
{{--    <div class="col-md-12 mb-5">--}}
    {{-- Minimal example / fill data using the component slot --}}

{{--    <form action="{{url()->current()}}" method="GET">--}}
{{--        <div class="d-flex flex-row bd-highlight mb-3">--}}
{{--            <div class="p-2 bd-highlight">--}}
{{--                <p>Статус</p>--}}
{{--                <select name="status" class="form-control form-control-lg">--}}
{{--                    <option @if(isset($_GET['status']) && $_GET['status'] == 'all') selected @endif value="all">Всі</option>--}}
{{--                    <option @if(isset($_GET['status']) && $_GET['status'] == 'on') selected @endif value="on">Активні</option>--}}
{{--                    <option @if(isset($_GET['status']) && $_GET['status'] == 'off') selected @endif value="off">Не активні</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="p-2 bd-highlight">--}}
{{--                <p>Назва</p>--}}
{{--                <input name="search" type="text" value="@if(isset($_GET['search']) && $_GET['search'] != ''){{$_GET['search']}}@endif">--}}
{{--            </div>--}}
{{--            <button class="btn btn-primary filter" type="submit">Застосувати</button>--}}
{{--            <a href="{{route('category.index')}}"  class="btn btn-outline-success h-25 ml-5">Скинути</a>--}}
{{--        </div>--}}
{{--    </form>--}}

    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($menu as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>

{{--    </div>--}}

    <script>



        // console.log($('button[name="status"]'));


        $('button[name="status"]').each(function (){
            // console.log($(this).attr('data-id'));

            $(this).on('click', function (){
                // console.log($(this).attr('data-id'))
                $.ajax({
                    method: "POST",
                    url: "menu/status/"+$(this).attr('data-id'),
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
                        url: "menu/"+$(this).attr('data-id'),
                    })
                        .done(function (msg){
                            $("button[data-id=" + msg + "]").parent().parent().parent().remove();
                        })
                }
            })
        });
    </script>
@stop

