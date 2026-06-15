<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\HandleFileUploads;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use HandleFileUploads;

    public function index() { return view('admin.services.index', ['services' => Service::orderBy('display_order')->get()]); }
    public function create() { return view('admin.services.form', ['service' => new Service]); }

    public function store(Request $request)
    {
        $data = $request->validate(['title'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','image'=>'nullable|image|max:2048','logo'=>'nullable|image|max:2048','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        
        $files = $this->uploadFiles($request, ['image', 'logo'], 'services');
        if ($files['image'] ?? null) $data['image_url'] = $files['image'];
        if ($files['logo'] ?? null) $data['logo_url'] = $files['logo'];
        
        unset($data['image'], $data['logo']);
        
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success','Service created.');
    }

    public function edit(Service $service) { return view('admin.services.form', compact('service')); }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate(['title'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','image'=>'nullable|image|max:2048','logo'=>'nullable|image|max:2048','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        
        $files = $this->uploadFiles($request, ['image', 'logo'], 'services');
        if ($files['image'] ?? null) $data['image_url'] = $files['image'];
        if ($files['logo'] ?? null) $data['logo_url'] = $files['logo'];
        
        unset($data['image'], $data['logo']);
        
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success','Service updated.');
    }

    public function destroy(Service $service) { $service->delete(); return redirect()->route('admin.services.index')->with('success','Deleted.'); }
}
