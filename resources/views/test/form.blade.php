@extends('layout.master')
@section('title', 'مقاله ')
@section('description', 'مقاله' )
@section('image', $constant['logo'])

@push('script')
	<link rel="stylesheet" type="text/css" href="/css/wizard.css">
@endpush

@section('container')

<div class="row">
  	<div class="col-xs-12">
	    <section>
	        <div class="wizard">
	            <div class="wizard-inner">
	                <div class="connecting-line"></div>
	                <ul class="nav nav-tabs" role="tablist">
	                    <li class="{{ $form['type'] == 'address' ? 'active' : 'disabled' }}">
	                        <a href="javascript:void(0)" title="آدرس دهی">
	                            <span class="round-tab">
	                                <i class="fa fa-map-marker"></i>
	                            </span>
	                        </a>
	                    </li>
	                    <li class="{{ $form['type'] == 'shipping' ? 'active' : 'disabled' }}">
	                        <a href="javascript:void(0)" title="روش ارسال">
	                            <span class="round-tab">
	                                <i class="fa fa-truck"></i>
	                            </span>
	                        </a>
	                    </li>
	                    <li class="{{ $form['type'] == 'payment' ? 'active' : 'disabled' }}">
	                        <a href="javascript:void(0)" title="پرداخت">
	                            <span class="round-tab">
	                                <i class="fa fa-credit-card"></i>
	                            </span>
	                        </a>
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </section>
    </div>
</div>

@endsection
@push('script')


@endpush