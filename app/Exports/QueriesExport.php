<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Query;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QueriesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $start_date = $this->request->start_date ? Carbon::parse($this->request->start_date) :  Query::Oldest()->first()->created_at;
        $end_date = $this->request->end_date ? Carbon::parse($this->request->end_date) : Carbon::now();

        $queries = Query::where(function ($query) use ($start_date, $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date])
                ->orWhereDate('created_at', $start_date)
                ->orWhereDate('created_at', $end_date);
        });

        if ($this->request->branches) {
            $queries = $queries->whereIn('branch', explode(';', $this->request->branches));
        }

        if ($this->request->channels) {
            $queries = $queries->whereIn('channel', explode(';', $this->request->channels));
        }

        if ($this->request->concerns) {
            $queries = $queries->whereIn('concern', explode(';', $this->request->concerns));
        }

        if ($this->request->departments) {
            $queries = $queries->whereIn('department', explode(';', $this->request->departments));
        }

        return $queries;
    }

    public function map($query): array
    {
        return [
            $query->id,
            $query->name,
            $query->branch,
            $query->department,
            $query->channel,
            $query->concern,
            $query->status,
            $query->resolved_by,
            $query->issue,
            $query->action_taken,
            $query->remarks,
            $query->is_member ? 'Yes' : 'No',
            $query->resolved_at ? Date::dateTimeToExcel($query->resolved_at) : null,
            $query->created_at ? Date::dateTimeToExcel($query->created_at) : null,
            $query->updated_at ? Date::dateTimeToExcel($query->updated_at) : null,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Branch',
            'Department',
            'Channel',
            'Concern',
            'Status',
            'Resolved By',
            'Issue',
            'Action Taken',
            'Remarks',
            'Is Member',
            'Resolved At',
            'Created At',
            'Updated At'
        ];
    }
}
