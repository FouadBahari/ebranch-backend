<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
            class="menu-title" data-i18n="nav.add_on_drag_drop.main">الصفحة الرئيسية </span></a>
        </li>
        {{-- <li class="nav-item">
                <a href=""><i class="la la-tasks"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الدول </span>
                        <span
                            class="badge badge badge-info  badge-pill float-right mr-2">{{App\Models\Countery::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{route('admin.counteries')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.counteries.create')}}"
                            data-i18n="nav.dash.ecommerce">اضافة دولة</a>
                        </li>
                    </ul>
            </li> --}}

            <li class="nav-item">
                <a href=""><i class="la la-tasks"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الاقسام </span>
                        <span
                            class="badge badge badge-info  badge-pill float-right mr-2">{{App\Models\Service::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{route('admin.services')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.services.create')}}"
                            data-i18n="nav.dash.ecommerce">اضافة قسم</a>
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
                            <li><a class="menu-item" href="{{route('admin.users','user')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
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
                            <li><a class="menu-item" href="{{route('admin.users','vendor')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.users.create','vendor')}}"
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
                            <li><a class="menu-item" href="{{route('admin.users','driver')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.users.waitapprove')}}"
                                data-i18n="nav.dash.ecommerce"> بانتظار التفعيل  </a>
                            </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href=""><i class="la la-male"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">شركات الشحن  </span>
                            <span
                                class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Admin::where('id','!=',1)->count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.chargers')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.chargers.create')}}"
                                data-i18n="nav.dash.ecommerce">اضافة شركة</a>
                            </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href=""><i class="la la-male"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">كروت الشحن  </span>
                            <span
                                class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Card::count()}}</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.cards')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.cards.create')}}"
                                data-i18n="nav.dash.ecommerce">اضافة كرت</a>
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
                            <li><a class="menu-item" href="{{route('admin.products')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
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
                                data-i18n="nav.dash.ecommerce">اضافة كوبون</a>
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
                <li class="nav-item">
                    <a href=""><i class="la la-life-bouy"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">الاعدادات  </span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.settings')}}"
                                data-i18n="nav.dash.ecommerce">عرض الاعدادات  </a>
                            </li>
                        </ul>
                </li>
        </ul>
    </div>
</div>
