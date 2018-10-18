@extends('layout.master')
@section('title', 'داشبورد')
@section('container-fluid')

<div class="admin">
	<div class="box-nav">
		<div class="box-nav-inner">
			<div class="items">
				<div class="item">
					<div class="sub-item">
						<div class="half-seperate"></div>
						<a href="{{ url('/') }}" class="big-size black-color">
							<span class="glyphicon glyphicon-home"></span>خانه
							<hr class="hr-class">
						</a>
						
						<a href="{{ url('/admin/profile') }}" class="{{ Request::segment(2) == 'profile' ? 'selected':'' }} ">
							<span class="glyphicon glyphicon-user"></span>پروفایل کاربری</a>
 						<a href="{{ url('/admin/factor') }}" class="{{ Request::segment(2) == 'factor' ? 'selected':'' }} ">
 							<span class="glyphicon glyphicon-shopping-cart"></span>سفارشات من</a>
						<a href="{{ url('/admin/favorite') }}" class="{{ Request::segment(2) == 'favorite' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-heart-empty"></span>مورد علاقه ها</a>
			      		<a href="{{ url('/admin/logout') }}" style="color: red">
							<span class="glyphicon glyphicon-off"></span>خروج</a>
						<div class="half-seperate"></div>
						<hr class="hr-class">
						<div class="half-seperate"></div>
					</div>
					<div class="sub-item">
						@can('factor_manager')
						<a href="{{ url('/admin/manage/factor') }}" class="{{ Request::segment(3) == 'factor' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-shopping-cart"></span>سفارشات
							<label class="label label-danger margin-right-10">
								{{ \App\Models\Factor::where('admin_seen', 0)
									->where('status', '>', 2)->count() }}
							</label>
						</a>
						<a href="{{ url('/admin/manage/report') }}" class=" {{ Request::segment(3) == 'report' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-signal"></span>گزارشات</a>
						
						@endcan	
						@can('user_manager')
						<a href="{{ url('/admin/manage/user') }}" class="{{ Request::segment(3) == 'user' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-user"></span>مدیریت کاربران</a>
						@endcan
						@can('product_manager')
						<a href="{{ url('/admin/manage/product') }}" class="{{ Request::segment(3) == 'product' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-equalizer"></span>محصولات</a>
						<a href="{{ url('/admin/manage/brand') }}" class="{{ Request::segment(3) == 'brand' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-bold"></span>برندها</a>
						<a href="{{ url('/admin/manage/feature') }}" class="{{ Request::segment(3) == 'feature' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-bookmark"></span>ویژگی ها</a>
						@endcan
						@can('category_manager')
						<a href="{{ url('/admin/manage/category') }}" class=" {{ Request::segment(3) == 'category' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-filter"></span>دسته بندی‌ها</a>
						@endcan
						@can('content_manager')
						<a href="{{ url('/admin/manage/content/menu') }}" class="{{ Request::segment(4) == 'menu' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-list"></span>منو</a>
						<a href="{{ url('/admin/manage/content/article') }}" class="{{ Request::segment(4) == 'article' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-book"></span>مقالات</a>
						<a href="{{ url('/admin/manage/content/news') }}" class="{{ Request::segment(4) == 'news' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-book"></span>اخبار</a>
						<a href="{{ url('/admin/manage/content/page') }}" class="{{ Request::segment(4) == 'page' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-duplicate"></span>صفحات</a>	
						<a href="{{ url('/admin/manage/baner') }}" class="{{ Request::segment(3) == 'baner' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-duplicate"></span>بنر ها</a>				
						@endcan
						@can('forum_manager')
						<a href="{{ url('/admin/manage/forum') }}" class="{{ Request::segment(3) == 'forum' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-blackboard"></span>انجمن</a>
						@endcan	
						@can('general_manager')
						<a href="{{ url('/admin/manage/setting') }}" class=" {{ Request::segment(3) == 'setting' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-cog"></span>تنظیمات</a>
						<a href="{{ url('/admin/manage/tagend') }}" class=" {{ Request::segment(3) == 'tagend' ? 'selected':'' }}">
							<span class="fa fa-magnet"></span>زیرفاکتور</a>
						<a href="{{ url('/admin/manage/role') }}" class="{{ Request::segment(3) == 'role' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-eye-open"></span>مدیریت دسترسی</a>
						@endcan
						@can('developer')
						<a href="{{ url('/admin/manage/developer/log') }}" class=" {{ Request::segment(4) == 'log' ? 'selected':'' }}">
							<span class="glyphicon glyphicon-signal"></span>مشاهده لاگ</a>
						@endcan
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box-container">
		<div class="content">
			<div class="half-seperate"></div>
      		<a href="{{ url('/') }}" class="hug-size show-3line">
      			<img src="{{ asset($constant['logo']) }}" alt="{{ $constant['name'] }}" class="admin-logo">
				{{ $constant['name'] }}
			</a>
			<a href="{{ url('/admin/profile') }}" class="margin-right-10">
                <i class="fa fa-user"></i>
                {{ Auth::user() ? Auth::user()->first_name : ''}} 
                {{ Auth::user() ? Auth::user()->last_name : ''}}
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
			<div class="half-seperate"></div>
            <hr class="hr-class">
			<div class="half-seperate"></div>
			@yield('content')
			<div class="seperate"></div>
		</div>
	</div>
</div>

@endsection
@push('script')
<script type="text/javascript">
var acc = document.getElementsByClassName("item-title");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}

</script>
@endpush