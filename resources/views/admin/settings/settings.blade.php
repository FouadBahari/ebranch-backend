@extends('layouts.admin')
@section('title',"الاعدادات")

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
                                <li class="breadcrumb-item active"> الاعدادات
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
                                    <h4 class="card-title" id="basic-layout-form">الاعدادات</h4>
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
                                        <form class="form" action="{{route('admin.settings.update')}}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="@if (!empty($admin -> photo))
                                                        {{asset($admin -> photo)}}
                                                            @else
                                                        {{asset("Adminlook/images/logo/logo.png")}}
                                                        @endif"
                                                        class="rounded-circle  height-150" alt="صورة">
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الاعدادات </h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">اللوجو </label>
                                                                    <input type="file" id="name" class="form-control"
                                                                        name="photo">
                                                                    @error("photo")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">اسم الموقع</label>
                                                                    <input type="text" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="اسم الموقع"
                                                                        name="name">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> عمولة الموقع </label>
                                                                    <input type="number" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="عمولة الموقع"
                                                                        name="sitepercent">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> قيمة خدمة التوصيل </label>
                                                                    <input type="number" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="قيمة خدمة التوصيل"
                                                                        name="name">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> قيمة توصيل الشركات </label>
                                                                    <input type="number" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="قيمة توصيل الشركات"
                                                                        name="name">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">حد الائتمان</label>
                                                                    <input type="number" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="حد الائتمان"
                                                                        name="name">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> رابط الاندوريد</label>
                                                                    <input type="url" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="رابط الاندوريد"
                                                                        name="name">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">رابط الايفون</label>
                                                                    <input type="url" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="رابط الايفون"
                                                                        name="name">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">العنوان</label>
                                                                    <input type="text" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="العنوان"
                                                                        name="name">
                                                                    @error("name")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">البريد الالكتروني</label>
                                                                    <input type="email" value="" id="name"
                                                                        class="form-control"
                                                                        placeholder="البريد الالكتروني"
                                                                        name="email">
                                                                    @error("email")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">رقم الهاتف</label>
                                                                    <input type="tel" value="" id="phone"
                                                                        class="form-control"
                                                                        placeholder="رقم الهاتف"
                                                                        name="phone">
                                                                    @error("phone")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <h4 class="form-section"><i class="ft-lock"></i> السوشيال ميديا </h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">الفيس بوك</label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder="اسم الموقع"
                                                                    name="name">
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">لينكيد اين</label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder="لينكيد اين"
                                                                    name="name">
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">اليوتيوب</label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder="اليوتيوب"
                                                                    name="name">
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">تويتر</label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder="تويتر"
                                                                    name="name">
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">الانستقرام</label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder="الانستقرام"
                                                                    name="name">
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">اسناب شات</label>
                                                                <input type="text" value="" id="name"
                                                                    class="form-control"
                                                                    placeholder="اسناب شات"
                                                                    name="name">
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="form-section"><i class="ft-lock"></i> الشروط والاحكام ووصف التطبيق </h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">الشروط والاجكام</label>
                                                                <textarea name="" id=""  class="form-control" cols="30" rows="10" placeholder="الشروط والاجكام"></textarea>
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">من نحن</label>
                                                                <textarea name="" id=""  class="form-control" cols="30" rows="10" placeholder="من نحن"></textarea>
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> وصف التطبيق</label>
                                                                <textarea name="" id=""  class="form-control" cols="30" rows="10" placeholder="وصف التطبيق"></textarea>
                                                                @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">سياسة الخصوصية</label>
                                                                <textarea name="" id=""  class="form-control" cols="30" rows="10" placeholder="سياسة الخصوصية"></textarea>
                                                                @error("name")
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
