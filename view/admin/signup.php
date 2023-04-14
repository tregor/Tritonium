<?php

use Tritonium\App\Models\Update;
use Tritonium\Base\App;

/**
 * This is template file
 *
 * @var $data Array
 * @var $models Array of models
 */
?>
<? App::$components->view->include('admin.block.head') ?>
<div class="login-page">
    <div class="container d-flex align-items-center position-relative py-5">
        <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
            <div class="card-body p-0">
                <div class="row gx-0 align-items-stretch">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">
                        <div class="info d-flex justify-content-center flex-column p-4 h-100">
                            <div class="py-5">
                                <h1 class="display-6 fw-bold">Dashboard</h1>
                                <p class="fw-light mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6 bg-white">
                        <div class="d-flex align-items-center px-4 px-lg-5 h-100 bg-dash-dark-2">
                            <form class="register-form py-5 w-100" method="get" action="login.html">
                                <div class="input-material-group mb-3">
                                    <input class="input-material" type="text" name="registerUsername" required
                                           data-validate-field="registerUsername">
                                    <label class="label-material" for="register-username">Username </label>
                                </div>
                                <div class="input-material-group mb-3">
                                    <input class="input-material" type="email" name="registerEmail" required
                                           data-validate-field="registerEmail">
                                    <label class="label-material">Email Address</label>
                                </div>
                                <div class="input-material-group mb-4">
                                    <input class="input-material" type="password" name="registerPassword" required
                                           data-validate-field="registerPassword">
                                    <label class="label-material">Password</label>
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input" id="register-agree" name="registerAgree"
                                           type="checkbox" required value="1" data-validate-field="registerAgree">
                                    <label class="form-check-label form-label" for="register-agree">I agree with the
                                        terms and policy </label>
                                </div>
                                <button class="btn btn-primary mb-3" id="login" type="submit">Register</button>
                                <br><small class="text-gray-500">Already have an account? </small><a
                                    class="text-sm text-paleBlue" href="login.html">Login</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="register-footer text-center position-absolute bottom-0 start-0 w-100">
        <p class="text-white">Design by <a class="external" href="https://bootstrapious.com/p/admin-template">Bootstrapious</a>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </p>
    </div>
</div>

<? App::$components->view->include('admin.block.footer') ?>
