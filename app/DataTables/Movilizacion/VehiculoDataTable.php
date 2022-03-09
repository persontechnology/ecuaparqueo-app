<?php

namespace App\DataTables\Movilizacion;

use App\Models\Vehiculo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VehiculoDataTable extends DataTable
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
            ->editColumn('foto',function($vehiculo){
                return view('vehiculos.foto',['vehiculo'=>$vehiculo])->render();
            })
            ->editColumn('tipo_vehiculo_id',function($vehiculo){
                return $vehiculo->tipoVehiculo->nombre;
            })
            ->filterColumn('tipo_vehiculo_id',function($query,$keyword){
                $query->whereHas('tipoVehiculo',function($query) use ($keyword){
                    $query->whereRaw('nombre like ?',["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($vehiculo){
                return view('movilizacion.actionVehiculo',['vehiculo'=>$vehiculo])->render();
            })->rawColumns(['action','foto']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Movilizacion/Vehiculo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vehiculo $model)
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
                    ->setTableId('movilizacion-vehiculo-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
                    // ->dom('Bfrtip')
                    // ->orderBy(1)
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
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
                  ->title('Seleccionar')
                  ->addClass('text-center'),
            // Column::make('id'),
            Column::make('foto')->searchable(false),
            Column::make('placa'),
            Column::make('color'),
            Column::make('numero_chasis')->title('Número de chasis'),
            Column::make('tipo_vehiculo_id')->title('Tipo'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Movilizacion/Vehiculo_' . date('YmdHis');
    }
}
