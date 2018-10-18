@extends('layout.master')
@section('title', 'آدرس دهی')
@section('container')

@each('common.form-wizard', [ ['type' => 'address'] ], 'form')

<div class="row">
    <div class="col-xs-12 text-center">
        <h3>
            انتخاب آدرس: 
        </h3>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="seperate"></div>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="list-unstyled">
                        <li>{{ Session::get('alert-' . $msg) }}</li>
                    </ul>
                </div>
            @endif
        @endforeach
        @if ($errors->all())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
    </div>  
</div>

<button class="btn btn-info btn-block" onclick="openCreateAddress()"> 
    <i class="fa fa-plus"></i> 
    افزودن آدرس جدید
</button>
<div class="seperate"></div>
<div class="row display-none add-address-css" id="addAdress">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="seperate"></div>
                @include('admin.profile.create-address')
                <div class="seperate"></div>
            </div>
        </div>
    </div>
</div>
<choose-address :provinces_json="{{ json_encode( \Config::get('constants.provinces') ) }}"></choose-address>
<div class="seperate"></div>
<div class="display-none">
    @each('common.basket-box', [$basket], 'basket')
</div>
@endsection
@push('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaTGuyJD5pQKp9i2zkyhg5NJ76RH3vLlA&callback=initMap" type="text/javascript"></script>
<script src="{{ asset('/js/google-map-marker.js') }}"></script>
<script type="text/javascript">
    var boxCreateAddress = document.getElementById('addAdress');
    boxCreateAddress.style.display = 'none';
    function openCreateAddress(){
        if(boxCreateAddress.style.display == 'none'){
            boxCreateAddress.style.display ='block';
        }else{
            boxCreateAddress.style.display ='none';
        }
    }
    
</script>
@endpush
