<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategoryDataTable extends DataTable
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
            ->editColumn('created_at', function ($category) {
                return getDateColumn($category, 'created_at');
            })
            ->editColumn('image', function ($category) {
                return getMediaColumn($category, 'category');
            })
            ->editColumn('parent_id', function ($category) {
                $name = 'name_'.app()->getLocale();
                return optional($category->parent)->$name;
            })
            ->editColumn('status', function ($category) {
                return getSwitchColumn($category, 'status');
            })
            ->addIndexColumn()
            ->addColumn('action', 'admin.categories.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
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
            ->parameters([
                    // 'dom'       => 'Bfrtip',
                    'stateSave' => true,
                    'order'     => [[0, 'desc']],
                    'language' => json_decode(
                        file_get_contents(
                            base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ),
                        true
                    )
                ]);
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
                'data' => 'name_en',
                'title' => trans('lang.category_name'),

            ],
            [
                'data' => 'name_ar',
                'title' => trans('lang.category_name_ar'),

            ],
            [
                'data' => 'parent_id',
                'title' => trans('lang.parent'),

            ],
            [
                'data' => 'image',
                'title' => trans('lang.image'),
                'searchable' => false,
                'printable' => false,
            ],
            [
                'data' => 'status',
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
        return 'categories_' . time();
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }
}
