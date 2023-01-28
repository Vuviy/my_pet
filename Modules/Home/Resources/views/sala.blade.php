@extends('home::layouts.main')

@section('content')



{{--    @dd($professions[3]->salaries)--}}


    <main>

        <button  id="btn" type="button" class="btn btn-success">gggggg</button>


        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
            @foreach($professions as $profession)
                <div class="text-center d-flex justify-content-center">
                    <div class="card w-75 mb-4 mt-3">
                        <h2>{{$profession->name}}</h2>
                        <div class="card-body">
                            <table class="text-center d-flex justify-content-center">
                                <tr>
                                    <td>#</td>
                                    <td>Country</td>
                                    <td>Salary</td>
                                </tr>
                                @foreach($profession->salaries as $salary)
                                    <tr>
                                        <td>{{$salary->country->id}}</td>
                                        <td>{{$salary->country->name}}</td>
                                        <td>{{$salary->amount}} $</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>

        {{$professions->links('vendor.pagination.bootstrap-5')}}

        </div>

{{--        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">--}}
{{--           @foreach($countries as $country)--}}
{{--                <div class="text-center d-flex justify-content-center">--}}
{{--                    <div class="card w-75 mb-4 mt-3">--}}
{{--                        <h2>{{$country->name}}</h2>--}}
{{--                        <div class="card-body">--}}
{{--                           <table class="text-center d-flex justify-content-center">--}}
{{--                                <tr>--}}
{{--                                    <td>#</td>--}}
{{--                                    <td>Profession</td>--}}
{{--                                    <td>Salary</td>--}}
{{--                                </tr>--}}
{{--                               @foreach($country->salaries as $salary)--}}
{{--                                   <tr>--}}
{{--                                       <td>{{$salary->profession->id}}</td>--}}
{{--                                       <td>{{$salary->profession->name}}</td>--}}
{{--                                       <td>{{$salary->amount}} $</td>--}}
{{--                                   </tr>--}}
{{--                               @endforeach--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
    </main>


<script>

    $('#btn').on('click', function (){


        console.log('dd');
        {{--$.ajax({--}}
        {{--    method: "POST",--}}
        {{--    url: "{{route('ajax')}}",--}}
        {{--    // url: "cdcdcdcd",--}}
        {{--    data: --}}
        {{--        { --}}
        {{--            name: 'hhh', --}}
        {{--            title: '7777'--}}
        {{--        },--}}
        {{--}).done(function (msg){--}}
        {{--    alert(msg);--}}
        {{--})--}}

    });
</script>

@endsection
