<form enctype="multipart/form-data" action="/admin/profile/charge-credit" method="POST">
	{{ csrf_field() }}
	<div class="panel panel-success">
	<div class="panel-heading">	شارژ حساب کاربری</div>
    <div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<td>مبلغ مورد نظر به تومان:</td>
			<td>
			<input type="number" name="charge-credit" class="form-control">
			<div class="help-block">
				مبلغ را به تومان وارد نمایید و بزرگتر از ۱۰۰۰ باشد.
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<button type="submit" class="btn btn-primary btn-block">پرداخت</button>
			</td>
		</tr>
	</table>			
	</div>
	</div>
</form>
