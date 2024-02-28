<?php 

session_start();

require_once __DIR__."/app/core/route.php";

route($routes);