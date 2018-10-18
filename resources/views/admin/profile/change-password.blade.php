<form enctype="multipart/form-data" action="/admin/profile/change-password" method="POST">
	{{ csrf_field() }}
	<div class="panel panel-default">
	<div class="panel-heading">	تغییر رمز عبور</div>
    <div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<td width="140px">رمز عبور قدیم:</td>
			<td><input type="text" name="oldpassword" class="form-control"></td>
		</tr>
		<tr>
			<td>رمز عبور جدید</td>
			<td><input type="text" name="newpassword" class="form-control"></td>
		</tr>
		<tr>
			<td colspan="2">
			<button type="submit" class="btn btn-danger btn-block">  تغییر رمز</button>
			</td>
		</tr>
	</table>			
	</div>
	</div>
</form>
