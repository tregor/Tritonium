<?php

use Tritonium\Base\Services\Core;
use Tritonium\Base\Services\View;

/**
 * This is template file
 * 
 * @var $data Array
 */
?>
<?Core::$view->include('admin.block.header')?>

<div class="container">
  <!-- Content here -->
  <h1>Hello, world!</h1>
</div>

<?Core::$view->include('admin.block.footer')?>