<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    public function index(){
        $product = Product::paginate(3);
        $comment = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }
    public function all_products(){
        $product = Product::paginate(3);
        $comment = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();
        return view('home.all_products',compact('product','comment','reply'));
    }

    public function redirect(){

        $usertype = Auth::user()->usertype;
        if($usertype == 1){
            $total_products = Product::all()->count();
            $total_orders = Order::all()->count();
            $total_customers = User::all()->count();
            $order = Order::all();
            $total_revenue = 0;
            foreach($order as $orders){
                $total_revenue += $orders->price;
            }
            $order_processing = Order::where('delivery_status','Processing')->count();
            $order_delivered = Order::where('delivery_status','Delivered')->count();
            return view('admin.home',compact(['total_products','total_orders','total_customers','total_revenue','order_processing','order_delivered']));

        }else{
            $product = Product::paginate(3);
            $comment = Comment::orderBy('id', 'desc')->get();
            $reply = Reply::all();
            return view('home.userpage',compact('product','comment','reply'));
        }
}


    public function product_details(Request $request, $id){

        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $product = Product::find($id);

            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->product_title = $product->title;


            $cart->quantity = Request::input('quantity');
            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }else{
                $cart->price = $product->price;
            }
            $cart->image = $product->image;
            $cart->total_price = $cart->price * $cart->quantity;
            $cart->save();

            Alert::success('Product Added Successfully', 'We have added the product to the cart');

            return redirect()->back();



        }else{
            return redirect('login');
        }
    }

    public function show_cart(){
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', $id)->get();
        $sum = Cart::where('user_id', $id)->sum('total_price');
        return view('home.show_cart',compact('cart','sum'));
    }

    public function delete_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        Alert::success('Product Deleted Successfully', 'We have deleted the product from the cart');
        return redirect()->back();
    }

    public function cash_on_delivery(){
        $data = Cart::where('user_id', Auth::user()->id)->get();

        foreach($data as $data){
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->address = $data->address;
            $order->phone = $data->phone;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->total_price = $data->quantity * $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = "Cash on delivery";
            $order->delivery_status = "Processing";
            $order->save();

            $cart_id = $data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();

        }
        Alert::success('Order Placed Successfully!', 'You have ordered the product through cash on delivery');
        return redirect()->back();
    }

    public function stripe($sum){
        return view('home.stripe',compact('sum'));
    }

    public function stripe_post(Request $request, $sum){


            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create ([
                    "amount" => $sum * 100,
                    "currency" => "inr",
                    "source" => Request::input('stripeToken'),
                    "description" => "Test payment from itsolutionstuff.com."
            ]);
            $data = Cart::where('user_id', Auth::user()->id)->get();

            foreach($data as $data){
                $order = new Order();
                $order->name = $data->name;
                $order->email = $data->email;
                $order->address = $data->address;
                $order->phone = $data->phone;
                $order->user_id = $data->user_id;
                $order->product_title = $data->product_title;
                $order->price = $data->price;
                $order->quantity = $data->quantity;
                $order->total_price = $data->quantity * $data->price;
                $order->image = $data->image;
                $order->product_id = $data->product_id;
                $order->payment_status = "Paid";
                $order->delivery_status = "Processing";
                $order->save();

                $cart_id = $data->id;
                $cart=Cart::find($cart_id);
                $cart->delete();

            }

            Session::flash('success', 'Payment successful!');

            Alert::success('Order Placed Successfully!', 'You have ordered the product through online paid successfully');
            return redirect('redirect');
        }
    public function show_order(){
        if(Auth::id()){
            $order = Order::where('user_id',Auth::user()->id)->get();
            return view('home.show_order',compact('order'));
        }else{
            return redirect('redirect')->with('message','Unauthorized User');
        }
    }
    public function order_cancel($id){
        $order = Order::find($id);
        $order->delivery_status = 'You cancel the Order';
        $order->save();
        Alert::html('<p style="color: red;">Order Canceled Successfully',
        '<p style="color: black;">You cant revert this anymore</p>',
        'success'
    );
        return redirect()->back();

    }
    public function search(Request $request)
    {
        $searchText = Request::get('search');

        $columns = ['title', 'price', 'discount_price', 'quantity'];

        $product = Product::when($searchText, function ($query) use ($searchText, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$searchText}%");
            }
        })->paginate(3);

        return view("home.userpage", compact("product"));
    }

    public function search_order(Request $request){
        $searchText = Request::get("search");

        $columns = ['product_title', 'price', 'payment_status', 'delivery_status', 'quantity'];

        $order = Order::when($searchText, function ($query) use ($searchText, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$searchText}%");
            }
        })->get();

        return view("home.show_order", compact("order"));
    }


    public function add_comment(Request $request){
        if(Auth::id()){
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = Request::get("comment");
            $comment->save();
            return redirect()->back();

        }else{
            return redirect('login')->with("message","Unauthorized User");
        }
    }
    public function add_reply(Request $request){
        if(Auth::id()){
           $reply = new Reply;
           $reply->name = Auth::user()->name;
           $reply->user_id = Auth::user()->id;
           $reply->reply = Request::get("reply");
           $reply->comment_id = Request::get("commentId");
           $reply->save();

             return redirect()->back();

        }else{
            return redirect('login')->with('message','Unauthorized user');
        }
    }
  // Delete a comment
  public function delete_comment($id)
  {
      $comment = Comment::findOrFail($id);

      if (Auth::id() == $comment->user_id) {
          $comment->delete();
          return redirect()->back()->with('message', 'Comment deleted successfully');
      } else {
          return redirect()->back()->with('message', 'Unauthorized action');
      }
  }

  // Update a comment
  public function update_comment(Request $request)
  {
      $comment = Comment::findOrFail(Request::get('commentId'));

      if (Auth::id() == $comment->user_id) {
          $comment->comment =Request::get('comment');
          $comment->save();

          return redirect()->back()->with('message', 'Comment updated successfully');
      } else {
          return redirect()->back()->with('message', 'Unauthorized action');
      }
  }

     // Delete a reply
     public function delete_reply($id)
     {
         $reply = Reply::findOrFail($id);

         if (Auth::id() == $reply->user_id) {
             $reply->delete();
             return redirect()->back()->with('message', 'Reply deleted successfully');
         } else {
             return redirect()->back()->with('message', 'Unauthorized action');
         }
     }

     // Update a reply
     public function update_reply(Request $request)
     {
         $reply = Reply::findOrFail(Request::get('replyId'));

         if (Auth::id() == $reply->user_id) {
             $reply->reply = Request::get('reply');
             $reply->save();

             return redirect()->back()->with('message', 'Reply updated successfully');
         } else {
             return redirect()->back()->with('message', 'Unauthorized action');
         }
     }

}

