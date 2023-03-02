@extends('home::layouts.main')

@section('content')

        <main>
            <div class="container mt-3">
                <h2>Indexes</h2>
                <section class="median mt-5">

                <h2>{{__('home::main.Top 5 countries by median of respect index')}}</h2>
                <div class="d-flex flex-row flex-wrap bd-highlight mb-3 w-100">
                    @php
                        $num = 1;
                    @endphp
                    @foreach($countriesSortByMedianDesc as $item)
                    <div class="card border-dark mb-3 m-3" style="max-width: 25rem; min-width: 24rem;">
                        <div class="card-header fw-bold fs-3"><a href="{{route('countries', ['search' => $item->translate(app()->getLocale())->name])}}">
                            {{$num.' '.$item->translate(app()->getLocale())->name}}</div>
                            </a>
                        @php
                            $num++;
                        @endphp
                        <div class="card-body text-dark">
                            <p class="card-text">{{__('home::main.Based by')}} {{count($item->salaries)}} {{__('home::main.professions')}}</p>
                            <p class="card-text">{{__('home::main.Median of respect index:')}} {{$item->median}}</p>
                            <p class="card-text">{{__('home::main.Average respect index:')}} {{$item->average}}</p>
                            <p class="card-text">{{__('home::main.Sum of all indexes:')}} {{$item->sum_index}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                </section>
            </div>
    </main>


@endsection

{{----}}
{{--                    <div class="card border-secondary mb-3 m-3" style="max-width: 20rem;">
                        <div class="card-header">Header</div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title">Secondary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
--}}
