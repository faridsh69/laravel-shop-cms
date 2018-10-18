@extends('layout.master')
@section('title', 'محصولات')
@section('description', 'محصولات' )
@section('image', $constant['logo'])
@section('container-fluid')
<div class="row">
	<div class="col-xs-12">
		<h2 class="page-header text-center">
			محصولات
		</h2>
	</div>
</div>
<products></products>
@endsection