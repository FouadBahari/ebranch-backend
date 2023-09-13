@extends('layouts.admin')
@section('title',"اضافة {{$nametype}}")

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
                            <li class="breadcrumb-item"><a href="{{route('admin.users',$type)}}"> {{$nametype}} </a>
                            </li>
                            <li class="breadcrumb-item active">إضافة {{$nametype}}
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
                                <h4 class="card-title" id="basic-layout-form"> إضافة {{$nametype}} </h4>
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
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> بيانات {{$nametype}} </h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">صورة {{$nametype}} </label>
                                                        <input type="file" value="" id="name" class="form-control" name="photo" required>
                                                        @error("photo")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if ($type == "vendor")
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الخدمات</label>
                                                        <select name="service_id" id="" class="form-control" @if ($type=="vendor" ) required @endif>
                                                            @foreach ($services as $service)
                                                            <option value="{{$service->id}}">{{$service->name}}</option>
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
                                                        <label for="projectinput1"> اسم {{$nametype}} </label>
                                                        <input type="text" value="" id="name" class="form-control" placeholder="اسم {{$nametype}}" name="name" required>
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> رقم الهاتف </label>
                                                        <input type="tel" value="" id="phone" class="form-control" placeholder=" رقم الهاتف" name="phone" required dir="ltr">
                                                        @error("phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> البريد الالكتروني</label>
                                                        <input type="email" value="" id="email" class="form-control" placeholder=" البريد الالكتروني" name="email" required>
                                                        @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">كلمة السر</label>
                                                        <input type="password" value="" id="password" class="form-control" placeholder="كلمة السر" name="password" required>
                                                        @error("password")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">العنوان</label>
                                                        <input type="text" value="" id="address" class="form-control" placeholder="العنوان" name="address" required>
                                                        @error("address")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">lat</label>
                                                        <input type="text" value="" id="latitude" class="form-control" placeholder="lat" name="lat" required>
                                                        @error("lat")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">lang</label>
                                                        <input type="text" value="" id="longitude" class="form-control" placeholder="lang" name="lang" required>
                                                        @error("address")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div id="map" style="height: 400px; width: 100%;"></div>

                                                <!-- JavaScript to initialize the map and handle the marker -->
         

       
    <!-- JavaScript to initialize the map and handle the marker -->
    <script>
        var map;
        var marker;
        var latitudeInput = document.getElementById('latitude');
        var longitudeInput = document.getElementById('longitude');

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 0, lng: 0 },
                zoom: 10,
            });

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;

                    var userLatLng = new google.maps.LatLng(lat, lng);

                    map.setCenter(userLatLng);

                    if (marker) {
                        marker.setPosition(userLatLng);
                    } else {
                        marker = new google.maps.Marker({
                            position: userLatLng,
                            map: map,
                            title: 'Marker'
                        });
                    }

                    latitudeInput.value = lat;
                    longitudeInput.value = lng;
                }, function(error) {
                    console.error("Error getting user's location:", error);
                });
            } else {
                console.error("Geolocation is not supported by your browser.");
            }

            // Add a click event listener to the map
            google.maps.event.addListener(map, 'click', function(event) {
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();

                if (marker) {
                    marker.setPosition({ lat: lat, lng: lng });
                } else {
                    marker = new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        title: 'Marker'
                    });
                }

                // Update the input fields with the latitude and longitude
                latitudeInput.value = lat;
                longitudeInput.value = lng;
            });
        }

        window.addEventListener('load', loadGoogleMapsScript);

        function loadGoogleMapsScript() {
            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyATRswW7jRw6XoQnGzoCmiGTgbLsyvApjA&callback=initMap';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }
    </script>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
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