<?php

namespace App\DataTables;

use App\Models\Departamento;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DepartamentoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id',function($dep){
                return $dep->supervisor->apellidos.' '.$dep->supervisor->nombres;
            })
            ->filterColumn('user_id',function($query,$keyword){
                $query->whereHas('supervisor',function($query) use($keyword){
                    $query->whereRaw("concat(apellidos,' ',nombres) like ?",["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($dep){
                return view('departamentos.action',['departamento'=>$dep])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Departamento $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Departamento $model)
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
                    // ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    // ->orderBy(1)
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->searchable(false)
                  ->title('Acción')
                  ->addClass('text-center'),
            // Column::make('id'),
            Column::make('nombre'),
            Column::make('descripcion')->title('Descripción'),
            Column::make('user_id')->title('Supervisor'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Departamento_' . date('YmdHis');
    }
}
