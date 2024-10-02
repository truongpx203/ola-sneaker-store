@extends('admin.layouts.master');

@section('title')
    Them moi san pham
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">









        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
