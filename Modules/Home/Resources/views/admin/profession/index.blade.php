@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a href="{{route('professions.create')}}" class="btn btn-success">Add</a>
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
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($professions as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>

    <script>
        // document.addEventListener('load', function ()
        // {

        $('button[name="delete"]').each(function (){
            $(this).on('click', function (){

                $.ajax({
                    method: "POST",
                    url: "{{route('ajax')}}",
                    // url: "cdcdcdcd",
                    data:
                        {
                            model: $(this).attr('data-model'),
                            id: $(this).attr('data-id'),
                        },
                }).done(function (msg){
                    alert(msg);
                })
                // console.log($(this).attr('data-id'));
            })
        });

        // btn.on("click", function (){
        //
        //
        //
        //     console.log(btn);
        //
        //
        //
        // })

        // for(let bbb in btn)
        // {
        //     bbb.on("click", function (){
        //         alert(btn[i].val());
        //     });
        // }
        // console.log(445454);

        // });
    </script>
{{--    <script defer>--}}
{{--        var elements = $('.sraka');--}}
{{--        // var elements = $('.content');--}}
{{--        console.log(5555);--}}
{{--    </script>--}}
@stop

