<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded = [];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function isProjectMember($user_id)
    {
        $isMember = false;
        foreach ($this->users as $user) {
            if ($user->id == $user_id) {
                $isMember = true;
            }
        }
        return $isMember;
    }
}
