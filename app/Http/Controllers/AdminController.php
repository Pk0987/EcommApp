<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\SendQueuedNotifications;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Notification; // Ensure this is imported
use App\Notifications\SentEmailNotification;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function view_catagory()
    {
        $data = Catagory::all();
        return view('admin.catagory', compact('data'));
    }

    public function add_catagory(Request $request)
    {

        // @dd($request->all());
        $data = new Catagory;
        $data->catagory_name = $request->catagory;
        $data->save();

        Alert::html('<p style="color: green;">Category Added Successfully',
        '<p style="color: black;">You can purchase this new category</p>',
        'success'
    );
        return redirect()->back();
    }
    public function delete_catagory($id)
    {
        $data = Catagory::find($id);
        $data->delete();
        Alert::html('<p style="color: red;">Category Deleted Successfully',
        '<p style="color: black;">You cant purchase this category anymore</p>',
        'success');
        return redirect()->back();
    }


    public function view_product()
    {
        $catagory = Catagory::all();
        return view('admin.product', compact('catagory'));
    }

    public function add_product(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->catagory = $request->catagory;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;

        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move(public_path('product'), $imageName);

        // $manager = new ImageManager(Driver::class);
        // $imageCrop = $manager->read(public_path('product' . $imageName));

        // $imageCrop->cover(150,150);
        // $imageCrop->save(public_path('product' . $imageName));
        $product->image = $imageName;

        $product->save();
        Alert::html('<p style="color: green;">Product Added Successfully',
        '<p style="color: black;">You can purchase this new Product</p>',
        'success'
    );
        return redirect('show_product');
    }
    public function show_product()
    {
        $product = Product::all();
        return view('admin.show-product', compact('product'));
    }
    public function delete_product($id)
    {
        $data = Product::find($id);
        $data->delete();
        Alert::html('<p style="color: red;">Product Deleted Successfully',
        '<p style="color: black;">You cant purchase this Product anymore</p>',
        'success');
        return redirect()->back();
    }

    public function update_product($id)
    {
        $product = Product::find($id);
        $catagory = Catagory::all();

        return view('admin.update-product', compact(['product', 'catagory']));
    }

    public function edit_product(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->catagory = $request->catagory;
        $product->discount_price = $request->discount_price;

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('product'), $imageName);
            $product->image = $imageName;
            // dd($product->image);
        }
        // $product->save();
        Product::where('id', $product->id)->update(['id' => $product->id, 'title' => $product->title, 'price' => $product->price, 'description' => $product->description, 'quantity' => $product->quantity, 'discount_price' => $product->discount_price, 'catagory' => $product->catagory, 'image' => $product->image]);

        Alert::html('<p style="color: green;">Product Updated Successfully',
        '<p style="color: black;">You can purchase this Product</p>',
        'success');
        // $product->save();
        return redirect('show_product');
    }

    public function order()
    {
        $order = Order::all();
        return view('admin.order', compact('order'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        $product = Product::find($order->product_id);
        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";
        $final_quantity = $product->quantity - $order->quantity;
        Product::where("id", $product->id)->update(["quantity" => $final_quantity]);


        $pdf = PDF::loadView('admin.download_pdf', ['order' => $order]); // Pass the necessary data to the view

        // Save the PDF file in the storage folder and ensure the path is correct
        $fileName = 'invoice_' . $order->id . '.pdf';
        $filePath = 'public/invoices/' . $fileName; // Store it in the "public/invoices" folder
        Storage::put($filePath, $pdf->output()); // Store the PDF file

        // Use Storage::path() to get the correct file path
        $fullFilePath = Storage::path($filePath);

        // Send the email notification with the PDF attached
        $details = [
            'subject' => 'Order Delivered Successfully!',
            'greeting' => 'Your order has been delivered successfully.',
            'content' => 'We hope you enjoy your purchase. Please visit us again for more!',
            'file' => $fullFilePath, // Path to the PDF file
            'button' => 'Click here',
            'url' => 'https://www.amazon.in/', // Link to your site or order details
            'footer' => 'Thank you for shopping with us!',
        ];

        Notification::send($order, new SentEmailNotification($details));

        $order->save();
        Alert::html('<p style="color: green;">Order Delivered Successfully',
        '<p style="color: black;">You can received this Product details in your mail</p>',
        'success');
        return redirect()->back();
    }

    public function download_pdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView("admin.download_pdf", compact('order'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download("Invoice.pdf");
    }

    public function searchData(Request $request)
    {
        $searchText = $request->get("search");

        $columns = ['name', 'email', 'product_title', 'price', 'address', 'phone', 'payment_status', 'delivery_status', 'quantity'];

        $order = Order::when($searchText, function ($query) use ($searchText, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$searchText}%");
            }
        })->get();

        return view("admin.order", compact("order"));
    }
}
