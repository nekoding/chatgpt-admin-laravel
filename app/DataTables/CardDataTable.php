<?php

namespace App\DataTables;

use App\Models\Card;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CardDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Card $card) {
                return view('pages.cards.datatable_action', compact('card'));
            })
            ->addColumn('thumbnail', function (Card $card) {
                $image = $card->images->filter(fn ($image) => $image->data['card_key'] == $card->getPrimaryCardKey())->first();
                return view('pages.cards.thumbnail', compact('card', 'image'));
            })
            ->filterColumn('title_lang.default', function ($query, $keyword) {
                return $query->whereHas('titleLang', function ($q) use (&$keyword) {
                    return $q->where('default', 'like', '%' . $keyword . '%')
                        ->orWhereHas('translates', function ($q) use (&$keyword) {
                            return $q->where('text', 'like', '%' . $keyword . '%');
                        });
                });
            })
            ->filterColumn('upright_lang.default', function ($query, $keyword) {
                return $query->whereHas('uprightLang', function ($q) use (&$keyword) {
                    return $q->where('default', 'like', '%' . $keyword . '%')
                        ->orWhereHas('translates', function ($q) use (&$keyword) {
                            return $q->where('text', 'like', '%' . $keyword . '%');
                        });
                });
            })
            ->filterColumn('reversed_lang.default', function ($query, $keyword) {
                return $query->whereHas('reversedLang', function ($q) use (&$keyword) {
                    return $q->where('default', 'like', '%' . $keyword . '%')
                        ->orWhereHas('translates', function ($q) use (&$keyword) {
                            return $q->where('text', 'like', '%' . $keyword . '%');
                        });
                });
            })
            ->addIndexColumn()
            ->setRowId('id')
            ->rawColumns(['thumbnail', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Card $model): QueryBuilder
    {
        return $model
            ->with([
                'titleLang',
                'uprightLang',
                'reversedLang',
                'images'
            ])
            ->select('cards.*')
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('card-table')
            ->columns($this->getColumns())
            ->addTableClass('w-100')
            ->minifiedAjax()
            ->orderBy(1)
            ->buttons([
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
            Column::computed('thumbnail')->title('Thumbnail'),
            Column::make('title_lang.default')->title('Card Title'),
            Column::make('upright_lang.default')->title('Card Upright'),
            Column::make('reversed_lang.default')->title('Card Reversed'),
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
        return 'Card_' . date('YmdHis');
    }
}
