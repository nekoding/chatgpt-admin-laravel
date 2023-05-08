<?php

namespace App\Imports;

use App\Helpers\LanguageCodes;
use App\Models\PromptCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PromptCategoryImport implements ToModel, WithHeadingRow, WithBatchInserts
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
            $prompt = PromptCategory::updateOrCreate([
                'title_id'  => $row['titleid']
            ], [
                'default'   => $row['basic']
            ]);

            unset($row['title_id'], $row['basic']);

            foreach ($row as $key => $value) {
                $langCode = LanguageCodes::getLanguageCodes($key);

                if (!$langCode) {
                    continue;
                }

                $prompt->translates()->create([
                    'lang_code'     => $langCode,
                    'text'          => $value
                ]);
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
