<?php

namespace App\DataTables;

use App\Models\DespachoCombustible;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DespachoCombustibleDataTable extends DataTable
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
            ->editColumn('vehiculo_id',function($dc){
                return $dc->vehiculo->numero_movil;
            })
            ->editColumn('foto',function($dc){
                return view('despachoCombustible.foto',['foto'=>$dc->foto])->render();
            })
            ->editColumn('estado',function($dc){
                return view('despachoCombustible.estado',['estado'=>$dc->estado])->render();
            })
            ->editColumn('chofer_id',function($dc){
                return $dc->conductor->apellidos_nombres;
            })
            ->filterColumn('vehiculo_id',function($query,$keyword){
                $query->whereHas('vehiculo',function($query) use($keyword){
                    $query->whereRaw('numero_movil like ?',["%{$keyword}%"]);
                });
            })
            ->filterColumn('chofer_id',function($query,$keyword){
                $query->whereHas('conductor',function($query) use($keyword){
                    $query->whereRaw("concat(apellidos,' ',nombres) like ?",["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($dc){
                return view('despachoCombustible.actionTable',['dc'=>$dc])->render();
            })->rawColumns(['action','estado','foto']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DespachoCombustible $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DespachoCombustible $model)
    {
        return $model->newQuery()->latest();
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
                  ->title('Ver')
                  ->addClass('text-center'),
            Column::make('estado')->title('Estado'),      
            Column::make('foto')->title('foto'),      
            Column::make('codigo')->title('Código'),
            Column::make('numero')->title('N° despacho'),
            Column::make('fecha'),
            Column::make('vehiculo_id')->title('N° movil'),
            Column::make('kilometraje')->title('Kilometraje'),
            Column::make('chofer_id')->title('Conductor'),
            Column::make('destino')->title('Destino'),
            Column::make('concepto')->title('Concepto'),
            Column::make('cantidad_galones')->title('Cantidad'),
            Column::make('valor')->title('Valor'),
            Column::make('observaciones')->title('Observaciones'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DespachoCombustible_' . date('YmdHis');
    }
}
