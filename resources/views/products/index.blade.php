@extends('layouts.app')
@section('content')
<table class="table table-striped table-bordered" style="margin-top:70px">
    <thead>
        <tr>
            <th scope="col">الاسم</th>
            <th scope="col">الصورة</th>
            <th scope="col">التصنيف</th>
            <th scope="col">الكمية</th>
            <th scope="col">العرض</th>
            <th scope="col">الاجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td><img src="{{$product->photo}}" style="width:50px;height:50px"></td>
                <td>{{$product->cat->name}}</td>
                <td>{{$product->amount}}</td>
                <td>@if ($product->offer != 0)
                    @else
                    لايوجد
                @endif</td>
                <td>
                    <a href="{{route('vendor.products.edit',$product->id)}}" class="btn btn-info">تعديل </a>
                    {{-- <a href="{{route('vendor.products.edit',$product->id)}}" class="btn btn-info">حذف قسم</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
