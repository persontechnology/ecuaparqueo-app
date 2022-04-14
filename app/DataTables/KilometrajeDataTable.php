<?php

namespace App\DataTables;

use App\Models\Vehiculo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KilometrajeDataTable extends DataTable
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
            ->editColumn('created_at',function($kilometraje){
                return $kilometraje->created_at;
            })
            ->editColumn('updated_at',function($kilometraje){
                return $kilometraje->updated_at;
            })
            ->editColumn('user_create',function($kilometraje){
                return $kilometraje->usuarioCreado->apellidos_nombres??'';
            })
            ->filterColumn('user_create',function($query,$keyword){
                $query->whereHas('usuarioCreado',function($query) use ($keyword){
                    $query->whereRaw('concat(apellidos," ",nombres) or email  like ?',["%{$keyword}%"]);
                });
            })
            ->editColumn('user_update',function($kilometraje){
                return $kilometraje->usuarioActualizado->apellidos_nombres??'';
            })
            ->filterColumn('user_update',function($query,$keyword){
                $query->whereHas('usuarioActualizado',function($query) use ($keyword){
                    $query->whereRaw('concat(apellidos," ",nombres) or email  like ?',["%{$keyword}%"]);
                });
            });

            // ->addColumn('action', 'kilometraje.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Kilometraje $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vehiculo $model)
    {
        $model=$this->vehiculo;
        return $model->kilometrajes()->latest();
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            // Column::make('id'),
            Column::make('numero')->title('Kilometraje'),
            Column::make('created_at')->title('Creado'),
            Column::make('updated_at')->title('Actualizado'),
            Column::make('user_create')->title('Creado por'),
            Column::make('user_update')->title('Actualizado por'),
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Kilometraje_' . date('YmdHis');
    }
}
