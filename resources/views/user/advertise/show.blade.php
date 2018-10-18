@extends('layout.master')
@section('title', $advertise->title )
@section('description', $advertise->title )
@section('image', $constant['logo'])
@section('container')
    <div class="row">
        <div class="col-xs-12">
            <div class="half-seperate"></div>
            <div class="panel-boddy">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="seperate"></div>
                        آگهی شماره {{ $advertise->id }}
                        @if($advertise->image_id)
                            <img src="{{ $advertise->image->src }}" class="img-responsive">
                        @else
                            <div class="seperate"></div>
                            <!-- <div class="text-center">
                            تصویر آپلود نشده است!
                            </div> -->
                        @endif
                        <div class="half-seperate"></div>
                        <div class="bold">

                            عنوان:
                            {{ $advertise->title }}
                            <div class="one-third-seperate"></div>

                        </div>
                        <div class="half-seperate"></div>
                        <div>
                            <label>دسته بندی:</label>
                            {{ $advertise->category ? $advertise->category->title : 'ندارد'}}
                        </div>
                        <div class="half-seperate"></div>
                        تاریخ:
                        -						{{ \Nopaad\jDate::forge( $advertise->updated_at )->format(' %Y/%m/%d') }}
                        -						{{ \Nopaad\jDate::forge( $advertise->updated_at )->format(' %H:%M:%S') }}
                        <hr>
                        <div>
                            <label>متن مقاله:</label>
                            {{ $advertise->content}}
                        </div>
                        <div class="seperate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')



@endpush