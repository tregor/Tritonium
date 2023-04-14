<?php

use Tritonium\App\Models\Update;
use Tritonium\Base\App;

/**
 * This is template file
 *
 * @var $data Array
 * @var $settings Array
 * @var $model Array, model
 */

$href_base = "/admin/{$modelname}/{$model_id}/";
$modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
?>
<?
App::$view->include('admin.block.head') ?>
<?
App::$view->include('admin.block.header') ?>

<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <?
    App::$view->include('admin.block.sidebar') ?>
    <!-- End Sidebar Navigation-->

    <!-- Main Content -->
    <div class="page-content form-page">
        <!-- Page Header-->
        <div class="bg-dash-dark-2 py-4">
            <div class="container-fluid">
                <h2 class="h5 mb-0"><?= $settings['title'] ?></h2>
            </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid py-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3 px-0">
                    <li class="breadcrumb-item"><a href="<?= $settings['href_base'] ?>">Home</a></li>
                    <?php
                    foreach (@$settings['breadcrumbs'] as $item) { ?>
                        <li class="breadcrumb-item"><a href="<?= $item[1] ?>"><?= $item[0] ?></a></li>
                        <?
                    } ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $settings['title'] ?></li>
                </ol>
            </nav>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-8 card">
                    <div class="card-header">
                        <?= $title ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <?php
                                foreach ($model as $key => $value) { ?>
                                    <tr>
                                        <th scope="row"><?= $modelClass::getLabel($key) ?></th>
                                        <td><?= $value ?></td>
                                    </tr>
                                    <?
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4 card">
                    <div class="card-header">
                        Actions
                    </div>
                    <div class="card-body">
                        <a href="<?= $href_base . 'edit' ?>"
                           class="btn btn-lg btn-block btn-outline-secondary">Edit</a>
                        <a href="<?= $href_base . 'copy' ?>" target="blank"
                           class="btn btn-lg btn-block btn-outline-success">Copy</a>
                        <a href="<?= $href_base . 'delete' ?>"
                           class="btn btn-lg btn-block btn-outline-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Page Footer-->
        <footer class="position-absolute bottom-0 bg-dash-dark-2 text-white text-center py-3 w-100 text-xs"
                id="footer">
            <div class="container-fluid text-center">
                <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                <p class="mb-0 text-dash-gray">2021 &copy; YelpStar. By <a href="https://tregor.space"
                                                                           target="blank">TREGOR LLC</a>.</p>
            </div>
        </footer>
    </div>
    <!-- Main Content -->
</div>

<?
App::$view->include('admin.block.footer') ?>
