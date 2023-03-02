

@extends('adminlte::page')

@section('title', 'Menu')

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
        <div class="form-group">
            <label for="link">Link</label>
            <input id="link" name="link" class="form-control" type="text" value="@if(isset($model)){{isset($model->link) ? $model->link : ''}}@endif">
        </div>
        <div class="form-group">
            <label for="title_uk">Title [UK]</label>
            <input id="title_uk" name="title_uk" class="form-control" type="text" value="@if(isset($model)){{isset($model->translate('uk')->title) ? $model->translate('uk')->title : ''}}@endif">
        </div>
        <div class="form-group">
            <label for="title_en">Title [EN]</label>
            <input id="title_en" name="title_en" class="form-control" type="text" value="@if(isset($model)){{isset($model->translate('en')->title) ? $model->translate('en')->title : ''}}@endif">
        </div>
        <div class="form-group mt-3">
            <div class="form-check">
                <input class="form-check-input" name="status" type="checkbox" id="gridCheck" @if(isset($model)){{$model->status ? 'checked' : ''}}@endif>
                <label class="form-check-label" for="gridCheck">
                    Status
                </label>
            </div>
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

                        $(location).prop('href',"/my_pet/public/admin/menu/"+ msg + "/edit");
                    }
                });
            }
            if($('.action').attr('data') == 'Creating')
            {
                $.ajax({
                    method: "POST",
                    url: "{{route('menu.store')}}",
                    data: $('form').serialize(),
                }).done(function (msg){
                    if(msg)
                    {
                        $(location).prop('href',"/my_pet/public/admin/menu/" + msg + "/edit");
                    }
                });
            }
        });
    </script>

@stop

