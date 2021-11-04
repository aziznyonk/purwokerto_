<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/logo_pdam.png">
    <title>Tirta Satria Purwokerto - <?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/adminLTE.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/skin-blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/maps.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo base_url(); ?>index.php/dashboard" class="logo" style="height: auto">
                <!--                    <img src="--><?php //echo base_url(); 
                                                        ?>
                <!--assets/images/logo_pdam.png" alt="homepage" style="width: 35px;"/>-->
                <span class="logo-lg" style="color: #e7b83d"><b style="color: #33b897">PDAM</b> TIRTA SATRIA</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu pull-left">
                    <ul class="nav navbar-nav">
                        <li><a href="#"><b>HOME</b></a></li>
                        <li><a href="http://103.25.210.61:81/purwokerto/"><b>ADMIN</b></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <form id="search_form" name="search_form" class="sidebar-form " style="padding: 10px">
                    <div class="input-group search">
                        <input type="text" name="search" class="form-control" id="search" style="border: 1px solid #d2d6de;">
                    </div>
                    <div class="input-group search">
                        <select class="form-control" id="option" name="option">
                            <option name="option_p" value="pelanggan">Pelanggan</option>
                            <option name="option_p" value="pelanggan_mbr">Pelanggan MBR</option>
                        </select>
                    </div>
                    <button class="btn pull-right" type="submit" name="btn_search" id="btn_search" style="border: 1px solid #d2d6de">Search</button>
                </form>
                <div>
                    <ul class="sidebar-menu" data-widget="tree" id="menu_sidebar">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/dashboard">
                                <i class="fa fa-id-card"></i><span>WEB ADMIN</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/mapTekanan">
                                <i class="fa fa-id-card"></i><span>WEB MAP TEKANAN PIPA</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-dashboard"></i>
                                <span>AKSESORIS PDAM</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#">
                                        <span>DATA TEKANAN</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_tekanan" id="cbx_tekanan">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadTekanan">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA MANOMETER</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_manometer" id="cbx_manometer">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadManometer">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA METER INDUK</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_meterinduk" id="cbx_meterinduk">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadMeter">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA VALVE</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_velve" id="cbx_velve">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadVelve">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA DOP</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_dop" id="cbx_dop">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadDop">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA FIRE HYDRANT</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_fhydrant" id="cbx_fhydrant">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadFhydrant">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA GIBOULT</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_giboult" id="cbx_giboult">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadGiboult">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA JEMBATAN PIPA</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_jembatan" id="cbx_jembatan">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadJembatan">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA KNIE</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_knie" id="cbx_knie">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadKnie">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA POMPA</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_pompa" id="cbx_pompa">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadPompa">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>DATA TEE</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_tee" id="cbx_tee">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadTee">
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-dashboard"></i>
                                <span>PELANGGAN PDAM</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#">
                                        </i> <span>DATA PELANGGAN</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_pelanggan" id="cbx_pelanggan">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadPelanggan">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        </i> <span>DATA PELANGGAN MBR</span>
                                        <span class="pull-right-container">
                                            <input type="checkbox" name="cbx_pelangganM" id="cbx_pelangganM">
                                        </span>
                                        <span class="pull-right-container">
                                            <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadPelangganM">
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>DATA BANGUNAN</span>
                                <span class="pull-right-container">
                                    <input type="checkbox" name="cbx_bangunan" id="cbx_bangunan">
                                </span>
                                <span class="pull-right-container">
                                    <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadBangunan">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>DATA PIPA RENCANA</span>
                                <span class="pull-right-container">
                                    <input type="checkbox" name="cbx_pipaR" id="cbx_pipaR">
                                </span>
                                <span class="pull-right-container">
                                    <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadPipaR">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>DATA PIPA</span>
                                <span class="pull-right-container">
                                    <input type="checkbox" name="cbx_pipa" id="cbx_pipa">
                                </span>
                                <span class="pull-right-container">
                                    <img src="<?php echo base_url(); ?>assets/images/loading2.gif" class="img-load" id="loadPipa">
                                </span>
                            </a>
                            <ul class="pipaLegenda">
                                <li><a href="#">
                                        <hr class="pipa dm_12"> Pipa 12,5 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_20"> Pipa 20 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_25"> Pipa 25 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_40"> Pipa 40 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_45"> Pipa 45 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_50"> Pipa 50 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_65"> Pipa 65 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_75"> Pipa 75 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_80"> Pipa 80 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_100"> Pipa 100 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_125"> Pipa 125 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_150"> Pipa 150 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_200"> Pipa 200 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_250"> Pipa 250 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_300"> Pipa 300 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_400"> Pipa 400 mm
                                    </a></li>
                                <li><a href="#">
                                        <hr class="pipa dm_500"> Pipa 500 mm
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </section>
        </aside>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-info">
                    <?php echo $map['html']; ?>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2018 <a href="#">PDAM Kab. Banyumas - Indonesia</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script rel="script" type="text/javascript" src="<?php echo base_url(); ?>assets/javascripts/adminLTE.js"></script>
    <?php echo $map['js']; ?>
    <script rel="script" type="text/javascript">
        $(function() {
            'use strict';
            $('#cbx_tekanan').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadTekanan").show();
                    if (markers_Tekanan.length == 0) {
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsTekanan',
                            success: function(response) {
                                makeMarker(response, markers_Tekanan, 'Pr' /*,markerClusterM*/ );
                                $("#loadTekanan").hide();
                            }
                        });
                    } else {
                        for (let i in markers_Tekanan) {
                            markers_Tekanan[i].setMap(map);
                        }
                        $("#loadTekanan").hide();
                    }

                } else {
                    $("#loadTekanan").show();
                    removeMarker(markers_Tekanan /*, markerClusterM*/ );
                    $('#loadTekanan').hide();
                }
            });
            $('#cbx_manometer').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadManometer").show();
                    if (markers_M.length == 0) {
                        // markerClusterM = createcluster(markers_M);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsManometer',
                            success: function(response) {
                                makeMarker(response, markers_I, 'I' /*,markerClusterI*/ );
                                $("#loadManometer").hide();
                            }
                        });
                    } else {
                        for (let i in markers_I) {
                            markers_M[i].setMap(map);
                        }
                        // markerClusterI.addMarkers(markers_I);
                        $("#loadManometer").hide();
                    }

                } else {
                    $("#loadManometer").show();
                    removeMarker(markers_I /*, markerClusterI*/ );
                    $('#loadManometer').hide();
                }
            });
            $('#cbx_meterinduk').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadMeter").show();
                    if (markers_I.length == 0) {
                        // markerClusterI = createcluster(markers_I);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsMeter',
                            success: function(response) {
                                makeMarker(response, markers_I, 'I' /*,markerClusterI*/ );
                                $("#loadMeter").hide();
                            }
                        });
                    } else {
                        for (let i in markers_I) {
                            markers_M[i].setMap(map);
                        }
                        // markerClusterI.addMarkers(markers_I);
                        $("#loadMeter").hide();
                    }

                } else {
                    $("#loadMeter").show();
                    removeMarker(markers_I /*, markerClusterI*/ );
                    $('#loadMeter').hide();
                }
            });
            $('#cbx_velve').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadVelve").show();
                    if (markers_V.length == 0) {
                        // markerClusterV = createcluster(markers_V);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsVelve',
                            success: function(response) {
                                makeMarker(response, markers_V, 'V' /*,markerClusterV*/ );
                                $("#loadVelve").hide();
                            }
                        });
                    } else {
                        for (let i in markers_V) {
                            markers_V[i].setMap(map);
                        }
                        // markerClusterV.addMarkers(markers_V);
                        $("#loadVelve").hide();
                    }

                } else {
                    $("#loadVelve").show();
                    removeMarker(markers_V /*, markerClusterV*/ );
                    $('#loadVelve').hide();
                }
            });
            $('#cbx_dop').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadDop").show();
                    if (markers_D.length == 0) {
                        // markerClusterD = createcluster(markers_D);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsDop',
                            success: function(response) {
                                makeMarker(response, markers_D, 'D' /*,markerClusterD*/ );
                                $("#loadDop").hide();
                            }
                        });
                    } else {
                        for (let i in markers_D) {
                            markers_D[i].setMap(map);
                        }
                        // markerClusterD.addMarkers(markers_D);
                        $("#loadDop").hide();
                    }

                } else {
                    $("#loadDop").show();
                    removeMarker(markers_D /*, markerClusterD*/ );
                    $('#loadDop').hide();
                }
            });
            $('#cbx_fhydrant').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadFhydrant").show();
                    if (markers_F.length == 0) {
                        // markerClusterF = createcluster(markers_F);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsFhydrant',
                            success: function(response) {
                                makeMarker(response, markers_F, 'FH' /*,markerClusterF*/ );
                                $("#loadFhydrant").hide();
                            }
                        });
                    } else {
                        for (let i in markers_F) {
                            markers_F[i].setMap(map);
                        }
                        // markerClusterF.addMarkers(markers_F);
                        $("#loadFhydrant").hide();
                    }

                } else {
                    $("#loadFhydrant").show();
                    removeMarker(markers_F /*, markerClusterF*/ );
                    $('#loadFhydrant').hide();
                }
            });
            $('#cbx_giboult').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadGiboult").show();
                    if (markers_G.length == 0) {
                        // markerClusterG = createcluster(markers_G);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsGiboult',
                            success: function(response) {
                                makeMarker(response, markers_G, 'G' /*,markerClusterG*/ );
                                $("#loadGiboult").hide();
                            }
                        });
                    } else {
                        for (let i in markers_G) {
                            markers_G[i].setMap(map);
                        }
                        // markerClusterG.addMarkers(markers_G);
                        $("#loadGiboult").hide();
                    }

                } else {
                    $("#loadGiboult").show();
                    removeMarker(markers_G /*, markerClusterG*/ );
                    $('#loadGiboult').hide();
                }
            });
            $('#cbx_jembatan').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadJembatan").show();
                    if (markers_J.length == 0) {
                        // markerClusterJ = createcluster(markers_J);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsJembatan',
                            success: function(response) {
                                makeMarker(response, markers_J, 'J' /*,markerClusterJ*/ );
                                $("#loadJembatan").hide();
                            }
                        });
                    } else {
                        for (let i in markers_J) {
                            markers_J[i].setMap(map);
                        }
                        // markerClusterJ.addMarkers(markers_J);
                        $("#loadJembatan").hide();
                    }

                } else {
                    $("#loadJembatan").show();
                    removeMarker(markers_J /*, markerClusterJ*/ );
                    $('#loadJembatan').hide();
                }
            });
            $('#cbx_knie').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadKnie").show();
                    if (markers_K.length == 0) {
                        // markerClusterK = createcluster(markers_K);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsKnie',
                            success: function(response) {
                                makeMarker(response, markers_K, 'K' /*,markerClusterK*/ );
                                $("#loadKnie").hide();
                            }
                        });
                    } else {
                        for (let i in markers_K) {
                            markers_K[i].setMap(map);
                        }
                        // markerClusterK.addMarkers(markers_K);
                        $("#loadKnie").hide();
                    }

                } else {
                    $("#loadKnie").show();
                    removeMarker(markers_K /*, markerClusterK*/ );
                    $('#loadKnie').hide();
                }
            });
            $('#cbx_pompa').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadPompa").show();
                    if (markers_V.length == 0) {
                        // markerClusterPo = createcluster(markers_Po);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsPompa',
                            success: function(response) {
                                makeMarker(response, markers_Po, 'Po' /*,markerClusterPo*/ );
                                $("#loadPompa").hide();
                            }
                        });
                    } else {
                        for (let i in markers_Po) {
                            markers_Po[i].setMap(map);
                        }
                        // markerClusterPo.addMarkers(markers_Po);
                        $("#loadPompa").hide();
                    }

                } else {
                    $("#loadPompa").show();
                    removeMarker(markers_Po /*, markerClusterV*/ );
                    $('#loadPompa').hide();
                }
            });
            $('#cbx_tee').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadTee").show();
                    if (markers_T.length == 0) {
                        // markerClusterT = createcluster(markers_T);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsTee',
                            success: function(response) {
                                makeMarker(response, markers_T, 'T' /*,markerClusterT*/ );
                                $("#loadTee").hide();
                            }
                        });
                    } else {
                        for (let i in markers_T) {
                            markers_T[i].setMap(map);
                        }
                        // markerClusterT.addMarkers(markers_T);
                        $("#loadTee").hide();
                    }

                } else {
                    $("#loadTee").show();
                    removeMarker(markers_T /*, markerClusterT*/ );
                    $('#loadTee').hide();
                }
            });

            $('#cbx_pelanggan').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadPelanggan").show();
                    if (markers_P.length == 0) {
                        // markerClusterP = createcluster(markers_P);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsPelanggan',
                            success: function(response) {
                                makeMarker(response, markers_P, 'P' /*,markerClusterP*/ );
                                $("#loadPelanggan").hide();
                            }
                        });
                    } else {
                        for (let i in markers_P) {
                            markers_P[i].setMap(map);
                        }
                        // markerClusterP.addMarkers(markers_P);
                        $("#loadPelanggan").hide();
                    }

                } else {
                    $("#loadPelanggan").show();
                    removeMarker(markers_P /*, markerClusterP*/ );
                    $('#loadPelanggan').hide();
                }
            });
            $('#cbx_pelangganM').click(function() {
                if ($(this).is(':checked')) {
                    $("#loadPelangganM").show();
                    if (markers_Mb.length == 0) {
                        // markerClusterMb = createcluster(markers_Mb);
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsMbr',
                            success: function(response) {
                                makeMarker(response, markers_Mb, 'Mb' /*,markerClusterMb*/ );
                                $("#loadPelangganM").hide();
                            }
                        });
                    } else {
                        for (let i in markers_Mb) {
                            markers_Mb[i].setMap(map);
                        }
                        // markerClusterMb.addMarkers(markers_Mb);
                        $("#loadPelangganM").hide();
                    }

                } else {
                    $("#loadPelangganM").show();
                    removeMarker(markers_Mb /*, markerClusterMb*/ );
                    $('#loadPelangganM').hide();
                }
            });
            $("#cbx_pipaR").click(
                function() {
                    if ($(this).is(':checked')) {
                        $('#loadPipaR').show();
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsPipaRencana',
                            success: function(response) {
                                makePipaPolyline(response, pipaRencanaPath);
                                $('#loadPipaR').hide();
                            }

                        });
                    } else {
                        $("#loadPipaR").show();
                        removePipaPolyline(pipaRencanaPath);
                        $('#loadPipaR').hide();
                    }
                }
            );
            $("#cbx_pipa").click(
                function() {
                    if ($(this).is(':checked')) {
                        $('#loadPipa').show();
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url() ?>mapsPipa',
                            success: function(response) {
                                makePipaPolyline(response, pipaPath);
                                $('#loadPipa').hide();
                            }

                        });

                    } else {
                        $("#loadPipa").show();
                        removePipaPolyline(pipaPath);
                        $('#loadPipa').hide();
                    }
                }
            );
            $("#search_form").submit(function(e) {
                e.preventDefault();
                let search = $("#search").val();
                let option = $("#option").val();

                if (search === '') {
                    alert("Gagal proses pencarian - input null");
                } else {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url() ?>mapsSearchPelanggan',
                        data: {
                            search: search,
                            option: option
                        },
                        success: function(response) {
                            searchPelanggan(response);
                        }
                    });
                }
            });
        });
    </script>
    <script rel="script" type="text/javascript">
        var markers_Tekanan = new Array();
        var markers_M = new Array();
        var markers_I = new Array();
        var markers_V = new Array();
        var markers_P = new Array();
        var markers_Mb = new Array();
        var markers_S = new Array();
        var markers_D = new Array();
        var markers_F = new Array();
        var markers_G = new Array();
        var markers_J = new Array();
        var markers_K = new Array();
        var markers_Po = new Array();
        var markers_T = new Array();

        //var markerClusterM 	= "" ;
        //var markerClusterI 	= "" ;
        //var markerClusterV 	= "" ;
        //var markerClusterP 	= "" ;
        //var markerClusterMb	= "" ;
        //var markerClusterS 	= "" ;
        //var markerClusterD	= "" ;
        //var markerClusterF	= "" ;
        //var markerClusterG	= "" ;
        //var markerClusterJ	= "" ;
        //var markerClusterK	= "" ;
        //var markerClusterPo	= "" ;
        //var markerClusterT	= "" ;

        var pipaPath = new Array();
        var pipaRencanaPath = new Array();

        bounds = new google.maps.LatLngBounds();
        infoWindow = new google.maps.InfoWindow();

        function createcluster(markers, Cluster) {
            Cluster = new MarkerClusterer(map, markers, {
                imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
            });
            return Cluster;
        }

        function pinColor(A = null, pres = null) {
            let color;
            switch (A) {
                case 'Pr':
                    if (parseFloat(pres) < 0.5) color = 'ff0303';
                    else color = '199C70';
                    break;
                case 'M':
                    color = 'eacd20';
                    break;
                case 'I':
                    if (parseInt(pres) >= 6) color = 'ea1f1f';
                    else color = '1bef48';
                    break;
                case 'Mb':
                    color = '1eea3d';
                    break;
                case 'V':
                    color = '1d5bea';
                    break;
                case 'P':
                    color = 'ff00e1';
                    break;
                case 'S':
                    color = '33ffbd';
                    break;
                case 'D':
                    color = '7e3d00';
                    break;
                case 'FH':
                    color = '175b88';
                    break;
                case 'G':
                    color = 'e31a1c';
                    break;
                case 'J':
                    color = 'ff6ff3';
                    break;
                case 'K':
                    color = 'd89972';
                    break;
                case 'Po':
                    color = 'f4e943';
                    break;
                case 'T':
                    color = '7e21e6';
                    break;
            }
            return color;
        }

        function makeMarker(response, markers_pelanggan, A /*, Cluster*/ ) {
            let locations = response;
            let color;

            markers_map = locations.map(function(location, i) {
                if (location.pres != undefined) color = pinColor(A, location.pres)
                else color = pinColor(A)
                marker = new google.maps.Marker({
                    title: location.nomor_pela,
                    // icon    : 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+A+'|'+color+'|6495ED',
                    icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + A + '|' + color + '|000000',
                    position: new google.maps.LatLng(location),
                    map: map
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
            // Cluster.addMarkers(markers_map);

            map.fitBounds(bounds);

        }

        function removeMarker(markers_map /*,Cluster*/ ) {

            for (let i in markers_map) {
                markers_map[i].setMap(null);
            }
            // Cluster.clearMarkers();
            // Cluster.redraw();
        }

        function makePipaPolyline(response, pipaPath) {
            for (let i in response) {
                let locations = response[i];
                let A = locations.diameter;
                let content = locations.content;
                let color;
                switch (A) {
                    case '12.500000000000000':
                        color = '#a53aa3';
                        break;
                    case '20.000000000000000':
                        color = '#a0561a';
                        break;
                    case '25.000000000000000':
                        color = '#59e4ff';
                        break;
                    case '40.000000000000000':
                        color = '#33a02c';
                        break;
                    case '45.000000000000000':
                        color = '#36d962';
                        break;
                    case '50.000000000000000':
                        color = '#175b88';
                        break;
                    case '65.000000000000000':
                        color = '#a53aa3';
                        break;
                    case '75.000000000000000':
                        color = '#7e21e6';
                        break;
                    case '80.000000000000000':
                        color = '#d89972';
                        break;
                    case '100.000000000000000':
                        color = '#e31a1c';
                        break;
                    case '125.000000000000000':
                        color = '#6b5b04';
                        break;
                    case '150.000000000000000':
                        color = '#ff7f00';
                        break;
                    case '200.000000000000000':
                        color = '#ee88ed';
                        break;
                    case '250.000000000000000':
                        color = '#f4e943';
                        break;
                    case '300.000000000000000':
                        color = '#7e3d00';
                        break;
                    case '400.000000000000000':
                        color = '#e41e8b';
                        break;
                    case '500.000000000000000':
                        color = '#ff6ff3';
                        break;
                }
                pipaPath.push(new google.maps.Polyline({
                    path: locations.lines,
                    geodesic: true,
                    strokeColor: color,
                    strokeOpacity: 1.0,
                    strokeWeight: 3
                }));
                google.maps.event.addListener(pipaPath[pipaPath.length - 1], 'click', function(event) {
                    infoWindow.setContent(content);
                    infoWindow.setPosition(event.latLng);
                    infoWindow.open(map);
                });
                pipaPath[pipaPath.length - 1].setMap(map);
            }
        }

        function removePipaPolyline(pipaPath) {
            for (let i = 0; i < pipaPath.length; i++) {
                pipaPath[i].setMap(null);
            }
        }

        function searchPelanggan(response) {
            if (response === null) {
                alert('Gagal proses pencarian - pelanggan null');
            } else {
                // markerClusterS = createcluster(markers_S);
                makeMarker(response, markers_S, 'S' /*,markerClusterS*/ );
            }
        }
    </script>
</body>

</html>