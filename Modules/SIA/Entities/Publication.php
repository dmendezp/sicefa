<?php

namespace Modules\SIA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Publication extends Model
{
    use SoftDeletes;

    protected $table = 'publications';

    protected $fillable = [
        'author_id',
        'reviewer_id',
        'title',
        'pdf_path',
        'publication_date',
        'status',
        'review_date',
        'reviewer_comments',
    ];

    protected $dates = ['publication_date', 'review_date', 'deleted_at'];

    /**
     * Relación con el autor de la publicación.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relación con el revisor de la publicación.
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Verifica si la publicación está pendiente de revisión.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Actualiza el estado y datos de revisión.
     */
    public function updateStatus($status, $reviewerId = null, $comments = null)
    {
        $this->update([
            'status' => $status,
            'reviewer_id' => $reviewerId,
            'review_date' => $status !== 'pending' ? now() : null,
            'reviewer_comments' => $comments,
        ]);
        return $this;
    }
}