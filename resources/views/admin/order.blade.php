
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <base href="/public">
    <style type="text/css">
        .div-center{
            text-align: center;
        }
        .h2-font{
            font-size:40px;
            color: black;
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
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      @include('admin.navbar')
      @include('admin.sidebar')
      <!-- page-body-wrapper ends -->

      <div class="main-panel">
        <div class="content-wrapper">

            <div class="div-center">
                <h2 class="h2-font text-dark mb-4">All Orders</h2>
                {{-- <a href="{{url('view_product')}}" type="button" class="btn btn-outline-light float-end right-[100px]">Add Product</a> --}}
            </div>
            <div>
                <form method="get" action="{{url('search')}}">
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
            <div class="table-responsive" style="width: 90%">
                <table class="table custom-table table-striped mt-3 table-bordered">
                    <thead class="text-center">
                        <tr class="table-secondary text-dark font-bold">
                            <td>Name</td>
                            <td>Email</td>
                            <td>Address</td>
                            <td>Phone</td>
                            <td>Product Title</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Payment Status</td>
                            <td>Delivery Status</td>
                            <td>Image</td>
                            <td>Action</td>
                            <td>Invoice</td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($order as $order )
                        <tr class="text-dark">
                            <td class="px-3">{{$order->name}}</td>
                            <td class="px-3">{{$order->email}}</td>
                            <td class="px-3">{{$order->address}}</td>
                            <td class="px-3">{{$order->phone}}</td>
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
                                @else
                                <p class="badge badge-success rounded-pill d-inline px-3">{{$order->delivery_status}}</p>
                                @endif
                            </td>
                            <td class="px-3 w-30 h-20">
                                <img src="{{asset('product/'.$order->image)}}" class="mx-auto w-30 h-15" alt="Product-Image" width="40px" height="20px">
                            </td>
                            <td class="py-2 px-3">
                                <div class="d-flex gap-2 text-center">
                                    @if($order->delivery_status == 'Processing')
                                    <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure the product could to delivered?')" class="btn btn-warning text-dark  text-sm px-2 mx-auto">
                                    Delivered
                                    </a>
                                    @else
                                    <p class="badge badge-success rounded-pill d-inline px-3">Delivered</p>
                                    @endif
                                </div>
                            </td>
                            <td class="py-2 px-3">
                                <div class="d-flex gap-2 text-center">
                                    <a href="{{url('download_pdf',$order->id)}}" class="text-primary mx-auto" data-toggle="tooltip" data-placement="top" title="Download PDF">
                                    <u>Download</u>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty

                        <tr>
                            <td colspan="16" class="text-white">No data found</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
    @include('admin.script')
  </body>
</html>
