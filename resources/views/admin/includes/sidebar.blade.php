<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
            class="menu-title" data-i18n="nav.add_on_drag_drop.main">الصفحة الرئيسية </span></a>
        </li>

            <li class="nav-item">
                <a href=""><i class="la la-tasks"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الخدمات </span>
                        <span
                            class="badge badge badge-info  badge-pill float-right mr-2">{{App\Models\Service::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{route('admin.services')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.services.create')}}"
                            data-i18n="nav.dash.ecommerce">اضافة خدمة</a>
                        </li>
                    </ul>
            </li>

                <li class="nav-item">
                    <a href=""><i class="la la-users"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">المستخدمين  </span>
                            <span
                                class="badge badge badge-warning  badge-pill float-right mr-2">{{App\User::where('type','user')->count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.users')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.users.create')}}"
                                data-i18n="nav.dash.ecommerce">اضافة مستخدم</a>
                            </li>
                        </ul>
                </li>

                <li class="nav-item">
                    <a href=""><i class="la la-male"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">التجار  </span>
                            <span
                                class="badge badge badge-primary  badge-pill float-right mr-2">{{App\User::where('type','vendor')->count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">اضافة تاجر</a>
                            </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href=""><i class="la la-male"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">السائقين  </span>
                            <span
                                class="badge badge badge-primary  badge-pill float-right mr-2">{{App\User::where('type','driver')->count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">اضافة تاجر</a>
                            </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href=""><i class="la la-building"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">المنتجات</span>
                            <span
                                class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Product::count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">اضافة منتج</a>
                            </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href=""><i class="la la-building"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">كوبونات الخصم  </span>
                            <span
                                class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Coupon::count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.coupons')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.coupons.create')}}"
                                data-i18n="nav.dash.ecommerce">اضافة تاجر</a>
                            </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href=""><i class="la la-bullhorn"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">الطلبات  </span>
                            <span
                                class="badge badge badge-dark  badge-pill float-right mr-2">{{App\Models\Order::count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">الجديدة</a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">جاهز للتوصيل</a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">تحت التنفيذ</a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">جاري التسيم</a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">متعثر</a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">مرتجع</a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">ملغاة</a>
                            </li>
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">خالص</a>
                            </li>
                        </ul>
                </li>

                <li class="nav-item">
                    <a href=""><i class="la la-life-bouy"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">الاشعارات  </span>
                            <span
                                class="badge badge badge-warning  badge-pill float-right mr-2">0</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href=""
                                data-i18n="nav.dash.ecommerce">عرض الكل  </a>
                            </li>
                        </ul>
                </li>
        </ul>
    </div>
</div>
