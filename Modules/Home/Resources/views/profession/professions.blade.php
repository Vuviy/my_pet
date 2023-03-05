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

{{--                        @dd($result)--}}

{{--                        @dd($result)--}}
                        <select name="search" class="form-select">
                            <option selected value="0">{{__('home::main.Profession')}}</option>

                            @foreach($profs as $pro)
                                <option @if(count($result) == 1 && $pro->id == $result[0]->id) selected @endif value="{{$pro->id}}">{{$pro->translate(app()->getLocale())->name}}</option>
                            @endforeach
                        </select>

{{--                        <input name="search" type="text" class="form-control profession" id="profession" placeholder="{{__('home::main.Profession')}}" value="@if(isset($_GET['search'])){{$_GET['search'] != ''?$_GET['search']:''}}@endif">--}}
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
                <h3>Ви можите скористатись калькулятором і дізнатись індин для своїє професії та який індекс був би в інших країнах</h3>
                <form class="row g-2 d-flex justify-content-center bg-dark bg-opacity-25 mt-3" method="GET">
                  <div class="p-3" style="width: 50%">


                    <div class="col-auto mb-5">
                        <label for="amount" class="visually-hidden">{{__('home::main.Enter your salary')}}</label>
                        <input name="amount" type="number" class="form-control salary" id="salary" placeholder="{{__('home::main.Salary')}}" value="@if(isset($_GET['amount'])){{$_GET['amount'] != ''?$_GET['amount']:''}}@endif">
                    </div>
                    <div class="col-auto mb-5">
                        <label for="country" class="visually-hidden">{{__('home::main.Country')}}</label>
                        <select name="country" class="form-select">
                            <option selected value="0">{{__('home::main.Country')}}</option>
                        @foreach($countries as $country)
                                <option @if(isset($culc_res['current_country']) && $country->id == $culc_res['current_country']->id) selected @endif value="{{$country->id}}">{{$country->translate(app()->getLocale())->name}}</option>
                            @endforeach
                        </select>

{{--                        <input name="country" type="text" class="form-control country" id="country" placeholder="{{__('home::main.Country')}}" value="@if(isset($_GET['country'])){{$_GET['country'] != ''?$_GET['country']:''}}@endif">--}}
                    </div>
                    <div class="col-auto d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mb-3 w-50">{{__('home::main.Calculate')}}</button>
                    </div>
                  </div>
                </form>
            </div>
            @if(isset($culc_res))
                <div class="mt-3">
                    <div class="mt-3 d-flex justify-content-center">
                        <h2>Індекс вашою зарплатні в країні: "{{$culc_res['current_country']->translate(app()->getLocale())->name}}" становить - {{$culc_res['index']}}</h2>
                    </div>

                    @if(count($culc_res['same']))
                        <div class="mt-3 d-flex justify-content-center">
                            <div class="mt-3 w-50">
                            <h2>Країни за схожим індексом:</h2>
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">{{__('home::main.Country')}}</th>
                                    <th scope="col">{{__('home::main.Index')}}</th>
                                    <th scope="col">{{__('home::main.Median')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($culc_res['same'] as $item)
                                    <tr>
                                        <td>{{$item['country']->translate(app()->getLocale())->name}}</td>
                                        <td>{{$item['index']}}</td>
                                        <td>{{$item['country']->median}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    @endif
                    @if(count($culc_res['best']))
                        <div class="mt-3 d-flex justify-content-center">
                            <div class="mt-3">
                        <h2>Країни за найвищим індексом для вашою зп:</h2>
                            <p>Тобто там де вам буде найкраще</p>
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">{{__('home::main.Country')}}</th>
                                    <th scope="col">{{__('home::main.Index')}}</th>
                                    <th scope="col">{{__('home::main.Median')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($culc_res['best'] as $item)
                                    <tr>
                                        <td>{{$item['country']->translate(app()->getLocale())->name}}</td>
                                        <td>{{$item['index']}}</td>
                                        <td>{{$item['country']->median}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    @endif

                    @if(count($culc_res['worst']))
                        <div class="mt-3 d-flex justify-content-center">
                            <div class="mt-3">
                        <h2>Країни за найнижчим індексом для вашою зп:</h2>
                        <p>Тобто там де вам буде найгірше</p>
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">{{__('home::main.Country')}}</th>
                                    <th scope="col">{{__('home::main.Index')}}</th>
                                    <th scope="col">{{__('home::main.Median')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($culc_res['worst'] as $item)
                                    <tr>
                                        <td>{{$item['country']->translate(app()->getLocale())->name}}</td>
                                        <td>{{$item['index']}}</td>
                                        <td>{{$item['country']->median}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    @endif


                </div>
            @endif
            @if(isset($result))
                <div class="mt-3">
                    @if(!count($result))
                        <h3>Нічого не знайдено</h3>
                    @elseif(count($result) == 1)
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

            <div class="mt-5">
                <form class="row g-2" method="GET">
                    <h2>{{__('home::main.Compare professions')}}</h2>
                    <div class="mt-3 d-flex flex-row bd-highlight mb-3 w-100 justify-content-around">
                        <div class="col-auto m-3" style="width: 40%">
                            <h3 class="mb-3 mb-5">Оберіть професію для прівняння</h3>
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

{{--    <script type="text/javascript">--}}
{{--        var route1 = "{{ route('autocomplete-search-country') }}";--}}
{{--        $('.country').typeahead({--}}
{{--            source: function (query, process) {--}}
{{--                return $.get(route1, {--}}
{{--                    query: query--}}
{{--                }, function (data) {--}}
{{--                    return process(data);--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

@endsection
