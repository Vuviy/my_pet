

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

        <label for="category">Category</label>
        <div class="input-group mb-3">


{{--            @dd($action)--}}


            <select name="category" class="custom-select" id="inputGroupSelect02">
                <option value="0">---</option>

{{--            @if($action == 'Creating')--}}
{{--                    <option value="0">without category</option>--}}
{{--                @endif--}}
                @foreach($categories as $category)

                    @if($action == 'Creating')
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @else
{{--                        @if(!isset($model->category))--}}
{{--                            <option selected value="">without category</option>--}}
{{--                        @else--}}
                            @if(isset($model->category->id) && $category->id == $model->category->id)
                                <option selected value="{{$category->id}}">{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endif
{{--                    @endif--}}
                @endforeach
            </select>
{{--            <div class="input-group-append">--}}
{{--                <label class="input-group-text" for="inputGroupSelect02">Category</label>--}}
{{--            </div>--}}
        </div>



{{--        <div>--}}
{{--            <select class="form-select" name="category"> <!--Supplement an id here instead of using 'name'-->--}}
{{--                @foreach($categories as $category)--}}

{{--                <option value="{{$category->id}}">{{$category->name}}</option>--}}

{{--                @endforeach--}}

{{--            </select>--}}
{{--        </div>--}}



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
                    {{--url:  "profession/"+"{{isset($model) ? $model->id : 'b'}}",--}}
                    url:  "{{ str_replace('/edit', '', $_SERVER['REQUEST_URI'])}}",
                    {{--url:  "profession/" + "{{str(isset($model) ? $model->id : '')->value()}}",--}}
                    data: $('form').serialize(),
                }).done(function (msg){
                    if(msg)
                    {

                        $(location).prop('href',"/my_pet/public/admin/professions/"+ msg + "/edit");
                    }
                });
            }
            if($('.action').attr('data') == 'Creating')
            {
                $.ajax({
                    method: "POST",
                    url: "{{route('professions.store')}}",
                    data: $('form').serialize(),
                }).done(function (msg){
                    if(msg)
                    {
                        $(location).prop('href',"/my_pet/public/admin/professions/" + msg + "/edit");
                    }
                });
            }
        });
    </script>
@stop

