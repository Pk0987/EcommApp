<!DOCTYPE html>
<html lang="en">
    <head>
     <base href="/public">
    @include('admin.css')
    <style type="text/css">
        .div-center{
            text-align: center;
        }
        .h2-font{
            font-size:40px;
            padding-bottom: 40px;
        }
        .center{
            margin-left:15%;
            text-align: center;
            /* border: 2px solid green */
        }
        .text-color{
            color: black;
            padding-bottom: 2px;
        }
        label, .img {
            display: inline-block;
            width: 200px;
        }
        .design{
            padding: 10px;
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

        <div class="main-panel">
            <div class="content-wrapper">

                @if (@session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif

                <div class="div-center">
                    <h2 class="h2-font">Update Product</h2>

                    <form method="POST" action="{{url('/edit_product',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="design">
                            <label for="">Product Title :<span class="text-danger">*</span></label>
                            <input type="text" class="text-color" value="{{$product->title}}" name="title" placeholder="Enter a Title" required>
                        </div>
                        <div class="design">
                            <label for="">Product Description : <span class="text-danger">*</span></label>
                            <input type="text" class="text-color" value="{{$product->description}}" name="description" placeholder="Enter a Description" required>
                        </div>
                        <div class="design">
                            <label for="">Product Price :<span class="text-danger">*</span></label>
                            <input type="text" class="text-color" value="{{$product->price}}" name="price" placeholder="Enter a Price" required>
                        </div>
                        <div class="design">
                            <label for="">Discount Price :<span class="text-danger">*</span></label>
                            <input type="text" class="text-color" value="{{$product->discount_price}}" name="discount_price" placeholder="Enter a Discount Price" required>
                        </div>
                        <div class="design">
                            <label for="">Product Quantity :<span class="text-danger">*</span></label>
                            <input type="text" class="text-color" value="{{$product->quantity}}" name="quantity" placeholder="Enter a Quantity" required>
                        </div>
                        <div class="design">
                            <label for="">Product Catagory :<span class="text-danger">*</span></label>
                            <select class="text-color" value="{{$product->catagory}}" name="catagory" required>
                                <option selected="">Add a catagory here</option>
                                    @foreach ($catagory as $catagory )

                                    <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="design">
                            <label for="">Product Image :<span class="text-danger">*</span></label>
                            <input type="file" value="{{$product->image}}" class="img text-color" name="image" placeholder="Enter a Image" required>
                        </div>
                        <div class="design">
                            <input type="submit" value="Update product" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('admin.script')
  </body>
</html>
