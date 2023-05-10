<?php

namespace App\Imports;

use App\Helpers\LanguageCodes;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LanguageImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $row = array_filter($row);

        DB::beginTransaction();
        try {
            // handle case when language is deleted 
            // user still can import lang files and use same title_id
            $lang = Language::withTrashed()->updateOrCreate([
                'title_id'      => $row['titleid']
            ], [
                'default'       => $row['basic'],
                'deleted_at'    => null
            ]);

            unset($row['title_id'], $row['basic']);

            foreach ($row as $key => $value) {
                $langCode = LanguageCodes::getLanguageCodes($key);

                if (!$langCode) {
                    continue;
                }

                $lang->translates()
                    ->withTrashed()
                    ->updateOrCreate(
                        [
                            'lang_code'     => $langCode,
                        ],
                        [
                            'lang_code'     => $langCode,
                            'text'          => $value,
                            'deleted_at'    => null
                        ]
                    );
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage(), $row);

            throw $th;
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 100;
    }
}
