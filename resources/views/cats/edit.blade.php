@extends('layouts.app')
@section('content')
<form action="{{route('vendor.cats.update',$cat->id)}}" method="POST" enctype="multipart/form-data" style="margin-top:70px">
    @csrf
    <input type="hidden" name="id" value="{{$cat->id}}">
    <div class="form-group text-center">
        <img src="{{asset($cat->photo)}}" style="width: 100px;height:100px">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">الصورة</label>
        <input type="file" class="form-control" name="photo" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">الاسم</label>
        <input type="text" class="form-control" name="name"  id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$cat->name}}">
    </div>
    <button type="submit" class="btn btn-primary btn-block">اضافة</button>
</form>
@endsection
