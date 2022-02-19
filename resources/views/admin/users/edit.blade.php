@extends('layouts.admin')
@section('title',"تعديل {{$nametype}}")

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users',$user->type)}}">  {{$nametype}} </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل {{$nametype}} - {{$user->name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل  {{$nametype}}  </h4>
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
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.users.update',$user -> id)}}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$user -> id}}" type="hidden">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="@if (!empty($user-> photo))
                                                        {{asset($user -> photo)}}
                                                            @else
                                                        {{asset("Adminlook/images/admin.png")}}
                                                        @endif"
                                                        class="rounded-circle  height-150" alt="صورة">
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات {{$nametype}}  </h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">صورة  {{$nametype}}  </label>
                                                                    <input type="file" value="" id="name" class="form-control"
                                                                        name="photo" required>
                                                                    @error("photo")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            @if ($user->type == "vendor")
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الخدمات</label>
                                                                        <select name="service_id" id=""   class="form-control" @if ($user->type == "vendor") required @endif>
                                                                            @foreach ($services as $service)
                                                                                <option value="{{$service->id}}" @if ($service->id == $user->service_id)
                                                                                    selected
                                                                                @endif>{{$service->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @error("service_id")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم {{$nametype}}  </label>
                                                                    <input type="text" value="{{$user->name}}" id="name"
                                                                        class="form-control"
                                                                        placeholder="اسم {{$nametype}} "
                                                                        name="name" required>
                                                                    @error("name")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> رقم الهاتف </label>
                                                                    <input type="tel" value="{{$user->phone}}" id="phone"
                                                                        class="form-control"
                                                                        placeholder=" رقم الهاتف"
                                                                        name="phone" required dir="ltr">
                                                                    @error("phone")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> البريد الالكتروني</label>
                                                                    <input type="email" value="{{$user->email}}" id="email"
                                                                        class="form-control"
                                                                        placeholder=" البريد الالكتروني"
                                                                        name="email" required>
                                                                    @error("email")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">كلمة السر</label>
                                                                    <input type="password" value="" id="password"
                                                                        class="form-control"
                                                                        placeholder="اذا اردت كلمة السر القديم اترك الحقل فارغ"
                                                                        name="password" required>
                                                                    @error("password")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">العنوان</label>
                                                                    <input type="url" value="{{$user->address}}"  id="address"
                                                                        class="form-control"
                                                                        placeholder="العنوان"
                                                                        name="address" required>
                                                                    @error("address")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                    </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
