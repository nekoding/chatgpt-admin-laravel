<?php

namespace App\DataTables;

use App\DataTables\Style\DatatableStyle;
use App\Models\OpenAiPrompt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OpenAiPromptDataTable extends DataTable
{

    use DatatableStyle;

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (OpenAiPrompt $openAiPrompt) {
                return view('pages.prompt.datatable_action', compact('openAiPrompt'));
            })
            ->setRowId('id')
            ->addIndexColumn()
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OpenAiPrompt $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('openaiprompt-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->dom($this->getDataTableDomConfiguration())
            ->orderBy(1)
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
            Column::make('id')->visible(false)->exportable(false)->printable(false),
            Column::make('key'),
            Column::make('prompt_template'),
            Column::make('created_at')->visible(false)->exportable(false)->printable(false),
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
        return 'OpenAiPrompt_' . date('YmdHis');
    }
}
