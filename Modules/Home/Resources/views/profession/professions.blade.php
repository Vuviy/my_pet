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
                        <label for="profession" class="visually-hidden">{{__('home::main.Enter profession')}}</label>
                        <input name="profession" type="text" class="form-control" id="profession" placeholder="{{__('home::main.Profession')}}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">{{__('home::main.search')}}</button>
                    </div>
                </form>
            </div>

            <div class="mt-5">
                <hr>
                <h2 class="h2">Filters</h2>
                <form class="row g-2">
                    <div class="col-auto">
                        <label for="profession" class="visually-hidden">{{__('home::main.Enter profession')}}</label>
                        <input name="profession" type="text" class="form-control" id="profession" placeholder="{{__('home::main.Profession')}}">
                    </div>
                    <div class="col-auto">
                        <label for="profession" class="visually-hidden">{{__('home::main.Enter profession')}}</label>
                        <input name="profession" type="text" class="form-control" id="profession" placeholder="{{__('home::main.Profession')}}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">{{__('home::main.search')}}</button>
                    </div>
                </form>
                <hr>
            </div>



            @if(isset($result))
                @if(empty($result))
                    <h3>Нічого не знайдено</h3>
                @else
                    <h2 class="h2">{{$result->translate(app()->getLocale())->name}}</h2>
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

                @foreach($result->salaries as $item)
                    <tr>
{{--                        <th scope="row">1</th>--}}
                        <td>{{$item->country->translate(app()->getLocale())->name}}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{ round($item->amount/($item->country->cost_live + $item->country->rent + $item->country->square_meter), 3)}}</td>
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
        var route = "{{ route('autocomplete-search') }}";
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
