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
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Gráfico</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <!-- Bootstrap CSS -->
                    <!-- jQuery first, then Bootstrap JS. -->
                    <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" href="#operadores" role="tab" data-toggle="tab">Operadores</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#institucion" role="tab" data-toggle="tab">Institución</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#ins_sit" role="tab" data-toggle="tab">Institución / situacion</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#mensiones" role="tab" data-toggle="tab">Estadisticas por Menciones</a>
                          </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane fade in active" id="operadores">
                              <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div id='container-operador-count'></div>
                                </div>
                              </div>
                              <div id="container-operador" style="min-width: 100%; height: 400px; max-width: 100%; margin: 3% auto"></div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="institucion">
                              <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div id='container-institucion-count'></div>
                                </div>
                              </div>
                              <div id="container-institucion" style="min-width: 100%; height: 400px; max-width: 100%; margin: 3% auto"></div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="ins_sit">
                              dddd
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="mensiones">
                              <div id="container-mensiones" style="min-width: 100%; height: 400px; max-width: 100%; margin: 3% auto"></div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


 <!-- Page-Level Scripts -->
<script src="<?php echo assets_url('js/components/grafico.js');?>"></script>
