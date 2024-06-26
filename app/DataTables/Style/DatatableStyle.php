<?php

namespace App\DataTables\Style;

trait DatatableStyle
{

    public function getDataTableDomConfiguration(): string
    {
        return "<'row align-items-center'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" .
            "<'row mt-2 align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
    }
}
