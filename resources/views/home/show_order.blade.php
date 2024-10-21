
<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />

      <style type="text/css">
        .div-center{
            text-align: center;
        }
        .h2-font{
            font-size:40px;
        }
        .center{
            margin-left:15%;
            text-align: center;
            /* border: 2px solid green */
        }
    </style>
   </head>
   <body>
    @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->

         <div class="main-panel">
            <div class="content-wrapper">

                <div class="div-center">
                    <h2 class="h2-font text-dark mb-4">All Orders</h2>
                    {{-- <a href="{{url('view_product')}}" type="button" class="btn btn-outline-light float-end right-[100px]">Add Product</a> --}}
                </div>
                <div>
                    <form method="get" action="{{url('search_order')}}">
                        @csrf
                        <div class="text-center mb-3">
                            <input style="width: 50%" class="rounded-sm" type="search" name="search" id="for1" placeholder="Search">
                        </div>
                    </form>
                </div>
                @if (@session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif
                <div class="table-responsive" style="width: 70%; margin:auto">
                    <table class="table custom-table table-striped mb-5 table-bordered">
                        <thead class="text-center">
                            <tr class="text-dark font-bold">
                                <td>Product Title</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Payment Status</td>
                                <td>Delivery Status</td>
                                <td>Image</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($order as $order )
                            <tr class="text-dark">
                                <td class="px-3">{{$order->product_title}}</td>
                                <td class="px-3">{{$order->quantity}}</td>
                                <td class="px-3">{{$order->price}}</td>
                                <td class="px-3">
                                    @if($order->payment_status == 'Paid')
                                    <p class="badge badge-success rounded-pill d-inline px-3">Paid</p>
                                    @else
                                    <p class="badge badge-warning rounded-pill d-inline px-2">{{$order->payment_status}}</p>
                                    @endif
                                </td>
                                <td class="px-3">
                                    @if($order->delivery_status == 'Processing')
                                    <p class="badge badge-warning rounded-pill d-inline px-3">{{$order->delivery_status}}</p>
                                    @elseif ($order->delivery_status == 'Delivered')
                                    <p class="badge badge-success rounded-pill d-inline px-3">{{$order->delivery_status}}</p>
                                    @else
                                    <p class="badge badge-danger rounded-pill d-inline px-3">{{$order->delivery_status}}</p>
                                    @endif
                                </td>
                                <td class="px-3 w-30 h-20">
                                    <img src="{{asset('product/'.$order->image)}}" class="mx-auto w-30 h-15" alt="Product-Image" width="40px" height="20px">
                                </td>
                                <td class="py-2 px-3">
                                    <div class="d-flex gap-2 text-center">
                                        @if($order->delivery_status == 'Processing')
                                        <a href="{{url('order_cancel',$order->id)}}" onclick="return confirm('Are you sure want to cancel?')" class="btn-sm rounded btn-danger text-white px-2 mx-auto">
                                        Order Cancel
                                        </a>
                                        @elseif ($order->delivery_status=='Delivered')
                                        <p class="badge badge-success rounded-pill d-inline px-3">Delivered</p>
                                        @else
                                        <p class="badge badge-danger rounded-pill d-inline px-">Order canceled</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty

                            <tr>
                                <td colspan="16" class="text-dark">No data found</td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @include('home.footer')
        </div>

</div>
      <!-- end client section -->
      <!-- footer start -->
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
