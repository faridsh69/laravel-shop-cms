@extends('layout.master')
@section('title', 'ورود کاربران')
@section('description', 'ورود کاربران' )
@section('image', $constant['logo'])
@section('container')
<div class="google-background">
<svg jsname="BUfzDd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 810" preserveAspectRatio="xMinYMin slice" aria-hidden="true"><path fill="#efefee" d="M592.66 0c-15 64.092-30.7 125.285-46.598 183.777C634.056 325.56 748.348 550.932 819.642 809.5h419.672C1184.518 593.727 1083.124 290.064 902.637 0H592.66z" /><path fill="#f6f6f6" d="M545.962 183.777c-53.796 196.576-111.592 361.156-163.49 490.74 11.7 44.494 22.8 89.49 33.1 134.883h404.07c-71.294-258.468-185.586-483.84-273.68-625.623z" /><path fill="#f7f7f7" d="M153.89 0c74.094 180.678 161.088 417.448 228.483 674.517C449.67 506.337 527.063 279.465 592.56 0H153.89z" /><path fill="#fbfbfc" d="M153.89 0H0v809.5h415.57C345.477 500.938 240.884 211.874 153.89 0z" /><path fill="#ebebec" d="M1144.22 501.538c52.596-134.583 101.492-290.964 134.09-463.343 1.2-6.1 2.3-12.298 3.4-18.497 0-.2.1-.4.1-.6 1.1-6.3 2.3-12.7 3.4-19.098H902.536c105.293 169.28 183.688 343.158 241.684 501.638v-.1z" /><path fill="#e1e1e1" d="M1285.31 0c-2.2 12.798-4.5 25.597-6.9 38.195C1321.507 86.39 1379.603 158.98 1440 257.168V0h-154.69z" /><path fill="#e7e7e7" d="M1278.31,38.196C1245.81,209.874 1197.22,365.556 1144.82,499.838L1144.82,503.638C1185.82,615.924 1216.41,720.211 1239.11,809.6L1439.7,810L1439.7,256.768C1379.4,158.78 1321.41,86.288 1278.31,38.195L1278.31,38.196z" /></svg>
</div>
<div class="row">
    <div class="col-xs-12">
        <h3 class="text-center">
            <a href="{{ url('user/register') }}"> ثبت نام </a> / ورود
        </h3> 
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" action="{{ url('/user/login') }}">
                    {{ csrf_field() }}
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
                    <div class="form-group">
                        <label for="phone">شماره همراه:</label>
                        <input type="text" class="form-control ltr" id="phone" name="phone" required>
                         <div class="help-block">مثال: 09123456789 </div>   
                    </div>
                    <div class="form-group">
                        <label for="pwd">رمز عبور:</label>
                        <input type="text" class="form-control ltr" id="pwd" name="password" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="always" name="always" value="1">
                        <label for="always">مرا به خاطر بسپار!</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">ورود</button>
                </form>
                <hr>
                <div class="half-seperate">  </div>
                <a href='/user/register' class="text-center">ثبت نام</a>
                <div class="half-seperate"></div>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#sms-modal">
                رمز عبور خود را فراموش کرده اید؟
                </a>
            </div>
        </div>
    </div>
</div>
<div class="double-seperate"></div>
<div class="double-seperate"></div>
<div class="modal fade" id="sms-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">فراموشی رمز عبور</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('user/forget-password') }}" method="post">
                    {{ csrf_field() }}
                    <p class="bold">
                        شماره همراه:
                    </p>
                    <input type="text" name="phone" class="form-control">
                    <div class="help-block">مثال: 09123456789</div>
                    <div class="half-seperate"></div>
                    <button class="btn btn-success btn-block">ارسال رمز عبور جدید</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection