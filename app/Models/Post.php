<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    /**
     * Fillable fields.
     *
     * @var string[]
     */
    protected $fillable = ['title', 'subtitle', 'description', 'autor', 'type', 'date', 'link', 'references', 'content', 'image'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
