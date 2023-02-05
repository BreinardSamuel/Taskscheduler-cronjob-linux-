<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url('/public/assets/css/main.css'); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">


        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <title>Create Cron</title>
    </head>
    <nav class="navbar bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Create Cron</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link " href="<?= base_url('/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Create Cron</a>
                        </li>
                        <li class="nav-item dropdown">
                            </div>
                            </div>
                            </div>
                            </nav>

                        <body>

                            <div id='box' class="mt-10 container">
                                <form>
                                    <div style="width: 50%;"  class="container mt-5 mb-5">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="cron_label" placeholder="cron_label">
                                            <label for="floatingInput">Cron Label</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="cronURL"  placeholder="url">
                                            <label for="floatingInput">Cron URL</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="minute"  placeholder="minute">
                                            <label for="floatingInput">Minute</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="hour" placeholder="hour">
                                            <label for="floatingInput">Hour</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="days" placeholder="days">
                                            <label for="floatingInput">Days</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="months" placeholder="months">
                                            <label for="floatingInput">Months</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="day_of_week"  placeholder="day_of_week">
                                            <label for="floatingInput">Day of week</label>
                                        </div>

                                        <div class="form-floating ">
                                            <input type="text" class="form-control" id="reccurance" placeholder="reccurance">
                                            <label for="floatingInput">Reccurance</label>
                                        </div>

                                    </div>
                                    <div class="text-center mb-5">
                                        <button class="btn btn-outline-success" type="button" data-Base_url="<?php echo base_url() ?>" id='create_cron'> Create Cron </button>
                                    </div>
                                </form>

                            </div>

                        </body>
                        <script src="<?= base_url('/public/assets/js/javascript.js') ?>"></script>
                        <script src="<?= base_url('/public/assets/bootstrap5/js/bootstrap.min.js') ?>"></script>
                        </html>