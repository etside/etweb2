<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = [
        'name','category','description','url','logo_url','cover_image',
        'screenshots','features','tech_stack',
        'login_username','login_password','display_order','is_active',
    ];
    protected $casts = ['is_active'=>'boolean','screenshots'=>'array'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('display_order'); }
}
