<?php

namespace App\DataTables;

use App\Models\OrdenMovilizacion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdenMovilizacionDataTable extends DataTable
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
            ->editColumn('user_id',function($orden){
                return $orden->info_conductor;
            })
            ->filterColumn('user_id',function($query,$keyword){
                $query->whereHas('conductor',function($query) use ($keyword){
                    $query->whereRaw("concat( apellidos,' ',nombres) like?",["%{$keyword}%"]);
                });
            })
            ->editColumn('vehiculo_id',function($orden){
                return $orden->info_vehiculo;
            })
            ->filterColumn('vehiculo_id',function($query,$keyword){
                $query->whereHas('vehiculo',function($query) use ($keyword){
                    $query->whereRaw("concat( placa,'-',numero_chasis) like?",["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($orden){
                return view('movilizacion.action',['orden'=>$orden])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrdenMovilizacion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrdenMovilizacion $model)
    {
        return $model->newQuery()->orderBy('created_at','desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    // ->setTableId('ordenmovilizacion-table')
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
            Column::make('numero')->title('Número'),
            Column::make('estado')->title('Estado'),
            Column::make('fecha_salida'),
            Column::make('user_id')->title('Conductor'),
            Column::make('vehiculo_id')->title('Vehículo'),
            Column::make('servidor_publico')->title('Servidor público'),
            Column::make('direccion')->title('Dirección'),
            Column::make('lugar_comision')->title('Lugar comisión'),
            Column::make('motivo'),
            Column::make('hora_salida'),
            Column::make('hora_retorno'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OrdenMovilizacion_' . date('YmdHis');
    }
}
