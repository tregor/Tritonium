<?php

use Tritonium\Base\Services\App;
use Tritonium\Base\Services\View;

/**
 * This is template file
 * 
 * @var $data Array
 */
?>
<?App::$view->include('admin.block.header')?>

<div class="container">
  <!-- Content here -->
  <h1>Hello, world!</h1>
</div>

<?App::$view->include('admin.block.footer')?>