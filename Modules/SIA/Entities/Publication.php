<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'reviewer_id',
        'title',
        'content',
        'location',
        'publication_date',
        'status',
        'review_date',
        'reviewer_comments',
    ];
    
 // Relation with the author (user)
 public function author()
 {
     return $this->belongsTo(User::class, 'author_id');
 }

 // Relation with the reviewer (user)
 public function reviewer()
 {
     return $this->belongsTo(User::class, 'reviewer_id');
 }
}