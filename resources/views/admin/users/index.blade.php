@extends('layouts.admin')
@section('title',"{{$nametype}}")
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{$nametype}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{$nametype}}
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
                                <h4 class="card-title">{{$nametype}}</h4>
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
                                                <th>الاسم </th>
                                                <th>الهاتف</th>
                                                <th>البريد الالكتروني</th>
                                                @if ($type == "vendor")
                                                <th>الخدمة</th>
                                                @endif
                                                @if ($type == "driver")
                                                <th>المحفظة</th>
                                                <th>التقييم</th>
                                                @endif
                                                <th>العنوان</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($users )
                                            @foreach($users as $user )
                                            <tr>
                                                <td>{{$user-> name}}</td>
                                                <td dir="ltr">{{$user-> phone}}</td>
                                                <td>{{$user-> email}}</td>
                                                @if ($type == "vendor")
                                                <td>{{$user->service->name}}</td>
                                                @endif
                                                @if ($type == "driver")
                                                <td>{{$user->wallet}}</td>
                                                <td>0</td>
                                                @endif
                                                <td>{{$user->address}}</td>
                                                <td>
                                                    <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                                                        <a href="{{route('admin.users.edit',$user -> id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                        <!-- <form method="POST" action="{{ route('admin.users.delete', ['id' => $user->id]) }}">
                                                            @csrf
                                                
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this resource?')">Delete</button>
                                                        </form>

                                                    </div> -->


                                                </td>
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