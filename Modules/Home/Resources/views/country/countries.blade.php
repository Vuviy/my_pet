@extends('home::layouts.main')

@section('content')

@php

    $min = $model[0]->min_rent + $model[0]->min_cost_live;
    $max = $model[0]->max_rent + $model[0]->max_cost_live;

    $minAll = $model[0]->min_rent + $model[0]->min_cost_live + $model[0]->min_square_meter;
    $maxAll = $model[0]->max_rent + $model[0]->max_cost_live + $model[0]->max_square_meter;

    $stepAll = ($maxAll - $minAll)/3;
    $colorCountryAll = 'text-danger';
    if($model[0]->cost_live + $model[0]->rent + $model[0]->square_meter < ($stepAll + $minAll)){
       $colorCountryAll = 'text-success';
    } else if($model[0]->cost_live + $model[0]->rent + $model[0]->square_meter < ((2*$stepAll) + $minAll)){
       $colorCountryAll = 'text-warning';
    }

    $step = ($max - $min)/3;
    $colorCountry = 'text-danger';
    if($model[0]->cost_live + $model[0]->rent < ($step + $min)){
       $colorCountry = 'text-success';
    } else if($model[0]->cost_live + $model[0]->rent < ((2*$step) + $min)){
       $colorCountry = 'text-warning';
    }

@endphp
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>

        <main>
            <div class="container mt-3">
                <div class="mt-3">
                    <h1 class="h1">{{__('home::main.Info about countries')}}</h1>
                </div>
                <div class="mt-5">
                    <form class="row g-2" method="GET">
                        {{--                    action="{{route('professionsSearch')}}"--}}
                        {{--                    @csrf--}}
                        <div class="col-auto w-50">
                            <label for="search" class="visually-hidden">{{__('home::main.Enter country')}}</label>
                            <input name="search" type="text" class="form-control" id="country" placeholder="{{__('home::main.Country')}}" value="@if(isset($_GET['search'])){{$_GET['search'] != ''?$_GET['search']:''}}@endif">
                        </div>
                        {{--                    <div class="col-auto">--}}
                        {{--                        <label for="country" class="visually-hidden">{{__('home::main.Enter country')}}</label>--}}
                        {{--                        <input name="country" type="text" class="form-control" id="country" placeholder="{{__('home::main.Country')}}" value="@if(isset($_GET['country'])){{$_GET['country'] != ''?$_GET['country']:''}}@endif">--}}
                        {{--                    </div>--}}
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">{{__('home::main.search')}}</button>
                        </div>
                    </form>
                </div>

                <div class="mt-5">
                    @if(isset($model))

                        @if(!count($model))
                            <h3>Нічого не знайдено</h3>
                        @elseif(count($model) > 1)
                            {{--                    @dd($result)--}}
                        @else

{{--                            @dd($model);--}}
                            <hr>
                            <h2 class="h2">{{$model[0]->translate(app()->getLocale())->name}}</h2>
                            <hr>
                            <section class="cost_live border border-dark p-3 m-3">
                                <div class="">
                                    <h2 class="h2">{{__('home::main.Cost of live')}}</h2>
                                    <div class="mt-3">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th class="fs-4" scope="col">{{__('home::main.Cost of live')}}</th>
                                                <th class="fs-4" scope="col">{{__('home::main.Rent')}}</th>
                                                <th class="fs-4" scope="col">{{__('home::main.Square meter')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fs-3">{{isset($model[0]->cost_live) ? $model[0]->cost_live : '---'}}</td>
                                                    <td class="fs-3">{{isset($model[0]->rent) ? $model[0]->rent : '---'}}</td>
                                                    <td class="fs-3">{{isset($model[0]->square_meter) ? $model[0]->square_meter : '---'}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="mt-3 d-flex justify-content-start">
                                            <div class="me-5 p-3 border-dark border">
                                                <h2>{{__('home::main.All')}}:</h2>
                                                <h2> <span class="fs-6">min:{{$model[0]->cost_live + $model[0]->rent + $model[0]->min_square_meter}}</span>  <span class="{{$colorCountryAll}}">~{{$model[0]->cost_live + $model[0]->rent + $model[0]->square_meter}}</span>  <span class="fs-6">max:{{$model[0]->cost_live + $model[0]->rent + $model[0]->max_square_meter}}</span></h2>
                                            </div>
                                            <div class="p-3 border-dark border">
                                                <h2>{{__('home::main.Live and rent')}}:</h2>
                                                <h2><span class="fs-6">min:{{$model[0]->min_cost_live + $model[0]->min_rent}}</span>  <span class="{{$colorCountry}}">~{{$model[0]->cost_live + $model[0]->rent}}</span>  <span class="fs-6">max:{{$model[0]->max_cost_live + $model[0]->max_rent}}</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="top_5 border border-dark p-3 m-3">
                                <div class="">
                                    <h2>{{__('home::main.Top 5 The most respected professions')}}</h2>
                                    <div class="mt-5">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">{{__('home::main.Profession')}}</th>
                                                <th scope="col">{{__('home::main.Salary')}}</th>
                                                <th scope="col">{{__('home::main.Index')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($model[0]->salariesOrderByIndex as $item)
                                                @php
                                                    $step = ($item->max - $item->min)/3;
                                                    $color = 'text-success';
                                                    if($item->amount < ($step + $item->min)){
                                                        $color = 'text-danger';
                                                    } else if($item->amount < ((2*$step) + $item->min)){
                                                        $color = 'text-warning';
                                                    }
                                                @endphp

                                                <tr>
                                                    <td>{{$item->profession->translate(app()->getLocale())->name}}</td>
                                                    <td> <span class="w-lighter">min: {{$item->min}}</span> || <span class="{{$color}}">{{$item->amount}}</span>|| <span>max: {{$item->max}}</span></td>
                                                    <td>{{isset($item->respect_index) ? $item->respect_index : '---'}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                            <section class="professions border border-dark p-3 m-3">
                                <div class="">
                                        <h2>{{__('home::main.Professions')}}</h2>

                                        <div class="mt-5">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">{{__('home::main.Profession')}}</th>
                                                <th scope="col">{{__('home::main.Salary')}}</th>
                                                <th scope="col">{{__('home::main.Index')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($model[0]->salaries as $item)
                                                <tr>
                                                    <td>{{$item->profession->translate(app()->getLocale())->name}}</td>
                                                    <td>{{$item->amount}}</td>
                                                    <td>{{isset($item->respect_index) ? $item->respect_index : '---'}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                            </section>



                        @endif
                    @endif
                </div>
            </div>
    </main>



        <script type="text/javascript">
            var route = "{{ route('autocomplete-search-country') }}";
            $('#country').typeahead({
                source: function (query, process) {
                    return $.get(route, {
                        query: query
                    }, function (data) {
                        return process(data);
                    });
                }
            });
        </script>

@endsection
