<?
//$baseUrl='http://'.$_SERVER['SERVER_NAME'].'/indibits_wiki/';
include('config.php');
$baseUrl=$this->config->base_url();
$bootstrap=$baseUrl."bootstrap/";
echo '<link href="'.$bootstrap.'css/'.$theme.'.css" rel="stylesheet">';
//echo '<link href="'.$bootstrap.'css/bootstrap.min.css" rel="stylesheet">';
echo '<link href="'.$bootstrap.'css/bootstrap-responsive.css" rel="stylesheet">';
//echo '<link href="'.$bootstrap.'css/bootstrap-responsive.min.css" rel="stylesheet">';
echo "<script type='text/javascript' src='".$bootstrap."js/jquery.js'></script>";
echo "<script type='text/javascript' src='".$bootstrap."js/bootstrap.js'></script>";
echo "<script type='text/javascript' src='".$bootstrap."js/bootstrap-popover.js'></script>";
echo "<script type='text/javascript' src='".$bootstrap."js/bootstrap-modal.js'></script>";
echo "<script type='text/javascript' src='".$bootstrap."js/bootstrap-typehead.js'></script>";
?>
<link rel="shortcut icon" href="" />
