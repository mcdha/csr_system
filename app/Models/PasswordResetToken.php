<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PasswordResetToken extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = "uuid";

    protected $fillable = [
        'email',
        'token',
        'uuid',
        'is_activated'
    ];
    
    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
