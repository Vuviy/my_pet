

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-around">
        <div>
            <h2 class="action" data="{{$action}}">{{$action}}</h2>
        </div>
        <p class="btn btn-success">Save</p>
    </div>
@stop



@section('content')


{{--    @dd($_SERVER)--}}
    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.js')}}"></script>


{{--    @if(isset($fcfcfc))--}}
{{--        {{dd(777)}}--}}
{{--    @else--}}
{{--        {{dd(111)}}--}}
{{--    @endif--}}

{{--    @dd(isset($model->translate('en')->name) ?: 2)--}}

    <form action="#" method="POST" class="container">
        <div>
            <label for="name">Name [UK]</label>
            <input id="name" name="name_uk" class="form-control" type="text" value="@if(isset($model)){{isset($model->translate('uk')->name) ? $model->translate('uk')->name : ''}}@endif">
        </div>
        <div>
            <label for="name">Name [EN]</label>
            <input id="name" name="name_en" class="form-control" type="text" value="@if(isset($model)){{isset($model->translate('en')->name) ? $model->translate('en')->name : ''}}@endif">
        </div>
    </form>

    <script>
        // console.log($(".action"))
        // console.log($(".action").val())
        // console.log($(".action").attr('data'))



        $('.btn').on('click', function (){
            if($('.action').attr('data') == 'Edit')
            {
                $.ajax({
                    method: "PUT",
                    {{--url:  "country/"+"{{isset($model) ? $model->id : 'b'}}",--}}
                    url:  "{{ str_replace('/edit', '', $_SERVER['REQUEST_URI'])}}",
                    {{--url:  "country/" + "{{str(isset($model) ? $model->id : '')->value()}}",--}}
                    data: $('form').serialize(),
                }).done(function (msg){
                    if(msg)
                    {

                        $(location).prop('href',"/my_pet/public/admin/country/"+ msg + "/edit");
                    }
                });
            }
            if($('.action').attr('data') == 'Creating')
            {
                $.ajax({
                    method: "POST",
                    url: "{{route('country.store')}}",
                    data: $('form').serialize(),
                }).done(function (msg){
                    if(msg)
                    {
                        $(location).prop('href',"/my_pet/public/admin/country/" + msg + "/edit");
                    }
                });
            }
        });
    </script>

@stop

