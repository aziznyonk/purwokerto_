<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/logo_pdam.png">
        <title>Tirta Satria Purwokerto - <?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app-style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/icons.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/maps.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vectormap/jquery-jvectormap-2.0.2.css">
    </head>
    <body class="bg-theme bg-theme1">
        <div id="wrapper">
            <header class="topbar-nav">
                <nav class="navbar navbar-expand fixed-top">
                    <ul class="navbar-nav mr-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="<?php echo base_url(); ?>assets/images/logo_pdam.png" class="img-responsive" alt="Logo Image" height="60">
                                <span class="logo-lg" style="color: #e7b83d"><b style="color: #33b897">PDAM</b> TIRTA SATRIA</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form class="search-bar">
                                <input type="text" class="form-control" placeholder="Enter keywords">
                                <a href="#"><i class="icon-magnifier"></i></a>
                            </form>
                        </li>
                    </ul>
                </nav>
            </header>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="card mt-3">
                        <div class="card-content">
                            <div class="row row-group m-0">
                                <div class="col-12 col-lg-6 col-xl-3 border-light">
                                    <div class="card-body">
                                        <h5 class="text-white mb-0">Pelanggan <span class="float-right"><i class="fa fa-user"></i></span></h5>
                                        <div class="progress my-3" style="height:3px;">
                                            <div class="progress-bar" style="width:100%"></div>
                                        </div>
                                        <p class="mb-0 text-white small-font">Pelanggan Aktif <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                        <p class="mb-0 text-white small-font">Pelanggan Pasif <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                        <p class="mb-0 text-white small-font">Total Pelanggan <span class="float-right"><?php echo $pelanggan?></span></p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-light">
                                    <div class="card-body">
                                        <h5 class="text-white mb-0">Pelanggan MBR <span class="float-right"><i class="fa fa-address-card"></i></span></h5>
                                        <div class="progress my-3" style="height:3px;">
                                            <div class="progress-bar" style="width:100%"></div>
                                        </div>
                                        <p class="mb-0 text-white small-font">Pelanggan Aktif <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                        <p class="mb-0 text-white small-font">Pelanggan Pasif <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                        <p class="mb-0 text-white small-font">Total Pelanggan <span class="float-right"><?php echo $mbr?></span></p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-light">
                                    <div class="card-body">
                                        <h5 class="text-white mb-0">Pelunasan Tagihan <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                                        <div class="progress my-3" style="height:3px;">
                                            <div class="progress-bar" style="width:100%"></div>
                                        </div>
                                        <p class="mb-0 text-white small-font">Pelanggan Lunas <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                        <p class="mb-0 text-white small-font">Pelanggan Belum Lunas <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-light">
                                    <div class="card-body">
                                        <h5 class="text-white mb-0">Daftar Rekening Ditagih <span class="float-right"><i class="fa fa-money"></i></span></h5>
                                        <div class="progress my-3" style="height:3px;">
                                            <div class="progress-bar" style="width:100%"></div>
                                        </div>
                                        <p class="mb-0 text-white small-font">DRD Terbit <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                        <p class="mb-0 text-white small-font">DRD Terjual <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                        <p class="mb-0 text-white small-font">% <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xl-8">
                            <div class="card">
                                <div class="card-header">Map Pipa
                                    <div class="card-action">
                                        <div class="dropdown">
                                            <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                                                <i class="icon-options"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void();">Action</a>
                                                <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="pull-left"><input type="checkbox" name="cbx_manometer" id="cbx_manometer"><img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadManometer"></span>
                                            <span></span>Manometer
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="pull-left"><input type="checkbox" name="cbx_meterinduk" id="cbx_meterinduk"><img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadMeter"></span>
                                            <span>Meter Induk</span>
                                        </li>
                                    </ul>
                                    <div id="map" style="height: 695px"></div>
                                </div>
                                <div class="row m-0 row-group text-center border-top border-light-3">
                                    <div class="col-12 col-lg-4">
                                        <div class="p-3">
                                            <h5 class="mb-0">45.87M</h5>
                                            <small class="mb-0">Merah <span> <i class="fa fa-arrow-up"></i> 0 - 0.3</span></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="p-3">
                                            <h5 class="mb-0">45.87M</h5>
                                            <small class="mb-0">Kuning <span> <i class="fa fa-arrow-up"></i> 0.3 - 0.5</span></small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="p-3">
                                            <h5 class="mb-0">45.87M</h5>
                                            <small class="mb-0">Hijau <span> <i class="fa fa-arrow-up"></i> &ge; 0.5</span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="card-header">Legenda
                                    <div class="card-action">
                                        <div class="dropdown">
                                            <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                                                <i class="icon-options"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void();">Action</a>
                                                <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th>Tekanan Pipa</th>
                                                    <th>Simbol Marker</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><hr class="pipa dm_100"> Tekanan 0 - 0.3</td>
                                                    <td><img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=M|eacd20|000000" height="20" width="15"> Manometer</td>
                                                </tr>
                                                <tr>
                                                    <td><hr class="pipa dm_250"> Tekanan 0.3 &le; 0.5</td>
                                                    <td><img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=I|ea1f1f|000000" height="20" width="15"> Meter Induk</td>
                                                </tr>
                                                <tr>
                                                    <td><hr class="pipa dm_40"> Tekanan &ge; 0.5</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xl-6">
                            <div class="card">
                                <div class="card-header">World Selling Region
                                    <div class="card-action">
                                        <div class="dropdown">
                                            <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                                                <i class="icon-options"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void();">Action</a>
                                                <a class="dropdown-item" href="javascript:void();">Another action</a>
                                                <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="dashboard-map" style="height: 270px;"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-items-center">
                                        <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th>Income</th>
                                            <th>Trend</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-ca mr-2"></i> USA</td>
                                            <td>4,586$</td>
                                            <td><span id="trendchart1"></span></td>
                                        </tr>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-us mr-2"></i>Canada</td>
                                            <td>2,089$</td>
                                            <td><span id="trendchart2"></span></td>
                                        </tr>

                                        <tr>
                                            <td><i class="flag-icon flag-icon-in mr-2"></i>India</td>
                                            <td>3,039$</td>
                                            <td><span id="trendchart3"></span></td>
                                        </tr>

                                        <tr>
                                            <td><i class="flag-icon flag-icon-gb mr-2"></i>UK</td>
                                            <td>2,309$</td>
                                            <td><span id="trendchart4"></span></td>
                                        </tr>

                                        <tr>
                                            <td><i class="flag-icon flag-icon-de mr-2"></i>Germany</td>
                                            <td>7,209$</td>
                                            <td><span id="trendchart5"></span></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 col-xl-6">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Debit Flowmeter</p>
                                            <h4 class="mb-0">SUM : <?php echo substr($sumDebit->debit, 0, 5);?> <small class="small-font">5.2% <i class="zmdi zmdi-long-arrow-up"></i></small></h4>
                                        </div>
                                        <canvas id="chart3" height="180"></canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Total Clicks</p>
                                            <h4 class="mb-0">7,493 <small class="small-font">1.4% <i class="zmdi zmdi-long-arrow-up"></i></small></h4>
                                        </div>
                                        <canvas id="chart4" height="180"></canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p class="mb-4">Total Downloads</p>
                                            <input class="knob" data-width="175" data-height="175" data-readOnly="true" data-thickness=".2" data-angleoffset="90" data-linecap="round" data-bgcolor="rgba(255, 255, 255, 0.14)" data-fgcolor="#fff" data-max="15000" value="8550"/>
                                            <hr>
                                            <p class="mb-0 small-font text-center">3.4% <i class="zmdi zmdi-long-arrow-up"></i> since yesterday</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Device Storage</p>
                                            <h4 class="mb-3">42620/50000</h4>
                                            <hr>
                                            <div class="progress-wrapper mb-4">
                                                <p>Documents <span class="float-right">12GB</span></p>
                                                <div class="progress" style="height:5px;">
                                                    <div class="progress-bar" style="width:80%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-wrapper mb-4">
                                                <p>Images <span class="float-right">10GB</span></p>
                                                <div class="progress" style="height:5px;">
                                                    <div class="progress-bar" style="width:60%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-wrapper mb-4">
                                                <p>Mails <span class="float-right">5GB</span></p>
                                                <div class="progress" style="height:5px;">
                                                    <div class="progress-bar" style="width:40%"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2018 <a href="#">PDAM Kab. Banyumas - Indonesia</a>.</strong> All rights
                reserved.
            </footer>
        </div>
        <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
        <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/vectormap/jquery-jvectormap-asia-mill.js"></script>
        <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
        <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/js/excanvas.js"></script>
        <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.knob.js"></script>
        <script type="text/javascript" src="http://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <!--script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCIzZP8FL9CcvsVaTj3ZjVi9Peum5pIozQ"></script-->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDhp3-zMM6Z1-NM8FBefecBjnRQBIv08_8"></script>
        <script rel="script" type="text/javascript">
            // WORLD MAP
            jQuery('#dashboard-map').vectorMap(
                {
                    map: 'asia_mill',
                    backgroundColor: 'transparent',
                    borderColor: '#818181',
                    borderOpacity: 0.25,
                    borderWidth: 1,
                    zoomOnScroll: false,
                    color: '#009efb',
                    regionStyle : {
                        initial : {
                            fill : '#fff'
                        }
                    },
                    markerStyle: {
                        initial: {
                            r: 9,
                            'fill': '#fff',
                            'fill-opacity':1,
                            'stroke': '#000',
                            'stroke-width' : 5,
                            'stroke-opacity': 0.4
                        },
                    },
                    enableZoom: true,
                    hoverColor: '#009efb',
                    markers : [{
                        latLng : [-7.431391, 109.247833],
                        name : 'Purwokerto, Indonesia'

                    }],
                    hoverOpacity: null,
                    normalizeFunction: 'linear',
                    scaleColors: ['#b6d6ff', '#005ace'],
                    selectedColor: '#c9dfaf',
                    selectedRegions: [],
                    showTooltip: true,
                });

            //chart page view
            var ctx = document.getElementById('chart3').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
                    datasets: [{
                        label: 'Page Views',
                        data: [0, 8, 12, 5, 12, 8, 16, 25, 15, 10, 20, 10, 30],
                        backgroundColor: 'rgba(255, 255, 255, 0.12)',
                        borderColor: '#fff',
                        pointBackgroundColor:'#fff',
                        pointHoverBackgroundColor:'#fff',
                        pointBorderColor :'#fff',
                        pointHoverBorderColor :'#fff',
                        pointBorderWidth :1,
                        pointRadius :0,
                        pointHoverRadius :4,
                        borderWidth: 3
                    }]
                },
                options: {
                    legend: {
                        position: false,
                        display: true,
                    },
                    tooltips: {
                        enabled: false
                    },
                    scales: {
                        xAxes: [{
                            display: false,
                            gridLines: false
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: false
                        }]
                    }
                }
            });
            // TOTAL CLICK
            var ctx = document.getElementById("chart4").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
                    datasets: [{
                        label: 'Total Clicks',
                        data: [0, 10, 14, 18, 12, 8, 16, 25, 15, 10, 20, 10, 30],
                        backgroundColor: "#fff"
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            fontColor: '#ddd',
                            boxWidth:40
                        }
                    },
                    tooltips: {
                        enabled:false
                    },

                    scales: {
                        xAxes: [{
                            barPercentage: .3,
                            display: false,
                            gridLines: false
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: false
                        }]
                    }

                }

            });


            $(function() {
                // TOTAL DOWNLOAD
                $(".knob").knob();

                //CHECK BOX MANOMETER & METER INDUK
                $('#cbx_manometer').click(function () {
                    if ($(this).is(':checked')){
                        $("#loadManometer").show();
                        if(markers_M.length == 0){
                            markerClusterM = createcluster(markers_M);
                            $.ajax({
                                type    : 'GET',
                                url     : '<?php echo base_url()?>mapsManometerCek',
                                success : function (response){makeMarker(response, markers_M, 'M',markerClusterM);$("#loadManometer").hide();}
                            });
                        }else{
                            for (let i in markers_M) {
                                markers_M[i].setMap(map);
                            }
                            markerClusterM.addMarkers(markers_M);
                            $("#loadManometer").hide();
                        }

                    }else{
                        $("#loadManometer").show();
                        removeMarker(markers_M, markerClusterM);
                        $('#loadManometer').hide();
                    }
                });
                $('#cbx_meterinduk').click(function () {
                    if ($(this).is(':checked')){
                        $("#loadMeter").show();
                        if(markers_I.length == 0){
                            markerClusterI = createcluster(markers_I);
                            $.ajax({
                                type    : 'GET',
                                url     : '<?php echo base_url()?>mapsMeterCek',
                                success : function (response){makeMarker(response, markers_I, 'I',markerClusterI);$("#loadMeter").hide();}
                            });
                        }else{
                            for (let i in markers_I) {
                                markers_M[i].setMap(map);
                            }
                            markerClusterI.addMarkers(markers_I);
                            $("#loadMeter").hide();
                        }

                    }else{
                        $("#loadMeter").show();
                        removeMarker(markers_I, markerClusterI);
                        $('#loadMeter').hide();
                    }
                });
            });
        </script>
        <script rel="script" type="text/javascript">
            //MAP PIPA

            var map; // Global declaration of the map
            var lat_longs_map = new Array();
            var markers_map = new Array();
            var markerCluster;
            var markers_M   = new Array();
            var markers_I   = new Array();


            var infoWindow = new google.maps.InfoWindow();

            function initialize_map() {

                var styles_0 = [{"featureType":"poi.business","elementType":"labels","stylers":[{"visibility":"off"}]}];
                var myLatlng = new google.maps.LatLng(-7.431391, 109.247833);
                var myOptions = {
                    zoom: 12,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP}
                map = new google.maps.Map(document.getElementById("map"), myOptions);
                map.setOptions({styles: styles_0});


                var clusterOptions = {
                    gridSize: 60,
                    minimumClusterSize: 3,
                    imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m"
                };
                var markerCluster = new MarkerClusterer(map, markers_map, clusterOptions);

                $.ajax({
                    type    : 'GET',
                    url     : '<?php echo base_url()?>mapsPipaTekanans',
                    success : function (response){
                        $.each(response, function(i, field){
                            let pipa        = field.lines;
                            let pipaPath    = new google.maps.Polyline({
                                path: pipa,
                                strokeColor: '#36d962',
                                strokeOpacity: 1.0,
                                strokeWeight: 2
                            });
                            let content = field.content;

                            google.maps.event.addListener(pipaPath, 'click', function(event) {
                                infoWindow.setContent(content);
                                infoWindow.setPosition(event.latLng);
                                infoWindow.open(map);
                            });
                            pipaPath.setMap(map);

                        });
                    },
                    complete: function () {
                        pipaTekananTimer();
                    }
                });


            }
            google.maps.event.addDomListener(window, "load", initialize_map);

            function  pipaTekananTimer() {
                $.ajax({
                    type    : 'GET',
                    url     : '<?php echo base_url()?>mapsTekananCek',
                    success : function (response){
                        $.each(response, function(i, field){
                            let pipa        = field.lines;
                            let A           = field.tekanan;
                            let color;
                            if((0 < A) && (A <= 0.3)){
                                color = '#e31a1c';
                            }else if ((0.3 < A) && (A <= 0.5)){
                                color = '#f4e943';
                            }else if(A>0.5){
                                color = '#36d962';
                            }

                            let pipaTPath    = new google.maps.Polyline({
                                path: pipa,
                                strokeColor: color,
                                strokeOpacity: 1.0,
                                strokeWeight: 8
                            });
                            let content = field.content;

                            google.maps.event.addListener(pipaTPath, 'click', function(event) {
                                infoWindow.setContent(content);
                                infoWindow.setPosition(event.latLng);
                                infoWindow.open(map);
                            });
                            pipaTPath.setMap(map);

                        });
                    },
                    complete: function () {
                        setTimeout(pipaTekananTimer, 60000);
                    }
                });
            }

            function createcluster(markers,Cluster) {
                Cluster = new MarkerClusterer(map, markers,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                return Cluster;
            }
            function makeMarker(response, markers_pelanggan, A, Cluster) {
                let bounds      = new google.maps.LatLngBounds();
                let infoWindow  = new google.maps.InfoWindow();
                let locations = response;
                let color;
                switch (A) {
                    case 'M' : color = 'eacd20';break;
                    case 'I' : color = 'ea1f1f';break;
                    case 'Mb': color = '1eea3d';break;
                    case 'V' : color = '1d5bea';break;
                    case 'P' : color = 'ff00e1';break;
                    case 'S' : color = '33ffbd';break;
                }

                markers_map = locations.map(function (location, i) {
                    marker = new google.maps.Marker({
                        title   : location.nomor_pela,
                        icon    : 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+A+'|'+color+'|000000',
                        position: new google.maps.LatLng(location),
                        map     : map
                    });

                    bounds.extend(location);
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infoWindow.setContent(location.content);
                            infoWindow.open(map, marker);
                        }
                    })(marker, i));
                    markers_pelanggan.push(marker);
                    return marker;
                });
                Cluster.addMarkers(markers_map);

                map.fitBounds(bounds);

            }
            function removeMarker(markers_map,Cluster) {

                for (let i in markers_map) {
                    markers_map[i].setMap(null);
                }
                Cluster.clearMarkers();
                Cluster.redraw();
            }
        </script>
    </body>
</html>
