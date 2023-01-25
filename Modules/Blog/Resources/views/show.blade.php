@extends('home::layouts.main')

@section('content')
       <div style="background: #1a202c; min-width: 49%; margin-bottom: 20px;" class="me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
           <div class="my-3 p-3">
               <h2 style="color: #a0aec0" class="display-5">{{$post->translate(\Illuminate\Support\Facades\App::getLocale())->title}}</h2>
               <p style="color: #a0aec0" class="lead">{{$post->translate(\Illuminate\Support\Facades\App::getLocale())->content}}</p>
               <p style="color: #a0aec0" class="lead">@lang('blog::main.author'): {{$post->author}}</p>
           </div>
       </div>
@endsection
