<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$myvar="alse";
class Wikiconfig{
	var $baseUrl;
	public function __construct(){
		$baseUrl='http://'.$_SERVER['SERVER_NAME'].'/indibits_wiki/';
	}
	public function base(){
		return "yoyo";
	}
}
?>
