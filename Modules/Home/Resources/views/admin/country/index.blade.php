

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a href="{{route('country.create')}}" class="btn btn-success">Add</a>
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

        $('button[name="delete"]').each(function (){
            $(this).on('click', function (){
                // console.log($(this).attr('data-id'));
                // $(this).parent().parent().parent().remove();

                if(confirm("ВИ точно хочете видалити це?")){
                    $.ajax({
                        method: "DELETE",
                        url: "country/"+$(this).attr('data-id'),
                        // data:
                        //     {
                        //         id: $(this).attr('data-id'),
                        //     },
                        // success: function(data) {
                        //     // alert(data);
                        //     $("button[data-id=" + data + "]").parent().parent().parent().remove();
                        //
                        // }
                    })
                        .done(function (msg){
                            $("button[data-id=" + msg + "]").parent().parent().parent().remove();
                        })
                }
            })
        });



        {{--$('.btn').on('click', function (){--}}
        {{--    $.ajax({--}}
        {{--        method: "POST",--}}
        {{--        url: "{{route('country.store')}}",--}}
        {{--        data: $('form').serialize(),--}}
        {{--    }).done(function (msg){--}}
        {{--        if(msg == true)--}}
        {{--        {--}}
        {{--            $(location).prop('href', "{{route('country.index')}}")--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
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
