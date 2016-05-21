<?php

$recepient = "localhost.kravets.yurka@gmail.com";
$sitename = "shop.com";
<<<<<<< HEAD
var_dump($GET);
=======

>>>>>>> d30082abfebca2d3a837423a96083542415bd16b
$name = trim($_POST["name"]);
$phone = trim($_POST["phone"]);
$text = trim($_POST["text"]);
$message = "Имя: $name \nТелефон: $phone \nТекст: $text";

$pagetitle = "Новая заявка с сайта \"$sitename\"";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");