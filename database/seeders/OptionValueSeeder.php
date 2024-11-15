<?php

namespace Database\Seeders;

use App\Models\Query;
use App\Models\OptionValue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OptionValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = Query::distinct()->pluck('branch')->toArray();
        $departments = Query::distinct()->pluck('department')->toArray();
        $channels = Query::distinct()->pluck('channel')->toArray();
        $concerns = Query::distinct()->pluck('concern')->toArray();

        OptionValue::create([
            'table' => 'queries',
            'field' => 'branch',
            'values' => $branches
        ]);

        OptionValue::create([
            'table' => 'queries',
            'field' => 'department',
            'values' => $departments
        ]);

        OptionValue::create([
            'table' => 'queries',
            'field' => 'channel',
            'values' => $channels
        ]);

        OptionValue::create([
            'table' => 'queries',
            'field' => 'concern',
            'values' => $concerns
        ]);
    }
}
