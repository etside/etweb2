<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\HandleFileUploads;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HandleFileUploads;

    public function index() { return view('admin.products.index', ['products' => Product::orderBy('display_order')->get()]); }
    public function create() { return view('admin.products.form', ['product' => new Product]); }

    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','image'=>'nullable|image|max:2048','logo'=>'nullable|image|max:2048','external_url'=>'nullable|url','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        
        $files = $this->uploadFiles($request, ['image', 'logo'], 'products');
        if ($files['image'] ?? null) $data['image_url'] = $files['image'];
        if ($files['logo'] ?? null) $data['logo_url'] = $files['logo'];
        
        unset($data['image'], $data['logo']);
        
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Product created.');
    }

    public function edit(Product $product) { return view('admin.products.form', compact('product')); }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate(['name'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','image'=>'nullable|image|max:2048','logo'=>'nullable|image|max:2048','external_url'=>'nullable|url','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        
        $files = $this->uploadFiles($request, ['image', 'logo'], 'products');
        if ($files['image'] ?? null) $data['image_url'] = $files['image'];
        if ($files['logo'] ?? null) $data['logo_url'] = $files['logo'];
        
        unset($data['image'], $data['logo']);
        
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Product updated.');
    }

    public function destroy(Product $product) { $product->delete(); return redirect()->route('admin.products.index')->with('success','Deleted.'); }
}
