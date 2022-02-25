@extends('layouts.admin')
@section('title','لوحة التحكم')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div id="crypto-stats-3" class="row">
                <div class="col-12 col-md-12 col-xl-12 col-lg-12 text-center mb-2">
                    <a href="#" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal"><i class="la la-send"></i> ارسال اشعارات</a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">اشعارات</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{route('admin.send.messages')}}">
                                @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">اختر لمن تريد الارسال</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="type" required>
                                    <option value="all"> الكل</option>
                                    <option value="user">المستخدمين</option>
                                    <option value="vendors">التجار</option>
                                    <option value="deleveries">السائقين</option>
                                </select>
                            </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">عنوان الرسالة</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="title" placeholder="عنوان الرسالة" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">محتوي الرسالة</label>
                                    <textarea name="content" class="form-control" placeholder="محتوي الرسالة" col="50" row="20" required> </textarea>
                                </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary"> ارسال</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="warning">{{App\Models\Order::whereIn('status',['تم الموافقة من السائق','تم الموافقة من المتجر'])->count()}}</h3>
                            <h6>الطلبات تحت التنفيذ</h6>
                        </div>
                        <div>
                            <i class="la la-history warning font-large-2 float-right"></i>
                        </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: {{App\Models\Order::whereIn('status',['تم الموافقة من السائق','تم الموافقة من المتجر'])->count()}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="info">{{App\Models\Order::where('status','مخالصة')->count()}}</h3>
                            <h6>الطلبات الخالصة</h6>
                        </div>
                        <div>
                            <i class="la la-check  info font-large-2 float-right"></i>
                        </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: {{App\Models\Order::where('status','مخالصة')->count()}}%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="success">{{App\Models\Order::where('status','جديد')->count()}}</h3>
                            <h6>الطلبات الجديدة</h6>
                        </div>
                        <div>
                            <i class="la la-bullhorn  success font-large-2 float-right"></i>
                        </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{App\Models\Order::where('status','جديد')->count()}}%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="warning">{{App\Models\Order::where('status','الطلب مرتجع')->count()}}</h3>
                            <h6>الطلبات المرتجعة</h6>
                        </div>
                        <div>
                            <i class="la la-calendar  warning font-large-2 float-right"></i>
                        </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: {{App\Models\Order::where('status','الطلب مرتجع')->count()}}%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="info">{{App\Models\Order::where('status','الطلب متعثر')->count()}}</h3>
                            <h6>الطلبات المتعثرة</h6>
                        </div>
                        <div>
                            <i class="la la-times  info font-large-2 float-right"></i>
                        </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: {{App\Models\Order::where('status','الطلب متعثر')->count()}}%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="danger">{{App\Models\Order::where('status','الطلب ملغي')->count()}}</h3>
                            <h6>الطلبات الملغاة</h6>
                        </div>
                        <div>
                            <i class="icon-ban  danger font-large-2 float-right"></i>
                        </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: {{App\Models\Order::where('status','الطلب ملغي')->count()}}%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Candlestick Multi Level Control Chart -->
            </div>
            <!-- Products sell and New Orders -->
        <div class="row match-height">
            <div class="col-xl-12 col-12" id="ecommerceChartView">
                <div class="card card-shadow">
                    <div class="card-header card-header-transparent py-20">
                        <div class="btn-group dropdown">
                            <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">تصنيف</a>
                            <div class="dropdown-menu animate" role="menu">
                                <a class="dropdown-item" href="#" role="menuitem">الطلبات الملغاة</a>
                                <a class="dropdown-item" href="#" role="menuitem"> الطلبات المتعثرة</a>
                                <a class="dropdown-item" href="#" role="menuitem"> الطلبات المرتجعة</a>
                            </div>
                        </div>
                        <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                            <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">اليوم</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">الاسبوع</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">الشهر</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content bg-white p-20">
                        <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>
                        <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
                        <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Products sell and New Orders -->
        </div>

    </div>
</div>


@endsection

