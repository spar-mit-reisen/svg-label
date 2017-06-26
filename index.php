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

$m = new Mustache_lib();
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


//$contents = file_get_contents("templates/sample.mustache");

# for svg including js - leads to download modal in firefox
//header('Content-Type: application/svg+xml');
# for svg without js - direct call shows 'image'
header('Content-Type: image/svg+xml');
$days = 0;
$expires = 60 * 60 * 24 * $days;
header("Pragma: public");
header("Cache-Control: maxage=" . $expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
//echo $contents;
echo $m->_render($contents, $view_object);
