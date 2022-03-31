<div>


    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-pointer icon-3x text-success"></i>
                    </div>

                    <div class="media-body text-right">
                        <h3 class="font-weight-semibold mb-0">{{ $data['contadorVehiculo'] ?? 0 }}</h3>
                        <span class="text-uppercase font-size-sm text-muted">Vehículos</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-enter6 icon-3x text-indigo"></i>
                    </div>

                    <div class="media-body text-right">
                        <h3 class="font-weight-semibold mb-0">{{ $data['contadorOrdenes'] ?? 0 }}</h3>
                        <span class="text-uppercase font-size-sm text-muted">Ordenes</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body">
                <div class="media">
                    <div class="media-body">
                        <h3 class="font-weight-semibold mb-0">{{ $data['contadorParqueaderos'] ?? 0 }}</h3>
                        <span class="text-uppercase font-size-sm text-muted">Parqueaderos</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-bubbles4 icon-3x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body">
                <div class="media">
                    <div class="media-body">
                        <h3 class="font-weight-semibold mb-0">{{ $data['contadorEstacionamientro'] ?? 0 }}</h3>
                        <span class="text-uppercase font-size-sm text-muted">Estacionaes</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-bag icon-3x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main charts -->
</div>
