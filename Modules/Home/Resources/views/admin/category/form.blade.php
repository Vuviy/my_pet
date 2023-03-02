

@extends('adminlte::page')

@section('title', 'Category')

@section('content_header')
    <div style="display: flex; justify-content: space-around">
        <div>
            <h2 class="action" data="{{$action}}">{{$action}}</h2>
        </div>
        <p class="btn btn-success">Save</p>
    </div>
@stop

@section('content')

    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.js')}}"></script>

    <form action="#" method="POST" class="container">
        <div>
            <label for="name_uk">Name [UK]</label>
            <input id="name_uk" name="name_uk" class="form-control" type="text" value="@if(isset($model)){{isset($model->translate('uk')->name) ? $model->translate('uk')->name : ''}}@endif">
        </div>
        <div>
            <label for="name_en">Name [EN]</label>
            <input id="name_en" name="name_en" class="form-control" type="text" value="@if(isset($model)){{isset($model->translate('en')->name) ? $model->translate('en')->name : ''}}@endif">
        </div>
        <div>
            <label for="status">Status</label>
            <input id="status" name="status"  class="form-control" type="checkbox"
            @if(isset($model)){{$model->status ? 'checked' : ''}}@endif>
            {{--                   @if(isset($model)){{isset($model->status) ? $model->status : 0}}@endif>--}}
        </div>
    </form>


    <script>
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

                        $(location).prop('href',"/my_pet/public/admin/category/"+ msg + "/edit");
                    }
                });
            }
            if($('.action').attr('data') == 'Creating')
            {
                $.ajax({
                    method: "POST",
                    url: "{{route('category.store')}}",
                    data: $('form').serialize(),
                }).done(function (msg){
                    if(msg)
                    {
                        $(location).prop('href',"/my_pet/public/admin/category/" + msg + "/edit");
                    }
                });
            }
        });
    </script>

@stop

