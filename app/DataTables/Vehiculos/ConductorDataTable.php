<?php

namespace App\DataTables\Vehiculos;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ConductorDataTable extends DataTable
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
            ->editColumn('foto',function($user){
                return view('usuarios.foto',['user'=>$user])->render();
            })
            ->addColumn('action', function($user){
                return view('vehiculos.conductor.action',['user'=>$user])->render();
            })->rawColumns(['foto','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Vehiculos/Conductor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                  ->addClass('text-center'),
            Column::make('foto'),
            Column::make('apellidos')->title('Apellidos'),
            Column::make('nombres')->title('Nombres'),
            Column::make('documento')->title('# Documento'),
            Column::make('email'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Vehiculos_Conductor_' . date('YmdHis');
    }
}
