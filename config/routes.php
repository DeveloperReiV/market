<?php

use market\Router;

//default routes
Router::add("^admin$", ["controller" => "main", "action" => "index", "prefix" => "admin"]);
Router::add("^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$", ["prefix" => "admin"]);

Router::add("^$", ["controller" => "main", "action" => "index"]);
Router::add("^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$");