<?php

namespace App\DataTables;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LanguageDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('translates.en_us', function (Language $language) {
                return $language->translates->where('lang_code', 'en_us')->first()?->text;
            })
            ->addColumn('translates.en_uk', function (Language $language) {
                return $language->translates->where('lang_code', 'en_uk')->first()?->text;
            })
            ->addColumn('translates.ja_jp', function (Language $language) {
                return $language->translates->where('lang_code', 'ja_jp')->first()?->text;
            })
            ->addColumn('translates.in_id', function (Language $language) {
                return $language->translates->where('lang_code', 'in_id')->first()?->text;
            })
            ->addColumn('translates.zh_cn', function (Language $language) {
                return $language->translates->where('lang_code', 'zh_cn')->first()?->text;
            })
            ->filterColumn('translates.en_us', function ($query, $keyword) {
                return $query->whereHas('translates', function ($q) use (&$keyword) {
                    return $q->where('text', 'like', '%' . $keyword . '%');
                });
            })
            ->editColumn('action', function (Language $language) {
                return view('pages.languages.datatable_action', compact('language'));
            })
            ->addIndexColumn()
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Language $model): QueryBuilder
    {
        return $model
            ->with('translates')
            ->select('languages.*')
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->pageLength(50)
            ->addTableClass('w-100')
            ->responsive(true)
            ->setTableId('language-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(8)
            // ->selectStyleSingle()
            ->buttons([
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('No'),
            Column::make('title_id')->title('TitleID'),
            Column::make('default')->title('Basic'),
            Column::make('translates.en_us')->sortable(false)->title('English (America)'),
            Column::make('translates.en_uk')->sortable(false)->title('English (British)'),
            Column::make('translates.ja_jp')->sortable(false)->title('Japanese'),
            Column::make('translates.in_id')->sortable(false)->title('Indonesian'),
            Column::make('translates.zh_cn')->sortable(false)->title('Chinese (Simplified)'),
            Column::make('updated_at')->visible(false)->exportable(false)->printable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Language_' . date('YmdHis');
    }
}
