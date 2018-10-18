@extends('layout.master')
@section('title', 'سبد خرید')
@section('description', 'سبد خرید' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
		<h2 class="text-center page-header">
			سبد خرید
		</h2>
	</div>
</div>
<div class="seperate"></div>
<basket></basket>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
@endsection
