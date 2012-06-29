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
          <a class="brand" href="<?echo $this->config->base_url();?>"><? echo $wikiapp_name;?></a>
          <ul class="nav pull-right">
          <? 
			$this->load->model("wiki_acc");
			if(!wiki_acc::isLoggedIn()){
          ?>
          <form class="navbar-search pull-left" method="post" action="<? echo $this->config->base_url().index_page()."/welcome/login";?>">
			<input type="text" name="username"class="search-query" placeholder="Username" style="font-size:11pt;height:25px;">
			<input type="password" name="password"class="search-query" placeholder="Password" style="font-size:11pt;height:25px;">
			<button type="submit" style="visibility:hidden;">Login</button>
		  </form>
		  <?
			}
			else{
				echo "<li><a>Hi, ".wiki_acc::get_user_data("fullname")."</a></li>";
				echo '<li><a href="'.$this->config->base_url().index_page().'/welcome/logout"><i class="icon-off"></i> Logout</a></li>';
			}
		  ?>
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="http://www.indibits.com/about/">About Indibits</a></li>
                <li><a href="#">About Indibits-wiki</a></li>
                <?
				if($this->session->userdata('account_type')=="owner")
					echo '<li class="divider"></li>
                <li><a href="'.$this->config->base_url().index_page().'/install/settings"><i class="icon-wrench"></i> Settings</a></li>';//settings is shown only to owners
                ?>
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
<!-- container class not closed!!! -->
    
    
    
