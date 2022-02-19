@extends('layouts.app')
@section('content')
<table class="table table-striped table-bordered" style="margin-top:70px">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">الصورة</th>
            <th scope="col">الاجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cats as $cat)
            <tr>
                <th scope="row">{{$cat->id}}</th>
                <td>{{$cat->name}}</td>
                <td><img src="{{$cat->photo}}" style="width:50px;height:50px"></td>
                <td>
                    <a href="{{route('vendor.cats.edit',$cat->id)}}" class="btn btn-info">تعديل قسم</a>
                    {{-- <a href="{{route('vendor.cats.edit',$cat->id)}}" class="btn btn-info">حذف قسم</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
