<section class="product_section layout_padding" id="product">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div>
            <form method="GET" action="{{url('search_product')}}">
                @csrf
                <div class="text-center mb-3">
                    <input style="width: 70%" type="search" name="search" id="for1" placeholder="Search">
                    <input type="submit" value="Search">
                </div>
            </form>
        </div>
        <div class="row">

            @foreach ($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box" style="height: 450px">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details', $products->id) }}" class="option1">
                                    Product Detail
                                </a>
                                <form method="Post" action="{{url('add_cart',$products->id)}}">
                                    @csrf
                                    <div class="row">
                                        <div class="pt-1">
                                            <input name="quantity" type="number"  value="1" min="1" max="{{$products->quantity}}"
                                                style="width: 70px">
                                        </div>
                                        <div class="px-2">
                                            <input type="submit" class="px-2" value="Add to Cart">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('product/' . $products->image) }}" alt="">
                        </div>
                        <div class="row detail-box justify-center">
                            <h5 class="mx-auto">
                                {{ $products->title }}
                            </h5>

                            <div class="d-flex gap-2 mx-auto " style="widows: 100%">
                                @if ($products->discount_price != null)
                                    <h6 style="color:red; font-size:15px">
                                        <span>Discount Price </span>
                                        ₹.{{ $products->discount_price }} <br>
                                    </h6>
                                    <h6 class="mx-3" style="text-decoration: line-through; color:grey">
                                        <span>Price </span>₹.{{$products->price}}
                                    </h6>
                                @else
                                    <h6 style="color:red">
                                        <span>Price </span>
                                        ₹.{{ $products->price }}
                                    </h6>
                                @endif
                             </div>
                            <div class="row mt-3 mx-3 gap-5" style="font-size:15px">

                                    <p>{{$products->description}}</p>

                                    <p class="text-bold">Available Quantity: <span style="font-weight: 500">{{$products->quantity}}</span></p>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="mt-3 mx-5">
            <span style="padding-top: 20px">
                {!! $product->links('pagination::bootstrap-5') !!}
            </span>
        </div>

    </div>
</section>
