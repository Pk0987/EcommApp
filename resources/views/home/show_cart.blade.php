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
        .div-center {
            text-align: center;
        }
        .h2-font {
            font-weight: bold;
            font-size: 30px;
        }
        /* Custom table styles for width */
        .custom-table {
            width: 100%; /* Increase the width to full */
            max-width: 1200px; /* Limit maximum width */
            margin: auto; /* Center align */
        }
        /* Responsive table - will scroll horizontally on small screens */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>

    @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->

      <div class="cart-panel ">
            @if (@session()->has('message'))
            <div class="alert alert-success mx-auto" style="width: 500px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                {{session()->get('message')}}
            </div>
            @endif

            <div class="div-center mt-5">
                <h2 class="h2-font font-sans">Cart List</h2>
            </div>
            @if ($cart->count()!==0)
            <div class="justify-content-center col-12">
                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table class="table custom-table table-striped mt-3 table-bordered">
                        <thead class="text-center">
                            <tr class="table-secondary text-dark font-bold">
                                <td>#</td>
                                <td>Product Title</td>
                                <td>Image</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($cart as $cart )
                            <tr>
                                <td class="text-dark px-3">{{$cart->id}}</td>
                                <td class="text-dark px-3">{{$cart->product_title}}</td>
                                <td class="text-dark px-3 w-30 h-20">
                                    <img src="{{asset('product/'.$cart->image)}}" class="mx-auto w-30 h-15" alt="Product-Image" width="40px" height="20px">
                                </td>
                                <td class="text-dark px-3">{{$cart->quantity}}</td>
                                <td class="text-dark px-3">{{$cart->price}}</td>
                                <td class="py-2 px-3">
                                    <div class="d-flex gap-2 text-center">
                                        <a href="{{url('delete_cart',$cart->id)}}" onclick="confirmation(event)" class="btn btn-outline-danger px-2 mx-auto" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3zM7 6h10v13H7zm2 2v9h2V8zm4 0v9h2V8z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-right">
                                    <h2 class="m-3 float-end font-bold font-sans">Total Price is: <strong>₹.{{$sum}}</strong></h2>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <h2 class="font-sans text-xl" style="font-weight: 700px">Buy a Product through</h2>
                <div class="d-flex justify-center mt-3 mb-5">
                    <div class="cash-on-delivery px-2"><a class="btn btn-danger" onclick="cashondelivery(event)" href="{{url('cash_on_delivery')}}">Cash on delivery</a></div>
                    <div class="online-payment px-2"><a class="btn btn-danger" href="{{url('stripe',$sum)}}">Online Payment</a></div>
                </div>
            </div>
            @else

            <p class="text-center mx-auto rounded-lg p-3" style="margin: 100px; background-color:rgb(236, 196, 196); width:500px;">Cart is empty</p>
            @endif


    </div>

</div>
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         </p>
      </div>




      @include('home.alert-script')

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
