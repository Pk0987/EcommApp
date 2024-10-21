
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <base href="/public">
    <style type="text/css">
        .div-center{
            text-align: center;
            padding-top: 40px;
        }
        .h2-font{
            font-size:40px;
            padding-bottom: 40px;
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
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      @include('admin.navbar')
      @include('admin.sidebar')
      <!-- page-body-wrapper ends -->
        @include('sweetalert::alert')
        <div class="main-panel">
            <div class="content-wrapper">

                @if (@session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif

                <div class="div-center">
                    <h2 class="h2-font">Product List</h2>
                    <a href="{{url('view_product')}}" type="button" class="absolute btn btn-outline-info float-end right-[100px]">Add Product</a>
                </div>

                <div class="table-responsive justify-items-center" style="width: 90%">
                    <table class="table mt-5 table-striped table-bordered">
                        <thead class="text-center">
                            <tr class="table-secondary text-dark font-bold">
                                <td class="py-2">#</td>
                                <td class="py-2">Title</td>
                                <td class="py-2">Image</td>
                                <td class="py-2">Description</td>
                                <td class="py-2">Price</td>
                                <td class="py-2">Catagory</td>
                                <td class="py-2">Discount Price</td>
                                <td class="py-2">Action</td>
                            </tr>
                        </thead>
                        <tbody class="">
                            @if($product->count() > 0)
                            @foreach ($product as $product )
                            <tr>
                                <td class="text-dark px-3">{{$product->id}}</td>
                                <td class="text-dark px-3">{{$product->title}}</td>
                                <td class="text-dark px-3"><img src="{{asset('product/'.$product->image)}}" alt="Product-Image" width="20px" height="20px"></td>
                                <td class="text-dark px-3">{{$product->description}}</td>
                                <td class="text-dark px-3">{{$product->price}}</td>
                                <td class="text-dark px-3">{{$product->catagory}}</td>
                                <td class="text-dark px-3">
                                    @if($product->discount_price !== null)
                                    <p class="text-center">{{$product->discount_price}}</p>
                                    @else
                                    <p class="text-center">-</p>
                                    @endif
                                </td>
                                <td class="py-2 px-3">
                                    <div class="d-flex gap-2">
                                        <a href="{{url('update_product',$product->id)}}" class="btn btn-outline-info px-2" data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m14.06 9l.94.94L5.92 19H5v-.92zm3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z"/></svg></a>
                                        <a href="{{url('delete_product',$product->id)}}" onclick="return confirm('Are you sure want to delete?')" class="btn btn-outline-danger px-2" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3zM7 6h10v13H7zm2 2v9h2V8zm4 0v9h2V8z"/></svg></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr  style="color: white">
                                <td colspan="16" class="text-center text-dark">
                                    <p>Product list is empty</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @include('admin.script')
  </body>
</html>
