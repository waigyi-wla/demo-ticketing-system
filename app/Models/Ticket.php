<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'developer_id', 'category_id', 'code', 'title', 'priority', 'description', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }
}
