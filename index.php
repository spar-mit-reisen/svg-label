<?php
/**
 * User: sbraun
 * Date: 21.06.17
 * Time: 13:39
 */

/*
  you need to download mustache.php and run composer
*/
if (!is_file("libs/mustache.php/vendor/autoload.php")) {
    ini_set("display_errors", 1);
    throw new Exception("Please install or link 'mustache.php' into 'libs/mustache.php/'.");
    die;
}
require __DIR__."/libs/mustache.php/vendor/autoload.php";
require __DIR__."/Mustache_lib.php";
require __DIR__."/View_object.php";

$request_uri_src = $_SERVER['REQUEST_URI'];
$request_uri = explode("/", $request_uri_src);
$requested_file = @explode("?", end($request_uri))[0];

$m = new Mustache_lib();
if ($requested_file == "file2.svg")
    $contents = $m->_load_template("full_vektor2.mustache");
else
    $contents = $m->_load_template("sample.mustache");

$view_object = new View_object();


if (is_numeric(@$_REQUEST['nights'])) {
    $view_object->set_nights($_REQUEST['nights']);
}
if (is_numeric(@$_REQUEST['price'])) {
    $view_object->set_price($_REQUEST['price']);
}
if (isset($_REQUEST['top_text'])) {
    $view_object->set_top_text(addslashes($_REQUEST['top_text']));
}
if (isset($_REQUEST['bottom_text'])) {
    $view_object->set_bottom_text(addslashes($_REQUEST['bottom_text']));
}


if (isset($_REQUEST['test'])) {
    $test = addslashes($_REQUEST['test']);
}

//$contents = file_get_contents("templates/sample.mustache");

if (@$test == 1) {
# for svg including js - leads to download modal in firefox
    header('Content-Type: application/svg+xml');
if (@$test == 2) {
    var_dump($_SERVER);die;
} else {
# for svg without js - direct call shows 'image'
    header('Content-Type: image/svg+xml');
}
$days = 0;
$expires = 60 * 60 * 24 * $days;
header("Pragma: public");
header("Cache-Control: maxage=" . $expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
//echo $contents;
$svg = $m->_render($contents, $view_object);


if ($requested_file == "demo.html") {
    header('Content-Type: text/html');
//    $url = "//" . $_SERVER['SERVER_NAME'] . "" . str_replace("/file.html", "/file.svg", $_SERVER['REQUEST_URI']);
    $url = "//" . $_SERVER['SERVER_NAME'] . "" . str_replace("/demo.html", "", $_SERVER['REQUEST_URI']);
    $html = 'img:<br><img src="%s" onerror="this.src=logo-fallback.png;this.onerror=null;" /><br>';
    echo sprintf($html, $url);
    #
    $url2 = "//" . $_SERVER['SERVER_NAME'] . "" . str_replace("/demo.html", "/file2.svg", $_SERVER['REQUEST_URI']);
    $html = '<img src="%s" onerror="this.src=logo-fallback.png;this.onerror=null;" /><br>';
    echo sprintf($html, $url2);
    #
    $html = 'picture:<br><picture>
    <source type="image/svg+xml" srcset="%s">
    <!--<img src="%s" alt="Image description">-->
</picture><br>';
    echo sprintf($html, $url, $url);
    #
    $html = 'object:<br><object data="%s" type="image/svg+xml">
    <!-- fallback here -->
    fail3
</object><br>';
    echo sprintf($html, $url);
    #
    $html = 'iframe:<br><iframe border="0" src="%s">
    <!-- fallback here -->
    fail4
</iframe><br>';
    echo sprintf($html, $url);
    #
} elseif ($requested_file == "file.png") {
    $im = new Imagick();
    $svg = file_get_contents("templates/sample.mustache");
    $im->readImageBlob($svg);
    $im->setImageFormat('png24');
    header('Content-Type: image/png');
    echo $im;
} elseif ($requested_file == "file2.svg") {
    echo $svg;
} else {
    echo $svg;
}