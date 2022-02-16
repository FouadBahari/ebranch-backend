@extends('layouts.admin')
@section('title'."تعديل المستخدم")
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
                            <li class="breadcrumb-item"><a href="{{route('admin.users')}}"> المستخدمين </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل المستخدم - {{ $user-> name }}
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل المستخدم</h4>
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
                                        <form class="form"
                                            action="{{route('admin.users.update',$user -> id)}}"
                                            method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input name="id" value="{{$user -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                src="@if(!empty($user->photo)){{asset($user->photo)}} @else {{asset('Adminlook/images/logo/logo.png')}} @endif"
                                                        class="rounded-circle  height-150" alt="صورة المشرفين  ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label> صورة المسخدم</label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="image">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المستخدم</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الدولة </label>
                                                            <select name="countery" class="form-control" id="">
                                                                @foreach ($counteries as $cat)
                                                                    <option @if ($cat->id == $user->countery)
                                                                        selected
                                                                    @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("countery")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> المنطقة </label>
                                                            <select name="region" class="form-control" id="">
                                                                @foreach ($regions as $cat)
                                                                    <option @if ($cat->id == $user->region)
                                                                        selected
                                                                    @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("region")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم</label>
                                                            <input type="text" id="name"
                                                                class="form-control"
                                                                placeholder="  "
                                                                value="{{$user -> name}}"
                                                                name="name">
                                                            @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> رقم الهاتف</label>
                                                            <input type="text" id="name"
                                                                class="form-control"
                                                                placeholder="  "
                                                                value="{{$user -> phone}}"
                                                                name="phone">
                                                            @error("phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">البريد الالكتروني</label>
                                                            <input type="email" id="name"
                                                                class="form-control"
                                                                placeholder="  "
                                                                value="{{$user -> email}}"
                                                                name="email">
                                                            @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">كلمة السر</label>
                                                            <input type="password" id="name"
                                                                class="form-control"
                                                                placeholder=" اذا كنت تريد كلمة السر القديمة اترك الحقل فارغ"
                                                                name="password" >
                                                            @error("password")
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
