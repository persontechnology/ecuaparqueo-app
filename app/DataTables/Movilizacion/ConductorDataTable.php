<?php

namespace App\DataTables\Movilizacion;

use App\Models\User;
use Spatie\Permission\Models\Role;
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
                return view('movilizacion.actionConductor',['user'=>$user])->render();
            })
            ->rawColumns(['foto','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Movilizacion/Conductor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $no_roles = Role::whereNotIn('name', ['SuperAdmin', 'SiteAdmin'])->get();

        return $model->role($no_roles);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('movilizacion-conductor-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->ajax(['data' => 'function(d) { d.table = "table_conductor"; }'])
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
            Column::make('foto'),
            Column::make('apellidos'),
            Column::make('nombres'),
            Column::make('email'),
            Column::make('documento'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Movilizacion_Conductor_' . date('YmdHis');
    }
}
