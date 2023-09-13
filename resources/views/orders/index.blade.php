@extends('layouts.app')
@section('content')

<table class="table table-striped table-bordered" style="margin-top:70px">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">اسم العميل</th>
            <th scope="col">رقم الهاتف</th>
            <th scope="col">المنتجات | الكمية</th>
            <th scope="col">العنوان</th>
            <th scope="col">الشحن</th>
            <th scope="col">السعر</th>
            <th scope="col">الاجراءات</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($orders as $order)
        <form  method="get" action="{{route('invoicePrinter') }}" >

            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->user->phone}}</td>
                <td>@foreach (App\Models\Product::whereIn('id',explode(',',$order->product_id))->get() as $index=>$item)
                    {{$item->name}} | {{explode(',',$order->amount)[$index]}} <br>
                @endforeach</td>
                <td>{{$order->address}}</td>
                <td>@if ($order->type == 'home')
                    العميل سياتي بنفسة
                @endif
                @if ($order->type == 'driver')
                    سياتي مندوب لاخذ المنتجات
                @endif
                @if ($order->type == 'charger')
                    تم نقلة الي شركة الشحن
                @endif</td>
                <td>{{$order->price}}</td>
                <td>
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <a href="{{route('vendor.orders.status',['accept',$order->id])}}" class="btn btn-info">قبول </a>
                    <a href="{{route('vendor.orders.status',['cancel',$order->id])}}" class="btn btn-danger">رفض </a>
                    <button type="submit"  class="btn btn-secondary">Print</button>
                </td>
            </tr>
        </form>
        @endforeach
    </tbody>
</table>
@endsection
