<?php

namespace App\DataTables\OrdenMovilizacion\Control;

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
                return $vehiculo->tipoVehiculo->nombre??'';
            })
            ->filterColumn('tipo_vehiculo_id',function($query,$keyword){
                $query->whereHas('tipoVehiculo',function($query) use ($keyword){
                    $query->whereRaw('nombre like ?',["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($ve){
                return view('movilizacion.control.actionVehiculo',['vehiculo'=>$ve])->render();
            })->rawColumns(['action','foto']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrdenMovilizacion/Control/Vehiculo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vehiculo $model)
    {
        return $model->newQuery()->where('estado','Activo')->with('espacio');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('vt')
                    ->columns($this->getColumns())
                   ->minifiedAjax()
                   ->ajax(['data' => 'function(d) { d.table = "vehiculos"; }'])
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
                  ->title('Acción')
                  ->searchable(false)
                  ->addClass('text-center'),
            Column::make('foto')->searchable(false),
            Column::make('numero_movil')->title('N° Móvil'),
            Column::make('modelo')->title('Modelo'),
            Column::make('marca')->title('Marca'),
            Column::make('placa'),
            Column::make('color'),
            Column::make('tipo_vehiculo_id')->title('Tipo'),
            Column::make('estado'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OrdenMovilizacion_Control_Vehiculo_' . date('YmdHis');
    }
}
