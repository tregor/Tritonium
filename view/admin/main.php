<?php

use Tritonium\App\Models\Update;
use Tritonium\Base\App;

/**
 * This is template file
 *
 * @var $data Array
 */
$page = [
    'base_url' => '/admin/',
    'title' => 'Tables',
];
?>
<? App::$components->view->include('admin.block.head') ?>
<? App::$components->view->include('admin.block.header') ?>

<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
        <? App::$components->view->include('admin.block.sidebar') ?>
    <!-- End Sidebar Navigation-->

    <!-- Main Content -->
    <div class="page-content form-page">
        <!-- Page Header-->
        <div class="bg-dash-dark-2 py-4">
            <div class="container-fluid">
                <h2 class="h5 mb-0"><?= $page['title'] ?></h2>
            </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid py-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3 px-0">
                    <li class="breadcrumb-item"><a href="<?= $page['base_url'] ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tables</li>
                </ol>
            </nav>
        </div>

        <div class="container-fluid">
            Тут короче всякие графики потом будут
            <!-- Charts Section-->
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body"><strong>Line Chart Example</strong>
                                    <canvas id="lineChartCustom1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body"><strong>Line Chart Example</strong>
                                    <canvas id="lineChartCustom2"></canvas>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="lineChartCustom3"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body"><strong>Bar Chart Example</strong>
                                    <canvas id="barChartCustom1"></canvas>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="barChartCustom2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body"><strong>Bar Chart Example</strong>
                                    <canvas id="barChartCustom3"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body"><strong>Pie Chart Example</strong>
                                    <canvas id="pieChartCustom1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body"><strong>Pie Chart Example</strong>
                                    <canvas id="doughnutChartCustom1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body"><strong>Polar Chart Example</strong>
                                    <canvas id="polarChartCustom"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body"><strong>Radar Chart Example</strong>
                                    <canvas id="radarChartCustom"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Forms Section-->
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <!-- Basic Form-->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4 mb-0">Basic Form</h3>
                                </div>
                                <div class="card-body pt-0">
                                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p>
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputEmail1">Email address</label>
                                            <input class="form-control" id="exampleInputEmail1" type="email"
                                                   aria-describedby="emailHelp">
                                            <div class="form-text" id="emailHelp">We'll never share your email with
                                                anyone else.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputPassword1">Password</label>
                                            <input class="form-control" id="exampleInputPassword1" type="password">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Horizontal Form-->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4 mb-0">Horizontal Form</h3>
                                </div>
                                <div class="card-body pt-0">
                                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p>
                                    <form class="form-horizontal">
                                        <div class="row gy-2 mb-4">
                                            <label class="col-sm-3 form-label"
                                                   for="inputHorizontalElOne">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="inputHorizontalElOne" type="email"
                                                       placeholder="Email Address"><small class="form-text">Example
                                                    help text that remains unchanged.</small>
                                            </div>
                                        </div>
                                        <div class="row gy-2 mb-4">
                                            <label class="col-sm-3 form-label"
                                                   for="inputHorizontalElTwo">Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="inputHorizontalElTwo"
                                                       type="password" placeholder="Pasword"><small
                                                    class="form-text">Example help text that remains
                                                    unchanged.</small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9 ms-auto">
                                                <input class="btn btn-primary" type="submit" value="Signin">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Inline Form-->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4 mb-0">Inline Form</h3>
                                </div>
                                <div class="card-body pt-0">
                                    <form class="row g-3 align-items-center">
                                        <div class="col-lg">
                                            <label class="visually-hidden"
                                                   for="inlineFormInputGroupUsername">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-text">@</div>
                                                <input class="form-control" id="inlineFormInputGroupUsername"
                                                       type="text" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <label class="visually-hidden"
                                                   for="inlineFormSelectPref">Preference</label>
                                            <select class="form-select" id="inlineFormSelectPref">
                                                <option selected>Choose...</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-lg">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Form-->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0">Signin Modal</h3>
                                </div>
                                <div class="card-body pt-0 text-center">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target="#myModal">Form in simple modal
                                    </button>
                                    <!-- Modal-->
                                    <div class="modal fade text-start" id="myModal" tabindex="-1"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">Signin Modal</h5>
                                                    <button class="btn-close btn-close-white" type="button"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                                                    <form>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="modalInputEmail1">Email
                                                                address</label>
                                                            <input class="form-control" id="modalInputEmail1"
                                                                   type="email" aria-describedby="emailHelp">
                                                            <div class="form-text" id="emailHelp">We'll never share
                                                                your email with anyone else.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                   for="modalInputPassword1">Password</label>
                                                            <input class="form-control" id="modalInputPassword1"
                                                                   type="password">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button class="btn btn-primary" type="button">Save changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Form Elements -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4 mb-0">All form elements</h3>
                                </div>
                                <div class="card-body pt-0">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Normal</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Help text</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text"><small class="form-text">A
                                                    block of help text that breaks onto a new line and may extend
                                                    beyond one line.</small>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="password" name="password">
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Placeholder</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="placeholder">
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Disabled</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" disabled=""
                                                       placeholder="Disabled input here...">
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Checkboxes &amp; radios <br><small
                                                    class="text-primary">Custom elements</small></label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultCheck0"
                                                           type="checkbox">
                                                    <label class="form-check-label" for="defaultCheck0">Option
                                                        one</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultCheck1"
                                                           type="checkbox" checked>
                                                    <label class="form-check-label" for="defaultCheck1">Option two
                                                        checked</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultCheck2"
                                                           type="checkbox" checked disabled>
                                                    <label class="form-check-label" for="defaultCheck2">Option three
                                                        checked and disabled</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultCheck3"
                                                           type="checkbox" disabled>
                                                    <label class="form-check-label" for="defaultCheck3">Option four
                                                        disabled</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultRadio0" type="radio"
                                                           name="exampleRadios">
                                                    <label class="form-check-label" for="defaultRadio0">Option
                                                        one</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultRadio1" type="radio"
                                                           name="exampleRadios" checked>
                                                    <label class="form-check-label" for="defaultRadio1">Option two
                                                        checked</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultRadio2" type="radio"
                                                           name="exampleRadios" checked disabled>
                                                    <label class="form-check-label" for="defaultRadio2">Option three
                                                        checked and disabled</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="defaultRadio3" type="radio"
                                                           name="exampleRadios" disabled>
                                                    <label class="form-check-label" for="defaultRadio3">Option four
                                                        disabled</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Select</label>
                                            <div class="col-sm-9">
                                                <select class="form-select mb-3" name="account">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-9 offset-sm-3">
                                                <select class="form-select" multiple="">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label" for="formFile">File input</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="formFile" type="file">
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Input with success</label>
                                            <div class="col-sm-9">
                                                <input class="form-control is-valid" type="text">
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Input with error</label>
                                            <div class="col-sm-9">
                                                <input class="form-control is-invalid" type="text">
                                                <div class="invalid-feedback">Please provide your name.</div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Control sizing</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-lg mb-3" type="text"
                                                       placeholder=".input-lg">
                                                <input class="form-control mb-3" type="text"
                                                       placeholder="Default input">
                                                <input class="form-control form-control-sm mb-3" type="text"
                                                       placeholder=".input-sm">
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Column sizing</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input class="form-control" type="text"
                                                               placeholder=".col-md-3">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-control" type="text"
                                                               placeholder=".col-md-4">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input class="form-control" type="text"
                                                               placeholder=".col-md-5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Material Inputs</label>
                                            <div class="col-sm-9">
                                                <div class="input-material-group mb-3">
                                                    <input class="input-material" id="register-username" type="text"
                                                           name="registerUsername" required value="Jason Doe">
                                                    <label class="label-material"
                                                           for="register-username">Username</label>
                                                </div>
                                                <div class="input-material-group mb-3">
                                                    <input class="input-material" id="register-email" type="email"
                                                           name="registerEmail" required>
                                                    <label class="label-material" for="register-email">Email
                                                        Address </label>
                                                </div>
                                                <div class="input-material-group mb-3">
                                                    <input class="input-material" id="register-password"
                                                           type="password" name="registerPassword" required>
                                                    <label class="label-material"
                                                           for="register-password">Password </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Input groups</label>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3"><span class="input-group-text"
                                                                                    id="basic-addon1">@</span>
                                                    <input class="form-control" type="text" placeholder="Username"
                                                           aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text" placeholder="Username"
                                                           aria-label="Username"
                                                           aria-describedby="basic-addon2"><span
                                                        class="input-group-text" id="basic-addon2">@</span>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox"
                                                               aria-label="Checkbox for following text input">
                                                    </div>
                                                    <input class="form-control" type="text"
                                                           aria-label="Text input with checkbox">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="text"
                                                           aria-label="Text input with radio button">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="radio"
                                                               aria-label="Radio button for following text input">
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3"><span
                                                        class="input-group-text">$</span><span
                                                        class="input-group-text">0.00</span>
                                                    <input class="form-control" type="text"
                                                           aria-label="Dollar amount (with dot and two decimal places)">
                                                </div>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                           aria-label="Dollar amount (with dot and two decimal places)"><span
                                                        class="input-group-text">$</span><span
                                                        class="input-group-text">0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">Button addons</label>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-primary" id="button-addon1"
                                                            type="button">Button
                                                    </button>
                                                    <input class="form-control" type="text" placeholder
                                                           aria-label="Example text with button addon"
                                                           aria-describedby="button-addon1">
                                                </div>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                           placeholder="Recipient's username"
                                                           aria-label="Recipient's username"
                                                           aria-describedby="button-addon2">
                                                    <button class="btn btn-primary" id="button-addon2"
                                                            type="button">Button
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <label class="col-sm-3 form-label">With dropdowns</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">Dropdown
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark shadow-sm">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Something else
                                                                here</a></li>
                                                        <li><a class="dropdown-item" href="#">Separated link</a>
                                                        </li>
                                                    </ul>
                                                    <input class="form-control" type="text"
                                                           aria-label="Text input with dropdown button">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4"></div>
                                        <div class="row">
                                            <div class="col-sm-9 ms-auto">
                                                <button class="btn btn-secondary" type="reset">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page Footer-->
                <footer class="position-absolute bottom-0 bg-dash-dark-2 text-white text-center py-3 w-100 text-xs"
                        id="footer">
                    <div class="container-fluid text-center">
                        <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                        <p class="mb-0 text-dash-gray">2021 &copy; Your company. Design by <a
                                href="https://bootstrapious.com">Bootstrapious</a>.</p>
                    </div>
                </footer>
            </section>

            <!-- Other huina -->
            <section>
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-end justify-content-between mb-2">
                                        <div class="me-2">
                                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                                                <use xlink:href="#user-1"></use>
                                            </svg>
                                            <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">New
                                                Clients</p>
                                        </div>
                                        <p class="text-xxl lh-1 mb-0 text-dash-color-1">27</p>
                                    </div>
                                    <div class="progress" style="height: 3px">
                                        <div class="progress-bar bg-dash-color-1" role="progressbar"
                                             style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-end justify-content-between mb-2">
                                        <div class="me-2">
                                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                                                <use xlink:href="#stack-1"></use>
                                            </svg>
                                            <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">New
                                                Projects</p>
                                        </div>
                                        <p class="text-xxl lh-1 mb-0 text-dash-color-2">375</p>
                                    </div>
                                    <div class="progress" style="height: 3px">
                                        <div class="progress-bar bg-dash-color-2" role="progressbar"
                                             style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-end justify-content-between mb-2">
                                        <div class="me-2">
                                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                                                <use xlink:href="#survey-1"></use>
                                            </svg>
                                            <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">New
                                                Invoices</p>
                                        </div>
                                        <p class="text-xxl lh-1 mb-0 text-dash-color-3">140</p>
                                    </div>
                                    <div class="progress" style="height: 3px">
                                        <div class="progress-bar bg-dash-color-3" role="progressbar"
                                             style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-end justify-content-between mb-2">
                                        <div class="me-2">
                                            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                                                <use xlink:href="#paper-stack-1"></use>
                                            </svg>
                                            <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">All
                                                Projects</p>
                                        </div>
                                        <p class="text-xxl lh-1 mb-0 text-dash-color-4">41</p>
                                    </div>
                                    <div class="progress" style="height: 3px">
                                        <div class="progress-bar bg-dash-color-4" role="progressbar"
                                             style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="barChartExample1"></canvas>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="barChartExample2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <!-- Stat card-->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row gx-sm-5">
                                        <div class="col-6 border-sm-end border-dash-dark-1">
                                            <!-- Stat item-->
                                            <div class="d-flex"><i class="mt-3 fas fa-caret-down text-danger"></i>
                                                <div class="ms-2">
                                                    <p class="text-xl fw-normal mb-0">5.657</p>
                                                    <p class="text-uppercase text-sm fw-light mb-2">Standard
                                                        scans</p>
                                                    <div class="progress" style="height: 2px">
                                                        <div class="progress-bar bg-dash-color-1" role="progressbar"
                                                             style="width: 60%;" aria-valuenow="60"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <!-- Stat item-->
                                            <div class="d-flex"><i class="mt-3 fas fa-caret-up text-success"></i>
                                                <div class="ms-2">
                                                    <p class="text-xl fw-normal mb-0">3.1459</p>
                                                    <p class="text-uppercase text-sm fw-light mb-2">Team Scans</p>
                                                    <div class="progress" style="height: 2px">
                                                        <div class="progress-bar bg-dash-color-2" role="progressbar"
                                                             style="width: 35%;" aria-valuenow="35"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Stat card-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gx-5">
                                        <div class="col-6 border-sm-end border-dash-dark-1">
                                            <!-- Stat item-->
                                            <div class="d-flex">
                                                <div>
                                                    <p class="text-xl fw-normal mb-0">745</p>
                                                    <p class="text-uppercase text-sm fw-light mb-2">Total
                                                        requests</p>
                                                    <div class="progress" style="height: 2px">
                                                        <div class="progress-bar bg-dash-color-1" role="progressbar"
                                                             style="width: 60%;" aria-valuenow="60"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-center text-center">
                                                <div class="px-3 px-lg-4">
                                                    <p class="text-lg fw-normal mb-0">4.124</p><span
                                                        class="text-sm text-uppercase mb-0">Threats</span>
                                                    <hr class="border-dark-1 mx-auto my-2" style="max-width: 3rem">
                                                    <small>+246</small>
                                                </div>
                                                <div class="px-3 px-lg-4">
                                                    <p class="text-lg fw-normal mb-0">2.147</p><span
                                                        class="text-sm text-uppercase mb-0">Neutral</span>
                                                    <hr class="border-dark-1 mx-auto my-2" style="max-width: 3rem">
                                                    <small>+416</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="lineChart1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <!-- User block-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block"><img
                                                class="avatar avatar-lg mb-3" src="/src/img/avatar-1.jpg"
                                                alt="Richard Nevoreski"><span
                                                class="avatar-badge bg-dash-color-1">1st</span>
                                        </div>
                                        <h3 class="h5 mb-0">Richard Nevoreski</h3>
                                        <p class="text-sm fw-light">@richardnevo</p>
                                        <div
                                            class="d-inline-block py-1 px-4 rounded-pill bg-dash-dark-3 fw-light text-sm mb-4">
                                            950 Contributions
                                        </div>
                                        <ul class="list-inline text-center mb-0 d-flex justify-content-between text-sm mb-0">
                                            <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>150
                                            </li>
                                            <li class="list-inline-item"><i class="fas fa-code-branch me-2"></i>340
                                            </li>
                                            <li class="list-inline-item"><i class="fab fa-gg me-2"></i>460</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- User block-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block"><img
                                                class="avatar avatar-lg mb-3" src="/src/img/avatar-4.jpg"
                                                alt="Samuel Watson"><span
                                                class="avatar-badge bg-dash-color-2">2nd</span></div>
                                        <h3 class="h5 mb-0">Samuel Watson</h3>
                                        <p class="text-sm fw-light">@samwatson</p>
                                        <div
                                            class="d-inline-block py-1 px-4 rounded-pill bg-dash-dark-3 fw-light text-sm mb-4">
                                            772 Contributions
                                        </div>
                                        <ul class="list-inline text-center mb-0 d-flex justify-content-between text-sm mb-0">
                                            <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>80
                                            </li>
                                            <li class="list-inline-item"><i class="fas fa-code-branch me-2"></i>420
                                            </li>
                                            <li class="list-inline-item"><i class="fab fa-gg me-2"></i>272</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- User block-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block"><img
                                                class="avatar avatar-lg mb-3" src="/src/img/avatar-6.jpg"
                                                alt="Sebastian Wood"><span
                                                class="avatar-badge bg-dash-color-3">3rd</span></div>
                                        <h3 class="h5 mb-0">Sebastian Wood</h3>
                                        <p class="text-sm fw-light">@sebastian</p>
                                        <div
                                            class="d-inline-block py-1 px-4 rounded-pill bg-dash-dark-3 fw-light text-sm mb-4">
                                            620 Contributions
                                        </div>
                                        <ul class="list-inline text-center mb-0 d-flex justify-content-between text-sm mb-0">
                                            <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>150
                                            </li>
                                            <li class="list-inline-item"><i class="fas fa-code-branch me-2"></i>280
                                            </li>
                                            <li class="list-inline-item"><i class="fab fa-gg me-2"></i>190</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gy-3 align-items-center">
                                        <div class="col-lg-4">
                                            <div class="d-flex align-items-center"><strong
                                                    class="text-sm d-none d-lg-block">4th</strong><img
                                                    class="avatar ms-3" src="/src/img/avatar-1.jpg"
                                                    alt="Tomas Hecktor">
                                                <div class="ms-3">
                                                    <h3 class="h5 mb-0">Tomas Hecktor</h3>
                                                    <p class="text-sm fw-light mb-0">@tomhecktor</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                            <div
                                                class="d-inline-block py-1 px-4 rounded-pill bg-dash-dark-3 fw-light text-sm">
                                                410 Contributions
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="list-inline text-center mb-0 d-flex justify-content-between mb-0 text-sm">
                                                <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>110
                                                </li>
                                                <li class="list-inline-item"><i class="fas fa-code-branch me-2"></i>200
                                                </li>
                                                <li class="list-inline-item"><i class="fab fa-gg me-2"></i>100</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gy-3 align-items-center">
                                        <div class="col-lg-4">
                                            <div class="d-flex align-items-center"><strong
                                                    class="text-sm d-none d-lg-block">5th</strong><img
                                                    class="avatar ms-3" src="/src/img/avatar-2.jpg"
                                                    alt="Alexander Shelby">
                                                <div class="ms-3">
                                                    <h3 class="h5 mb-0">Alexander Shelby</h3>
                                                    <p class="text-sm fw-light mb-0">@alexshelby</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                            <div
                                                class="d-inline-block py-1 px-4 rounded-pill bg-dash-dark-3 fw-light text-sm">
                                                320 Contributions
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="list-inline text-center mb-0 d-flex justify-content-between mb-0 text-sm">
                                                <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>150
                                                </li>
                                                <li class="list-inline-item"><i class="fas fa-code-branch me-2"></i>120
                                                </li>
                                                <li class="list-inline-item"><i class="fab fa-gg me-2"></i>50</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gy-3 align-items-center">
                                        <div class="col-lg-4">
                                            <div class="d-flex align-items-center"><strong
                                                    class="text-sm d-none d-lg-block">6th</strong><img
                                                    class="avatar ms-3" src="/src/img/avatar-6.jpg"
                                                    alt="Arther Kooper">
                                                <div class="ms-3">
                                                    <h3 class="h5 mb-0">Arther Kooper</h3>
                                                    <p class="text-sm fw-light mb-0">@artherkooper</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                            <div
                                                class="d-inline-block py-1 px-4 rounded-pill bg-dash-dark-3 fw-light text-sm">
                                                170 Contributions
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="list-inline text-center mb-0 d-flex justify-content-between mb-0 text-sm">
                                                <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>60
                                                </li>
                                                <li class="list-inline-item"><i class="fas fa-code-branch me-2"></i>70
                                                </li>
                                                <li class="list-inline-item"><i class="fab fa-gg me-2"></i>40</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row d-flex align-items-stretch gy-4">
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-0">Sales Difference</h3>
                                    <p class="text-sm fw-light">Lorem ipsum dolor sit</p>
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <p class="text-xl fw-light mb-0 text-dash-color-3">$740</p><span
                                                class="d-block">May 2017</span><small class="d-block"> 320
                                                Sales</small>
                                        </div>
                                        <div class="col-lg-7">
                                            <canvas id="salesBarChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-0">Visit Statistics</h3>
                                    <p class="text-sm fw-light">Lorem ipsum dolor sit</p>
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <p class="text-xl fw-light mb-0 text-dash-color-1">$457</p><span
                                                class="d-block">May 2017</span><small class="d-block"> 210
                                                Sales</small>
                                        </div>
                                        <div class="col-lg-7">
                                            <canvas id="visitPieChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-0">Sales Activities</h3>
                                    <p class="text-sm fw-light">Lorem ipsum dolor sit</p>
                                    <div class="row align-items-end">
                                        <div class="col-lg-5">
                                            <p class="text-xl fw-light mb-0 text-dash-color-4">80%</p><span
                                                class="d-block">May 2017</span><small class="d-block"> +35
                                                Sales</small>
                                        </div>
                                        <div class="col-lg-7">
                                            <canvas id="salesBarChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">To do list</h3>
                                    <form id="checkListForm">
                                        <div class="p-3">
                                            <div class="form-check mb-0 py-1">
                                                <input class="form-check-input" type="checkbox" name="input-1"
                                                       id="input-1" checked>
                                                <label class="form-check-label text-gray-600 text-sm" for="input-1">Lorem
                                                    ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-dash-dark-3">
                                            <div class="form-check mb-0 py-1">
                                                <input class="form-check-input" type="checkbox" name="input-2"
                                                       id="input-2" checked>
                                                <label class="form-check-label text-gray-600 text-sm" for="input-2">Lorem
                                                    ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <div class="form-check mb-0 py-1">
                                                <input class="form-check-input" type="checkbox" name="input-3"
                                                       id="input-3">
                                                <label class="form-check-label text-gray-600 text-sm" for="input-3">Lorem
                                                    ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-dash-dark-3">
                                            <div class="form-check mb-0 py-1">
                                                <input class="form-check-input" type="checkbox" name="input-4"
                                                       id="input-4">
                                                <label class="form-check-label text-gray-600 text-sm" for="input-4">Lorem
                                                    ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <div class="form-check mb-0 py-1">
                                                <input class="form-check-input" type="checkbox" name="input-5"
                                                       id="input-5">
                                                <label class="form-check-label text-gray-600 text-sm" for="input-5">Lorem
                                                    ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-dash-dark-3">
                                            <div class="form-check mb-0 py-1">
                                                <input class="form-check-input" type="checkbox" name="input-6"
                                                       id="input-6">
                                                <label class="form-check-label text-gray-600 text-sm" for="input-6">Lorem
                                                    ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <div class="form-check mb-0 py-1">
                                                <input class="form-check-input" type="checkbox" name="input-7"
                                                       id="input-7">
                                                <label class="form-check-label text-gray-600 text-sm" for="input-7">Lorem
                                                    ipsum dolor sit amet, consectetur adipisicing elit.</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">New messages</h3><a
                                        class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3"
                                        href="#">
                                        <div class="position-relative"><img class="avatar"
                                                                            src="/src/img/avatar-3.jpg" alt=""><span
                                                class="availability-status bg-success"></span></div>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-0">Nadia Halsey</p>
                                            <p class="text-sm fw-light mb-0">lorem ipsum dolor sit amit</p>
                                            <p class="small fw-light mb-0">09:30am</p>
                                        </div>
                                    </a><a
                                        class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3"
                                        href="#">
                                        <div class="position-relative"><img class="avatar"
                                                                            src="/src/img/avatar-2.jpg" alt=""><span
                                                class="availability-status bg-warning"></span></div>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-0">Peter Ramsy</p>
                                            <p class="text-sm fw-light mb-0">lorem ipsum dolor sit amit</p>
                                            <p class="small fw-light mb-0">7:30am</p>
                                        </div>
                                    </a><a
                                        class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3"
                                        href="#">
                                        <div class="position-relative"><img class="avatar"
                                                                            src="/src/img/avatar-1.jpg" alt=""><span
                                                class="availability-status bg-danger"></span></div>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-0">Sam Kaheil</p>
                                            <p class="text-sm fw-light mb-0">lorem ipsum dolor sit amit</p>
                                            <p class="small fw-light mb-0">06:55pm</p>
                                        </div>
                                    </a><a
                                        class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3"
                                        href="#">
                                        <div class="position-relative"><img class="avatar"
                                                                            src="/src/img/avatar-5.jpg" alt=""><span
                                                class="availability-status bg-gray"></span></div>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-0">Sara Wood</p>
                                            <p class="text-sm fw-light mb-0">lorem ipsum dolor sit amit</p>
                                            <p class="small fw-light mb-0">10:30pm</p>
                                        </div>
                                    </a><a
                                        class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3"
                                        href="#">
                                        <div class="position-relative"><img class="avatar"
                                                                            src="/src/img/avatar-1.jpg" alt=""><span
                                                class="availability-status bg-success"></span></div>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-0">Nader Magdy</p>
                                            <p class="text-sm fw-light mb-0">lorem ipsum dolor sit amit</p>
                                            <p class="small fw-light mb-0">9:47pm</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-0">Credit Sales</h3>
                                    <p class="text-sm fw-light mb-5">Lorem ipsum dolor sit</p>
                                    <div class="position-relative text-center">
                                        <canvas id="pieChartHome1"></canvas>
                                        <div class="position-absolute top-50 start-50 translate-middle"><strong
                                                class="text-lg d-block">$2.145</strong><span
                                                class="d-block">Sales</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-0">Channel Sales</h3>
                                    <p class="text-sm fw-light mb-5">Lorem ipsum dolor sit</p>
                                    <div class="position-relative text-center">
                                        <canvas id="pieChartHome2"></canvas>
                                        <div class="position-absolute top-50 start-50 translate-middle"><strong
                                                class="text-lg d-block">$7.784</strong><span
                                                class="d-block">Sales</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-0">Direct Sales</h3>
                                    <p class="text-sm fw-light mb-5">Lorem ipsum dolor sit</p>
                                    <div class="position-relative text-center">
                                        <canvas id="pieChartHome3"></canvas>
                                        <div class="position-absolute top-50 start-50 translate-middle"><strong
                                                class="text-lg d-block">$4.957</strong><span
                                                class="d-block">Sales</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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

<script src="/src/js/charts-custom.js"></script>
<script src="/src/js/charts-home.js"></script>
<? App::$components->view->include('admin.block.footer') ?>
