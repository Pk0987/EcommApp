<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<!-- Invoice 1 - Bootstrap Brain Component -->
<section class="py-3 py-md-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
          <div class="row gy-3 mb-3">
            <div class="col-6">
              <h2 class="text-uppercase text-endx m-0">Invoice</h2>
            </div>
            <div class="col-6">
              <a class="d-block text-end" href="#!">
                <img src="admin/assets/images/logo-mini.svg" class="img-fluid" alt="BootstrapBrain Logo" width="135" height="44">
              </a>
            </div>
            <div class="col-12">
              <h4>From</h4>
              <address>
                <strong>BootstrapBrain</strong><br>
                875 N Coast Hwybr<br>
                Laguna Beach, California, 92651<br>
                United States<br>
                Phone: (949) 494-7695<br>
                Email: email@domain.com
              </address>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-6 col-md-8">
              <h4>Bill To</h4>
              <address>
                <strong>{{$order->name}}</strong><br>
                {{$order->address}}<br>
                Phone: {{$order->phone}}<br>
                Email: {{$order->email}}
              </address>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <h4 class="row">
                <span class="col-6">Invoice #</span>
                <span class="col-6 text-sm-end">{{$order->product_id}}</span>
              </h4>
              <div class="row">
                <span class="col-6">Payment</span>
                <span class="col-6 text-sm-end">Paid</span>
                <span class="col-6">Order ID</span>
                <span class="col-6 text-sm-end">{{$order->id}}</span>
                <span class="col-6">Invoice Date</span>
                <span class="col-6 text-sm-end">{{$order->updated_at->format('d/m/y')}}</span>
                <span class="col-6">Due Date</span>
                <span class="col-6 text-sm-end">{{$date = now()->format('d/m/y')}}</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col" class="text-uppercase">Qty</th>
                      <th scope="col" class="text-uppercase">Product</th>
                      <th scope="col" class="text-uppercase text-end">Unit Price</th>
                      <th scope="col" class="text-uppercase text-end">Amount</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th scope="row">{{$order->quantity}}</th>
                      <td>{{$order->product_title}}</td>
                      <td class="text-end">{{$order->price}}</td>
                      <td class="text-end">{{$order->total_price}}</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-end">Subtotal</td>
                      <td class="text-end">{{$order->total_price}}</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-end">GST (18%)</td>
                      <td class="text-end">{{$order->total_price * 0.18}}</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-end">Shipping</td>
                      <td class="text-end">40</td>
                    </tr>
                    <tr>
                      <th scope="row" colspan="3" class="text-uppercase text-end">Total</th>
                      <td class="text-end">{{($order->total_price * 0.18) + $order->total_price + 40 }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>



