<!DOCTYPE html>
<html>
<head>
  <title>Order @if($order) - {{$order->cart_id}} @endif</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .invoice-header {
      background: #f7f7f7;
      padding: 10px 20px;
      border-bottom: 1px solid gray;
      display: flex;
      justify-content: space-between;
    }
    .invoice-header img {
      width: 150px;
    }
    .invoice-right-top h3 {
      color: green;
      font-size: 30px;
      font-family: serif;
    }
    .invoice-left-top {
      border-left: 4px solid green;
      padding-left: 20px;
    }
    .invoice-left-top p {
      margin: 0;
      line-height: 20px;
      font-size: 16px;
      margin-bottom: 3px;
    }
    thead {
      background: green;
      color: #FFF;
    }
    .table-header {
      background-color: rgba(0,0,0,.03);
      border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .table td, .table th {
      padding: .30rem;
    }
    .authority {
      text-align: right;
      margin-top: 50px;
    }
    .authority h5 {
      margin-top: -10px;
      color: green;
    }
    .thanks {
      color: green;
      font-size: 25px;
      font-family: serif;
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

@if($order)
  <div class="invoice-header">
    <div class="site-logo">
      <!-- Use base64 for inline image -->
      <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('backend/img/logo.png'))) }}" alt="">
    </div>
    <div class="site-address">
      <h4>{{env('APP_NAME')}}</h4>
      <p>{{env('APP_ADDRESS')}}</p>
      <p>Phone: <a href="tel:{{env('APP_PHONE')}}">{{env('APP_PHONE')}}</a></p>
      <p>Email: <a href="mailto:{{env('APP_EMAIL')}}">{{env('APP_EMAIL')}}</a></p>
    </div>
  </div>
  <div class="invoice-description">
    <div class="invoice-left-top">
      <h6>Invoice to</h6>
      <h3>{{$order->first_name}} {{$order->last_name}}</h3>
      <div class="address">
        <p><strong>Country: </strong>{{$order->country}}</p>
        <p><strong>Address: </strong>{{ $order->address1 }} @if($order->address2) OR {{ $order->address2}} @endif</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
      </div>
    </div>
    <div class="invoice-right-top">
      <h3>Invoice #{{$order->cart_id}}</h3>
      <p>{{ $order->created_at->format('D d m Y') }}</p>
    </div>
  </div>
  <section class="order_details">
    <div class="table-header">
      <h5>Order Details</h5>
    </div>
    <table class="table table-bordered table-stripe">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
      @foreach($order->cart_info as $cart)
        @php
          // Pre-fetch product title in PHP before rendering
          $product = DB::table('products')->where('id', $cart->product_id)->value('title');
        @endphp
        <tr>
          <td>{{$product}}</td>
          <td>x{{$cart->quantity}}</td>
          <td>${{number_format($cart->price, 2)}}</td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td class="text-right">Subtotal:</td>
          <td>${{number_format($order->sub_total, 2)}}</td>
        </tr>
        <tr>
          <td></td>
          <td class="text-right">Shipping:</td>
          <td>${{number_format($order->delivery_charge, 2)}}</td>
        </tr>
        <tr>
          <td></td>
          <td class="text-right">Total:</td>
          <td>${{number_format($order->total_amount, 2)}}</td>
        </tr>
      </tfoot>
    </table>
  </section>
  <div class="thanks">
    <h4>Thank you for your business !!</h4>
  </div>
  <div class="authority">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
  </div>
@else
  <h5 class="text-danger">Invalid</h5>
@endif

</body>
</html>
