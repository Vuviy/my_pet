@extends('home::layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>

    <main>
        <div class="container">

            <div class="mt-3">
                <h1 class="h1">{{__('home::main.Index of profession')}}</h1>
            </div>
            <div class="mt-5">
                <form class="row g-2" method="GET">
{{--                    action="{{route('professionsSearch')}}"--}}
{{--                    @csrf--}}
                    <div class="col-auto w-50">
                        <label for="search" class="visually-hidden">{{__('home::main.Enter profession')}}</label>
                        <input name="search" type="text" class="form-control profession" id="profession" placeholder="{{__('home::main.Profession')}}" value="@if(isset($_GET['search'])){{$_GET['search'] != ''?$_GET['search']:''}}@endif">
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
            @if(isset($result))
                <div class="mt-3">
                    @if(!count($result))
                        <h3>Нічого не знайдено</h3>
                    @elseif(count($result) > 1)
                    @else
                        <h2 class="h2">{{$result[0]->translate(app()->getLocale())->name}}</h2>
                        <div class="mt-5">
                            <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{__('home::main.Country')}}</th>
                                <th scope="col">{{__('home::main.Salary')}}</th>
                                <th scope="col">{{__('home::main.Index')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($result[0]->salaries as $item)
                                <tr>
                                    <td>{{$item->country->translate(app()->getLocale())->name}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{isset($item->respect_index) ? $item->respect_index : '---'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @endif

            <div class="mt-5 compareccc">
                <form class="row g-2 yyy" method="GET">
                    <h2>{{__('home::main.Compare professions')}}</h2>
                    <div class="mt-3 d-flex flex-row bd-highlight mb-3 w-100 justify-content-around">
                        <div class="col-auto m-3" style="width: 40%">
                            <h3 class="mb-3">Оберіть професію для прівняння</h3>
                            <label for="compare" class="visually-hidden">{{__('home::main.Enter profession')}}</label>
                            <input name="compare" type="text" class="form-control profession" placeholder="{{__('home::main.Profession')}}" value="@if(isset($_GET['compare'])){{$_GET['compare'] != ''?$_GET['compare']:''}}@endif">
                        </div>
                        <div class="col-auto m-3" style="width: 40%">
                            <h3 class="mb-3">Оберіть професію з якою буде порівняння</h3>
                            <label for="compare_with" class="visually-hidden">{{__('home::main.Enter profession')}}</label>
                            <input name="compare_with" type="text" class="form-control profession" placeholder="{{__('home::main.Profession')}}" value="@if(isset($_GET['compare_with'])){{$_GET['compare_with'] != ''?$_GET['compare_with']:''}}@endif">
                        </div>
                    </div>
                    <button class="btn btn-primary mb-3" id="compare">Порівняти</button>
                </form>
            </div>

                @if(isset($data))

{{--                    @dd($data)--}}
                    <div class="mt-5">
                        <h3>compare</h3>

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{__('home::main.Country')}}</th>
                                <th scope="col">{{$data['professions']['compare'][0]->translate(app()->getLocale())->name}}</th>
                                <th scope="col">{{$data['professions']['compare_with'][0]->translate(app()->getLocale())->name}}</th>
                                <th scope="col">compare</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $sum = 0;
                                $sum_index = 0;
                                $count_countries = 0;
                            @endphp
                            @foreach($data['countries'] as $key => $item)
                                @php

                                    if(in_array($key, array_keys($data['professions']['compare'][1])) && in_array($key, array_keys($data['professions']['compare_with'][1])))
                                    {
                                        $sum += ($data['professions']['compare'][1][$key])->amount - ($data['professions']['compare_with'][1][$key])->amount;
                                        $sum_index += ($data['professions']['compare'][1][$key])->respect_index - ($data['professions']['compare_with'][1][$key])->respect_index;
                                        $count_countries++;
                                    }
                                @endphp

                                <tr>
                                    <td>{{$item->translate(app()->getLocale())->name}}</td>
                                    <td>@if(in_array($key, array_keys($data['professions']['compare'][1]))) {{($data['professions']['compare'][1][$key])->amount.' | '. ($data['professions']['compare'][1][$key])->respect_index}}@endif</td>
                                    <td>@if(in_array($key, array_keys($data['professions']['compare_with'][1]))) {{($data['professions']['compare_with'][1][$key])->amount.' | '. ($data['professions']['compare_with'][1][$key])->respect_index}}@endif</td>
                                    <td>@if(in_array($key, array_keys($data['professions']['compare'][1])) && in_array($key, array_keys($data['professions']['compare_with'][1]))) {{($data['professions']['compare'][1][$key])->amount - ($data['professions']['compare_with'][1][$key])->amount. ' | index: '. ($data['professions']['compare'][1][$key])->respect_index - ($data['professions']['compare_with'][1][$key])->respect_index}}@endif</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="mt-5">
                            <h3>Загалом</h3>
                            <div class="mt-3">
                                <p>Оцінювались дані {{$count_countries}} зп</p>
                                <h4>Зп {{($data['professions']['compare'][0])->translate(app()->getLocale())->name}} відрізняється від зп  {{($data['professions']['compare_with'][0])->translate(app()->getLocale())->name}} на {{$sum}}</h4>
                                <hr>
                                <h4>Загальний індекс відрізняється на {{$sum_index}}</h4>
                                <hr>
                                <h4>Отже, якщо ми віддаємо перевагу оцінці за індексом то враховуючи ці дані можна сказати що професія {{($data['professions']['compare'][0])->translate(app()->getLocale())->name}} в даних країнах оцінюється @if($sum_index > 0) <span class="text-success">краще</span> @else <span class="text-danger">гірше</span>  @endif ніж  {{($data['professions']['compare_with'][0])->translate(app()->getLocale())->name}}</h4>
                            </div>
                        </div>
{{--                        <div class="mt-3 d-flex flex-row bd-highlight mb-3 w-100 justify-content-between">--}}
{{--                            @foreach($data as $item)--}}
{{--                                <div class="col-auto m-3" style="width: 33%">--}}
{{--                                    <h3 class="mb-3">{{$item->translate(app()->getLocale())->name}}</h3>--}}
{{--                                    <div class="mt-3 border-dark border">--}}
{{--                                        <div class="p-3">--}}
{{--                                            <h3 class="p-3">Cost live</h3>--}}
{{--                                            <hr>--}}
{{--                                            <p>Cost live: {{$country[0]->cost_live}}</p>--}}
{{--                                            <p>Rent: {{$country[0]->rent}}</p>--}}
{{--                                            <p>Square meter: {{$country[0]->square_meter}}</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="p-3">--}}
{{--                                            <h3 class="p-3">Salaries</h3>--}}
{{--                                            <hr>--}}
{{--                                            @foreach($data['professions'] as $id)--}}
{{--                                                @if(in_array($id, array_keys($country[1])))--}}
{{--                                                    <p class="h-25">{{($country[1][$id])->profession->translate(app()->getLocale())->name . ' -- '. ($country[1][$id])->amount. ' | index: '. ($country[1][$id])->respect_index}}</p>--}}
{{--                                                @else--}}
{{--                                                    <p>---</p>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                            <hr>--}}
{{--                                            <p>Median: {{$country[0]->median}}</p>--}}
{{--                                            <p>Average: {{$country[0]->average}}</p>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
                    </div>
                @endif
        </div>

    </main>


    <script type="text/javascript">
        var route = "{{ route('autocomplete-search-profession') }}";
        $('.profession').typeahead({
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
