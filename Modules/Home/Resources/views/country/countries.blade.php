@extends('home::layouts.main')

@section('content')

@php

    if(isset($model)){
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
     }

@endphp
{{--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">--}}
{{--    </script>--}}

        <main>
            <div class="container mt-3">
                <div class="mt-3">
                    <h1 class="h1">{{__('home::main.Info about countries')}}</h1>
                </div>
                <div class="mt-5">
                    <form class="row g-2" method="GET">
                        <div class="col-auto w-50">
                            <label for="search" class="visually-hidden">{{__('home::main.Enter country')}}</label>

                            <select name="search" class="form-select">
                                <option selected value="0">{{__('home::main.Country')}}</option>
                                @foreach($countries as $country)
                                    <option @if(isset($model) && $model[0]->id == $country->id) selected @endif value="{{$country->id}}">{{$country->translate(app()->getLocale())->name}}</option>
                                @endforeach
                            </select>
{{--                            <input name="search" type="text" class="form-control country" id="country" placeholder="{{__('home::main.Country')}}" value="@if(isset($_GET['search'])){{$_GET['search'] != ''?$_GET['search']:''}}@endif">--}}
                        </div>
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
                        @else
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

                <div class="mt-5">
                    <form class="row g-2" method="GET">
                    <h2>{{__('home::main.Compare countries')}}</h2>
                    <div class="mt-3 d-flex flex-row bd-highlight mb-3 w-100 justify-content-around">
                        <div class="col-auto m-3" style="width: 40%">
                            <h3 class="mb-3">Оберіть країну для прівняння</h3>
                            <label for="compare" class="visually-hidden">{{__('home::main.Enter country')}}</label>

                            <select name="compare" class="form-select">
                                <option selected value="0">{{__('home::main.Country')}}</option>
                                @foreach($countries as $country)
                                    <option @if(isset($data) && $country->id == $data['countries']['compare'][0]->id) selected @endif value="{{$country->id}}">{{$country->translate(app()->getLocale())->name}}</option>
                                @endforeach
                            </select>



{{--                            <input name="compare" type="text" class="form-control country" placeholder="{{__('home::main.Country')}}" value="@if(isset($_GET['compare'])){{$_GET['compare'] != ''?$_GET['compare']:''}}@endif">--}}
                        </div>
                        <div class="col-auto m-3" style="width: 40%">
                            <h3 class="mb-3">Оберіть країну з якою буде порівняння</h3>
                            <label for="compare_with" class="visually-hidden">{{__('home::main.Enter country')}}</label>

                            <select name="compare_with" class="form-select">
                                <option selected value="0">{{__('home::main.Country')}}</option>
                                @foreach($countries as $country)
                                    <option @if(isset($data) && $country->id == $data['countries']['compare_with'][0]->id) selected @endif value="{{$country->id}}">{{$country->translate(app()->getLocale())->name}}</option>
                                @endforeach
                            </select>

{{--                            <input name="compare_with" type="text" class="form-control country" placeholder="{{__('home::main.Country')}}" value="@if(isset($_GET['compare_with'])){{$_GET['compare_with'] != ''?$_GET['compare_with']:''}}@endif">--}}
                        </div>
                    </div>
                    <button class="btn btn-primary mb-3" id="compare">Compare</button>
                    </form>
                    @if(isset($data))
                        <div class="mt-3 d-flex flex-row bd-highlight mb-3 w-100 justify-content-between">
                            @foreach($data['countries'] as $country)

                                <div class="col-auto m-3" style="width: 38%">
                                    <h3 class="mb-3">{{$country[0]->translate(app()->getLocale())->name}}</h3>
                                    <div class="mt-3 border-dark border">
                                        <div class="p-3">
                                            <h3 class="p-3">Cost live</h3>
                                            <hr>
                                            <p>Cost live: {{$country[0]->cost_live}}</p>
                                            <p>Rent: {{$country[0]->rent}}</p>
                                            <p>Square meter: {{$country[0]->square_meter}}</p>
                                        </div>
                                        <div class="p-3">
                                            <h3 class="p-3">Salaries</h3>
                                            <hr>
                                                @foreach($data['professions'] as $id)
                                                        @if(in_array($id, array_keys($country[1])))
                                                            <p class="h-25">{{($country[1][$id])->profession->translate(app()->getLocale())->name . ' -- '. ($country[1][$id])->amount. ' | index: '. ($country[1][$id])->respect_index}}</p>
                                                        @else
                                                            <p>---</p>
                                                        @endif
                                                @endforeach
                                            <hr>
                                            <p>Median: {{$country[0]->median}}</p>
                                            <p>Average: {{$country[0]->average}}</p>
                                        </div>

                                    </div>
                                </div>

                            @endforeach
                                <div class="col-auto m-3" style="width: 20%">
                                    <h3 class="mb-3">{{'compare'}}</h3>
                                    <div class="mt-3 border-dark border">
                                        <div class="p-3">
                                            <h3 class="p-3">Cost live</h3>
                                            <hr>
                                            @php
                                                $cost = ($data['countries']['compare'][0])->cost_live - ($data['countries']['compare_with'][0])->cost_live;
                                                $rent = ($data['countries']['compare'][0])->rent - ($data['countries']['compare_with'][0])->rent;
                                                $square_meter = ($data['countries']['compare'][0])->square_meter - ($data['countries']['compare_with'][0])->square_meter;
                                                $cost_procent = round(abs(((($data['countries']['compare'][0])->cost_live - ($data['countries']['compare_with'][0])->cost_live)/($data['countries']['compare_with'][0])->cost_live))*100, 2);
                                                $rent_procent = round(abs(((($data['countries']['compare'][0])->rent - ($data['countries']['compare_with'][0])->rent)/($data['countries']['compare_with'][0])->rent))*100, 2);
                                                $square_meter_procent = round(abs(((($data['countries']['compare'][0])->square_meter - ($data['countries']['compare_with'][0])->square_meter)/($data['countries']['compare_with'][0])->square_meter))*100, 2);
                                            @endphp

                                            <p>Cost live: <span class="{{$cost > 0 ? 'text-danger' : 'text-success'}}">{{$cost.'  --  '. $cost_procent.'%'}}</span></p>
                                            <p>Rent: <span class="{{$rent > 0 ? 'text-danger' : 'text-success'}}">{{$rent.' -- '. $rent_procent.'%'}}</span></p>
                                            <p>Square meter: <span class="{{$square_meter > 0 ? 'text-danger' : 'text-success'}}">{{$square_meter.' -- '. $square_meter_procent.'%'}}</span></p>
                                        </div>
                                        <div class="p-3">
                                            <h3 class="p-3">Salaries</h3>
                                            <hr>

                                            @foreach($data['professions'] as $id)
                                                @if(in_array($id, array_keys($data['countries']['compare'][1])) && in_array($id, array_keys($data['countries']['compare_with'][1])))

                                                    @php
                                                        $salary = ($data['countries']['compare'][1][$id])->amount - ($data['countries']['compare_with'][1][$id])->amount;
                                                        $index = ($data['countries']['compare'][1][$id])->respect_index - ($data['countries']['compare_with'][1][$id])->respect_index;
                                                    @endphp

                                                    <p> <span class="{{$salary > 0 ? 'text-success' : 'text-danger'}}">{{$salary}}</span>  index: <span class="{{$index > 0 ? 'text-success' : 'text-danger'}}">{{$index}}</span></p>
                                                @else
                                                    <p>---</p>
                                                @endif
                                            @endforeach
                                            <hr>
                                            @php
                                                $median = $data['countries']['compare'][0]->median - $data['countries']['compare_with'][0]->median;
                                                $average = $data['countries']['compare'][0]->average - $data['countries']['compare_with'][0]->average;
                                            @endphp
                                                <p>Median: <span class="{{$median > 0 ? 'text-success' : 'text-danger'}}">{{$median}}</span></p>
                                                <p>Average: <span class="{{$average > 0 ? 'text-success' : 'text-danger'}}">{{$average}}</span></p>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="mt-3 border border-success p-3">
                            <h3>Топ 5 професій які найбільше поважають</h3>
                            <div class="mt-3 d-flex flex-row bd-highlight mb-3 w-100 justify-content-between">
                                @foreach($data['countries'] as $country)
                                    <div  style="width: 45%">
                                        <h3>{{$country[0]->translate(app()->getLocale())->name}}</h3>
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

                                                @php
                                                    $limit = 0;
                                                @endphp
                                                @foreach($country[1] as $item)
                                                    @php
                                                        $limit++;
                                                    @endphp
                                                    @if($limit < 5)
                                                        <tr>
                                                            <td>{{$item->profession->translate(app()->getLocale())->name}}</td>
                                                            <td>{{$item->amount}}</td>
                                                            <td>{{$item->respect_index}}</td>
                                                            {{--                                        <td>{{$item->country->translate(app()->getLocale())->name}}</td>--}}
                                                            {{--                                        <td>{{$item->amount}}</td>--}}
                                                            {{--                                        <td>{{isset($item->respect_index) ? $item->respect_index : '---'}}</td>--}}
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="mt-3 border border-danger p-3">
                            <h3>Топ 5 професій які найменше поважають</h3>
                            <div class="mt-3 d-flex flex-row bd-highlight mb-3 w-100 justify-content-between">
                                @foreach($data['countries'] as $country)
                                    <div  style="width: 45%">
                                        <h3>{{$country[0]->translate(app()->getLocale())->name}}</h3>
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

                                                @php
                                                    $limit = 0;

                                                $arr = array_reverse($country[1]);
                                                @endphp
                                                @foreach($arr as $item)
                                                    @php
                                                        $limit++;
                                                    @endphp
                                                    @if($limit < 5)
                                                        <tr>
                                                            <td>{{$item->profession->translate(app()->getLocale())->name}}</td>
                                                            <td>{{$item->amount}}</td>
                                                            <td>{{$item->respect_index}}</td>
                                                            {{--                                        <td>{{$item->country->translate(app()->getLocale())->name}}</td>--}}
                                                            {{--                                        <td>{{$item->amount}}</td>--}}
                                                            {{--                                        <td>{{isset($item->respect_index) ? $item->respect_index : '---'}}</td>--}}
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="mt-3">
                            <h2>Висновок:</h2>
                            <h3>
                                Отже, загалом оцінка професій в {{($data['countries']['compare'][0])->translate(app()->getLocale())->name}} відрізняється від {{($data['countries']['compare_with'][0])->translate(app()->getLocale())->name}} на <span class="{{$median > 0 ? 'text-success' : 'text-danger'}}">{{$median}}</span>
                            </h3>
                        </div>

                    @endif

                </div>


            </div>
    </main>



{{--        <script type="text/javascript">--}}
{{--            var route = "{{ route('autocomplete-search-country') }}";--}}
{{--            $('.country').typeahead({--}}
{{--                source: function (query, process) {--}}
{{--                    return $.get(route, {--}}
{{--                        query: query--}}
{{--                    }, function (data) {--}}
{{--                        return process(data);--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        </script>--}}

@endsection
