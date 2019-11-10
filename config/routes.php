<?php

use market\Router;

Router::add("^product/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "Product", "action" => "view"]);


//default routes
Router::add("^admin$", ["controller" => "main", "action" => "index", "prefix" => "admin"]);
Router::add("^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$", ["prefix" => "admin"]);

Router::add("^$", ["controller" => "main", "action" => "index"]);
Router::add("^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$");