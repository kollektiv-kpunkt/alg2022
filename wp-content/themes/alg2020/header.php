<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    wp_head();
    ?>
</head>
<body data-barba="wrapper">
    <?php
    if (!isset($_COOKIE["alg-catcher-closed"])) {
        get_template_part( "template-parts/catcher/index");
    }
    get_template_part( "template-parts/navbar/index");
    ?>
    <div id="main-content">
        <main data-barba="container" data-barba-namespace="home">