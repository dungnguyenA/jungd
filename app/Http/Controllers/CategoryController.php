<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function list_category()
    {
        $list_category = Categories::all();
        
        return view('admin.category.list_category', compact('list_category'));
    }

    public function create_category(REQUEST $request)
    {
        if ($request->isMethod('GET')) {

            return view('admin.category.create_category');

        } elseif ($request->isMethod('POST')) {

            $rule = [
                'name' => 'required | max:100 | min:2',
            ];

            $message = [
                'required' => 'Không được bỏ trống',
                'min' => 'Không được nhỏ hơn 2 kí tự',
                'max' => 'Không được lớn hơn 100 kí tự',
            ];

            $request->validate($rule, $message);

            $new_category = new Categories();

            $new_category->category_name = $request->name;

            $new_category->save();

            return response()->json(['success' => 'Add Category successfully']);
        }
    }


    public function edit_category(REQUEST $request, $id)
    {
        if ($request->isMethod('GET')) {

            $edit_category = Categories::find($id);

            return view('admin.category.update_category', compact('edit_category'));

        } elseif ($request->isMethod('POST')) {

            $update_category = Categories::find($id);

            $update_category->category_name = $request->name;

            $update_category->save();

            return response()->json(['success' => 'Update Category successfully']);
        }
    }

    public function delete($id)
    {
        // Xoá sản phẩm theo id
        $category = Categories::destroy($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        Products::where('category_id', $id)->update(['category_id' => null]);


        return response()->json([
            'success' => 'Category successfully deleted',
        ]);
    }
}
