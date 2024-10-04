@extends('admin.layouts.master');

@section('title')
    Xem Chi Tiet San Pham
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Xem chi tiết danh mục</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <ul>
                                    @foreach (collect($category)->toArray() as $key=>$value)
                                        <li>{{$key}} : {{$value}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div><!-- end card header -->
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
