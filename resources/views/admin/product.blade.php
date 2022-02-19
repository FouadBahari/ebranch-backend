@extends('layouts.admin')
@section('title',"المنتجات")
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  المنتجات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> المنتجات
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
                                    <h4 class="card-title">المنتجات</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">{{--scroll-horizontal--}}
                                            <thead class="">
                                            <tr>
                                                <th>الاسم </th>
                                                <th>الصورة</th>
                                                <th>السعر</th>
                                                <th>الكمية</th>
                                                <th>اسم التاجر</th>
                                                <th>التصنيف</th>
                                                <th>العرض</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($products )
                                                @foreach($products  as $product )
                                                    <tr>
                                                        <td>{{$product-> name}}</td>
                                                        <td><img
                                                            src="@if (!empty($product -> photo))
                                                            {{asset($product -> photo)}}
                                                                @else
                                                            {{asset("Adminlook/images/logo/logo.png")}}
                                                            @endif"
                                                            class="rounded-circle  height-50" alt="صورة">
                                                        </td>
                                                        <td>{{$product-> price}}</td>
                                                        <td>{{$product-> amount}}</td>
                                                        <td>{{$product-> user->name}}</td>
                                                        <td>{{$product-> cat->name}}</td>
                                                        <td>{{$product->offer}}%</td>
                                                    </tr>
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
