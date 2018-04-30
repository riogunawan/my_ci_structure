<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-bg-blue-grey align-right">
                <li><a href="javascript:void(0);"><i class="material-icons">assignment</i> <?= $title_awal ?></a></li>
                <li><a href="<?= site_url('basic_form/input_text') ?>"> <?= $title ?></a></li>
                <li class="active"> <?= $subtitle ?></li>
            </ol>
        </div>

       <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            BASIC EXAMPLE
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <a href="#" class="btn btn-success waves-effect m-b-20">
                            <i class="material-icons">add</i>
                            <span>Tambah</span>
                        </a>
                        <button class="btn btn-info waves-effect m-b-20 pull-right" type="button" data-toggle="collapse" data-target="#pencarian_rinci" aria-expanded="false" aria-controls="pencarian_rinci">
                            <i class="material-icons">search</i>
                            <span>Pencarian Rinci</span>
                        </button>
                        <div class="collapse m-b-20" id="pencarian_rinci">
                            <div class="panel panel-primary">
                                <form class="panel-body form-filter" action="index.html" method="POST">
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <?= $filter["input_text"] ?>
                                                <label class="form-label">Input Text</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control">
                                                <label class="form-label">Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control">
                                                <label class="form-label">Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary waves-effect btn-cari" type="submit">
                                            <i class="material-icons">filter_list</i>
                                            <span>Filter Data</span>
                                        </button>
                                        <button class="btn btn-default waves-effect btn-reset" type="button">
                                            <i class="material-icons">refresh</i>
                                            <span>Reset</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="">  <!-- tambahkan class table-responsive disini -->
                            <table class="table table-condensed table-striped table-hover dataTable">
                                <thead class="bg-blue">
                                    <tr>
                                        <th width="2%" class="text-center">#</th>
                                        <th width="2%">Action</th>
                                        <th>Input Text</th>
                                    </tr>
                                </thead>
                                <tfoot class="bg-blue">
                                    <tr>
                                        <th width="2%" class="text-center">#</th>
                                        <th width="2%">Action</th>
                                        <th>Input Text</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>