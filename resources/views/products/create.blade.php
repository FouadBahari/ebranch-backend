@extends('layouts.app')
@section('content')
<form action="{{route('vendor.products.store')}}" method="POST" enctype="multipart/form-data" style="margin-top:70px;margin-bottom:70px">
    @csrf
    <div class="row form-body">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 mylables">الصورة</label>
            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="photo" required>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 mylables">الاسم</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الاسم" required>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 mylables">السعر</label>
            <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="السعر" required>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 mylables">التنصنيف</label>
            <select name="cat" id="" class="form-control" required>
                @foreach ($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 mylables">الكمية</label>
            <input type="number" class="form-control" name="amount" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الكمية" required>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 mylables">نسبة العرض</label>
            <input type="number" class="form-control" name="offer" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نسبة العرض">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputEmail1 mylables">التفاصيل</label>
            <textarea name="description" class="form-control"  cols="30" rows="5"></textarea>
        </div>
        <div class="col-md-6">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>اللون</th>
                        <th>
                            <a href="#" class="btn btn-success pull-right btn-sm add-answer-btn"> اضافه لون</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="answer-list">
                    <tr>
                        <td><input type="color" name="colors[]" class="form-control" required></td>
                        <td><button class="btn btn-danger btn-sm" disabled>حذف</button></td>
                    </tr>
                </tbody>
            </table><!-- end of table -->
        </div>
        <div class="col-md-6">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>الحجم</th>
                        <th>
                            <a href="#" class="btn btn-success pull-right btn-sm add-size-btn"> اضافه حجم</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="answer-list-size">
                    <tr>
                        <td><input type="text" name="size[]" class="form-control" required></td>
                        <td><button class="btn btn-danger btn-sm" disabled>حذف</button></td>
                    </tr>
                </tbody>
            </table><!-- end of table -->
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">اضافة</button>
</form>
@endsection
@section('script')
    <script>
 //add answer btn
$('.add-answer-btn').on('click', function (e) {
        e.preventDefault();
        var html =
            `<tr>
                <td><input type="color" name="colors[]" class="form-control" dir="ltr"></td>
                <td><button class="btn btn-danger btn-sm remove-answer-btn">حذف</button></td>
            </tr>`;
        $('.answer-list').append(html);
    });
    //remove answer btn
    $('body').on('click', '.remove-answer-btn', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });//end of remove answer btn

    $('.add-size-btn').on('click', function (e) {
        e.preventDefault();
        var html =
            `<tr>
                <td><input type="text" name="size[]" class="form-control" dir="ltr"></td>
                <td><button class="btn btn-danger btn-sm remove-size-btn">حذف</button></td>
            </tr>`;
        $('.answer-list-size').append(html);
    });
    //remove answer btn
    $('body').on('click', '.remove-size-btn', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });//end of remove answer btn
</script>
@endsection
