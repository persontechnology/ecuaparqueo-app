@extends('layouts.app')
{{-- @section('breadcrumbs', Breadcrumbs::render('parqueaderoListarBrazos', $parqueadero)) --}}
@section('content')
    <div class="content">
        @livewire('reportes.vehiculos.contador-vehiculos')
     
        @livewire('reportes.vehiculos.ordenes-vehiculos')


        <!-- Dashboard content -->
        <div class="row">
            <div class="col-xl-8">

                <!-- Marketing campaigns -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Marketing campaigns</h6>
                        <div class="header-elements">
                            <span class="badge badge-success badge-pill">28 active</span>
                            <div class="list-icons ml-3">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a>
                                        <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed
                                            log</a>
                                        <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
                        <div class="d-flex align-items-center mb-3 mb-sm-0">
                            <div id="campaigns-donut"><svg width="42" height="42">
                                    <g transform="translate(21,21)">
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M1.1634144591899855e-15,19A19,19 0 0,1 -14.050144241469582,12.790365389381929L-7.025072120734791,6.3951826946909645A9.5,9.5 0 0,0 5.817072295949927e-16,9.5Z"
                                                style="fill: rgb(102, 187, 106);"></path>
                                        </g>
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M-14.050144241469582,12.790365389381929A19,19 0 0,1 0.6493373977393208,-18.988900993577726L0.3246686988696604,-9.494450496788863A9.5,9.5 0 0,0 -7.025072120734791,6.3951826946909645Z"
                                                style="fill: rgb(149, 117, 205);"></path>
                                        </g>
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M0.6493373977393208,-18.988900993577726A19,19 0 0,1 5.817072295949928e-15,19L2.908536147974964e-15,9.5A9.5,9.5 0 0,0 0.3246686988696604,-9.494450496788863Z"
                                                style="fill: rgb(255, 112, 67);"></path>
                                        </g>
                                    </g>
                                </svg></div>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold mb-0">38,289 <span
                                        class="text-success font-size-sm font-weight-normal"><i
                                            class="icon-arrow-up12"></i> (+16.2%)</span></h5>
                                <span class="badge badge-mark border-success mr-1"></span> <span
                                    class="text-muted">May 12, 12:30 am</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 mb-sm-0">
                            <div id="campaign-status-pie"><svg width="42" height="42">
                                    <g transform="translate(21,21)">
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M1.1634144591899855e-15,19A19,19 0 0,1 -10.035763324841723,-16.133302652828462L-5.017881662420861,-8.066651326414231A9.5,9.5 0 0,0 5.817072295949927e-16,9.5Z"
                                                style="fill: rgb(41, 182, 246);"></path>
                                        </g>
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M-10.035763324841723,-16.133302652828462A19,19 0 0,1 17.35205039879773,-7.739919053684189L8.676025199398865,-3.8699595268420945A9.5,9.5 0 0,0 -5.017881662420861,-8.066651326414231Z"
                                                style="fill: rgb(239, 83, 80);"></path>
                                        </g>
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M17.35205039879773,-7.739919053684189A19,19 0 0,1 14.540850859600345,12.229622082421841L7.270425429800173,6.1148110412109205A9.5,9.5 0 0,0 8.676025199398865,-3.8699595268420945Z"
                                                style="fill: rgb(129, 199, 132);"></path>
                                        </g>
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M14.540850859600345,12.229622082421841A19,19 0 0,1 5.817072295949928e-15,19L2.908536147974964e-15,9.5A9.5,9.5 0 0,0 7.270425429800173,6.1148110412109205Z"
                                                style="fill: rgb(153, 153, 153);"></path>
                                        </g>
                                    </g>
                                </svg></div>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold mb-0">2,458 <span
                                        class="text-danger font-size-sm font-weight-normal"><i
                                            class="icon-arrow-down12"></i> (-4.9%)</span></h5>
                                <span class="badge badge-mark border-danger mr-1"></span> <span class="text-muted">Jun
                                    4, 4:00 am</span>
                            </div>
                        </div>

                        <div>
                            <a href="#" class="btn btn-indigo"><i class="icon-statistics mr-2"></i> View report</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Campaign</th>
                                    <th>Client</th>
                                    <th>Changes</th>
                                    <th>Budget</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-active table-border-double">
                                    <td colspan="5">Today</td>
                                    <td class="text-right">
                                        <span class="progress-meter" id="today-progress" data-progress="30"><svg width="20"
                                                height="20">
                                                <g transform="translate(10,10)">
                                                    <g class="progress-meter">
                                                        <path d="M0,8A8,8 0 1,1 0,-8A8,8 0 1,1 0,8Z"
                                                            style="fill: none; stroke: rgb(121, 134, 203); stroke-width: 1.5;">
                                                        </path>
                                                        <path
                                                            d="M4.898587196589413e-16,-8A8,8 0 0,1 7.608452130361228,2.472135954999579L0,0Z"
                                                            style="fill: rgb(121, 134, 203);"></path>
                                                    </g>
                                                </g>
                                            </svg></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/brands/facebook.svg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Facebook</a>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark border-primary mr-1"></span>
                                                    02:00 - 03:00
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">Mintlime</span></td>
                                    <td><span class="text-success"><i class="icon-stats-growth2 mr-2"></i> 2.43%</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$5,489</h6>
                                    </td>
                                    <td><span class="badge badge-primary">Active</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-file-stats"></i>
                                                        View statement</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-text2"></i>
                                                        Edit campaign</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-locked"></i>
                                                        Disable campaign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-gear"></i>
                                                        Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/brands/youtube.svg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Youtube videos</a>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark border-danger mr-1"></span>
                                                    13:00 - 14:00
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">CDsoft</span></td>
                                    <td><span class="text-success"><i class="icon-stats-growth2 mr-2"></i> 3.12%</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$2,592</h6>
                                    </td>
                                    <td><span class="badge badge-danger">Closed</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-file-stats"></i>
                                                        View statement</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-text2"></i>
                                                        Edit campaign</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-locked"></i>
                                                        Disable campaign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-gear"></i>
                                                        Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/brands/spotify.svg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Spotify ads</a>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark border-secondary mr-1"></span>
                                                    10:00 - 11:00
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">Diligence</span></td>
                                    <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> -
                                            8.02%</span></td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$1,268</h6>
                                    </td>
                                    <td><span class="badge badge-secondary">On hold</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-file-stats"></i>
                                                        View statement</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-text2"></i>
                                                        Edit campaign</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-locked"></i>
                                                        Disable campaign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-gear"></i>
                                                        Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/brands/twitter.svg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Twitter ads</a>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark border-secondary mr-1"></span>
                                                    04:00 - 05:00
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">Deluxe</span></td>
                                    <td><span class="text-success"><i class="icon-stats-growth2 mr-2"></i> 2.78%</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$7,467</h6>
                                    </td>
                                    <td><span class="badge badge-secondary">On hold</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-file-stats"></i>
                                                        View statement</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-text2"></i>
                                                        Edit campaign</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-locked"></i>
                                                        Disable campaign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-gear"></i>
                                                        Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="table-active table-border-double">
                                    <td colspan="5">Yesterday</td>
                                    <td class="text-right">
                                        <span class="progress-meter" id="yesterday-progress" data-progress="65"><svg
                                                width="20" height="20">
                                                <g transform="translate(10,10)">
                                                    <g class="progress-meter">
                                                        <path d="M0,8A8,8 0 1,1 0,-8A8,8 0 1,1 0,8Z"
                                                            style="fill: none; stroke: rgb(121, 134, 203); stroke-width: 1.5;">
                                                        </path>
                                                        <path
                                                            d="M4.898587196589413e-16,-8A8,8 0 1,1 -6.472135954999579,4.702282018339786L0,0Z"
                                                            style="fill: rgb(121, 134, 203);"></path>
                                                    </g>
                                                </g>
                                            </svg></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/brands/bing.svg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Bing campaign</a>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark border-success mr-1"></span>
                                                    15:00 - 16:00
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">Metrics</span></td>
                                    <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> -
                                            5.78%</span></td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$970</h6>
                                    </td>
                                    <td><span class="badge badge-success">Pending</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-file-stats"></i>
                                                        View statement</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-text2"></i>
                                                        Edit campaign</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-locked"></i>
                                                        Disable campaign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-gear"></i>
                                                        Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/brands/amazon.svg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Amazon ads</a>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark border-danger mr-1"></span>
                                                    18:00 - 19:00
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">Blueish</span></td>
                                    <td><span class="text-success"><i class="icon-stats-growth2 mr-2"></i> 6.79%</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$1,540</h6>
                                    </td>
                                    <td><span class="badge badge-primary">Active</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-file-stats"></i>
                                                        View statement</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-text2"></i>
                                                        Edit campaign</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-locked"></i>
                                                        Disable campaign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-gear"></i>
                                                        Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/brands/dribbble.svg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Dribbble ads</a>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark border-primary mr-1"></span>
                                                    20:00 - 21:00
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">Teamable</span></td>
                                    <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> 9.83%</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$8,350</h6>
                                    </td>
                                    <td><span class="badge badge-danger">Closed</span></td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-file-stats"></i>
                                                        View statement</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-text2"></i>
                                                        Edit campaign</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-file-locked"></i>
                                                        Disable campaign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-gear"></i>
                                                        Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /marketing campaigns -->


                <!-- Quick stats boxes -->
                <div class="row">
                    <div class="col-lg-4">

                        <!-- Members online -->
                        <div class="card bg-teal text-white">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">3,450</h3>
                                    <span class="badge badge-dark badge-pill align-self-center ml-auto">+53,6%</span>
                                </div>

                                <div>
                                    Members online
                                    <div class="font-size-sm opacity-75">489 avg</div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div id="members-online"><svg width="171.09375" height="50">
                                        <g width="171.09375">
                                            <rect class="d3-random-bars" width="4.928626543209876" x="2.112268518518518"
                                                height="28.947368421052634" y="21.052631578947366"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="9.153163580246913"
                                                height="36.84210526315789" y="13.15789473684211"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="16.194058641975307"
                                                height="50" y="0" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="23.234953703703702"
                                                height="34.21052631578947" y="15.789473684210527"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="30.275848765432098"
                                                height="31.57894736842105" y="18.42105263157895"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="37.316743827160494"
                                                height="39.473684210526315" y="10.526315789473685"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="44.357638888888886"
                                                height="50" y="0" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="51.398533950617285"
                                                height="39.473684210526315" y="10.526315789473685"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="58.43942901234568"
                                                height="39.473684210526315" y="10.526315789473685"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="65.48032407407406"
                                                height="50" y="0" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="72.52121913580247"
                                                height="47.368421052631575" y="2.631578947368425"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="79.56211419753086"
                                                height="44.73684210526316" y="5.2631578947368425"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="86.60300925925925"
                                                height="47.368421052631575" y="2.631578947368425"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="93.64390432098764"
                                                height="50" y="0" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="100.68479938271605"
                                                height="44.73684210526316" y="5.2631578947368425"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="107.72569444444444"
                                                height="28.947368421052634" y="21.052631578947366"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="114.76658950617283"
                                                height="31.57894736842105" y="18.42105263157895"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="121.80748456790123"
                                                height="28.947368421052634" y="21.052631578947366"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="128.84837962962962"
                                                height="39.473684210526315" y="10.526315789473685"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="135.889274691358"
                                                height="36.84210526315789" y="13.15789473684211"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="142.9301697530864"
                                                height="42.10526315789473" y="7.894736842105267"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="149.97106481481478"
                                                height="42.10526315789473" y="7.894736842105267"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="157.0119598765432"
                                                height="47.368421052631575" y="2.631578947368425"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                            <rect class="d3-random-bars" width="4.928626543209876" x="164.0528549382716"
                                                height="44.73684210526316" y="5.2631578947368425"
                                                style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                        </g>
                                    </svg></div>
                            </div>
                        </div>
                        <!-- /members online -->

                    </div>

                    <div class="col-lg-4">

                        <!-- Current server load -->
                        <div class="card bg-pink text-white">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">49.4%</h3>
                                    <div class="list-icons ml-auto">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-cog3"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update
                                                    data</a>
                                                <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i>
                                                    Detailed log</a>
                                                <a href="#" class="dropdown-item"><i class="icon-pie5"></i>
                                                    Statistics</a>
                                                <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear
                                                    list</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    Current server load
                                    <div class="font-size-sm opacity-75">34.6% avg</div>
                                </div>
                            </div>

                            <div id="server-load"><svg width="191.09375" height="50">
                                    <g transform="translate(0,0)" width="191.09375">
                                        <defs>
                                            <clipPath id="load-clip-server-load">
                                                <rect class="load-clip" width="191.09375" height="50"></rect>
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#load-clip-server-load)">
                                            <path
                                                d="M-7.349759615384616,22.333333333333332L-6.12479967948718,23.666666666666664C-4.899839743589744,25,-2.449919871794872,27.666666666666664,0,29.444444444444443C2.449919871794872,31.22222222222222,4.899839743589744,32.111111111111114,7.349759615384615,29C9.799679487179487,25.88888888888889,12.24959935897436,18.777777777777775,14.69951923076923,16.555555555555554C17.149439102564102,14.333333333333332,19.599358974358974,17,22.049278846153847,20.333333333333336C24.499198717948715,23.666666666666668,26.94911858974359,27.66666666666667,29.39903846153846,27.888888888888893C31.848958333333336,28.111111111111114,34.298878205128204,24.555555555555557,36.74879807692308,23C39.19871794871795,21.444444444444443,41.64863782051282,21.888888888888886,44.09855769230769,19.444444444444443C46.54847756410256,17,48.99839743589743,11.666666666666664,51.44831730769231,13.444444444444443C53.89823717948718,15.222222222222221,56.34815705128205,24.11111111111111,58.79807692307692,27.666666666666668C61.247996794871796,31.22222222222222,63.69791666666666,29.444444444444443,66.14783653846153,24.555555555555554C68.59775641025641,19.666666666666664,71.04767628205128,11.666666666666663,73.49759615384616,11.44444444444444C75.94751602564102,11.222222222222218,78.3974358974359,18.777777777777775,80.84735576923077,18.111111111111107C83.29727564102564,17.444444444444443,85.74719551282051,8.555555555555555,88.19711538461539,9.88888888888889C90.64703525641025,11.222222222222223,93.09695512820512,22.77777777777778,95.546875,28.555555555555557C97.99679487179486,34.333333333333336,100.44671474358974,34.333333333333336,102.89663461538461,31.444444444444443C105.34655448717947,28.555555555555557,107.79647435897435,22.77777777777778,110.24639423076923,17.444444444444443C112.69631410256409,12.11111111111111,115.14623397435898,7.222222222222221,117.59615384615384,7.666666666666667C120.04607371794872,8.11111111111111,122.49599358974359,13.88888888888889,124.94591346153845,19.444444444444443C127.39583333333331,25,129.84575320512818,30.33333333333333,132.29567307692307,33C134.74559294871793,35.666666666666664,137.1955128205128,35.666666666666664,139.64543269230768,30.77777777777777C142.09535256410254,25.888888888888886,144.54527243589743,16.111111111111107,146.99519230769232,10.111111111111109C149.44511217948718,4.111111111111111,151.89503205128204,1.8888888888888893,154.3449519230769,6.1111111111111125C156.7948717948718,10.333333333333336,159.24479166666669,21.000000000000004,161.69471153846155,27.444444444444446C164.1446314102564,33.88888888888889,166.59455128205127,36.111111111111114,169.04447115384613,36.111111111111114C171.49439102564102,36.111111111111114,173.94431089743588,33.88888888888889,176.39423076923077,30.55555555555556C178.84415064102564,27.222222222222225,181.2940705128205,22.77777777777778,183.7439903846154,20.555555555555557C186.19391025641025,18.333333333333336,188.64383012820514,18.333333333333336,191.09375,19C193.54366987179486,19.666666666666668,195.99358974358975,21,198.44350961538464,18.111111111111107C200.8934294871795,15.22222222222222,203.34334935897436,8.111111111111107,204.5683092948718,4.555555555555552L205.79326923076923,0.9999999999999964L205.79326923076923,50L204.5683092948718,49.999999999999986C203.34334935897436,49.99999999999999,200.8934294871795,49.99999999999999,198.44350961538464,49.999999999999986C195.99358974358975,49.99999999999999,193.54366987179486,49.99999999999999,191.09375,49.999999999999986C188.64383012820514,49.99999999999999,186.19391025641025,49.99999999999999,183.7439903846154,49.999999999999986C181.2940705128205,49.99999999999999,178.84415064102564,49.99999999999999,176.39423076923075,49.999999999999986C173.94431089743588,49.99999999999999,171.49439102564102,49.99999999999999,169.04447115384616,49.999999999999986C166.59455128205127,49.99999999999999,164.1446314102564,49.99999999999999,161.69471153846155,49.999999999999986C159.24479166666669,49.99999999999999,156.7948717948718,49.99999999999999,154.34495192307693,49.999999999999986C151.89503205128204,49.99999999999999,149.44511217948718,49.99999999999999,146.9951923076923,49.999999999999986C144.54527243589743,49.99999999999999,142.09535256410254,49.99999999999999,139.64543269230768,49.999999999999986C137.1955128205128,49.99999999999999,134.74559294871793,49.99999999999999,132.29567307692307,49.999999999999986C129.84575320512818,49.99999999999999,127.39583333333331,49.99999999999999,124.94591346153845,49.999999999999986C122.49599358974359,49.99999999999999,120.04607371794872,49.99999999999999,117.59615384615384,49.999999999999986C115.14623397435898,49.99999999999999,112.69631410256409,49.99999999999999,110.24639423076923,49.999999999999986C107.79647435897435,49.99999999999999,105.34655448717947,49.99999999999999,102.89663461538461,49.999999999999986C100.44671474358974,49.99999999999999,97.99679487179486,49.99999999999999,95.546875,49.999999999999986C93.09695512820512,49.99999999999999,90.64703525641025,49.99999999999999,88.19711538461539,49.999999999999986C85.74719551282051,49.99999999999999,83.29727564102564,49.99999999999999,80.84735576923077,49.999999999999986C78.3974358974359,49.99999999999999,75.94751602564102,49.99999999999999,73.49759615384616,49.999999999999986C71.04767628205128,49.99999999999999,68.59775641025641,49.99999999999999,66.14783653846153,49.999999999999986C63.69791666666666,49.99999999999999,61.247996794871796,49.99999999999999,58.79807692307692,49.999999999999986C56.34815705128205,49.99999999999999,53.89823717948718,49.99999999999999,51.44831730769231,49.999999999999986C48.99839743589743,49.99999999999999,46.54847756410256,49.99999999999999,44.09855769230769,49.999999999999986C41.64863782051282,49.99999999999999,39.19871794871795,49.99999999999999,36.74879807692308,49.999999999999986C34.298878205128204,49.99999999999999,31.848958333333336,49.99999999999999,29.39903846153846,49.999999999999986C26.94911858974359,49.99999999999999,24.499198717948715,49.99999999999999,22.049278846153847,49.999999999999986C19.599358974358974,49.99999999999999,17.149439102564102,49.99999999999999,14.699519230769232,49.999999999999986C12.24959935897436,49.99999999999999,9.799679487179487,49.99999999999999,7.349759615384615,49.999999999999986C4.899839743589744,49.99999999999999,2.449919871794872,49.99999999999999,0,49.999999999999986C-2.449919871794872,49.99999999999999,-4.899839743589744,49.99999999999999,-6.12479967948718,49.999999999999986L-7.349759615384616,50Z"
                                                class="d3-area" style="fill: rgba(255, 255, 255, 0.5); opacity: 1;"
                                                transform="translate(-7.349759578704834,0)"></path>
                                        </g>
                                    </g>
                                </svg></div>
                        </div>
                        <!-- /current server load -->

                    </div>

                    <div class="col-lg-4">

                        <!-- Today's revenue -->
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">$18,390</h3>
                                    <div class="list-icons ml-auto">
                                        <a class="list-icons-item" data-action="reload"></a>
                                    </div>
                                </div>

                                <div>
                                    Today's revenue
                                    <div class="font-size-sm opacity-75">$37,578 avg</div>
                                </div>
                            </div>

                            <div id="today-revenue"><svg width="191.09375" height="50">
                                    <g transform="translate(0,0)" width="191.09375">
                                        <defs>
                                            <clipPath id="clip-line-small">
                                                <rect class="clip" width="191.09375" height="50"></rect>
                                            </clipPath>
                                        </defs>
                                        <path
                                            d="M20,8.46153846153846L45.18229166666667,25.76923076923077L70.36458333333334,5L95.546875,15.384615384615383L120.72916666666667,5L145.91145833333334,36.15384615384615L171.09375,8.46153846153846"
                                            clip-path="url(#clip-line-small)" class="d3-line d3-line-medium"
                                            style="stroke: rgb(255, 255, 255);"></path>
                                        <g>
                                            <line class="d3-line-guides" x1="20" y1="50" x2="20" y2="8.46153846153846"
                                                style="stroke: rgba(255, 255, 255, 0.3); stroke-dasharray: 4, 2; shape-rendering: crispedges;">
                                            </line>
                                            <line class="d3-line-guides" x1="45.18229166666667" y1="50"
                                                x2="45.18229166666667" y2="25.76923076923077"
                                                style="stroke: rgba(255, 255, 255, 0.3); stroke-dasharray: 4, 2; shape-rendering: crispedges;">
                                            </line>
                                            <line class="d3-line-guides" x1="70.36458333333334" y1="50"
                                                x2="70.36458333333334" y2="5"
                                                style="stroke: rgba(255, 255, 255, 0.3); stroke-dasharray: 4, 2; shape-rendering: crispedges;">
                                            </line>
                                            <line class="d3-line-guides" x1="95.546875" y1="50" x2="95.546875"
                                                y2="15.384615384615383"
                                                style="stroke: rgba(255, 255, 255, 0.3); stroke-dasharray: 4, 2; shape-rendering: crispedges;">
                                            </line>
                                            <line class="d3-line-guides" x1="120.72916666666667" y1="50"
                                                x2="120.72916666666667" y2="5"
                                                style="stroke: rgba(255, 255, 255, 0.3); stroke-dasharray: 4, 2; shape-rendering: crispedges;">
                                            </line>
                                            <line class="d3-line-guides" x1="145.91145833333334" y1="50"
                                                x2="145.91145833333334" y2="36.15384615384615"
                                                style="stroke: rgba(255, 255, 255, 0.3); stroke-dasharray: 4, 2; shape-rendering: crispedges;">
                                            </line>
                                            <line class="d3-line-guides" x1="171.09375" y1="50" x2="171.09375"
                                                y2="8.46153846153846"
                                                style="stroke: rgba(255, 255, 255, 0.3); stroke-dasharray: 4, 2; shape-rendering: crispedges;">
                                            </line>
                                        </g>
                                        <g>
                                            <circle class="d3-line-circle d3-line-circle-medium" cx="20"
                                                cy="8.46153846153846" r="3"
                                                style="stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255); opacity: 1;">
                                            </circle>
                                            <circle class="d3-line-circle d3-line-circle-medium" cx="45.18229166666667"
                                                cy="25.76923076923077" r="3"
                                                style="stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255); opacity: 1;">
                                            </circle>
                                            <circle class="d3-line-circle d3-line-circle-medium" cx="70.36458333333334"
                                                cy="5" r="3"
                                                style="stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255); opacity: 1;">
                                            </circle>
                                            <circle class="d3-line-circle d3-line-circle-medium" cx="95.546875"
                                                cy="15.384615384615383" r="3"
                                                style="stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255); opacity: 1;">
                                            </circle>
                                            <circle class="d3-line-circle d3-line-circle-medium" cx="120.72916666666667"
                                                cy="5" r="3"
                                                style="stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255); opacity: 1;">
                                            </circle>
                                            <circle class="d3-line-circle d3-line-circle-medium" cx="145.91145833333334"
                                                cy="36.15384615384615" r="3"
                                                style="stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255); opacity: 1;">
                                            </circle>
                                            <circle class="d3-line-circle d3-line-circle-medium" cx="171.09375"
                                                cy="8.46153846153846" r="3"
                                                style="stroke: rgb(255, 255, 255); fill: rgb(255, 255, 255); opacity: 1;">
                                            </circle>
                                        </g>
                                    </g>
                                </svg></div>
                        </div>
                        <!-- /today's revenue -->

                    </div>
                </div>
                <!-- /quick stats boxes -->


                <!-- Support tickets -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Support tickets</h6>
                        <div class="header-elements">
                            <a class="text-body daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <i class="icon-calendar3 mr-2"></i>
                                <span>March 1 - March 30</span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body d-lg-flex align-items-lg-center justify-content-lg-between flex-lg-wrap">
                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                            <div id="tickets-status"><svg width="42" height="42">
                                    <g transform="translate(21,21)">
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M1.1634144591899855e-15,19A19,19 0 0,1 -12.326087772183463,-14.459168725498339L-6.163043886091732,-7.229584362749169A9.5,9.5 0 0,0 5.817072295949927e-16,9.5Z"
                                                style="fill: rgb(41, 182, 246);"></path>
                                        </g>
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M-12.326087772183463,-14.459168725498339A19,19 0 0,1 14.331188229058796,-12.474656065130077L7.165594114529398,-6.237328032565038A9.5,9.5 0 0,0 -6.163043886091732,-7.229584362749169Z"
                                                style="fill: rgb(102, 187, 106);"></path>
                                        </g>
                                        <g class="d3-arc d3-slice-border" style="cursor: pointer;">
                                            <path
                                                d="M14.331188229058796,-12.474656065130077A19,19 0 0,1 5.817072295949928e-15,19L2.908536147974964e-15,9.5A9.5,9.5 0 0,0 7.165594114529398,-6.237328032565038Z"
                                                style="fill: rgb(239, 83, 80);"></path>
                                        </g>
                                    </g>
                                </svg></div>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold mb-0">14,327 <span
                                        class="text-success font-size-sm font-weight-normal"><i
                                            class="icon-arrow-up12"></i> (+2.9%)</span></h5>
                                <span class="badge badge-mark border-success mr-1"></span> <span
                                    class="text-muted">Jun 16, 10:00 am</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                            <a href="#"
                                class="btn bg-transparent border-indigo text-indigo rounded-pill border-2 btn-icon">
                                <i class="icon-alarm-add"></i>
                            </a>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold mb-0">1,132</h5>
                                <span class="text-muted">total tickets</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                            <a href="#"
                                class="btn bg-transparent border-indigo text-indigo rounded-pill border-2 btn-icon">
                                <i class="icon-spinner11"></i>
                            </a>
                            <div class="ml-3">
                                <h5 class="font-weight-semibold mb-0">06:25:00</h5>
                                <span class="text-muted">response time</span>
                            </div>
                        </div>

                        <div>
                            <a href="#" class="btn btn-teal"><i class="icon-statistics mr-2"></i> Report</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 50px">Due</th>
                                    <th style="width: 300px;">User</th>
                                    <th>Description</th>
                                    <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-active table-border-double">
                                    <td colspan="3">Active tickets</td>
                                    <td class="text-right">
                                        <span class="badge badge-primary badge-pill">24</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <h6 class="mb-0">12</h6>
                                        <div class="font-size-sm text-muted line-height-1">hours</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-teal rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">A</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#"
                                                    class="text-body font-weight-semibold letter-icon-title">Annabelle
                                                    Doney</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-primary mr-1"></span> Active</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div class="font-weight-semibold">[#1183] Workaround for OS X selects printing
                                                bug</div>
                                            <span class="text-muted">Chrome fixed the bug several versions ago, thus
                                                rendering this...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-cross2 text-danger"></i> Close issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <h6 class="mb-0">16</h6>
                                        <div class="font-size-sm text-muted line-height-1">hours</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/demo/users/face15.jpg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Chris Macintyre</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-primary mr-1"></span> Active</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div class="font-weight-semibold">[#1249] Vertically center carousel controls
                                            </div>
                                            <span class="text-muted">Try any carousel control and reduce the screen
                                                width below...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-cross2 text-danger"></i> Close issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <h6 class="mb-0">20</h6>
                                        <div class="font-size-sm text-muted line-height-1">hours</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-primary rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">R</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Robert
                                                    Hauber</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-primary mr-1"></span> Active</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div class="font-weight-semibold">[#1254] Inaccurate small pagination height
                                            </div>
                                            <span class="text-muted">The height of pagination elements is not
                                                consistent with...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-cross2 text-danger"></i> Close issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <h6 class="mb-0">40</h6>
                                        <div class="font-size-sm text-muted line-height-1">hours</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-warning rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">R</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Robert
                                                    Hauber</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-primary mr-1"></span> Active</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div class="font-weight-semibold">[#1184] Round grid column gutter operations
                                            </div>
                                            <span class="text-muted">Left rounds up, right rounds down. should keep
                                                everything...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-cross2 text-danger"></i> Close issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="table-active table-border-double">
                                    <td colspan="3">Resolved tickets</td>
                                    <td class="text-right">
                                        <span class="badge badge-success badge-pill">42</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <i class="icon-checkmark3 text-success"></i>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-success rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">A</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Alan
                                                    Macedo</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-success mr-1"></span> Resolved</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div>[#1046] Avoid some unnecessary HTML string</div>
                                            <span class="text-muted">Rather than building a string of HTML and then
                                                parsing it...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-plus3 text-primary"></i> Unresolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-cross2 text-danger"></i> Close issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <i class="icon-checkmark3 text-success"></i>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-pink rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">B</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Brett
                                                    Castellano</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-success mr-1"></span> Resolved</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div>[#1038] Update json configuration</div>
                                            <span class="text-muted">The <code>files</code> property is necessary to
                                                override the files property...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-plus3 text-primary"></i> Unresolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-cross2 text-danger"></i> Close issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <i class="icon-checkmark3 text-success"></i>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/demo/users/face3.jpg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Roxanne Forbes</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-success mr-1"></span> Resolved</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div>[#1034] Tooltip multiple event</div>
                                            <span class="text-muted">Fix behavior when using tooltips and popovers that
                                                are...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-plus3 text-primary"></i> Unresolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-cross2 text-danger"></i> Close issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="table-active table-border-double">
                                    <td colspan="3">Closed tickets</td>
                                    <td class="text-right">
                                        <span class="badge badge-danger badge-pill">37</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <i class="icon-cross2 text-danger"></i>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#">
                                                    <img src="../../../../global_assets/images/demo/users/face8.jpg"
                                                        class="rounded-circle" width="32" height="32" alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold">Mitchell Sitkin</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-danger mr-1"></span> Closed</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div>[#1040] Account for static form controls in form group</div>
                                            <span class="text-muted">Resizes control label's font-size and account for
                                                the standard...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-plus3 text-primary"></i> Unresolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-spinner11 text-success"></i> Reopen issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <i class="icon-cross2 text-danger"></i>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-indigo rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">K</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#"
                                                    class="text-body font-weight-semibold letter-icon-title">Katleen
                                                    Jensen</a>
                                                <div class="text-muted font-size-sm"><span
                                                        class="badge badge-mark border-danger mr-1"></span> Closed</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-body">
                                            <div>[#1038] Proper sizing of form control feedback</div>
                                            <span class="text-muted">Feedback icon sizing inside a larger/smaller
                                                form-group...</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-undo"></i>
                                                        Quick reply</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-history"></i> Full
                                                        history</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-plus3 text-primary"></i> Unresolve issue</a>
                                                    <a href="#" class="dropdown-item"><i
                                                            class="icon-spinner11 text-success"></i> Reopen issue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /support tickets -->


                <!-- Latest posts -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Latest posts</h6>
                    </div>

                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="media flex-column flex-sm-row mt-0 mb-3">
                                    <div class="mr-sm-3 mb-2 mb-sm-0">
                                        <div class="card-img-actions">
                                            <a href="#">
                                                <img src="../../../../global_assets/images/demo/flat/1.png"
                                                    class="img-fluid img-preview rounded" alt="">
                                                <span class="card-img-actions-overlay card-img"><i
                                                        class="icon-play3 icon-2x"></i></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="media-title"><a href="#">Up unpacked friendly</a></h6>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item"><i class="icon-book-play mr-2"></i> Video
                                                tutorials</li>
                                        </ul>
                                        The him father parish looked has sooner. Attachment frequently terminated son
                                        hello...
                                    </div>
                                </div>

                                <div class="media flex-column flex-sm-row mt-0 mb-3">
                                    <div class="mr-sm-3 mb-2 mb-sm-0">
                                        <div class="card-img-actions">
                                            <a href="#">
                                                <img src="../../../../global_assets/images/demo/flat/21.png"
                                                    class="img-fluid img-preview rounded" alt="">
                                                <span class="card-img-actions-overlay card-img"><i
                                                        class="icon-play3 icon-2x"></i></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="media-title"><a href="#">It allowance prevailed</a></h6>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item"><i class="icon-book-play mr-2"></i> Video
                                                tutorials</li>
                                        </ul>
                                        Alteration literature to or an sympathize mr imprudence. Of is ferrars subject
                                        enjoyed...
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="media flex-column flex-sm-row mt-0 mb-3">
                                    <div class="mr-sm-3 mb-2 mb-sm-0">
                                        <div class="card-img-actions">
                                            <a href="#">
                                                <img src="../../../../global_assets/images/demo/flat/12.png"
                                                    class="img-fluid img-preview rounded" alt="">
                                                <span class="card-img-actions-overlay card-img"><i
                                                        class="icon-play3 icon-2x"></i></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="media-title"><a href="#">Case read they must</a></h6>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item"><i class="icon-book-play mr-2"></i> Video
                                                tutorials</li>
                                        </ul>
                                        On it differed repeated wandered required in. Then girl neat why yet knew rose
                                        spot...
                                    </div>
                                </div>

                                <div class="media flex-column flex-sm-row mt-0 mb-3">
                                    <div class="mr-sm-3 mb-2 mb-sm-0">
                                        <div class="card-img-actions">
                                            <a href="#">
                                                <img src="../../../../global_assets/images/demo/flat/15.png"
                                                    class="img-fluid img-preview rounded" alt="">
                                                <span class="card-img-actions-overlay card-img"><i
                                                        class="icon-play3 icon-2x"></i></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="media-title"><a href="#">Too carriage attended</a></h6>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item"><i class="icon-book-play mr-2"></i> FAQ section
                                            </li>
                                        </ul>
                                        Marianne or husbands if at stronger ye. Considered is as middletons uncommonly...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /latest posts -->

            </div>

            <div class="col-xl-4">

                <!-- Progress counters -->
                <div class="row">
                    <div class="col-sm-6">

                        <!-- Available hours -->
                        <div class="card text-center">
                            <div class="card-body">

                                <!-- Progress counter -->
                                <div class="svg-center position-relative" id="hours-available-progress"><svg width="76"
                                        height="76">
                                        <g transform="translate(38,38)">
                                            <path class="d3-progress-background"
                                                d="M0,38A38,38 0 1,1 0,-38A38,38 0 1,1 0,38M0,36A36,36 0 1,0 0,-36A36,36 0 1,0 0,36Z"
                                                style="fill: rgb(240, 98, 146); opacity: 0.2;"></path>
                                            <path class="d3-progress-foreground" filter="url(#blur)"
                                                d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.38342799370878,16.179613079472677L-32.57377388877674,15.328054496342538A36,36 0 1,0 2.204364238465236e-15,-36Z"
                                                style="fill: rgb(240, 98, 146); stroke: rgb(240, 98, 146);"></path>
                                            <path class="d3-progress-front"
                                                d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.38342799370878,16.179613079472677L-32.57377388877674,15.328054496342538A36,36 0 1,0 2.204364238465236e-15,-36Z"
                                                style="fill: rgb(240, 98, 146); fill-opacity: 1;"></path>
                                        </g>
                                    </svg>
                                    <h2 class="pt-1 mt-2 mb-1">68%</h2><i class="icon-watch text-pink counter-icon"
                                        style="top: 22px"></i>
                                    <div>Hours available</div>
                                    <div class="font-size-sm text-muted mb-3">64% average</div>
                                </div>
                                <!-- /progress counter -->


                                <!-- Bars -->
                                <div id="hours-available-bars"><svg width="97.828125" height="40">
                                        <g width="97.828125">
                                            <rect class="d3-random-bars" width="2.818094135802469" x="1.2077546296296295"
                                                height="27.36842105263158" y="12.631578947368421"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="5.233603395061729"
                                                height="35.78947368421053" y="4.210526315789473"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="9.259452160493828"
                                                height="27.36842105263158" y="12.631578947368421"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="13.285300925925927"
                                                height="23.157894736842106" y="16.842105263157894"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="17.311149691358025"
                                                height="27.36842105263158" y="12.631578947368421"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="21.336998456790123"
                                                height="33.68421052631579" y="6.315789473684212"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="25.362847222222225"
                                                height="29.473684210526315" y="10.526315789473685"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="29.388695987654323"
                                                height="27.36842105263158" y="12.631578947368421"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="33.41454475308642"
                                                height="33.68421052631579" y="6.315789473684212"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="37.44039351851852"
                                                height="33.68421052631579" y="6.315789473684212"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="41.46624228395061"
                                                height="40" y="0" style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="45.492091049382715"
                                                height="40" y="0" style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="49.51793981481482"
                                                height="27.36842105263158" y="12.631578947368421"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="53.54378858024691"
                                                height="33.68421052631579" y="6.315789473684212"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="57.56963734567901"
                                                height="29.473684210526315" y="10.526315789473685"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="61.59548611111111"
                                                height="23.157894736842106" y="16.842105263157894"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="65.62133487654322"
                                                height="31.578947368421055" y="8.421052631578945"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="69.64718364197532"
                                                height="37.89473684210526" y="2.10526315789474"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="73.67303240740742"
                                                height="31.578947368421055" y="8.421052631578945"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="77.6988811728395"
                                                height="23.157894736842106" y="16.842105263157894"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="81.72472993827161"
                                                height="33.68421052631579" y="6.315789473684212"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="85.75057870370371"
                                                height="29.473684210526315" y="10.526315789473685"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="89.77642746913581"
                                                height="25.263157894736842" y="14.736842105263158"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="93.80227623456791"
                                                height="37.89473684210526" y="2.10526315789474"
                                                style="fill: rgb(236, 64, 122);"></rect>
                                        </g>
                                    </svg></div>
                                <!-- /bars -->

                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="col-sm-6">

                        <!-- Productivity goal -->
                        <div class="card text-center">
                            <div class="card-body">

                                <!-- Progress counter -->
                                <div class="svg-center position-relative" id="goal-progress"><svg width="76" height="76">
                                        <g transform="translate(38,38)">
                                            <path class="d3-progress-background"
                                                d="M0,38A38,38 0 1,1 0,-38A38,38 0 1,1 0,38M0,36A36,36 0 1,0 0,-36A36,36 0 1,0 0,36Z"
                                                style="fill: rgb(92, 107, 192); opacity: 0.2;"></path>
                                            <path class="d3-progress-foreground" filter="url(#blur)"
                                                d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.3834279937087,-16.179613079472855L-32.573773888776664,-15.328054496342704A36,36 0 1,0 2.204364238465236e-15,-36Z"
                                                style="fill: rgb(92, 107, 192); stroke: rgb(92, 107, 192);"></path>
                                            <path class="d3-progress-front"
                                                d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.3834279937087,-16.179613079472855L-32.573773888776664,-15.328054496342704A36,36 0 1,0 2.204364238465236e-15,-36Z"
                                                style="fill: rgb(92, 107, 192); fill-opacity: 1;"></path>
                                        </g>
                                    </svg>
                                    <h2 class="pt-1 mt-2 mb-1">82%</h2><i class="icon-trophy3 text-indigo counter-icon"
                                        style="top: 22px"></i>
                                    <div>Productivity goal</div>
                                    <div class="font-size-sm text-muted mb-3">87% average</div>
                                </div>
                                <!-- /progress counter -->

                                <!-- Bars -->
                                <div id="goal-bars"><svg width="97.828125" height="40">
                                        <g width="97.828125">
                                            <rect class="d3-random-bars" width="2.818094135802469" x="1.2077546296296295"
                                                height="20" y="20" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="5.233603395061729"
                                                height="36" y="4" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="9.259452160493828"
                                                height="38" y="2" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="13.285300925925927"
                                                height="24" y="16" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="17.311149691358025"
                                                height="22" y="18" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="21.336998456790123"
                                                height="32" y="8" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="25.362847222222225"
                                                height="32" y="8" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="29.388695987654323"
                                                height="20" y="20" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="33.41454475308642"
                                                height="24" y="16" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="37.44039351851852"
                                                height="30" y="10" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="41.46624228395061"
                                                height="22" y="18" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="45.492091049382715"
                                                height="28" y="12" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="49.51793981481482"
                                                height="36" y="4" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="53.54378858024691"
                                                height="22" y="18" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="57.56963734567901"
                                                height="26" y="14" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="61.59548611111111"
                                                height="28" y="12" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="65.62133487654322"
                                                height="30" y="10" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="69.64718364197532"
                                                height="22" y="18" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="73.67303240740742"
                                                height="34" y="6" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="77.6988811728395"
                                                height="40" y="0" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="81.72472993827161"
                                                height="36" y="4" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="85.75057870370371"
                                                height="34" y="6" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="89.77642746913581"
                                                height="36" y="4" style="fill: rgb(92, 107, 192);"></rect>
                                            <rect class="d3-random-bars" width="2.818094135802469" x="93.80227623456791"
                                                height="24" y="16" style="fill: rgb(92, 107, 192);"></rect>
                                        </g>
                                    </svg></div>
                                <!-- /bars -->

                            </div>
                        </div>
                        <!-- /productivity goal -->

                    </div>
                </div>
                <!-- /progress counters -->


                <!-- Daily sales -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Daily sales stats</h6>
                        <div class="header-elements">
                            <span class="font-weight-bold text-danger ml-2">$4,378</span>
                            <div class="list-icons ml-3">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-cog3"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update
                                            data</a>
                                        <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed
                                            log</a>
                                        <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="chart" id="sales-heatmap"><svg width="257.65625" height="214.80978260869566">
                                <g transform="translate(0,20)" width="257.65625" height="214.80978260869566">
                                    <g class="hour-group" transform="translate(0, 0)"><text class="d3-text"
                                            x="0" y="-10">Alpha app</text><text class="sales-count d3-text" x="257.65625"
                                            y="-10" style="text-anchor: end;">445 sales today</text>
                                        <rect x="0" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="10.735677083333332" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="21.471354166666664" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="32.20703125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="42.94270833333333" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="53.67838541666667" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="64.4140625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="75.14973958333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="85.88541666666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="96.62109375" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="107.35677083333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="118.09244791666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="128.828125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="139.56380208333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="150.29947916666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="161.03515625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="171.77083333333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="182.50651041666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="193.2421875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="203.97786458333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="214.71354166666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="225.44921875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="236.18489583333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="246.92057291666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                    </g>
                                    <g class="hour-group" transform="translate(0, 51.202445652173914)"><text
                                            class="d3-text" x="0" y="-10">Omega app</text><text
                                            class="sales-count d3-text" x="257.65625" y="-10"
                                            style="text-anchor: end;">422 sales today</text>
                                        <rect x="0" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="10.735677083333332" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="21.471354166666664" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="32.20703125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="42.94270833333333" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="53.67838541666667" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="64.4140625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="75.14973958333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="85.88541666666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="96.62109375" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="107.35677083333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="118.09244791666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="128.828125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="139.56380208333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="150.29947916666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="161.03515625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="171.77083333333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="182.50651041666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="193.2421875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="203.97786458333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="214.71354166666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="225.44921875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="236.18489583333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="246.92057291666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                    </g>
                                    <g class="hour-group" transform="translate(0, 102.40489130434783)"><text
                                            class="d3-text" x="0" y="-10">Delta app</text><text
                                            class="sales-count d3-text" x="257.65625" y="-10"
                                            style="text-anchor: end;">403 sales today</text>
                                        <rect x="0" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="10.735677083333332" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="21.471354166666664" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="32.20703125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="42.94270833333333" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="53.67838541666667" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="64.4140625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="75.14973958333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="85.88541666666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="96.62109375" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="107.35677083333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="118.09244791666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="128.828125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="139.56380208333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="150.29947916666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="161.03515625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="171.77083333333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="182.50651041666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="193.2421875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="203.97786458333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="214.71354166666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="225.44921875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="236.18489583333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="246.92057291666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                    </g>
                                    <g class="hour-group" transform="translate(0, 153.60733695652175)"><text
                                            class="d3-text" x="0" y="-10">Sigma app</text><text
                                            class="sales-count d3-text" x="257.65625" y="-10"
                                            style="text-anchor: end;">445 sales today</text>
                                        <rect x="0" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="10.735677083333332" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="21.471354166666664" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="32.20703125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="42.94270833333333" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="53.67838541666667" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="64.4140625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="75.14973958333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="85.88541666666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="96.62109375" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="107.35677083333334" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="118.09244791666666" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="128.828125" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="139.56380208333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="150.29947916666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="161.03515625" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="171.77083333333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="182.50651041666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="193.2421875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(85, 139, 47);"></rect>
                                        <rect x="203.97786458333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="214.71354166666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="225.44921875" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(124, 179, 66);"></rect>
                                        <rect x="236.18489583333331" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                        <rect x="246.92057291666669" y="0" class="heatmap-hour d3-slice-border d3-bg"
                                            width="11.202445652173912" height="11.202445652173912"
                                            style="cursor: pointer; fill: rgb(156, 204, 101);"></rect>
                                    </g>
                                    <g class="legend-group" width="257.65625"
                                        transform="translate(100.82201086956522,194.80978260869566)">
                                        <g class="heatmap-legend">
                                            <rect class="heatmap-legend-item d3-slice-border" x="0" y="-8"
                                                width="11.202445652173912" height="5"
                                                style="stroke-width: 1; fill: rgb(220, 237, 200);"></rect>
                                        </g>
                                        <g class="heatmap-legend">
                                            <rect class="heatmap-legend-item d3-slice-border" x="11.202445652173912"
                                                y="-8" width="11.202445652173912" height="5"
                                                style="stroke-width: 1; fill: rgb(197, 225, 165);"></rect>
                                        </g>
                                        <g class="heatmap-legend">
                                            <rect class="heatmap-legend-item d3-slice-border" x="22.404891304347824"
                                                y="-8" width="11.202445652173912" height="5"
                                                style="stroke-width: 1; fill: rgb(156, 204, 101);"></rect>
                                        </g>
                                        <g class="heatmap-legend">
                                            <rect class="heatmap-legend-item d3-slice-border" x="33.607336956521735"
                                                y="-8" width="11.202445652173912" height="5"
                                                style="stroke-width: 1; fill: rgb(124, 179, 66);"></rect>
                                        </g>
                                        <g class="heatmap-legend">
                                            <rect class="heatmap-legend-item d3-slice-border" x="44.80978260869565" y="-8"
                                                width="11.202445652173912" height="5"
                                                style="stroke-width: 1; fill: rgb(85, 139, 47);"></rect>
                                        </g><text class="min-legend-value d3-text" x="-10" y="-2"
                                            style="text-anchor: end; font-size: 11px;">4</text><text
                                            class="max-legend-value d3-text" x="66.01222826086956" y="-2"
                                            style="font-size: 11px;">43</text>
                                    </g>
                                </g>
                            </svg></div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-100">Application</th>
                                    <th>Time</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-primary rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">S</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Sigma
                                                    application</a>
                                                <div class="text-muted font-size-sm"><i
                                                        class="icon-checkmark3 font-size-sm mr-1"></i> New order</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted font-size-sm">06:28 pm</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$49.90</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-danger rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">A</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Alpha
                                                    application</a>
                                                <div class="text-muted font-size-sm"><i
                                                        class="icon-spinner11 font-size-sm mr-1"></i> Renewal</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted font-size-sm">04:52 pm</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$90.50</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-indigo rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">D</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Delta
                                                    application</a>
                                                <div class="text-muted font-size-sm"><i
                                                        class="icon-lifebuoy font-size-sm mr-1"></i> Support</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted font-size-sm">01:26 pm</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$60.00</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-success rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">O</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Omega
                                                    application</a>
                                                <div class="text-muted font-size-sm"><i
                                                        class="icon-lifebuoy font-size-sm mr-1"></i> Support</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted font-size-sm">11:46 am</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$55.00</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <a href="#" class="btn btn-danger rounded-pill btn-icon btn-sm">
                                                    <span class="letter-icon">A</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="text-body font-weight-semibold letter-icon-title">Alpha
                                                    application</a>
                                                <div class="text-muted font-size-sm"><i
                                                        class="icon-spinner11 font-size-sm mr-2"></i> Renewal</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted font-size-sm">10:29 am</span>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-semibold mb-0">$90.50</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /daily sales -->


                <!-- My messages -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">My messages</h6>
                        <div class="header-elements">
                            <span><i class="icon-history text-warning mr-2"></i> Jul 7, 10:30</span>
                            <span class="badge badge-success align-self-start ml-3">Online</span>
                        </div>
                    </div>

                    <!-- Numbers -->
                    <div class="card-body py-0">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">2,345</h5>
                                    <span class="text-muted font-size-sm">this week</span>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">3,568</h5>
                                    <span class="text-muted font-size-sm">this month</span>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0">32,693</h5>
                                    <span class="text-muted font-size-sm">all messages</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /numbers -->


                    <!-- Area chart -->
                    <div id="messages-stats"><svg width="297.65625" height="40">
                            <g transform="translate(0,0)" width="297.65625">
                                <path class="d3-area"
                                    d="M0,6.184118060435697C0.31827505032179454,6.836049961144085,7.120497493505259,25.31689293165268,9.921875,26.507378777231203S17.071118912574818,15.83455161878289,19.84375,14.6170063246662S27.621634619534344,19.372668364205534,29.765625,17.793394237526353S37.28128932956641,1.472477744504466,39.6875,0S47.33278786437175,4.1182098610986255,49.609375,5.650035137034433S56.310910483982255,13.881237942838201,59.53125,13.352073085031622S66.96481931304595,0.9617723805014604,69.453125,2.3893183415319763S76.86539760735981,23.321593126524732,79.375,24.736472241742796S87.63397077151319,15.230570020693898,89.296875,13.576950105411104S96.29849311201373,3.9403857815395407,99.21875,5.00351370344343S106.47692086638989,19.491801364551694,109.14062499999999,20.801124385101897S116.37793148822935,16.05051346143789,119.0625,14.757554462403375S125.68820168588573,11.052414301022333,128.984375,11.243851018974S136.79976920392005,14.319613704751994,138.90625,15.91004919184821S145.66736819093475,26.906841866492258,148.828125,26.226282501756852S155.46124560731673,11.390475818527307,158.75,11.63738580463809S165.79758918525724,26.600484148553214,168.671875,27.71609276177091S176.1753941908013,20.805630830408646,178.59375,19.339423752635277S185.59536811201374,14.62204424956484,188.515625,15.685172171468729S195.3216827533922,25.791199624570307,198.4375,26.563598032326073S206.08577441003683,22.1373934046987,208.359375,20.604356992269853S216.08469686221133,14.745400019054202,218.28124999999997,13.183415319747013S225.60252744896837,5.137659186881474,228.20312500000003,6.493323963457485S235.3207675161538,22.3400314781153,238.125,23.527758257203093S245.02031351662922,15.81986567164153,248.046875,14.89810260014055S255.13617997335146,18.643792701742274,257.96875,17.484188334504566S264.888321071577,7.731324562597396,267.890625,6.774420238931835S275.29681483030095,9.748340813942965,277.8125,11.159522136331695S284.4330453623965,18.046127520414313,287.734375,17.905832747716094S296.61302397741684,11.114234457323148,297.65625,10.316233309908643L297.65625,40C296.0026041666667,40,291.0416666666667,40,287.734375,40S281.1197916666667,40,277.8125,40S271.1979166666667,40,267.890625,40S261.2760416666667,40,257.96875,40S251.35416666666666,40,248.046875,40S241.43229166666666,40,238.125,40S231.51041666666669,40,228.20312500000003,40S221.58854166666663,40,218.28124999999997,40S211.66666666666666,40,208.359375,40S201.74479166666666,40,198.4375,40S191.82291666666666,40,188.515625,40S181.90104166666666,40,178.59375,40S171.97916666666666,40,168.671875,40S162.05729166666666,40,158.75,40S152.13541666666666,40,148.828125,40S142.21354166666666,40,138.90625,40S132.29166666666666,40,128.984375,40S122.36979166666667,40,119.0625,40S112.44791666666666,40,109.14062499999999,40S102.52604166666666,40,99.21875,40S92.60416666666667,40,89.296875,40S82.68229166666667,40,79.375,40S72.76041666666667,40,69.453125,40S62.838541666666664,40,59.53125,40S52.916666666666664,40,49.609375,40S42.994791666666664,40,39.6875,40S33.072916666666664,40,29.765625,40S23.151041666666668,40,19.84375,40S13.229166666666666,40,9.921875,40S1.6536458333333333,40,0,40Z"
                                    style="fill: rgb(92, 107, 192);"></path>
                            </g>
                        </svg></div>
                    <!-- /area chart -->


                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified mb-0">
                        <li class="nav-item">
                            <a href="#messages-tue" class="nav-link active" data-toggle="tab">
                                Tuesday
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#messages-mon" class="nav-link" data-toggle="tab">
                                Monday
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#messages-fri" class="nav-link" data-toggle="tab">
                                Friday
                            </a>
                        </li>
                    </ul>
                    <!-- /tabs -->


                    <!-- Tabs content -->
                    <div class="tab-content card-body">
                        <div class="tab-pane active fade show" id="messages-tue">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="../../../../global_assets/images/demo/users/face10.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                        <span
                                            class="badge badge-danger badge-pill badge-float border-2 border-white">8</span>
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">James Alexander</a>
                                            <span class="font-size-sm text-muted">14:58</span>
                                        </div>

                                        The constitutionally inventoried precariously...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="../../../../global_assets/images/demo/users/face3.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                        <span
                                            class="badge badge-danger badge-pill badge-float border-2 border-white">6</span>
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Margo Baker</a>
                                            <span class="font-size-sm text-muted">12:16</span>
                                        </div>

                                        Pinched a well more moral chose goodness...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face24.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Jeremy Victorino</a>
                                            <span class="font-size-sm text-muted">09:48</span>
                                        </div>

                                        Pert thickly mischievous clung frowned well...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face4.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Beatrix Diaz</a>
                                            <span class="font-size-sm text-muted">05:54</span>
                                        </div>

                                        Nightingale taped hello bucolic fussily cardinal...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face25.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Richard Vango</a>
                                            <span class="font-size-sm text-muted">01:43</span>
                                        </div>

                                        Amidst roadrunner distantly pompously where...
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="messages-mon">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face2.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Isak Temes</a>
                                            <span class="font-size-sm text-muted">Tue, 19:58</span>
                                        </div>

                                        Reasonable palpably rankly expressly grimy...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face7.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Vittorio Cosgrove</a>
                                            <span class="font-size-sm text-muted">Tue, 16:35</span>
                                        </div>

                                        Arguably therefore more unexplainable fumed...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face18.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Hilary Talaugon</a>
                                            <span class="font-size-sm text-muted">Tue, 12:16</span>
                                        </div>

                                        Nicely unlike porpoise a kookaburra past more...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face14.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Bobbie Seber</a>
                                            <span class="font-size-sm text-muted">Tue, 09:20</span>
                                        </div>

                                        Before visual vigilantly fortuitous tortoise...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face8.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Walther Laws</a>
                                            <span class="font-size-sm text-muted">Tue, 03:29</span>
                                        </div>

                                        Far affecting more leered unerringly dishonest...
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="messages-fri">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face15.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Owen Stretch</a>
                                            <span class="font-size-sm text-muted">Mon, 18:12</span>
                                        </div>

                                        Tardy rattlesnake seal raptly earthworm...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face12.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Jenilee Mcnair</a>
                                            <span class="font-size-sm text-muted">Mon, 14:03</span>
                                        </div>

                                        Since hello dear pushed amid darn trite...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face22.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Alaster Jain</a>
                                            <span class="font-size-sm text-muted">Mon, 13:59</span>
                                        </div>

                                        Dachshund cardinal dear next jeepers well...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face24.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Sigfrid Thisted</a>
                                            <span class="font-size-sm text-muted">Mon, 09:26</span>
                                        </div>

                                        Lighted wolf yikes less lemur crud grunted...
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="../../../../global_assets/images/demo/users/face17.jpg"
                                            class="rounded-circle" width="36" height="36" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="#">Sherilyn Mckee</a>
                                            <span class="font-size-sm text-muted">Mon, 06:38</span>
                                        </div>

                                        Less unicorn a however careless husky...
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /tabs content -->

                </div>
                <!-- /my messages -->


                <!-- Daily financials -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Daily financials</h6>
                        <div class="header-elements">
                            <label class="custom-control custom-switch custom-control-inline custom-control-right">
                                <input type="checkbox" class="custom-control-input" id="realtime" checked="">
                                <span class="custom-control-label">Realtime</span>
                            </label>
                            <span class="badge badge-danger badge-pill">+86</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="chart mb-3" id="bullets"><svg class="bullet-1" width="257.65625"
                                height="80">
                                <g transform="translate(10,20)" width="257.65625">
                                    <rect class="bullet-range bullet-range-1" width="225.833171994271" height="25" rx="2"
                                        x="0"></rect>
                                    <rect class="bullet-range bullet-range-2" width="66.06289451274938" height="25" rx="2"
                                        x="0"></rect>
                                    <rect class="bullet-range bullet-range-3" width="16.95979077294826" height="25" rx="2"
                                        x="0"></rect>
                                    <rect class="bullet-measure bullet-measure-1" width="213.42282528201383" height="5"
                                        x="0" y="10" style="shape-rendering: crispedges;"></rect>
                                    <rect class="bullet-measure bullet-measure-2" width="205.66697781454093" height="5"
                                        x="0" y="10" style="shape-rendering: crispedges;"></rect>
                                    <line class="bullet-marker bullet-marker-1" x1="237.65625" x2="237.65625"
                                        y1="4.166666666666667" y2="20.833333333333332"></line>
                                    <g class="bullet-tick" transform="translate(0,0)" style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">0</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(44.32746505737305,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">100</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(88.6549301147461,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">200</text>
                                    </g>
                                    <g style="text-anchor: start;"><text class="bullet-title"
                                            y="-10">Revenue</text><text class="bullet-subtitle" x="237.65625" y="-10"
                                            style="text-anchor: end; opacity: 0.75;">USD, in thousands</text></g>
                                    <g class="bullet-tick" transform="translate(132.98239135742188,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">300</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(177.3098602294922,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">400</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(221.63731384277344,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">500</text>
                                    </g>
                                </g>
                            </svg><svg class="bullet-2" width="257.65625" height="80">
                                <g transform="translate(10,20)" width="257.65625">
                                    <rect class="bullet-range bullet-range-1" width="237.65625" height="25" rx="2" x="0">
                                    </rect>
                                    <rect class="bullet-range bullet-range-2" width="45.280862465540736" height="25"
                                        rx="2" x="0"></rect>
                                    <rect class="bullet-range bullet-range-3" width="1.0317451760595184" height="25"
                                        rx="2" x="0"></rect>
                                    <rect class="bullet-measure bullet-measure-1" width="80.15127450084017" height="5"
                                        x="0" y="10" style="shape-rendering: crispedges;"></rect>
                                    <rect class="bullet-measure bullet-measure-2" width="4.953988313841608" height="5"
                                        x="0" y="10" style="shape-rendering: crispedges;"></rect>
                                    <line class="bullet-marker bullet-marker-1" x1="87.18989933941982"
                                        x2="87.18989933941982" y1="4.166666666666667" y2="20.833333333333332"></line>
                                    <g class="bullet-tick" transform="translate(0,0)" style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">0</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(23.218406677246094,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">5</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(46.43681335449219,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">10</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(69.65522003173828,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">15</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(92.87362670898438,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">20</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(116.09202575683594,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">25</text>
                                    </g>
                                    <g style="text-anchor: start;"><text class="bullet-title" y="-10">Profit</text><text
                                            class="bullet-subtitle" x="237.65625" y="-10"
                                            style="text-anchor: end; opacity: 0.75;">in percents</text></g>
                                    <g class="bullet-tick" transform="translate(139.31044006347656,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">30</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(162.52883911132812,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">35</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(185.74725341796875,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">40</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(208.9656524658203,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">45</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(232.18405151367188,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">50</text>
                                    </g>
                                </g>
                            </svg><svg class="bullet-3" width="257.65625" height="80">
                                <g transform="translate(10,20)" width="257.65625">
                                    <rect class="bullet-range bullet-range-1" width="41.675665962017405" height="25"
                                        rx="2" x="0"></rect>
                                    <rect class="bullet-range bullet-range-2" width="30.470967724817495" height="25"
                                        rx="2" x="0"></rect>
                                    <rect class="bullet-range bullet-range-3" width="0" height="25" rx="2" x="0"></rect>
                                    <rect class="bullet-measure bullet-measure-1" width="79.72049575452316" height="5"
                                        x="0" y="10" style="shape-rendering: crispedges;"></rect>
                                    <rect class="bullet-measure bullet-measure-2" width="37.70015929447967" height="5"
                                        x="0" y="10" style="shape-rendering: crispedges;"></rect>
                                    <line class="bullet-marker bullet-marker-1" x1="237.65625" x2="237.65625"
                                        y1="4.166666666666667" y2="20.833333333333332"></line>
                                    <g class="bullet-tick" transform="translate(0,0)" style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">0</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(40.603172302246094,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">100</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(81.20634460449219,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">200</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(121.80950927734375,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">300</text>
                                    </g>
                                    <g class="bullet-tick" transform="translate(162.41268920898438,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">400</text>
                                    </g>
                                    <g style="text-anchor: start;"><text class="bullet-title" y="-10">Order
                                            Size</text><text class="bullet-subtitle" x="237.65625" y="-10"
                                            style="text-anchor: end; opacity: 0.75;">Average value</text></g>
                                    <g class="bullet-tick" transform="translate(203.01585388183594,0)"
                                        style="opacity: 1;">
                                        <line y1="28" y2="32.16666666666667"></line><text text-anchor="middle" dy="1em"
                                            y="33.16666666666667">500</text>
                                    </g>
                                </g>
                            </svg></div>

                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3">
                                    <a href="#"
                                        class="btn bg-transparent border-pink text-pink rounded-pill border-2 btn-icon"><i
                                            class="icon-statistics"></i></a>
                                </div>

                                <div class="media-body">
                                    Stats for July, 6: <span class="font-weight-semibold">1938</span> orders, <span
                                        class="font-weight-semibold text-danger">$4220</span> revenue
                                    <div class="text-muted">2 hours ago</div>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#"
                                        class="btn bg-transparent border-success text-success rounded-pill border-2 btn-icon"><i
                                            class="icon-checkmark3"></i></a>
                                </div>

                                <div class="media-body">
                                    Invoices <a href="#">#4732</a> and <a href="#">#4734</a> have been paid
                                    <div class="text-muted">Dec 18, 18:36</div>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#"
                                        class="btn bg-transparent border-primary text-primary rounded-pill border-2 btn-icon"><i
                                            class="icon-alignment-unalign"></i></a>
                                </div>

                                <div class="media-body">
                                    Affiliate commission for June has been paid
                                    <div class="text-muted">36 minutes ago</div>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#"
                                        class="btn bg-transparent border-warning text-warning rounded-pill border-2 btn-icon"><i
                                            class="icon-spinner11"></i></a>
                                </div>

                                <div class="media-body">
                                    Order <a href="#">#37745</a> from July, 1st has been refunded
                                    <div class="text-muted">4 minutes ago</div>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <a href="#"
                                        class="btn bg-transparent border-teal text-teal rounded-pill border-2 btn-icon"><i
                                            class="icon-redo2"></i></a>
                                </div>

                                <div class="media-body">
                                    Invoice <a href="#">#4769</a> has been sent to <a href="#">Robert Smith</a>
                                    <div class="text-muted">Dec 12, 05:46</div>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <a href="#" class="list-icons-item"><i class="icon-more"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /daily financials -->

            </div>
        </div>
        <!-- /dashboard content -->

    </div>
    @push('linksCabeza')
        <script src="{{ asset('global_assets/js/plugins/buttons/spin.min.js') }}"></script>
        <script src="{{ asset('global_assets/js/plugins/buttons/ladda.min.js') }}"></script>
        <script src="{{ asset('global_assets/js/demo_pages/components_buttons.js') }}"></script>
    @endpush

    @prepend('linksPie')
    @endprepend
@endsection
