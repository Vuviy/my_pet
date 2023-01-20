@extends('layouts.main')

@section('content')
    <h1>{{__('blog::main.Hello World')}}</h1>

    <p>
        This view is loaded from module: {!! config('blog.name') !!}
    </p>
@endsection
