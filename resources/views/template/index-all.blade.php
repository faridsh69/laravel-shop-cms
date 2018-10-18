@include('module.extra.go-top')
@push('style')

@endpush
@each('module.title.1', ['ماژول مطلب 1 - هدر صفحه بدون عکس'], 'title')
@include('module.content.1')
@each('module.title.1', ['ماژول مطلب 2 - هدر صفحه با عکس'], 'title')
@include('module.content.2')
@each('module.title.1', ['ماژول مطلب 3 - نمایش عکس گوگلی سمت چپ'], 'title')
@include('module.content.3')
@each('module.title.1', ['ماژول مطلب 4 - نمایش عکس تمام صفحه'], 'title')
@include('module.content.4')
@each('module.title.1', ['ماژول مطلب 5 - نمایش عکس گوگلی سمت راست'], 'title')
@include('module.content.5')
@each('module.title.1', ['ماژول مطلب 6 - مزیت رقابتی ساده و شکیل'], 'title')
@include('module.content.6')
@each('module.title.1', ['ماژول مطلب 7 - مزیت رقابتی با تصویر'], 'title')
@include('module.content.7')
@each('module.title.1', ['ماژول مطلب 8 - مزیت رقابتی با آیکون'], 'title')
@include('module.content.8')
@each('module.title.1', ['ماژول مطلب 9 - نمونه کار'], 'title')
@include('module.content.9')
@each('module.title.1', ['ماژول مطلب 10 - نمونه کار 2'], 'title')
@include('module.content.10')
<div class="container-fluid">
	<div class="seperate"></div>
	<div class="seperate"></div>
	@each('module.title.1', ['ماژول اخبار 1 - سایدبار'], 'title')
	@include('module.news.1')
	@each('module.title.1', ['ماژول اخبار 2 - دیجی کالا'], 'title')
	@include('module.news.2')
	@each('module.title.1', ['ماژول اخبار 3 - دیجی مگ'], 'title')
	@include('module.news.3')
	@each('module.title.1', ['ماژول اخبار 4 - ساده و شکیل'], 'title')
	@include('module.news.4')
	<div class="seperate"></div>
	<div class="seperate"></div>
	<div class="seperate"></div>
	@each('module.title.1', ['ماژول برندها و همکاران 1 - سایدبار'], 'title')
	<div class="row">
		<div class="col-sm-4 col-md-3">
			@include('module.brand.1')
		</div>
	</div>
	@each('module.title.1', ['ماژول برندها و همکاران 2 - با عنوان'], 'title')
	@include('module.brand.2')
	@each('module.title.1', ['ماژول برندها و همکاران 3 - بدون عنوان'], 'title')
	@include('module.brand.3')
</div>
@each('module.title.1', ['ماژول برندها و همکاران 4 - 12 تایی شکیل'], 'title')
@include('module.brand.4')
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
@each('module.title.1', ['ماژول بنر 1 - 2 - دیجی کالایی بنر و پیشنهاد لحظه ای'], 'title')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			@include('module.baner.1')
		</div>
		<div class="col-md-3">
			@include('module.baner.2')
		</div>
		<div class="col-md-3">
			@include('module.baner.3')
		</div>
		<div class="col-md-3">
			@include('module.baner.4')
		</div>
	</div>
	@each('module.title.1', ['ماژول اسلایدر 1 - ساده و شکیل'], 'title')
	<div class="row">
		<div class="col-xs-6">
			@include('module.slider.1')
		</div>
		<div class="col-xs-6">
			@include('module.slider.2')
		</div>
	</div>
</div>


<div class="seperate"> </div>
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Email</th>
			</tr>
		</thead>
	    <tbody>
			<tr>
			<td>Default</td>
			<td>Defaultson</td>
			<td>def@somemail.com</td>
			</tr>      
			<tr class="success">
			<td>Success</td>
			<td>Doe</td>
			<td>john@example.com</td>
			</tr>
			<tr class="danger">
			<td>Danger</td>
			<td>Moe</td>
			<td>mary@example.com</td>
			</tr>
			<tr class="info">
			<td>Info</td>
			<td>Dooley</td>
			<td>july@example.com</td>
			</tr>
			<tr class="warning">
			<td>Warning</td>
			<td>Refs</td>
			<td>bo@example.com</td>
			</tr>
			<tr class="active">
			<td>Active</td>
			<td>Activeson</td>
			<td>act@example.com</td>
			</tr>
    	</tbody>
  	</table>

  	<div class="well">Basic Well</div>
  	<div class="alert alert-success">
		<strong>Success!</strong> Indicates a successful or positive action.
	</div>

	<div class="alert alert-info">
		<strong>Info!</strong> Indicates a neutral informative change or action.
	</div>

	<div class="alert alert-warning">
		<strong>Warning!</strong> Indicates a warning that might need attention.
	</div>

	<div class="alert alert-danger">
		<strong>Danger!</strong> Indicates a dangerous or potentially negative action.
	</div>

	<button type="button" class="btn">Basic</button>
	<button type="button" class="btn btn-default">Default</button>
	<button type="button" class="btn btn-primary">Primary</button>
	<button type="button" class="btn btn-success">Success</button>
	<button type="button" class="btn btn-info">Info</button>
	<button type="button" class="btn btn-warning">Warning</button>
	<button type="button" class="btn btn-danger">Danger</button>
	<button type="button" class="btn btn-link">Link</button>

	<div class="container">
  		<h2>Panels with Contextual Classes</h2>
		<div class="panel panel-default">
			<div class="panel-heading">Panel with panel-default class</div>
			<div class="panel-body">Panel Content
				Panel Content Panel Content Panel Content Panel Content
				Panel Content Panel Content Panel Content Panel Content
				Panel Content Panel Content Panel Content Panel Content
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading">Panel with panel-primary class</div>
			<div class="panel-body">Panel Content</div>
		</div>

		<div class="panel panel-success">
			<div class="panel-heading">Panel with panel-success class</div>
			<div class="panel-body">Panel Content</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">Panel with panel-info class</div>
			<div class="panel-body">Panel Content</div>
		</div>

		<div class="panel panel-warning">
			<div class="panel-heading">Panel with panel-warning class</div>
			<div class="panel-body">Panel Content</div>
		</div>

		<div class="panel panel-danger">
			<div class="panel-heading">Panel with panel-danger class</div>
			<div class="panel-body">Panel Content</div>
		</div>
	</div>

	<form action="/action_page.php">
		<div class="form-group">
			<label for="email">Email address:</label>
			<input type="email" class="form-control" id="email">
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd">
		</div>
		<div class="checkbox">
			<label><input type="checkbox"> Remember me</label>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>