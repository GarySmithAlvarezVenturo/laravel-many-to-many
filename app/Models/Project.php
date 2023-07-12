<?php

namespace App\Models;

use App\Models\Type;
use App\Traits\Slugger;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Slugger;

    public $timestamps = false;

    public function getRouteKey()
    {
        return $this->slug;
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }
    
}
