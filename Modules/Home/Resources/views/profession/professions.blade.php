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
                        <input name="search" type="text" class="form-control" id="profession" placeholder="{{__('home::main.Profession')}}" value="@if(isset($_GET['search'])){{$_GET['search'] != ''?$_GET['search']:''}}@endif">
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

{{--            <div class="mt-5">--}}

{{--                    <div class="col-auto">--}}
{{--                        <label for="profession" class="visually-hidden">{{__('home::main.Enter profession')}}</label>--}}
{{--                        <input name="profession" type="text" class="form-control" id="profession" placeholder="{{__('home::main.Profession')}}">--}}
{{--                    </div>--}}

{{--            </div>--}}



            @if(isset($result))
                @if(!count($result))
                    <h3>Нічого не знайдено</h3>
                @elseif(count($result) > 1)
{{--                    @dd($result)--}}
                @else
{{--                    @dd(!count($result))--}}
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
{{--                        <th scope="row">1</th>--}}
                        <td>{{$item->country->translate(app()->getLocale())->name}}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{isset($item->respect_index) ? $item->respect_index : '---'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
                @endif
            @endif
        </div>

    </main>


    <script type="text/javascript">
        var route = "{{ route('autocomplete-search-profession') }}";
        $('#profession').typeahead({
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
