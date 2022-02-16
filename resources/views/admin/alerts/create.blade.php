@extends('layouts.admin')
@section('title',"اضافة مستخدم")
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
                            <li class="breadcrumb-item"><a href="{{route('admin.users',$type)}}"> المستخدمين </a>
                                </li>
                                <li class="breadcrumb-item active">اضافة مستخدم
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
                                    <h4 class="card-title" id="basic-layout-form"> اضافة مستخدم</h4>
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
                                        <form class="form" action="{{route('admin.users.store')}}"
                                            method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input name="type" type="hidden" value="{{$type}}">
                                            <div class="form-group">
                                                <label> صورة المستخدم ان وجد </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="image" />
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المستخدم </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> الدولة </label>
                                                                    <select name="countery" class="form-control" id="">
                                                                        @foreach ($counteries as $cat)
                                                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
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
                                                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error("region")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> الاسم </label>
                                                                    <input type="text" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="  "
                                                                        name="name">
                                                                    @error("name")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> رقم الهاتف </label>
                                                                    <input type="tel" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="  "
                                                                        name="phone">
                                                                    @error("phone")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">البريد الالكتروني </label>
                                                                    <input type="email" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="  "
                                                                        name="email">
                                                                    @error("email")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">كلمة السر</label>
                                                                    <input type="password" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="  "
                                                                        name="password">
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
                                                    <i class="la la-check-square-o"></i> حفظ
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
