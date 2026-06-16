<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'cli_documents';

    protected $fillable = [
        'cliente_id',
        'type',
        'name',
        'current_version'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function versions()
    {
        return $this->hasMany(DocumentVersion::class, 'document_id');
    }
}
