<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Person;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'reviewer_id', 'title', 'description', 'image', 'pdf_path', 'publication_date', 'review_date', 'status', 'reviewer_comments'];
    
    protected static function newFactory()
    {
        return \Modules\SIA\Database\factories\PublicationFactory::new();
    }

    public function author()
    {
        return $this->belongsTo(Person::class, 'author_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Person::class, 'reviewer_id');
    }
    
}
