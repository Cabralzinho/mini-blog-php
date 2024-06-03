<?php

require "../app/Core/Core.php";
require "../vendor/autoload.php";
require "../lib/Database/DataBase.php";

require "../app/Model/UserModel.php";
require "../app/Model/PostModel.php";
require "../app/Model/CommentModel.php";

require "../app/Services/Post/CreatePostService.php";
require "../app/Services/Post/EditPostService.php";
require "../app/Services/Auth/LoginService.php";
require "../app/Services/Auth/RegisterService.php";
require "../app/Services/Comment/CreateCommentService.php";
require "../app/Services/Post/GetPostsService.php";
require "../app/Services/Comment/GetCommentsService.php";

require "../app/Controller/LoginController.php";
require "../app/Controller/ErrorController.php";
require "../app/Controller/RegisterController.php";
require "../app/Controller/HomeController.php";

$template = file_get_contents("../app/Template/template.html");

ob_start();
$core = new Core();
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

$templateDinamico = str_replace("{{conteudo dinamico}}", $saida, $template);

echo $templateDinamico;