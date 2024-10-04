@extends('admin.layouts.master');

@section('title')
    Them moi san pham
@endsection

@section('content')
    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <label for="" class="form-label">Tên:</label>
            <input type="text" name="name" class="form-control">
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
