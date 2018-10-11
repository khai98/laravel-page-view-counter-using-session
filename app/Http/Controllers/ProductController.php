<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {

        return view('index');
    }

    public function listProducts()
    {
        $products = Product::all();
        return view('view', compact('products'));
    }

    public function showProduct($id)
    {
        $productKey = 'product_' . $id;

        // Kiểm tra Session của sản phẩm có tồn tại hay không.

        // Nếu không tồn tại, sẽ tự động tăng trường view_count lên 1 đồng thời tạo session lưu trữ key sản phẩm.

        if (!session()->has($productKey)) {

            Product::where('id', $id)->increment('view_count');
            session()->put($productKey, 1);

        }

        // Sử dụng Eloquent để lấy ra sản phẩm theo id
        $product = Product::find($id);

        // Trả về view
        return view('welcome', compact(['product']));
    }

}
