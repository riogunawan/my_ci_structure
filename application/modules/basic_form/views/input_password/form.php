
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-bg-blue-grey align-right">
                <li><a href="javascript:void(0);"><i class="material-icons">assignment</i> <?= $title_awal ?></a></li>
                <li><a href="<?= site_url('basic_form/input_password') ?>"> <?= $title ?></a></li>
                <li class="active"> <?= $subtitle ?></li>
            </ol>
        </div>

       <!-- Basic Examples -->
        <?php echo $this->session->flashdata("msg") ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?php echo strtoupper($subtitle) ?>
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
                        <div class="row clearfix">
                            <form class="form" action="<?= $form_action ?>" method="POST" role="form">
                                <?= $input['hide']['id'] ?>

                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <?= $input["input_password"] ?>
                                            <label class="form-label">Input Password</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <?= $input["pass_confirm"] ?>
                                            <label class="form-label">Konfirmasi Password</label>
                                        </div>
                                    </div>

                                    <div class="btn-group pull-right">
                                            <button class="btn btn-success waves-effect btn-proses">
                                                <i class="material-icons">check</i>
                                                <span>Proses</span>
                                            </button>
                                            <a href="<?= @$link_back ?>" class="btn btn-warning waves-effect">
                                                <i class="material-icons">arrow_back</i>
                                                <span>Kembali</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>