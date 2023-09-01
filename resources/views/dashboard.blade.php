@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-value float-right text-warning"><i class="wi wi-day-cloudy"></i></div>
                    <h3 class="mb-1">16°C</h3>
                    <div>Warsaw, Poland</div>
                </div>
            </div>
            <div class="card">
                <div class="card-body widgets1">
                    <div class="icon">
                        <i class="icon-heart text-warning font-30"></i>
                    </div>
                    <div class="details">
                        <h5 class="mb-0">Total Likes</h5>
                        <p class="mb-0">6,270</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body widgets1">
                    <div class="icon">
                        <i class="icon-user text-primary font-30"></i>
                    </div>
                    <div class="details">
                        <h5 class="mb-0">Users</h5>
                        <p class="mb-0">614 Users</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body currency_state">
                    <div class="icon"><img src="../assets/images/crypto/ETC.svg" alt="RaiBlocks"></div>
                    <div class="content">
                        <div class="text">RaiBlocks</div>
                        <h5 class="number">0.000009</h5>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body currency_state">
                    <div class="icon"><img src="../assets/images/crypto/XRP.svg" alt="Monero"></div>
                    <div class="content">
                        <div class="text">Monero</div>
                        <h5 class="number">0.000725</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-value float-right text-warning">0%</div>
                    <h3 class="mb-1">$8,530</h3>
                    <div>Total Payment</div>
                </div>
            </div>
            <div class="card">
                <div class="card-body widgets1">
                    <div class="icon">
                        <i class="icon-trophy text-success font-30"></i>
                    </div>
                    <div class="details">
                        <h5 class="mb-0">Total Income</h5>
                        <p class="mb-0">$96,720 Profit</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body widgets1">
                    <div class="icon">
                        <i class="icon-handbag text-danger font-30"></i>
                    </div>
                    <div class="details">
                        <h5 class="mb-0">Delivered</h5>
                        <p class="mb-0">720 Delivered</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body currency_state">
                    <div class="icon"><img src="../assets/images/crypto/qtum.svg" alt="Cardano"></div>
                    <div class="content">
                        <div class="text">Cardano</div>
                        <h5 class="number">0.000434</h5>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body currency_state">
                    <div class="icon"><img src="../assets/images/crypto/stellar.svg" alt="Stellar"></div>
                    <div class="content">
                        <div class="text">Stellar</div>
                        <h5 class="number">0.000125</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-value float-right text-danger">-1%</div>
                    <h3 class="mb-1">935</h3>
                    <div>Total Sales</div>
                    <div class="mt-4">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h3>902</h3>
                    <span>Uploads</span>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h3>521</h3>
                    <span>New items</span>
                </div>
            </div>
            <div class="card">
                <div class="card-body w_sparkline">
                    <div class="details">
                        <h6 class="mb-0">Population</h6>
                        <h3 class="mb-0">614</h3>
                    </div>
                    <div class="w_chart">
                        <div id="apexspark-chart3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-value float-right text-primary">20%</div>
                    <h3 class="mb-1">1530</h3>
                    <div>Total Leads</div>
                    <div class="mt-4">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 20%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h3>1,025</h3>
                    <span>Feeds</span>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-body">
                    <h3>318</h3>
                    <span>Comments</span>
                </div>
            </div>
            <div class="card">
                <div class="card-body w_sparkline">
                    <div class="details">
                        <h6 class="mb-0">Page Views</h6>
                        <h3 class="mb-0">2,614</h3>
                    </div>
                    <div class="w_chart">
                        <div id="apexspark-chart1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body top_counter">
                    <div class="icon bg-yellow"><i class="fa fa-building"></i> </div>
                    <div class="content">
                        <span>Properties</span>
                        <h5 class="number mb-0">53,251</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body top_counter">
                    <div class="icon bg-green"><i class="fa fa-area-chart"></i> </div>
                    <div class="content">
                        <span>Growth</span>
                        <h5 class="number mb-0">62%</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body top_counter">
                    <div class="icon bg-blue"><i class="fa fa-shopping-cart"></i> </div>
                    <div class="content">
                        <span>Total Sales</span>
                        <h5 class="number mb-0">$3205</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body top_counter">
                    <div class="icon bg-indigo"><i class="fa fa-tag"></i> </div>
                    <div class="content">
                        <span>Rented</span>
                        <h5 class="number mb-0">3,217</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="widgets2">
                        <div class="state">
                            <h6>Server</h6>
                            <h2>62%</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-database"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-red" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;"></div>
                    </div>
                    <span class="text-small">6% higher than last month</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="widgets2">
                        <div class="state">
                            <h6>Traffic</h6>
                            <h2>45%</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
                    </div>
                    <span class="text-small">61% higher than last month</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="widgets2">
                        <div class="state">
                            <h6>Email</h6>
                            <h2>32</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 31%;"></div>
                    </div>
                    <span class="text-small">Total Registered email</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="widgets2">
                        <div class="state">
                            <h6>Domians</h6>
                            <h2>11</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-hand-o-left"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                    </div>
                    <span class="text-small">Total Registered domain</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-12">
            <div class="card visitors-map">
                <div class="card-header">
                    <h3 class="card-title">Our Location</h3>
                </div>
                <div class="card-body">
                    <div id="world-map-markers" style="height:300px;"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cryptocurrency</h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                        <div class="item-action dropdown ml-2">
                            <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body currency_state">
                                    <div class="icon"><img src="../assets/images/crypto/BTC.svg" alt="Bitcoin"></div>
                                    <div class="content">
                                        <div class="text">Bitcoin</div>
                                        <h5 class="number">0.005034</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body currency_state">
                                    <div class="icon"><img src="../assets/images/crypto/ETH.svg" alt="Ethereum"></div>
                                    <div class="content">
                                        <div class="text">Ethereum</div>
                                        <h5 class="number">0.000359</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body currency_state">
                                    <div class="icon"><img src="../assets/images/crypto/neo.svg" alt="Neo"></div>
                                    <div class="content">
                                        <div class="text">Neo</div>
                                        <h5 class="number">0.000482</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="User_Statistics" style="height: 290px"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="margin-0">Total Sale</h5>
                    <h6 class="mb-0">2,45,124</h6>
                    <div id="apex-circle-gradient"></div>

                    <div class="sale_Weekly">2,5,4,8,3,9,1,5</div>
                    <h6>Weekly Earnings</h6>
                    <div class="sale_Monthly">3,1,5,4,7,8,2,3,1,4,6,5,4,4,2,3,1,5,4,7,8,2,3,1,4,6,5,4,4,2</div>
                    <h6>Monthly Earnings</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Task Panding</h3>
                </div>
                <div class="card-body">
                    <div>
                        <div id="apex-circle-chart"></div>
                    </div>
                    <div>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="example-radios" value="option1" checked>
                            <span class="custom-control-label">Panding</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="example-radios" value="option1" checked>
                            <span class="custom-control-label">Complated</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Visitor Statistics</h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                        <div class="item-action dropdown ml-2">
                            <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div id="chart_donut"></div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-vcenter text-nowrap card-table table_custom">
                                    <tr>
                                        <td>
                                            <div class="clearfix">
                                                <div class="float-left"><strong>35%</strong></div>
                                                <div class="float-right"><small class="text-muted">visitor from America</small></div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-azure" role="progressbar" style="width: 35%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="clearfix">
                                                <div class="float-left"><strong>25%</strong></div>
                                                <div class="float-right"><small class="text-muted">visitor from Canada</small></div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-green" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="clearfix">
                                                <div class="float-left"><strong>15%</strong></div>
                                                <div class="float-right"><small class="text-muted">visitor from India</small></div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-orange" role="progressbar" style="width: 15%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="clearfix">
                                                <div class="float-left"><strong>20%</strong></div>
                                                <div class="float-right"><small class="text-muted">visitor from UK</small></div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-indigo" role="progressbar" style="width: 20%" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="clearfix">
                                                <div class="float-left"><strong>5%</strong></div>
                                                <div class="float-right"><small class="text-muted">visitor from Australia</small></div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-cyan" role="progressbar" style="width: 5%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales Analytics</h3>
                    <div class="card-options">
                        <button class="btn btn-sm btn-outline-secondary mr-1" id="one_month">1M</button>
                        <button class="btn btn-sm btn-outline-secondary mr-1" id="six_months">6M</button>
                        <button class="btn btn-sm btn-outline-secondary mr-1" id="one_year" class="active">1Y</button>
                        <button class="btn btn-sm btn-outline-secondary mr-1" id="ytd">YTD</button>
                        <button class="btn btn-sm btn-outline-secondary" id="all">ALL</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="apex-timeline-chart"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Site Traffic</h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 border-right pb-4 pt-4">
                            <label class="mb-0">User</label>
                            <h4 class="font-30 font-weight-bold text-col-blue">11,545</h4>
                        </div>
                        <div class="col-6 pb-4 pt-4">
                            <label class="mb-0">Chat</label>
                            <h4 class="font-30 font-weight-bold text-col-blue">542</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="d-block">New items <span class="float-right">77%</span></label>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Uploads <span class="float-right">50%</span></label>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Comments <span class="float-right">23%</span></label>
                        <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gender Overview</h3>
                </div>
                <div class="card-body">
                    <div id="apex-Gender-Overview"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
