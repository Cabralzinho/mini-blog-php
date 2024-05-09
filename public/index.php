<?php 

require "../app/Core/Core.php";
require "../vendor/autoload.php";
require "../app/Model/FormModel.php";

require "../app/Controller/LoginController.php";
require "../app/Controller/ErrorController.php";
require "../app/Controller/RegisterController.php";

require "../lib/Database/DataBase.php";

$template = file_get_contents("../app/Template/template.html");

ob_start();
$core = new Core();
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

$templateDinamico = str_replace("{{conteudo dinamico}}", $saida, $template);

echo $templateDinamico;