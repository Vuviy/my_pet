

@extends('adminlte::page')

@section('title', 'Country')

@section('content_header')
    <a href="{{route('country.create')}}" class="btn btn-success">Add</a>
    <button name="culcMedian" class="btn btn-info">Розрахувати всі медіани</button>
    <button name="culcAverage" class="btn btn-info">Розрахувати всі average</button>
@stop

@section('content')


    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.js')}}"></script>

{{--@dd(json_encode($countries))--}}

{{--    <script>--}}
{{--        let countries = {{json_encode($countries)}};--}}
{{--        console.log(countries);--}}
{{--    </script>--}}
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
                <p>Назва</p>
                <input name="search" type="text" value="@if(isset($_GET['search']) && $_GET['search'] != ''){{$_GET['search']}}@endif">
            </div>
{{--            <div class="p-2 bd-highlight">--}}
{{--                <select name="www" class="form-control form-control-lg">--}}
{{--                    <option value="3">Активні</option>--}}
{{--                    <option value="4">Не активні</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <button class="btn btn-primary filter" type="submit">Застосувати</button>
            <a href="{{route('country.index')}}"  class="btn btn-outline-success h-25 ml-5">Скинути</a>
        </div>
    </form>
    <x-adminlte-datatable id="table1" :heads="$heads">

    @foreach($countries as $row)
            <tr>
            @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>




    {{-- Compressed with style options / fill data using the plugin config --}}
{{--    <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config"--}}
{{--                          striped hoverable bordered compressed/>--}}


    <script>
        $('button[name="status"]').each(function (){
            $(this).on('click', function (){

                // console.log($(this).attr('data-id'))
                    $.ajax({
                        method: "POST",
                        url: "country/status/"+$(this).attr('data-id'),
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
                        url: "country/"+$(this).attr('data-id'),
                    })
                        .done(function (msg){
                            $("button[data-id=" + msg + "]").parent().parent().parent().remove();
                        })
                }
            })
        });





        $('button[name="culcMedian"]').on('click', function (){
            $.ajax({
                method: "POST",
                url: "{{route('culcAllMedian')}}",
            })
            .done(function (msg){
                alert(msg)
            })
        });

        $('button[name="culcAverage"]').on('click', function (){
            $.ajax({
                method: "POST",
                url: "{{route('culcAllAverage')}}",
            })
            .done(function (msg){
                alert(msg)
            })
        });

        // $('.filter').on('click', function (){
        //
        //     $.ajax({
        //         method: "GET",
        //         url: "country/filter",
        //     })
        //         .done(function (msg){
        //             console.log(333);
        //         })
        //
        //     console.log($('select[name="status"]').val());
        // });
    </script>

    @stop


{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">Manage Employees</div>--}}
{{--            <div class="card-body">--}}
{{--                {{ $dataTable->table() }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@stop--}}

{{--@push('scripts')--}}
{{--    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}--}}
{{--@endpush--}}
