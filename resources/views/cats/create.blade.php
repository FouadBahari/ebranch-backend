@extends('layouts.app')
@section('content')
<form action="{{route('vendor.cats.store')}}" method="POST" enctype="multipart/form-data" style="margin-top:70px">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">الصورة</label>
        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="photo">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">الاسم</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الاسم">
    </div>
    <button type="submit" class="btn btn-primary btn-block">اضافة</button>
</form>
@endsection
