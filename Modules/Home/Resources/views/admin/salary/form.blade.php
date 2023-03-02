

@extends('adminlte::page')

@section('title', 'Salary')

@section('content_header')
    <div style="display: flex; justify-content: space-around">
        <div>
            <h2 class="action" data="{{$action}}">{{$action}}</h2>
        </div>
        <p class="save btn btn-success">Save</p>
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

        <div class="border p-3 mt-3">
            <label for="respect_index">Respect index</label>

            @if(isset($model))
                    @if($model->respect_index)
                        <h3 class="resp_index h3">{{$model->respect_index}}</h3>
                    @else
                    <h3 class="havent_index h3">Не визначено</h3>
                    @endif
                    <h3 class="resp_index_hiden h3" hidden="hidden"></h3>
            @endif
{{--            <input id="respect_index" name="respect_index"  class="form-control" type="number"--}}
{{--                   value="@if(isset($model))--}}
{{--                                @if($model->respect_index)--}}
{{--                                    {{$model->respect_index}}--}}
{{--                                @endif--}}
{{--                            @endif">--}}
            <p class="calculate_index btn btn-dark mt-3">Розрахувати</p>
        </div>


    </form>

    <script>
        $('.save').on('click', function (){
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

        $('.calculate_index').on('click', function (){



            $.ajax({
                method: "POST",
{{--                url: "{{route('calculateIndex')}}",--}}
                url:  "{{ str_replace('/edit', '/respect_index', $_SERVER['REQUEST_URI'])}}",

                data: "{{isset($model->id) ? $model->id : ''}}",
            }).done(function (msg){
                let obj = jQuery.parseJSON(msg);
                if(obj.error)
                {
                    console.log(obj.error);
                    // $(location).prop('href',"/my_pet/public/admin/salary/" + msg + "/edit");
                } else{
                    console.log('esle ---');

                    if($('.resp_index').text()){
                        console.log($('.resp_index').text());
                        console.log('resp_index exist');

                        $('.resp_index').text(msg);
                    } else{
                        console.log('resp_index exist і ми показуємо респ хіден');

                        $('.resp_index_hiden').attr('hidden', false).text(msg);
                    }
                    console.log('end now havent_index hide');

                    $('.havent_index').attr('hidden', true);
                }
            });
        })


        //calculate_index
    </script>


@stop

