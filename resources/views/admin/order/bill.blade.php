
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order_details[0]->id  }}</title>
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>
    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start"> Ecommerce</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $order_details[0]->id}} </span> <br>
                    <span>Date:{{ date('d / m / Y') }}</span> <br>
                    <span>Zip code : 751001</span> <br>
                    <span>Address: #355, Palasuni,Rasulgarh,Bhubaneswar,Odisha, India</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td> {{ $order_details[0]->id  }} </td>

                <td>Full Name:</td>
                <td>{{ $order_details[0]->name }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $order_details[0]->added_on }}</td>

                <td>Email Id:</td>
                <td>{{ $order_details[0]->email }}</td>
            </tr>
            <tr>
                <td>Payment id:</td>
                <?php
                if ($order_details[0]->payment_id != '') {
                    $payment = $order_details[0]->payment_id;
                } else {
                    $payment = 'No Payment Id';
                }
                ?>
                <td>{{ $payment }}</td>
                    
                <td>Phone:</td>
                <td>{{ $order_details[0]->mobile }}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <?php 
                    if ($order_details[0]->payment_type == 'Gateway') {
                        $order_payment_type = 'Online Payment';
                    } else {
                        $order_payment_type = 'Case On Delivery';
                    }
                ?>
                <td>{{ $order_payment_type }}</td>


                <td>Address:</td>
                <td>{{ $order_details[0]->address }},{{ $order_details[0]->city }},{{ $order_details[0]->state }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>{{ $order_details[0]->payment_status }}</td>

                <td>Pin code:</td>
                <td> {{ $order_details[0]->pincode }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                              <th>Product</th>
                               <th>Color</th>
                               <th>Size</th>
                               <th>Price</th>
                               <th>qty</th>
                               <th>Total</th>
            </tr>
        </thead>
        <tbody>
            

            @php
                              $totalAmt = 0;
                            @endphp
                            @foreach ($order_details as $list)
                              @php
                              $totalAmt = $totalAmt+($list->price*$list->qty);
                              @endphp
                              <tr>
                                <td>{{  $list->pname  }}</td>
                             
                                <td>{{  $list->color  }}</td>
                                <td>{{  $list->size  }}</td>
                                <td>Rs.{{  $list->price  }}</td>
                                <td>{{  $list->qty  }}</td>
                                <td>Rs.{{  $list->price*$list->qty  }}</td>                      
                              </tr>                    
                            @endforeach
            <tr>
                <td colspan="5" class="total-heading">Total Amount  </td>
                <td colspan="1" class="total-heading"><b>Rs.{{ $totalAmt  }}</b></td>
            </tr>
            <?php
            if ($order_details[0]->coupon_value>0) {
              echo ' <td colspan="5" class="total-heading"><b>Coupon <span class="coupon_apply_txt">('.$order_details[0]->coupon_code.')</span></b></td> 
                <td colspan="1" class="total-heading">&nbsp;-&nbsp;'.$order_details[0]->coupon_value.'</td>';
            $totalAmt = $totalAmt-$order_details[0]->coupon_value;
            echo '<tr>
                <td colspan="5" class="total-heading"><b>Final Price - <small>Inc. all vat/tax</small>:</b></td> 
                <td  colspan="1" class="total-heading">Rs.'.$totalAmt.'</td><tr/>';
            }
          ?>  
          
        </tbody>
    </table>
    <br>
    <p class="text-center">
        Thank your for shopping {{ $order_details[0]->name }}
    </p>

</body>
</html>