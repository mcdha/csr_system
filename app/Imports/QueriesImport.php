<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Query;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class QueriesImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation, SkipsEmptyRows, WithMultipleSheets 
{
    use Importable, SkipsFailures;

    private $success_count = 0;

    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        ++$this->success_count;

        return new Query([
            'name'         => $row['name'],
            'branch'       => $row['branch'],
            'department'   => $row['department'],
            'channel'      => $row['channel'],
            'concern'      => $row['concern'],
            'status'       => $row['status'],
            'resolved_by'  => $row['resolved_by'],
            'issue'        => $row['issue'],
            'action_taken' => $row['action_taken'],
            'remarks'      => $row['remarks'],
            'is_member'    => $row['is_member'] == "Yes" ? 1 : 0,
            'created_at'  =>  Date::excelToDateTimeObject($row['created_at'])
        ]);
    }

    public function getSuccessCount(){
        return $this->success_count;
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'branch' => [
                'required',
                'string',
            ],
            'department' => [
                'required',
                'string',
            ],
            'channel' => [
                'required',
                'string',
            ],
            'concern' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
                'string',
                'in:Pending,Resolved'
            ],
            'resolved_by' => [
                'nullable',
                'string'
            ],
            'issue' => [
                'nullable',
                'string'
            ],
            'action_taken' => [
                'nullable',
                'string'
            ],
            'remarks' => [
                'nullable',
                'string'
            ],
            'resolved_at' => [
                'nullable'
            ],
            'created_at' => [
                'nullable'
            ],
            'updated_at' => [
                'nullable'
            ],
            'is_member' => [
                'required',
                'string',
                'in:Yes,No'
            ],
        ];
    }
}
