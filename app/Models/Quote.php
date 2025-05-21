<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'service_id', 'phone', 'message', 'status', 'notes'
    ];

    /**
     * Get the service that was requested.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}