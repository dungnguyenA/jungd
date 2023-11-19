<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Images;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function list_product()
    {
        $list_products = Products::with('image')->paginate(5);

        return view('admin.product.list_product', compact('list_products'));
    }

    public function create_product(ProductRequest $request)
    {
        if ($request->isMethod('GET')) {
            $category = Categories::all();
            $brand = Brand::all();

            return view('admin.product.create_product', compact('category', 'brand'));

        } elseif ($request->isMethod('POST')) {

            $add_product = new Products();

            $add_product->product_name = $request->name;
            $add_product->price = $request->price;
            $add_product->discount_price = $request->discount_price;
            $add_product->quantity = $request->quantity;
            $add_product->description = $request->description;

            $add_product->category_id = $request->category_id;
            $add_product->brand_id = $request->brand_id;

            $add_product->save();

            $imagesData = [];

            if ($request->hasFile('image')) {
                $images = $request->file('image');
                $imagesData = uploadFile('upload', $images);

                // Thêm thông tin product_id vào mảng imagesData
                foreach ($imagesData as &$imageData) {
                    $imageData['product_id'] = $add_product->id;
                }

                // Chèn dữ liệu của các tệp hình ảnh vào bảng Images
                Images::insert($imagesData);
            }

            return response()->json(['success' => 'Sản phẩm đã được thêm thành công!']);
        }
    }


    public function edit_product(ProductRequest $request, $id)
    {
        if ($request->isMethod('GET')) {

            $product = Products::findOrFail($id);

            $brands = Brand::all();

            $categories = Categories::all();

            $images = Images::where('product_id', $id)->get();

            return view('admin.product.update_product', compact('categories', 'brands', 'product', 'images'));

        } elseif ($request->isMethod('POST')) {

            $update_product = Products::find($id);

            $update_product->product_name = $request->name;
            $update_product->price = $request->price;
            $update_product->discount_price = $request->discount_price;
            $update_product->quantity = $request->quantity;
            $update_product->description = $request->description;

            $update_product->category_id = $request->category_id;
            $update_product->brand_id = $request->brand_id;

            $update_product->save();

            // Lấy danh sách các ảnh cũ của sản phẩm
            $oldImages = Images::where('product_id', $id)->get();
            // Xử lý các ảnh
            if ($request->hasFile('image')) {
                // Xóa các ảnh cũ
                foreach ($oldImages as $oldImage) {
                    // Xóa file ảnh cũ trong thư mục storage/upload
                    $oldImagePath = '/public/' . $oldImage->image_name;

                    Storage::delete($oldImagePath);

                    // Xóa bản ghi ảnh cũ trong bảng images
                    $oldImage->delete();
                }

                $imagesData = [];

                if ($request->hasFile('image')) {
                    $images = $request->file('image');
                    $imagesData = uploadFile('upload', $images);

                    // Thêm thông tin product_id vào mảng imagesData
                    foreach ($imagesData as &$imageData) {
                        $imageData['product_id'] = $update_product->id;
                    }

                    // Chèn dữ liệu của các tệp hình ảnh vào bảng Images
                    Images::insert($imagesData);
                }
            }

            $newImages = Images::where('product_id', $id)->get();

            return response()->json(['success' => 'Updated product successfully',
                                     'newImages' => $newImages]);
        }
    }


    public function delete($id)
    {
        // Xoá sản phẩm theo id
        $product = Products::destroy($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'success' => 'Product successfully deleted',
        ]);
    }
}
