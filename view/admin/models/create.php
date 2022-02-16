<?php

use Tritonium\Base\App;
use Tritonium\Base\Services\View;
use Tritonium\App\Models\Update;
use Tritonium\App\Models\User;
use Tritonium\Base\Models\Migrations;

/**
 * This is template file
 * 
 * @var $data Array
 * @var $model Array, model
 */

$href_base = "/admin/{$modelname}/";
$modelClass = '\\Tritonium\\App\\Models\\'.ucfirst($modelname);

$cookies = App::$components->request->cookies();
$user_token = $cookies['admin_token'];
$user = User::getByToken($user_token);
?>
<?App::$view->include('admin.block.head')?>
<?App::$view->include('admin.block.header')?>

<div class="d-flex align-items-stretch">
  <!-- Sidebar Navigation-->
  <?App::$view->include('admin.block.sidebar')?>
  <!-- End Sidebar Navigation-->

  <!-- Main Content -->
  <div class="page-content form-page">
    <!-- Page Header-->
    <div class="bg-dash-dark-2 py-4">
      <div class="container-fluid">
        <h2 class="h5 mb-0"><?=$settings['title']?></h2>
      </div>
    </div>
    <!-- Breadcrumb-->
    <div class="container-fluid py-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 py-3 px-0">
          <li class="breadcrumb-item"><a href="<?=$settings['href_base']?>">Home</a></li>
          <?php foreach (@$settings['breadcrumbs'] as $item) {?>
            <li class="breadcrumb-item"><a href="<?=$item[1]?>"><?=$item[0]?></a></li>
          <?}?>
          <li class="breadcrumb-item active" aria-current="page"><?=$settings['title']?></li>
        </ol>
      </nav>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-8 card">
          <div class="card-header">
            <?=$title?> 
          </div>
          <div class="card-body">
            <form id="model-<?=$modelname?>" action="<?=$href_base . 'save'?>" method="POST">
            <?php

            foreach ($attributes as $key) {
              if ($model) {
                $value = $model[$key];
              }else{
                $value = '';
              }
              $type = (strlen($value) > 32) ? 'textarea' : 'text';
              switch ($type) {
                case 'textarea':
                  $form_input = '<textarea class="form-control" id="model-'.$key.'" name="'.$modelname.'['.$key.']" rows="5">'.$value.'</textarea>';
                  $form_label = '<label class="form-label" for="model-'.$key.'">'.$modelClass::getLabel($key).'</label>';
                  break;
                
                default:
                  $form_input = '<input class="form-control" id="model-'.$key.'" name="'.$modelname.'['.$key.']" type="text" name="model'.$key.'" value="'.$value.'" onchange="changed(this);" autocompleate=off>';
                  $form_label = '<label class="form-label" for="model-'.$key.'">'.$modelClass::getLabel($key).'</label>';
                  break;
              }
              ?>

              <div class="row">
                <div class="col-sm-3 form-label">
                  <?=$form_label?>
                </div>
                <div class="col-sm-9">
                  <?=$form_input?>
                </div>
              </div>
            <? } ?>
            </form>
          </div>
        </div>
        <div class="col-4 card">
          <div class="card-header">
            Actions
          </div>
          <div class="card-body">
            <button type="button" onclick="document.getElementById('model-<?=$modelname?>').submit();" class="btn btn-lg btn-block btn-outline-success">Save</button>
            <a href="<?=$href_base . 'list'?>" class="btn btn-lg btn-block btn-outline-secondary">Cancel</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Page Footer-->
    <footer class="position-absolute bottom-0 bg-dash-dark-2 text-white text-center py-3 w-100 text-xs" id="footer">
      <div class="container-fluid text-center">
        <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        <p class="mb-0 text-dash-gray">2021 &copy; YelpStar. By <a href="https://tregor.space" target="blank">TREGOR LLC</a>.</p>
      </div>
    </footer>
  </div>
  <!-- Main Content -->
</div>
<script type="text/javascript">
  function onBeforeUnload(e) {
    if (thereAreUnsavedChanges()) {
        e.preventDefault();
        e.returnValue = '';
        return;
    }

    delete e['returnValue'];
  }

  window.addEventListener('beforeunload', onBeforeUnload);
</script>
<?App::$view->include('admin.block.footer')?>