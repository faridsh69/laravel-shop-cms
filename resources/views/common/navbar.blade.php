@if(request::segment(1) != 'admin')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xs-9">
            <div class="half-seperate"></div>
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-6">
                    <a href="{{ url('/') }}">
                        <span class="hidden-xs">
                            به
                        </span>
                        <span class="nowrap-word">
                            {{ $constant['name'] }}
                        </span>
                        <span class="hidden-xs">
                            خوش آمدید!
                        </span>
                    </a>
                    <div class="half-seperate visible-xs"></div>
                    <!-- <div class="language-box">
                        <a href="/language/fa"><img src="{{ asset('images/iran.png') }}" class="language-icon"></a>
                        <a href="/language/en"><img src="{{ asset('images/englis.png') }}" class="language-icon"></a>
                    </div> -->
                    @if(empty(Auth::user()))
                        <a href="{{ url('/user/register') }}" class="margin-right-15">
                            <i class="fa fa-user"></i> ثبت نام
                        </a>
                        |
                        <a href="{{ url('/user/login') }}" class=""><i class="fa fa-sign-in"></i> ورود</a>
                    @else
                        <div class="half-seperate visible-xs"></div>
                        <a href="{{ url('/admin/profile') }}" class="margin-right-15">
                            <i class="fa fa-user"></i>
                            {{ Auth::user() ? Auth::user()->first_name : ''}} 
                            {{ Auth::user() ? Auth::user()->last_name : ''}}
                            <!-- <label class="label label-default" style="margin:3px;padding: 0px 7px 0px 7px">
                            اعتبار: {{ \Nopaad\Persian::correct(number_format( Auth::user()->credit , 0, '',',')) }} تومان
                            </label> -->
                            <span class="hidden-xs"> 
                                @if(\Auth::user()->roles()->count() > 0)
                                <span>
                                    @foreach(\Auth::user()->roles()->pluck('name') as $role)
                                        <small>
                                            <span class="label label-info">{{ trans('roles.' . $role) }}</span>
                                        </small>
                                    @endforeach
                                </span>
                                @endif
                            </span>
                        </a>
                    @endif
                </div>
                <div class="col-md-3 col-sm-4 col-xs-5">
                    <ul class="list-inline margin-0 pull-left">
                        <li class="li-no-decoration">
                            <a href="tel:{{ $constant['mobile'] }}" class="a-no-decoration">
                                <i class="fa fa-phone margin-right-5 font-13 color-gray hidden-xs"></i>
                                <span class="">{{ $constant['mobile'] }}</span>
                            </a>
                        </li>
                        <!-- <li class="li-no-decoration visible-xs">
                            <i class="fa fa-search font-13 color-gray"></i>
                        </li> -->
                        <li class="li-no-decoration">
                            <div class="half-seperate"></div>
                            <a href="{{ url('/basket') }}" class="btn btn-xs btn-success visible-xs">
                                سبدخرید
                                <i class="fa fa-shopping-cart"></i>
                                {{ \App\Http\Services\FactorService::_getUserBasketCountProducts() }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="half-seperate"></div>
            <div class="half-seperate"></div>
            <div class="row hidden-xs">
                <div class="col-lg-2 col-sm-3 col-xs-4">
                    <div class="btn-group">
                        <a href="{{ url('/basket') }}" class="btn btn-success">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="label label-warning">
                            {{ \App\Http\Services\FactorService::_getUserBasketCountProducts() }}
                            </span>
                            <span class="margin-right-5">سبد خرید</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <search-product></search-product>
                </div>
                <div class="half-seperate"></div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-3">
            <div class="seperate"></div>
            <a class="" href="{{ url('/') }}"> 
                <img src="{{ asset($constant['logo']) }}" alt="{{ $constant['name'] }}" class="header-logo">
            </a>
            <div class="seperate"></div>
        </div>
    </div>
</div>

@if(1==2)
<nav class="navbar navbar-default background-nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <i class="fa fa-dedent"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}" class="draw"> <i class="fa fa-home"></i> خانه </a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle draw" data-toggle="dropdown" href="{{ url('/product') }}">
                        <i class="fa fa-shopping-basket"></i>
                        محصولات
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Category::Product()->Active()->get() as $category)
                        <li><a href="{{ url('/product/category/' . $category->id) }}">{{ $category->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @foreach(\App\Models\Menu::Active()->get() as $menu)
                <li><a href="{{ url($menu->url) }}" class="draw">{{ $menu->title }}</a></li>
                @endforeach
                @foreach(\App\Models\Page::Active()->get() as $page)
                <li>
                    <a href="{{ url('/content/page/'. $page->id) }}" class="draw">
                        {{ $page->title }}
                    </a>
                </li>
                @endforeach
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#contact-us-modal" class="draw">تماس با ما</a></li>
            </ul>
        </div>
    </div>
</nav>
@endif
@else
@endif


@if(request::segment(1) != 'admin')
<nav class="uk-navbar-container" uk-navbar>
    <div class="container">
    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
            <li>
                <a href="/"> <i class="fa fa-home margin-left-10"></i> خانه </a>
            </li>
            <li>
                <a href="#">محصولات <span class="caret"></span> </a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                    <div class="uk-navbar-dropdown-grid uk-child-width-1-5" uk-grid>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">دی وی دی های درسی</li>
                                <li class="uk-nav-divider"></li>
                                <li class="uk-active"><a href="#">فیزیک</a></li>
                                <li><a href="#">شیمی</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">دی وی دی های کنکوری</li>
                                <li class="uk-nav-divider"></li>
                                <li class=""><a href="#">فیزیک</a></li>
                                <li><a href="#">شیمی</a></li>
                                <li><a href="#">ریاضی</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">کتب کنکوری</li>
                                <li class="uk-nav-divider"></li>
                                <li class=""><a href="#">زیست</a></li>
                                <li><a href="#">شیمی</a></li>
                                <li><a href="#">ریاضی</a></li>
                                <li><a href="#">فیزیک</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">کتب درسی</li>
                                <li class="uk-nav-divider"></li>
                                <li class=""><a href="#">زیست</a></li>
                                <li><a href="#">شیمی</a></li>
                                <li><a href="#">ریاضی</a></li>
                                <li><a href="#">فیزیک</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">بانک تست</li>
                                <li class="uk-nav-divider"></li>
                                <li class=""><a href="#">زیست</a></li>
                                <li><a href="#">شیمی</a></li>
                                <li><a href="#">ریاضی</a></li>
                                <li><a href="#">فیزیک</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>

            @foreach(\App\Models\Menu::Active()->get() as $menu)
                <li>
                    <a href="{{ url($menu->url) }}" class="">
                        {{ $menu->title }}  
                    </a>
                </li>
            @endforeach
            @foreach(\App\Models\Page::Active()->get() as $page)
                <li>
                    <a href="{{ url('/content/page/'. $page->id) }}" class="">
                        {{ $page->title }}
                    </a>
                </li>
            @endforeach
            <li>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#contact-us-modal">
                    تماس با ما
                </a>    
            </li>
        </ul>
    </div>

</nav>
@endif
        
@if(Request::segment(1) != 'admin')
<img src="{{ asset('/images/shadow-3.png') }}" class="background-nav-shadow" alt="shadow png">
@else
@endif
<div class="modal fade" id="contact-us-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">تماس با {{ $constant['name'] }}</h4>
            </div>
            <div class="modal-body contact-us-box">
                <h4 class="text-center bold">
                    {{ $constant['name'] }}
                </h4>
                <p class="rtl">
                    تلفن ثابت:
                    {{ $constant['phone'] }}
                </p>
                <p>
                    تلفن همراه:
                    {{ $constant['mobile'] }}
                </p>
                <p>
                    ایمیل:
                    {{ $constant['email'] }}
                </p>
                <p>
                    آدرس تلگرام:
                    <a href="https://telegram.me/{{ $constant['telegram'] }}">
                        {{ $constant['telegram'] }}
                    </a>
                </p>
                <p>
                    آدرس اینستاگرام:
                    <a href="https://www.instagram.com/{{ $constant['instagram'] }}"> 
                    {{ $constant['instagram'] }}
                    </a>
                </p>
                <p>
                    فکس:
                    {{ $constant['fax'] }}
                </p>
                <p>
                    آدرس:
                    {{ $constant['address'] }}
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="about-us-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">معرفی مرکز</h4>
            </div>
            <div class="modal-body">
                <h3 class="text-center bold">
                    {{ $constant['name'] }}
                </h3>
                <div class="seperate"></div>
                <h5 class="line-height-180">
                    {{ $constant['description'] }}
                </h5>
            </div>
        </div>
    </div>
</div>
