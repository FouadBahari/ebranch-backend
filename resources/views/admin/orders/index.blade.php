@extends('layouts.admin')
@section('title',"الطلبات")
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{$page}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{$page}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$page}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered scroll-horizontal">{{--scroll-horizontal--}}
                                        <thead class="">
                                            <tr>
                                                <th>id </th>
                                                <th>المنتجات</th>
                                                <th>السعر</th>
                                                <th>اسم العميل</th>
                                                <th>رقم هاتف</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($orders )
                                            @foreach($orders as $order )
                                            <tr>
                                                <td>{{ $order -> id}}</td>
                                                <td>
                                                    @foreach ($order->products as $index => $product)

                                                    {{ $product->name }} | {{ explode(',', $order->amount)[$index] }} | @php
                                                    $backgroundColor = isset(explode(',', $order->color)[$index]) ? explode(',', $order->color)[$index] : '';
                                                    @endphp

                                                    <div style="display: inline-block; width: 10px; height: 10px; background-color: {{ $backgroundColor }};"></div>
                                                    | حجم : ( {{ explode(',', $order->size)[$index] }})
                                                    <br>
                                                    @endforeach
                                                </td>

                                                <td>{{$order->price}}</td>
                                                <td>{{$order->user->name}}</td>
                                                <td dir="ltr">{{$order->user->phone}}</td>


                                                <td>

                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="" data-toggle="modal" data-target="#exampleModal{{$order->id}}" class="btn btn-outline-primary btn-sm box-shadow-3 mr-2 mb-2">تفاصيل</a>

                                                        <a href="{{route('admin.orders.status',['finished',$order->id])}}" class="btn btn-outline-primary btn-sm box-shadow-3 mr-1 mb-1">مخالصة</a>
                                                    </div>
                                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">تفاصيل</h5>
                                                                </div>
                                                                <form id="invoice" method="get" action="{{route('invoicePrinter') }}" class="modal-body">
                                                                    <table class="table table-bordered ">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>id order</th>
                                                                                <th>اسم المتجر</th>
                                                                                <th>هاتف المتجر</th>
                                                                                <th>العنوان</th>
                                                                                <th>التوصيل</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>{{$order->id}}</td>
                                                                                <td>{{$order-> products[0]->user->name}}</td>
                                                                                <td dir="ltr">{{$order-> products[0]->user->phone}}</td>
                                                                                <td>{{$order->address}}</td>
                                                                                <td>
                                                                                    @if ($order->driver_id == 0 && $order->type == 'home')
                                                                                    العميل يستلم من المتجر
                                                                                    @endif
                                                                                    @if ($order->driver_id == 0 && $order->type == 'charger')
                                                                                    شركات الشحن
                                                                                    @endif
                                                                                    @if ($order->driver_id != 0)
                                                                                    السائق : {{$order->driver->name}}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                                        <button type="submit" data-order-id="{{ $order->id }}" class="btn btn-secondary">Print</button>

                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                </div>
                                </td>

                                @endforeach
                                @endisset
                                </tbody>
                                </table>












                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
</div>
</div>
@endsection