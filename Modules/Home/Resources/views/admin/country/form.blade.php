

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-around">
        <div>
            <h2 class="action" data="{{$action}}">{{$action}}</h2>
        </div>
        <p class="btn btn-success btn-save">Save</p>
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
        @if($action != 'Creating')
        <div class="border border-primary p-3 m-3">
            <form action="#" class="cost_live_form">
                <div>
                    <label for="cost_live">Cost of live</label>
                    <input id="cost_live" name="cost_live"  class="form-control" type="number" value="@if(isset($model)){{isset($model->cost_live) ? $model->cost_live : ''}}@endif">
                </div>
                <div>
                    <label for="rent">Rent</label>
                    <input id="rent" name="rent"  class="form-control" type="number" value="@if(isset($model)){{isset($model->rent) ? $model->rent : ''}}@endif">
                </div>
                <div>
                    <label for="square_meter">Meter</label>
                    <input id="square_meter" name="square_meter"  class="form-control" type="number" value="@if(isset($model)){{isset($model->square_meter) ? $model->square_meter : ''}}@endif">
                </div>
                <button class="cost_live_btn btn btn-dark mt-3" type="button">Load from site</button>
                <div class="spinner-border" hidden role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </form>
        </div>
        @endif

    </form>

    <script>
        $('.btn-save').on('click', function (){
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


        $('.cost_live_btn').on('click', function (){
            // console.log('ajax reload costs of live fron site');
            if("{{ isset($model) && $model->translate('en')->name }}"){
                $.ajax({
                    method: "POST",
                    url:  "{{ str_replace('/edit', "/load_cost_live", $_SERVER['REQUEST_URI'])}}",
                    data: $('.cost_live_form').serialize(),
                    beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('.spinner-border').removeAttr('hidden');
                        $('.cost_live_btn').attr({hidden: true});
                    },
                    complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                        $('.cost_live_btn').removeAttr('hidden');
                        $('.spinner-border').attr({hidden: true});
                    },
                }).done(function (msg){

                    if(msg){
                        let obj = jQuery.parseJSON(msg);

                        $('#cost_live').val(obj.cost_live);
                        $('#rent').val(obj.rent);
                        $('#square_meter').val(obj.square_meter);
                    } else{
                        alert("Country not found");
                        // console.log('error');
                    }

                    // console.log("cost_live- " + obj.cost_live);
                    // console.log("rent- " + obj.rent);
                    // console.log("square_meter- " + obj.square_meter);
                })
                {{--console.log("{{ $model->translate('en')->name }}");--}}
            } else{
                alert('Country name by en not exist');
            }
        })
    </script>

@stop

