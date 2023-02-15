

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
            <label for="amount">Amount</label>
            <input required id="amount" name="amount" class="form-control" type="number" value="@if(isset($model)){{isset($model->amount) ? $model->amount : ''}}@endif">
        </div>


{{--        @dd($model->profession->id)--}}


        <label for="category">Country</label>
        <div class="input-group mb-3">
            <select name="country" class="custom-select" id="inputGroupSelect02" required>
                <option value="0">---</option>
                @foreach($countries as $country)

                    @if($action == 'Creating')
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @else
                        @if($country->id == $model->country->id)
                            <option selected value="{{$country->id}}">{{$country->name}}</option>
                        @else
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        <label for="category">Profession</label>
        <div class="input-group mb-3">
            <select name="profession" class="custom-select" id="inputGroupSelect02" required>
                <option value="0">---</option>
                @foreach($professions as $profession)

                    @php
                      $cat = '---';
                    @endphp

                    @if(isset($profession->category))
                        {{$cat = $profession->category->name}}
                    @endif

                    @if($action == 'Creating')
                        <option value="{{$profession->id}}">{{$profession->name}}</option>
                    @else
                        @if(isset($model->profession->id) && $profession->id == $model->profession->id)
                            <option selected value="{{$profession->id}}">{{$profession->name.' --- '.$cat}}</option>
                        @else
                            <option value="{{$profession->id}}">

{{--                                {{$profession->name. ' --- '. isset($profession->category) ? $profession->category->name : '---' }}--}}
                                {{$profession->name. ' --- '. $cat }}

                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        <div>
            <label for="status">Status</label>
            <input required id="status" name="status"  class="form-control" type="checkbox"
            @if(isset($model)){{$model->status ? 'checked' : ''}}@endif>
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

                        $(location).prop('href',"/my_pet/public/admin/salary/"+ msg + "/edit");
                    }
                });
            }
            if($('.action').attr('data') == 'Creating')
            {
                $.ajax({
                    method: "POST",
                    url: "{{route('salary.store')}}",
                    data: $('form').serialize(),
                }).done(function (msg){
                    if(msg)
                    {
                        $(location).prop('href',"/my_pet/public/admin/salary/" + msg + "/edit");
                    }
                });
            }
        });
    </script>


@stop

