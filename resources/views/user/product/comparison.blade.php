@extends('layout.master')
@section('title','مقایسه املاک')
@section('image','/images/logo.png')
@section('keywords','Melkana,ملکانا,تور مجازی , فروش خانه , اجاره خانه')
@section('description', 'ملکانا وب سایتی مطمئن برای خرید و فروش ملک، رهن و اجاره خانه در شهر تهران با نمایش موقعیت ملک در نقشه و تصاویر 360 درجه و تور مجازی')
@push('style')
    <link href="{{asset('css/comparison-table.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('container')

<div class="seperate"></div>
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

<div class="row">
    <div class="col-xs-12">
        <h3>
            مقایسه کالاها با کدهای :
        </h3>
    </div>
    <div class="seperate"></div>
    <div class="col-lg-5 col-sm-8 col-xs-12">
        <ol class="list-group">
        @foreach($products as $key => $product)
            <li class="list-group-item">
                <label>
                    کد کالا:
                </label>
                <a href="/product/{{ $product->id }}" class="margin-right-10">
                    {{ $product->id}}
                </a>
                <a href="/product/comparison/remove/{{ $product->id }}" class="pull-left">
                    <i class="fa fa-remove"></i>
                </a>
            </li>
        @endforeach
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form class="form-inline" method="post" action="/product/comparison/add">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="product_id">کد کالا:</label>
                <input type="text" id="product_id" name="product_id" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">افزودن به لیست مقایسه</button>
            </div>
        </form>
    </div>
</div>
<div class="seperate"></div>
<div class="row">
    <div class="col-md-12">
        <div class="limiter">
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100 ver1 m-b-110">
                        <table data-vertable="ver1">
                            <thead>
                            <tr class="row100 head">
                                <th class="column100 column1" data-column="column1"></th>
                                @foreach($features as $key => $feature)
                                    <th class="column100 column{{$key+2}}" data-column="column{{$key+2}}">
                                        شماره {{ $feature }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product_datas as $product_data)
                                <tr class="row100">
                                    @foreach($product_data as $key => $data)
                                        <td class="column100 column{{$key+1}}" data-column="column1">{!! $data !!}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
@push('script')
    <script src="{{asset('js/comparison-table.js') }}"></script>
@endpush