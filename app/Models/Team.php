<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
/**
 * @property int $id
 * @property string $name
 */
class Team extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'teams';


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id');
    }
}
