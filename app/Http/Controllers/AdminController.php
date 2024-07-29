<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\fileExists;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function add_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category;
        $category->save();
        return redirect()->back()->with('message', "Adding Category Successfully!");
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('message', "Deleting Category Successfully!");
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.edit_category', compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);
        $category->category_name = $request->category;
        $category->save();
        return redirect('/view_category')->with('message', "Editing Category Successfully!");
    }

    public function add_product()
    {
        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    public function upload_product(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quatity = $request->qty;
        $product->category = $request->category;

        $image = $request->image;

        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect()->back()->with('message', "Adding Product Successfully!");
    }

    public function view_product()
    {
        $products = Product::paginate(3);
        return view('admin.view_product', compact('products'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);

        $image_path = public_path('products/' . $product->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $product->delete();

        return redirect()->back()->with('message', "Deleting Product Successfully!");
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.edit_product', compact('categories', 'product'));
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quatity = $request->qty;
        $product->category = $request->category;

        $image = $request->image;

        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect('/view_product')->with('message', "Editing Product Successfully!");
    }

    public function search_product(Request $request)
    {
        $search = $request->search;
        $products = Product::where('title', 'like', '%' . $search . '%')->paginate(3);
        return view('admin.view_product', compact('products'));
    }

    public function view_orders() {
        $orders = Order::all();
        return view('admin.view_order', compact('orders'));
    }

    public function on_the_way($id) {
        $order = Order::find($id);
        $order->status = 'on the way';
        $order->save();

        return redirect('/view_orders');
    }

    public function delivered($id) {
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->save();

        return redirect('/view_orders');
    }

    public function print_pdf($id) {
        $order = Order::find($id);
        $pdf = Pdf::loadView('admin.invoice', compact('order'));
        return $pdf->download('invoice.pdf');
    }

}
