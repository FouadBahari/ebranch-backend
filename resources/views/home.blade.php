@extends('layouts.app')

@section('content')
<div class="card-columns" style="margin-top:70px">
    <div class="card bg-danger">
      <div class="card-body text-center">
        <p class="card-text">الطلبات</p>
        <h4>0</h4>
      </div>
    </div>
    <div class="card bg-success">
      <div class="card-body text-center">
        <p class="card-text">الاقسام</p>
        <h4>{{App\Models\Cat::where('user_id',Auth::id())->count()}}</h4>
      </div>
    </div>
    <div class="card bg-info">
      <div class="card-body text-center">
        <p class="card-text">المنتجات</p>
        <h4>{{App\Models\Product::where('user_id',Auth::id())->count()}}</h4>
      </div>
    </div>
  </div>
  <style>
      .mylables{
        float: right !important;
      }
  </style>
  <form action="{{route('post.profile')}}" method="POST" enctype="multipart/form-data" style="margin-bottom:70px">
    @csrf
    <div class="form-group text-center">
        <img src="{{asset(Auth::user()->photo)}}" style="width: 100px;height:100px">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">الصورة</label>
        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="photo">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">الاسم</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Auth::user()->name}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">البريد الاكتروني</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{Auth::user()->email}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1 mylables">رقم الهاتف</label>
        <input type="tel" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" value="{{Auth::user()->phone}}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1 mylables">كلمة المرور</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="اذا كنت تريد كلمة المرور القديمة اترك الحقل فارغ">
    </div>
    <button type="submit" class="btn btn-primary btn-block">تحديث</button>
</form>
@endsection
