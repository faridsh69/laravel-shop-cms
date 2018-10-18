@extends('layout.master')
@section('title', $constant['name'])
@section('description', $constant['description'] )
@section('image', $constant['logo'])

@section('body')
    @include('template.index-all')
@endsection

