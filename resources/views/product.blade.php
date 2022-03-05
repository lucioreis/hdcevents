@extends('layouts.main')

@section('title')
Product
@endsection

@section('main')
@if($id != null)
<h1>Showing product {{$id}}</h1>
@else
<h1> Nothing to show </h1>
@endif

@endsection
