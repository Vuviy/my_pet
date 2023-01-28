

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <a href="{{route('salary.create')}}" class="btn btn-success">Add</a>
    </div>

@stop

@section('content')
    {{-- Setup data for datatables --}}

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($salaries as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>@stop

