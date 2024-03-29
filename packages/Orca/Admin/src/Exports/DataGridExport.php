<?php

namespace Orca\Admin\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

/**
 * DataGridExport class
 *
 * @author     <>
 *
 */

class DataGridExport implements FromView, ShouldAutoSize
{

    /**
     * DataGrid instance
     *
     * @var mixed
     */
    protected $gridData = array();

    /**
     * Create a new instance.
     *
     * @param mixed DataGrid
     * @return void
     */
    public function __construct($gridData)
    {
        $this->gridData = $gridData;
    }

     /**
     * function to create a blade view for export.
     *
     */
    public function view(): View
    {
        $columns = array();

        foreach($this->gridData as $key => $gridData) {
            $columns = array_keys((array) $gridData);

            break;
        }

        return view('admin::export.temp', [
            'columns' => $columns,
            'records' => $this->gridData,
        ]);
    }
}