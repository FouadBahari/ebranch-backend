<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        /* Add your CSS styles here for formatting the invoice */
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .invoice-footer {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-header">
            <h2>Invoice</h2>
            <p>Date: {{ date('Y-m-d') }}</p>
            <p>Invoice Number: {{ $order->id }}</p>
            <p>اسم العميل : {{ $user->name }}</p>
            <p>العنوان : {{ $user->address }}</p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>المنتجات</th>
                    <th>سعر المنتج</th>
                    <th>الكمية</th>
                    <th>المجموع</th>
                </tr>
            </thead>
            @foreach (App\Models\Product::whereIn('id',explode(',',$order->product_id))->get() as $index=>$item)
            <tbody>
                <tr>


                    <td>
                        {{$item->name}} <br>
                    </td>
                    <td>
                        <?php $data3 = $item->price * (1 - ($item->offer) / 100) ?>

                        رس {{$data3}}<br>
                    </td>
                    <td>
                        {{explode(',',$order->amount)[$index]}} <br>
                    </td>
                    <td>
                     <?php $total_itmes=$data3*explode(',',$order->amount)[$index] ?>  رس {{$total_itmes}} <br>
                    </td>
                </tr>

            </tbody>
            @endforeach
        </table>
        <div class="invoice-footer">
        <h3> <p>  مجموع بدون شحن : {{ $order->price }}رس</p>
            <p> سعر الشحن : {{$order->shipping_price}}رس</p>
          
            <p>  المجموع : <?php $data5=($order->price)+($floatValue =floatval($order->shipping_price))?> {{$data5}}رس </p> </h3>
        </div>
    </div>
    <button id="printButton" type="button" class="btn btn-secondary" onclick="printInvoice()">Print Invoice</button>

    <script>
        function printInvoice() {
            var printContents = document.querySelector('.invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>