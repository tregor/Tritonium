<?php

use Tritonium\Base\App;
use Tritonium\Base\Services\View;

/**
 * This is template file
 * 
 * @var $data Array
 */

$sidebar = [
  0 => [
    'title' => 'Home',
    'href' => '/admin/index',
    'icon' => '<svg class="svg-icon svg-icon-sm svg-icon-heavy"><use xlink:href="#real-estate-1"> </use></svg>',
  ],
  200 => [
    'title' => 'Execute test',
    'href' => '/admin/test',
    'icon' => '<svg class="svg-icon svg-icon-sm svg-icon-heavy"><use xlink:href="#portfolio-grid-1"> </use></svg>',
  ],
  5000 => [
    'title' => 'Models',
    'dropdown' => [
      1 => [
        'title' => 'Users',
        'href' => '/admin/' . 'user/list',
      ],
      2 => [
        'title' => 'Tasks',
        'href' => '/admin/' . 'task/list',
      ],
      3 => [
        'title' => 'Completions',
        'href' => '/admin/' . 'completion/list',
      ],
      4 => [
        'title' => 'Withdrawals',
        'href' => '/admin/' . 'withdrawal/list',
      ],
      999 => [
        'title' => 'Updates',
        'href' => '/admin/' . 'update/list',
      ],
    ],
  ],
  999999 => [
    'title' => 'Login page',
    'href' => '/admin/login',
    'icon' => '<svg class="svg-icon svg-icon-sm svg-icon-heavy"><use xlink:href="#disable-1"> </use></svg>',
  ],
];
ksort($sidebar);

?>
<!-- Sidebar Navigation-->
<nav id="sidebar" class="shrinked">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center p-4">
        <img class="avatar shadow-0 img-fluid rounded-circle" src="/src/img/avatar614511949-0.jpg" alt="...">
        <div class="ms-3 title">
            <h1 class="h5 mb-1">Steve Miller</h1>
            <p class="text-sm text-gray-700 mb-0 lh-1">CEO of IT Solutions</p>
        </div>
    </div>
    <span class="text-uppercase text-gray-600 text-xs mx-3 px-2 heading mb-2">Main menu</span>
    <ul class="list-unstyled">
      <?
        foreach ($sidebar as $order => $entry) {
            $entryID = 'entry_' . substr(md5($entry['title'].$order), 0, 8);
            if (isset($entry['dropdown'])) {
              $href = "#{$entryID}\" data-bs-toggle=\"collapse";
            }else{
              $href = $entry['href'];
            }
          ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?=$href?>">
              <?=$entry['icon'] ?: ''?>
              <span><?=$entry['title']?></span>  
              </a>
              <?
              if (isset($entry['dropdown'])) {
                ?>
                <ul class="collapse list-unstyled" id="<?=$entryID?>">
                  <?
                  foreach ($entry['dropdown'] as $subOrder => $subEntry) {
                    ?>
                    <li><a class="sidebar-link" href="<?=$subEntry['href']?>"><?=$subEntry['title']?></a></li>
                    <?
                  }
                  ?>
                </ul>
                <?
              }
              ?>
          </li>
          <?
        }
        ?>
    </ul>
</nav>