<style type="text/css">

    .ibox-title {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background-color: #aae4ae;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 2px 0 0;
        color: #000000;
        margin-bottom: 0;
        padding: 15px 15px 7px;
        min-height: 48px;
    }

    $padding-base: 15px;
    $color-body: #fff;
    $color-border: #ddd;
    $color-link: #0275d8;
    $border-radius: .25rem;

    .nav-tabs {
        &--vertical {
            border-bottom: none;
            border-right: 1px solid $color-border;
            display: flex;
            flex-flow: column nowrap;
        }
        
        &--left {
            margin: 0 $padding-base;
            
            .nav-item + .nav-item {
                margin-top: .25rem;
            }
            
            .nav-link {
                transition: border-color .125s ease-in;
                white-space: nowrap;
                
                &:hover {
                    background-color: lighten($color-border, 10%);
                    border-color: transparent;
                }
            }
            
            .nav-link.active {
                border-bottom-color: $color-border;
                border-right-color: $color-body;
                border-bottom-left-radius: $border-radius;
                border-top-right-radius: 0;
                margin-right: -1px;
                
                &:hover {
                    background-color: $color-body;
                    border-color: $color-link $color-body $color-link $color-link;
                }
            }
        }
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Observación</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li class="active">
                <strong>Observación</strong>
            </li>
        </ol>
       
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content">
        <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <!--<span class="label label-success pull-right">Monthly</span>-->
                                <h5>Menciones</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins count-menciones">0</h1>
                                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                                <small>Total menciones</small>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h5>Etiquetas del Dia</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins count-menciones-etiqueta">0</h1>
                                
                                <small>Total etiquetas</small>
                            </div>
                        </div>
                    </div>-->
                    <!--<div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Today</span>
                                <h5>visits</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">106,120</h1>
                                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                                <small>New visits</small>
                            </div>
                        </div>
                    </div>-->
                    <!--<div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Low value</span>
                                <h5>User activity</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">80,600</h1>
                                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                                <small>In first month</small>
                            </div>
                        </div>
                    </div>-->
        </div>
        <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Operadores</h5>
                                <!--<div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">Today</button>
                                        <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                        <button type="button" class="btn btn-xs btn-white">Annual</button>
                                    </div>
                                </div>-->
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-9" style="height: 345px !important;">
                                    <div class="flot-chart">
                                        <div id="container-operador" style="min-width: 100%; height: 300px; max-width: 100%; margin: 0% auto"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 yellow-bg">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <i class="fa fa-users fa-5x"></i>
                                            </div>
                                            <div class="col-xs-8 text-right">
                                                <span> Operadores </span>
                                                <h2 class="font-bold count-opr">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Instituciones</h5>
                                <!--<div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">Today</button>
                                        <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                        <button type="button" class="btn btn-xs btn-white">Annual</button>
                                    </div>
                                </div>-->
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-10" style="height: 400px !important;">
                                    <div class="flot-chart">
                                        <div id="container-institucion" style="min-width: 100%; height: 400px; max-width: 100%; margin: 0% auto"></div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="widget style1 blue-bg">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <i class="fa fa-building fa-5x"></i>
                                            </div>
                                            <div class="col-xs-8 text-right">
                                                <span> Inst </span>
                                                <h2 class="font-bold count-ins">0</h2>
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


 <!-- Page-Level Scripts -->
<script src="<?php echo assets_url('js/components/grafico.js');?>"></script>
