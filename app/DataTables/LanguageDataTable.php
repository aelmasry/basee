<?php

namespace App\DataTables;

use App\Models\Language;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class LanguageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        return $dataTable
            ->editColumn('created_at', function ($language) {
                return getDateColumn($language, 'created_at');
            })
            ->editColumn('active', function ($language) {
                return getSwitchColumn($language, 'active');
            })
            ->editColumn('default', function ($language) {
                return getBooleanColumn($language, 'default');
            })
            ->addIndexColumn()
            ->addColumn('action', 'admin.languages.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Language $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Language $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'),
                [
                    // 'dom'       => 'Bfrtip',
                    'stateSave' => true,
                    'order'     => [[0, 'desc']],
                    'language' => json_decode(
                        file_get_contents(
                            base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ),
                        true
                    )
                ]
            ));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                "data" => 'DT_RowIndex',
                'title' => '#',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'name',
                'title' => trans('lang.name'),

            ],
            [
                'data' => 'native',
                'title' => trans('lang.native'),

            ],
            [
                'data' => 'abbr',
                'title' => trans('lang.abbr'),

            ],
            [
                'data' => 'default',
                'title' => trans('lang.default'),
                'searchable' => false,
            ],
            [
                'data' => 'active',
                'title' => trans('lang.active'),
                'searchable' => false,
            ],
            [
                'data' => 'created_at',
                'title' => trans('lang.created_at'),
                'searchable' => false,
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Language_' . date('YmdHis');
    }
}
