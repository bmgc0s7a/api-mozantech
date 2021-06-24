<?php

define("protecao_url", true);

require_once __DIR__."/vendor/autoload.php";

use resources\controller\api;

if($_SERVER["REQUEST_METHOD"] == "GET"):
	$dados_proc = $_GET['td'];
else:
	$dados_proc = '';
endif;


$produtos = new api($_SERVER["REQUEST_METHOD"], $_GET['td']);



//echo $_SERVER["REQUEST_METHOD"];


//(isset($_GET['var'])) ? $produtos->mostradados($_GET['var']) : $produtos->mostradados('');
