@extends('layout.master')
@section('title', $constant['name'])
@section('description', $constant['description'] )
@section('image', $constant['logo'])

@section('body')
    @if($constant['theme'] == 'developer')
        @include('template.developer')
    @elseif($constant['theme'] == 'news')
        @include('template.news')
    @elseif($constant['theme'] == 'konkor')
        @include('template.konkor')
    @elseif($constant['theme'] == 'digikala')
        @include('template.digikala')
    @elseif($constant['theme'] == 'holo')
        @include('template.holo')
    @elseif($constant['theme'] == 'default')
        @include('template.default')
    @else
        @include('template.default')
    @endif
@endsection

