<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Query extends Model
{
    use HasFactory;

    protected $table = 'queries';

    protected $guarded = ['id'];

    protected $casts = [
        'resolved_at' => 'datetime'
    ];

    public function scopeTopConcerns(Builder $query)
    {
        $max_count = $query->select(DB::raw('COUNT(*) as count'))
            ->groupBy('concern')
            ->orderByDesc('count')
            ->limit(1)
            ->value('count');

        return $query->select('concern', DB::raw('COUNT(*) as count'))
            ->groupBy('concern')
            ->havingRaw('COUNT(*) = ?', [$max_count]);
    }

    public function scopeConcernsCount(Builder $query)
    {
        return $query->select('concern', DB::raw('COUNT(*) as count'))
            ->groupBy('concern')
            ->orderByDesc('count');
    }

    public function handler()
{
    return $this->belongsTo(User::class, 'resolved_by');
}
}
