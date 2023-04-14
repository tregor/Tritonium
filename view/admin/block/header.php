<?php

/**
 * This is template file
 *
 * @var $data Array
 */

?>
<!-- HEADER START -->
<header class="header">
    <nav class="navbar navbar-expand-lg py-3 bg-dash-dark-2 border-bottom border-dash-dark-1 z-index-10">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn d-flex align-items-center position-absolute top-0 end-0 me-4 mt-2 cursor-pointer">
                    <span>Close </span>
                    <svg class="svg-icon svg-icon-md svg-icon-heavy text-gray-700 mt-1">
                        <use xlink:href="#close-1"></use>
                    </svg>
                </div>
                <div class="row w-100">
                    <div class="col-lg-8 mx-auto">
                        <form class="px-4" id="searchForm" action="#">
                            <div class="input-group position-relative flex-column flex-lg-row flex-nowrap">
                                <input class="form-control shadow-0 bg-none px-0 w-100" type="search" name="search"
                                       placeholder="What are you searching for...">
                                <button
                                    class="btn btn-link text-gray-600 px-0 text-decoration-none fw-bold cursor-pointer text-center"
                                    type="submit">Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between py-1">
            <div class="navbar-header d-flex align-items-center">
                <a class="navbar-brand text-uppercase text-reset active" href="<?= $settings['base_url'] ?>">
                    <div class="brand-text brand-big"><strong class="text-primary">Yelp</strong><strong>Star</strong>
                    </div>
                    <div class="brand-text brand-sm"><strong class="text-primary">Y</strong><strong>S</strong></div>
                </a>
                <button class="sidebar-toggle active">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy transform-none">
                        <use xlink:href="#arrow-left-1"></use>
                    </svg>
                </button>
            </div>
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <a class="search-open nav-link px-0" href="#">
                        <svg class="svg-icon svg-icon-xs svg-icon-heavy text-gray-700">
                            <use xlink:href="#find-1"></use>
                        </svg>
                    </a>
                </li>
                <!-- Messages dropdown -->
                <li class="list-inline-item dropdown px-lg-2">
                    <a class="nav-link text-reset px-1 px-lg-0" id="navbarDropdownMenuLink1" href="#"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                            <use xlink:href="#envelope-1"></use>
                        </svg>
                        <span class="badge bg-dash-color-1">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                        aria-labelledby="navbarDropdownMenuLink1">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="position-relative">
                                    <img class="avatar avatar-md" src="/src/img/avatar-3.jpg" alt="Nadia Halsey">
                                    <div class="availability-status bg-success"></div>
                                </div>
                                <div class="ms-3">
                                    <strong class="d-block">Nadia Halsey</strong>
                                    <span class="d-block text-xs">lorem ipsum dolor sit amit</span>
                                    <small class="d-block">9:30am</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="position-relative">
                                    <img class="avatar avatar-md" src="/src/img/avatar-2.jpg" alt="Peter Ramsy">
                                    <div class="availability-status bg-warning"></div>
                                </div>
                                <div class="ms-3">
                                    <strong class="d-block">Nadia Halsey</strong>
                                    <span class="d-block text-xs">lorem ipsum dolor sit amit</span>
                                    <small class="d-block">9:30am</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="position-relative">
                                    <img class="avatar avatar-md" src="/src/img/avatar-1.jpg" alt="Sam Kaheil">
                                    <div class="availability-status bg-danger"></div>
                                </div>
                                <div class="ms-3">
                                    <strong class="d-block">Nadia Halsey</strong>
                                    <span class="d-block text-xs">lorem ipsum dolor sit amit</span>
                                    <small class="d-block">9:30am</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="position-relative">
                                    <img class="avatar avatar-md" src="/src/img/avatar-5.jpg" alt="Sara Wood">
                                    <div class="availability-status bg-secondary"></div>
                                </div>
                                <div class="ms-3">
                                    <strong class="d-block">Nadia Halsey</strong>
                                    <span class="d-block text-xs">lorem ipsum dolor sit amit</span>
                                    <small class="d-block">9:30am</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-center message" href="#">
                                <strong>See All Messages <i class="fas fa-angle-right ms-1"></i></strong>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Tasks dropdown                   -->
                <li class="list-inline-item dropdown px-lg-2">
                    <a class="nav-link text-reset px-1 px-lg-0" id="navbarDropdownMenuLink2" href="#"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                            <use xlink:href="#paper-stack-1"></use>
                        </svg>
                        <span class="badge bg-dash-color-3">9</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                        aria-labelledby="navbarDropdownMenuLink2">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex justify-content-between mb-1"><strong>Task 1</strong><span>40% complete</span>
                                </div>
                                <div class="progress" style="height: 2px">
                                    <div class="progress-bar bg-dash-color-1" role="progressbar" style="width: 40%"
                                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex justify-content-between mb-1"><strong>Task 2</strong><span>20% complete</span>
                                </div>
                                <div class="progress" style="height: 2px">
                                    <div class="progress-bar bg-dash-color-2" role="progressbar" style="width: 20%"
                                         aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex justify-content-between mb-1"><strong>Task 3</strong><span>70% complete</span>
                                </div>
                                <div class="progress" style="height: 2px">
                                    <div class="progress-bar bg-dash-color-3" role="progressbar" style="width: 70%"
                                         aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex justify-content-between mb-1"><strong>Task 4</strong><span>40% complete</span>
                                </div>
                                <div class="progress" style="height: 2px">
                                    <div class="progress-bar bg-dash-color-4" role="progressbar" style="width: 40%"
                                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex justify-content-between mb-1"><strong>Task 5</strong><span>30% complete</span>
                                </div>
                                <div class="progress" style="height: 2px">
                                    <div class="progress-bar bg-dash-color-1" role="progressbar" style="width: 30%"
                                         aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </li>
                        <li><a class="dropdown-item text-center" href="#"> <strong>See All Tasks <i
                                        class="fas fa-angle-right ms-1"></i></strong></a></li>
                    </ul>
                </li>
                <!-- Mega menu-->
                <!-- <li class="list-inline-item dropdown menu-large px-lg-2">
                    <a class="nav-link text-sm text-reset px-1 px-lg-0" href="#" data-bs-toggle="dropdown">Mega <i class="fas fa-ellipsis-v ms-1"></i></a>
                    <ul class="dropdown-menu megamenu dropdown-menu-dark p-4">
                        <div class="row gy-3 mb-4">
                            <div class="col-lg-3">
                                <h6 class="mb-2 text-uppercase">Elements Heading</h6>
                                <ul class="list-unstyled text-gray-700">
                                    <li class="py-1"><a class="inherit-link" href="#">Lorem ipsum dolor</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Sed ut perspiciatis</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Voluptatum deleniti</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">At vero eos</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Consectetur adipiscing</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Duis aute irure</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Necessitatibus saepe</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Maiores alias</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3">
                                <h6 class="mb-2 text-uppercase">Elements Heading</h6>
                                <ul class="list-unstyled text-gray-700">
                                    <li class="py-1"><a class="inherit-link" href="#">Lorem ipsum dolor</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Sed ut perspiciatis</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Voluptatum deleniti</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">At vero eos</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Consectetur adipiscing</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Duis aute irure</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Necessitatibus saepe</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Maiores alias</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3">
                                <h6 class="mb-2 text-uppercase">Elements Heading</h6>
                                <ul class="list-unstyled text-gray-700">
                                    <li class="py-1"><a class="inherit-link" href="#">Lorem ipsum dolor</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Sed ut perspiciatis</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Voluptatum deleniti</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">At vero eos</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Consectetur adipiscing</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Duis aute irure</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Necessitatibus saepe</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Maiores alias</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3">
                                <h6 class="mb-2 text-uppercase">Elements Heading</h6>
                                <ul class="list-unstyled text-gray-700">
                                    <li class="py-1"><a class="inherit-link" href="#">Lorem ipsum dolor</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Sed ut perspiciatis</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Voluptatum deleniti</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">At vero eos</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Consectetur adipiscing</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Duis aute irure</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Necessitatibus saepe</a></li>
                                    <li class="py-1"><a class="inherit-link" href="#">Maiores alias</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row text-center gy-3">
                            <div class="col-lg-2 col-md-4">
                                <a class="d-block p-4 text-white bg-dash-color-1" href="#">
                                    <svg class="svg-icon svg-icon-sm sv-icon-heavy text-white">
                                        <use xlink:href="#time-1"> </use>
                                    </svg>
                                    <p class="text-sm d mb-0">Demo 1</p>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a class="d-block p-4 text-white bg-dash-color-2" href="#">
                                    <svg class="svg-icon svg-icon-sm sv-icon-heavy text-white">
                                        <use xlink:href="#time-1"> </use>
                                    </svg>
                                    <p class="text-sm d mb-0">Demo 2</p>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a class="d-block p-4 text-white bg-dash-color-3" href="#">
                                    <svg class="svg-icon svg-icon-sm sv-icon-heavy text-white">
                                        <use xlink:href="#time-1"> </use>
                                    </svg>
                                    <p class="text-sm d mb-0">Demo 3</p>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a class="d-block p-4 text-white bg-dash-color-4" href="#">
                                    <svg class="svg-icon svg-icon-sm sv-icon-heavy text-white">
                                        <use xlink:href="#time-1"> </use>
                                    </svg>
                                    <p class="text-sm d mb-0">Demo 4</p>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a class="d-block p-4 text-white bg-danger" href="#">
                                    <svg class="svg-icon svg-icon-sm sv-icon-heavy text-white">
                                        <use xlink:href="#time-1"> </use>
                                    </svg>
                                    <p class="text-sm d mb-0">Demo 5</p>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <a class="d-block p-4 text-white bg-info" href="#">
                                    <svg class="svg-icon svg-icon-sm sv-icon-heavy text-white">
                                        <use xlink:href="#time-1"> </use>
                                    </svg>
                                    <p class="text-sm d mb-0">Demo 6</p>
                                </a>
                            </div>
                        </div>
                    </ul>
                </li> -->
                <!-- Languages dropdown    -->
                <!-- <li class="list-inline-item dropdown">
                    <a class="nav-link dropdown-toggle text-sm text-reset px-1 px-lg-0" id="languages" rel="nofollow" data-bs-target="#" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/src/img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block ms-2">English</span></a>
                    <ul class="dropdown-menu dropdown-menu-end mt-sm-3 dropdown-menu-dark" aria-labelledby="languages">
                        <li><a class="dropdown-item" rel="nofollow" href="#"> <img class="me-2" src="/src/img/flags/16/DE.png" alt="English"><span>German</span></a></li>
                        <li><a class="dropdown-item" rel="nofollow" href="#"> <img class="me-2" src="/src/img/flags/16/FR.png" alt="English"><span>French                   </span></a></li>
                    </ul>
                </li> -->
                <li class="list-inline-item logout px-lg-2">
                    <a class="nav-link text-sm text-reset px-1 px-lg-0" id="logout" href="/admin/login?logout=1">
                        <span class="d-none d-sm-inline-block">Logout </span>
                        <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                            <use xlink:href="#disable-1"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- HEADER END -->
