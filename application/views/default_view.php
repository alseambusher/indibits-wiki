<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><? echo $wikiapp_name;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
</head>
<body>
	<!-- navigation bar begins -->
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><? echo $wikiapp_name;?></a>
          <ul class="nav pull-right">
          <!-- TODO this will be logout if already logged in -->
          <form class="navbar-search pull-left">
			<input type="text" class="search-query" placeholder="Username" style="font-size:11pt;height:25px;">
			<input type="password" class="search-query" placeholder="Password" style="font-size:11pt;height:25px;">
		  </form>
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">About Indibits</a></li>
                <li><a href="#">About Indibits-wiki</a></li>
                <li class="divider"></li>
                <li><a href="#">Settings</a></li>
                <li class="divider"></li>
                <li><a href="#">Help</a></li>
              </ul>
            </li>
          </ul>
          
          
          
        </div>
      </div>
    </div>
    <!-- Navigation bar done -->
    
    <!-- Lower status bar begins -->
    <div class="navbar navbar-fixed-bottom">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="nav-collapse">
            <ul class="nav ">           
              <li class="active"><a href="#">&copy;Copyright <? echo $copyright;?></a></li>
              <li><a href="#">Terms and Conditions</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>	
    <!-- Lower status bar ends -->
    <div class="container">
    <div id="login_window" style="height:0px;width:0px;overflow:hidden;">
		    <form action="" id="loginForm" method="post"><br>
    		<input type="text" class="span3" style="font-size:12pt;height:30px;"placeholder="Username">
    		<input type="password" class="span3" style="font-size:12pt;height:30px;"placeholder="password"><br>
    </form>
    </div>
    
    
    <header class="jumbotron subhead" id="overview">
  <div class="subnav">
    <ul class="nav nav-pills">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Buttons <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#buttonGroups">Button groups</a></li>
          <li><a href="#buttonDropdowns">Button dropdowns</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Navigation <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#navs">Nav, tabs, pills</a></li>
          <li><a href="#navbar">Navbar</a></li>
          <li><a href="#breadcrumbs">Breadcrumbs</a></li>
          <li><a href="#pagination">Pagination</a></li>
        </ul>
      </li>
      <li><a href="#labels">Labels</a></li>
      <li><a href="#badges">Badges</a></li>
      <li><a href="#typography">Typography</a></li>
      <li><a href="#thumbnails">Thumbnails</a></li>
      <li><a href="#alerts">Alerts</a></li>
      <li><a href="#progress">Progress bars</a></li>
      <li><a href="#misc">Miscellaneous</a></li>
    </ul>
  </div>
</header>
<!-- container class not closed!!! -->
    
    
    
