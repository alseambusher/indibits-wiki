<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>indibits_wiki</title>
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
            <ul class="nav">           
              <li class="active"><a href="#">&copy;Copyright <? echo $copyright;?></a></li>
              <li><a href="#">Terms and Conditions</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>	
    <!-- Lower status bar ends -->
    <div class="container">
    
    
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
    
    
    
    
	<div id="notification">
		<div class="alert alert-success">
			<h1>About <?echo $wikiapp_name;?></h1><br>
			<pre class="alert alert-success	"style='font-family:"Sans-serif", Times, serif;'><em><?echo $wikiapp_description;?></em></pre>
		</div>
	</div>
</body>
</html>

