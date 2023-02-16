@extends('home::layouts.main')
@section('content')

    @foreach($posts as $post)
        <div class="text-center d-flex justify-content-center">

            <div class="card w-75 mb-4 mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{$post->translate(\Illuminate\Support\Facades\App::getLocale())->title}}</h5>
                    <p class="card-text">{{$post->translate(\Illuminate\Support\Facades\App::getLocale())->short_text}}</p>
                    <a href="{{route('show', ['id' => $post->id])}}" class="btn btn-primary">@lang('blog::main.read all')</a>
                </div>
            </div>




{{--       <div style="background: #1a202c; margin-bottom: 20px;" class="me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">--}}
{{--           <div class="my-3 p-3">--}}
{{--               <h2 style="color: #a0aec0" class="display-5">{{$post->translate(\Illuminate\Support\Facades\App::getLocale())->title}}</h2>--}}
{{--               <p style="color: #a0aec0" class="lead">{{$post->translate(\Illuminate\Support\Facades\App::getLocale())->content}}</p>--}}
{{--               <a href="{{route('show', ['id' => $post->id])}}">@lang('blog::main.read all')</a>--}}
{{--           </div>--}}
{{--       </div>--}}

        </div>
    @endforeach




        <div class="w-25 mx-auto">
            {{$posts->withQueryString()->links('vendor.pagination.bootstrap-5')}}

        </div>
@endsection


