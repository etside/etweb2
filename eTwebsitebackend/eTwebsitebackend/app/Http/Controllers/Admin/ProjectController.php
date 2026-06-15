<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {
    public function index() {
        return view('admin.projects.index', ['projects' => Project::orderBy('display_order')->get()]);
    }
    public function create() {
        return view('admin.projects.form', ['project' => new Project]);
    }
    public function store(Request $r) {
        $data = $this->validated($r);
        $this->uploads($r, $data, new Project);
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success','Project created.');
    }
    public function edit(Project $project) {
        return view('admin.projects.form', compact('project'));
    }
    public function update(Request $r, Project $project) {
        $data = $this->validated($r);
        $this->uploads($r, $data, $project);
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success','Project updated.');
    }
    public function destroy(Project $project) {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success','Deleted.');
    }

    private function validated(Request $r): array {
        $d = $r->validate([
            'name'           =>'required|max:255',
            'category'       =>'nullable|max:100',
            'description'    =>'nullable',
            'url'            =>'nullable|url',
            'features'       =>'nullable',
            'tech_stack'     =>'nullable',
            'login_username' =>'nullable|max:255',
            'login_password' =>'nullable|max:255',
            'display_order'  =>'nullable|integer',
        ]);
        $d['is_active'] = $r->boolean('is_active');
        return $d;
    }

    private function uploads(Request $r, array &$d, Project $project): void {
        if ($r->hasFile('logo'))
            $d['logo_url'] = 'storage/'.$r->file('logo')->store('logos','public');
        if ($r->hasFile('cover_image'))
            $d['cover_image'] = 'storage/'.$r->file('cover_image')->store('projects','public');
        if ($r->hasFile('screenshots')) {
            $paths = $project->screenshots ?? [];
            foreach ($r->file('screenshots') as $f)
                $paths[] = 'storage/'.$f->store('projects/screenshots','public');
            $d['screenshots'] = $paths;
        }
    }
}
