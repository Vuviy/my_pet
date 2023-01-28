

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <a href="{{route('category.create')}}" class="btn btn-success">Add</a>
    </div>
@stop

@section('content')
    {{-- Setup data for datatables --}}
{{--    <div class="col-md-12 mb-5">--}}
    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($categories as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>

{{--    </div>--}}
@stop

