<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductSize;
use App\Models\Product;
use App\Models\ProductImage;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    // =========================
    // INDEX
    // =========================

    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    // =========================
    // CREATE
    // =========================

    public function create()
    {
        return view('admin.products.create');
    }

    // =========================
    // STORE
    // =========================

    public function store(Request $request)
    {

        // VALIDATION
        $request->validate([

            'name' => 'required',

            'price' => 'required|numeric',

            'image' => 'required|image|mimes:jpg,jpeg,png,webp',

            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            
            'size_chart' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        // =========================
        // UPLOAD COVER IMAGE
        // =========================

        $imageFile = $request->file('image');

$imageName = time() . '_' .
    $imageFile->getClientOriginalName();

$imageFile->move(
    base_path('../public_html/storage/products'),
    $imageName
);

$coverImage = 'products/' . $imageName;
        // =========================
        // CREATE PRODUCT
        // =========================
        
        $totalStock = 0;

if ($request->sizes) {

    foreach ($request->sizes as $stock) {

        $totalStock += (int) $stock;
    }
}

$sizeChartPath = null;

if ($request->hasFile('size_chart')) {

    $chart = $request->file('size_chart');

    $chartName = time() . '_chart_' .
        $chart->getClientOriginalName();

    $chart->move(
        base_path('../public_html/storage/size-chart'),
        $chartName
    );

    $sizeChartPath =
        'storage/size-chart/' . $chartName;
}

        $product = Product::create([

            'name' => $request->name,

            'slug' => Str::slug($request->name),

            'description' => $request->description,

            'price' => $request->price,
            
            'saleprice' => $request->saleprice,

            'category' => $request->category,

            'image' => $coverImage,

            'size_chart' => $sizeChartPath,
            
            'stock' => $totalStock,
        ]);
        
        // =========================
        // SAVE PRODUCT SIZES
        // =========================
        
        if ($request->sizes) {
        
            foreach ($request->sizes as $size => $stock) {
        
                ProductSize::create([
        
                    'product_id' => $product->id,
        
                    'size' => $size,
        
                    'stock' => $stock ?? 0,
                ]);
            }
        }

        // =========================
        // MULTIPLE GALLERY IMAGES
        // =========================

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $galleryImage) {

                $galleryName = time() . '_' .
    $galleryImage->getClientOriginalName();

$galleryImage->move(
    base_path('../public_html/storage/products/gallery'),
    $galleryName
);

$path =
    'products/gallery/' . $galleryName;
                ProductImage::create([

                    'product_id' => $product->id,

                    'image' => $path,
                ]);
            }
        }


        // =========================
        // REDIRECT
        // =========================

        return redirect('/admin/products')
            ->with('success', 'Product created successfully');
    }

    // =========================
// EDIT
// =========================

public function edit(Product $product)
{
    $product->load(
        'sizes',
        'images'
    );

    return view(
        'admin.products.edit',
        compact('product')
    );
}

// =========================
// UPDATE
// =========================

public function update(Request $request, Product $product)
{

    // VALIDATION
    $request->validate([

        'name' => 'required',

        'price' => 'required|numeric',

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

        'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        
        'size_chart' => 'nullable|image|mimes:jpg,jpeg,png,webp',
    ]);

    // =========================
    // UPDATE COVER IMAGE
    // =========================

    if ($request->hasFile('image')) {

        $imageFile = $request->file('image');

$imageName = time() . '_' .
    $imageFile->getClientOriginalName();

$imageFile->move(
    base_path('../public_html/storage/products'),
    $imageName
);

$product->image =
    'products/' . $imageName;

$product->save();
    }

    // =========================
    // UPDATE DATA
    // =========================
    
    $totalStock = 0;

if ($request->sizes) {

    foreach ($request->sizes as $stock) {

        $totalStock += (int) $stock;
    }
}

    $product->update([

        'name' => $request->name,

        'slug' => Str::slug($request->name),

        'description' => $request->description,

        'price' => $request->price,
        
        'saleprice' => $request->saleprice,

        'category' => $request->category,

        // 'size_chart' => $request->size_chart,
        
        'stock' => $totalStock,
    ]);
    
// =========================
// UPDATE PRODUCT SIZES
// =========================

if ($request->has('sizes')) {

    // DELETE OLD SIZES
    $product->sizes()->delete();

    foreach ($request->sizes as $size => $stock) {

        ProductSize::create([

            'product_id' => $product->id,

            'size' => $size,

            'stock' => $stock ?? 0,
        ]);
    }
}

if ($request->hasFile('size_chart')) {
    
    if (
        $product->size_chart &&
        file_exists(
            base_path('../public_html/' . $product->size_chart)
        )
    ) {
    
        unlink(
            base_path('../public_html/' . $product->size_chart)
        );
    }
    
    $chart = $request->file('size_chart');

    $chartName = time() . '_chart_' .
        $chart->getClientOriginalName();

    $chart->move(
        base_path('../public_html/storage/size-chart'),
        $chartName
    );

    $product->size_chart =
        'storage/size-chart/' . $chartName;

    $product->save();
}

    // =========================
    // ADD NEW GALLERY IMAGES
    // =========================

    if ($request->hasFile('gallery')) {

        foreach ($request->file('gallery') as $galleryImage) {

            $galleryName = time() . '_' .
    $galleryImage->getClientOriginalName();

$galleryImage->move(
    base_path('../public_html/storage/products/gallery'),
    $galleryName
);

$path =
    'products/gallery/' . $galleryName;

            \App\Models\ProductImage::create([

                'product_id' => $product->id,

                'image' => $path,
            ]);
        }
    }

    return redirect('/admin/products')
        ->with('success', 'Product updated successfully');
}

// =========================
// DELETE
// =========================

public function destroy(Product $product)
{

    // =========================
    // DELETE COVER IMAGE
    // =========================

    if ($product->image) {

        if (file_exists(
    public_path('storage/' . $product->image)
)) {

    unlink(
        public_path('storage/' . $product->image)
    );
}
    }

    // =========================
    // DELETE GALLERY IMAGES
    // =========================

    foreach ($product->images as $img) {

        if (file_exists(
    public_path('storage/' . $img->image)
)) {

    unlink(
        public_path('storage/' . $img->image)
    );
}

        $img->delete();
    }

    // =========================
    // DELETE PRODUCT
    // =========================
    // DELETE PRODUCT SIZES
    $product->sizes()->delete();
    
    // DELETE SIZE CHART
    if (
        $product->size_chart &&
        file_exists(
            base_path('../public_html/' . $product->size_chart)
        )
    ) {
    
        unlink(
            base_path('../public_html/' . $product->size_chart)
        );
    }

    $product->delete();

    return redirect('/admin/products')
        ->with('success', 'Product deleted successfully');
}

// =========================
// DELETE SINGLE GALLERY
// =========================

public function deleteGallery(ProductImage $image)
{

    // DELETE STORAGE
    if ($image->image) {

        if (file_exists(
    public_path('storage/' . $image->image)
)) {

    unlink(
        public_path('storage/' . $image->image)
    );
}
    }

    // DELETE DATABASE
    $image->delete();

    return back()
        ->with('success', 'Gallery image deleted');
}

}