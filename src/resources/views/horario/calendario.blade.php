@extends('layouts.app')

@section('content')
    <h1>{{$tipo}} y {{$id}}</h1>
    <div id="calendar"
         data-tipo="{{ $tipo }}"
         data-id="{{ $id }}">
    </div>
@endsection
