<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Products;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function list_brand()
    {
        $list_brand = Brand::all();
        return view('admin.brand.list_brand', compact('list_brand'));
    }

    public function create_brand(BrandRequest $request)
    {
        if ($request->isMethod('GET')) {

            return view('admin.brand.create_brand');

        } 
        
        elseif ($request->isMethod('POST')) {

            $new_brand = new Brand();

            $new_brand->brand_name = $request->name;

            $new_brand->save();

            return response()->json(['success' => 'Add Brand successfully']);
        }
    }

    public function edit_brand(BrandRequest $request, $id)
    {
        if ($request->isMethod('GET')) {
            $edit_brand = Brand::find($id);

            return view('admin.brand.update_brand', compact('edit_brand'));
        } else if ($request->isMethod('POST')) {
            $update_brand = Brand::find($id);

            $update_brand->brand_name = $request->name;

            $update_brand->save();

            return response()->json(['success' => 'Update Brand successfully']);
        }
    }

    public function delete($id)
    {
        Brand::destroy($id);

        Products::where('category_id', $id)->update(['category_id' => null]);

        $newData = Brand::all();

        return response()->json([
            'success' => 'Brand successfully deleted',
            'newData' => $newData,
        ]);
    }

    public function search(REQUEST $request)
    {
        $searchBrand = $request->input('search');

        $fields = ['brand_name'];

        $list_brand = search(Brand::class, $searchBrand, $fields);

        // Trả về JSON response
        return view('admin.brand.list_brand', compact('list_brand'));
    }
}
