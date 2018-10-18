@extends('admin.dashboard')

@section('content')
    <h3>بکاپ های سیستم</h3>
    <div class="row">
        <div class="col-xs-12 clearfix">
            <a id="create-new-backup-button" href="{{ url('/admin/manage/backup/create') }}" class="btn btn-primary pull-right"
               style="margin-bottom:2em;"><i
                    class="fa fa-plus"></i> ایجاد بکاپ جدید
            </a>
        </div>
        <div class="col-xs-12">
            @if (count($backups))

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>نام فایل</th>
                        @if(1==2)
                        <th>حجم</th>
                        <th>تاریخ</th>
                        <th>سن</th>
                        @endif
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>
                            @if(1==2)
                            <td>{{ humanFilesize($backup['file_size']) }}</td>
                            <td>
                                {{ formatTimeStamp($backup['last_modified'], 'F jS, Y, g:ia (T)') }}
                            </td>
                            <td>
                                {{ diffTimeStamp($backup['last_modified']) }}
                            </td>
                            @endif
                            <td class="text-right">
                                <a class="btn btn-xs btn-default"
                                   href="{{ url('admin/manage/backup/download/'.$backup['file_name']) }}"><i
                                        class="fa fa-cloud-download"></i> Download</a>
                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="{{ url('admin/manage/backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                    Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="well">
                    <h4>بکاپی موجود نیست</h4>
                </div>
            @endif
        </div>
    </div>
@endsection