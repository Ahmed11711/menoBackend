<?php

namespace App\Http\Controllers;

use App\Models\Menuo;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 🟢 1. عرض كل المنتجات
    public function index()
    {
        return response()->json(Product::all());
    }

    // 🟢 2. عرض منتجات قسم معين
    public function products($id)
    {
        $category = Menuo::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category Not Found'], 404);
        }

        // جلب المنتجات المرتبطة بالقسم
        $products = $category->products;

        return response()->json($products);
    }

    // 🟢 3. إنشاء منتج جديد
    public function store(Request $request)
    {
        $data = $request->except('image');

        // 📸 رفع الصورة إن وُجدت
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);

            // تخزين الباث الكامل
            $data['image'] = asset('uploads/products/' . $filename);
        }

        $product = Product::create($data);

        return response()->json([
            'message' => 'Product Created Successfully',
            'data' => $product
        ], 201);
    }

    // 🟡 4. تعديل منتج
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        $data = $request->except('image');

        // 📸 لو فيها صورة جديدة نحذف القديمة
        if ($request->hasFile('image')) {
            // حذف القديمة لو موجودة
            if ($product->image) {
                $oldPath = str_replace(asset(''), '', $product->image);
                if (file_exists(public_path($oldPath))) {
                    unlink(public_path($oldPath));
                }
            }

            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);

            // تخزين الباث الكامل
            $data['image'] = asset('uploads/products/' . $filename);
        }

        $product->update($data);

        return response()->json([
            'message' => 'Product Updated Successfully',
            'data' => $product
        ]);
    }

    // 🔴 5. حذف منتج
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        // 🗑️ حذف الصورة لو موجودة
        if ($product->image) {
            $oldPath = str_replace(asset(''), '', $product->image);
            if (file_exists(public_path($oldPath))) {
                unlink(public_path($oldPath));
            }
        }

        $product->delete();

        return response()->json(['message' => 'Product Deleted Successfully']);
    }
}
