<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
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
      <style>
        label{
            width: 200px;
            font-weight: bold;
            color: rgb(231, 55, 82);
        }
        span{
            display: inline-block;
            width: 400px;
            padding-left: 40px;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->


      <div class="card mx-auto mt-3 shadow-xl border-3 mb-5" style="width: 34rem;">
        <img class="mt-3 shadow-sm mx-auto w-36 h-40 rounded-top" src="{{asset('product/'.$product->image)}}" class="card-img-top" alt="" with="40px" height="40px">
        <div class="card-body">
        <ul class="list-group list-group-flush ">
          <li class="list-group-item d-flex">
            <label for="">Title</label>
            <span><strong>:</strong> {{$product->title}}</span>
          </li>
          <li class="list-group-item d-flex">
            <label for="">Description</label>
            <span><strong>:</strong> {{$product->description}}</span>
          </li>
          <li class="list-group-item d-flex">
            <label for="">Price</label>
            <span><strong>:</strong> <strong>₹.</strong>{{$product->price}}</span>
          </li>
          <li class="list-group-item d-flex">
            <label for="">Discount Price</label>
            <span><strong>:</strong> <strong>₹.</strong>{{$product->discount_price}}</span>
          </li>
          <li class="list-group-item d-flex">
            <label for="">Catagory</label>
            <span><strong>:</strong> {{$product->catagory}}</span>
          </li>
          <li class="list-group-item d-flex">
            <label for="">Available Quantity</label>
            <span><strong>:</strong> {{$product->quantity}}</span>
          </li>

        </ul>
        <div class="card-body float-end">
            <form method="Post" action="{{url('add_cart',$product->id)}}">
                @csrf
                <div class="row">
                    <div class="pt-1 px-3">
                        <input name="quantity" type="number"  value="1" min="1" max="{{$product->quantity}}"
                            style="width: 70px">
                    </div>
                    <div class="px-2">
                        <input type="submit" class="px-2" value="Add to Cart">
                    </div>
                </div>
            </form>
        </div>
    </div>
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
