<?php

use Tritonium\App\Models\Update;
use Tritonium\Base\App;

/**
 * This is template file
 *
 * @var $data Array
 * @var $settings Array
 * @var $models Array of models
 */
$href_base = "/admin/{$modelname}/";
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
        <!-- Breadcrumb-->
        <div class="container-fluid py-2">
            <a href="<?= $href_base ?>create" target="blank" class="btn btn-outline-success">Create</a>
        </div>

        <div class="container-fluid">
            <?
            if (!empty($models)) { ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <?php
                            foreach (array_keys($models[0]) as $colTitle) { ?>
                                <th scope="col"><?= $colTitle ?></th>
                                <?
                            } ?>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($models as $id => $row) { ?>
                            <tr>
                                <?php
                                $idKey = array_keys($row)[0];
                                $modelID = $row[$idKey];
                                foreach ($row as $key => $value) {
                                    printf("<td>%.32s</td>", $value);
                                }
                                ?>
                                <td>
                                    <a href="<?= $href_base . $modelID ?>/view"
                                       class="btn btn-outline-secondary">View</a>
                                    <a href="<?= $href_base . $modelID ?>/edit"
                                       class="btn btn-outline-secondary">Edit</a>
                                    <a href="<?= $href_base . $modelID ?>/copy" target="_blank"
                                       class="btn btn-outline-success">Copy</a>
                                    <a href="<?= $href_base . $modelID ?>/delete"
                                       class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                            <?
                        } ?>
                        </tbody>
                    </table>
                </div>
                <?
            } ?>
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
