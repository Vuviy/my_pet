

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-around">
        <div>
            <h2>Creating</h2>
        </div>
        <a href="{{route('salary.store')}}" class="btn btn-success">Save</a>
    </div>
@stop

@section('content')

    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.js')}}"></script>

    <form action="#" method="POST" class="container">
        <div>
            <label for="title">Title</label>
            <input id="title" name="title" class="form-control" type="text">
        </div>
        <div>
            <label for="title">Title</label>
            <input id="title" name="title" class="form-control" type="text">
        </div>
        <div>
            <label for="title">Title</label>
            <input id="title" name="title" class="form-control" type="text">
        </div>


    </form>

@stop

