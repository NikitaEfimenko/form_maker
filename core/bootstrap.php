<?php
include "controller.php";
include "router.php";
include "view.php";
include "controllers/bootstrap.php";
include "views/bootstrap.php";

require_once 'core/rb.php';
\R::setup('mysql:host=localhost;dbname=forms', 'nikita', 'password');
