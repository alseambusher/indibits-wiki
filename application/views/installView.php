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
<body onload="$('#step2').fadeOut(0);">
	<!-- navigation bar begins -->
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Wiki installer</a>
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
              <li class="active"><a href="#">&copy;Copyright</a></li>
              <li><a href="#">Terms and Conditions</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>	
    <!-- Lower status bar ends -->
    <? echo form_open('install');?>
		<? echo validation_errors();;?>
    <div class="container" id="step1">
    <h1>Step 1</h1><br>
	<table class="table table-striped">
		<tr>
			<td>Name of the wiki application</td>
			<td><input type="text" class="span3" name="wikiapp_name"style="font-size:12pt;height:30px;width:400px;"placeholder="Eg: my cooking wiki"></td>
		</tr>
		<tr>
		<td>Description about this wiki application</td>
		<td><textarea rows="5" name="wikiapp_description"style="width:50%;" placeholder="Eg: This is a wiki application where people can learn various cooking methods"></textarea></td>
		</tr>
		<tr>
			<td>Database Host</td>
			<td><input type="text" name="db_host"class="span3" style="font-size:12pt;height:30px;"></td>
		</tr>
		<tr>
			<td>Database Username</td>
			<td><input type="text" name="db_username"class="span3" style="font-size:12pt;height:30px;"></td>
		</tr>
		<tr>
			<td>Database Password</td>
			<td><input type="password" name="db_password"class="span3" style="font-size:12pt;height:30px;"></td>
		</tr>
		<tr>
			<td>Default Database Name</td>
			<td><input type="text" name="db_name"class="span3" style="font-size:12pt;height:30px;"placeholder="Eg: mydb"></td>
		</tr>
	</table>
	<button type="button"class="btn btn-primary btn-large" value="next" onclick="$('#step1').fadeOut(500,function(){$('#step2').fadeIn(500);});">next >></button>
	</div>
	
	<div class="container" id="step2">
    <h1>Step 2</h1><br>
	<table class="table table-striped">
		<tr>
			<td>Admin Username</td>
			<td><input type="text" class="span3" name="admin_username"style="font-size:12pt;height:30px;"placeholder="Enter Username"></td>
		</tr>
		<tr>
			<td>Admin Password</td>
			<td><input type="password" class="span3" name="admin_password"style="font-size:12pt;height:30px;"placeholder="Enter Password"></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="password" class="span3" name="admin_password_confirm"style="font-size:12pt;height:30px;"placeholder="Confirm Password"></td>
		</tr>
	</table>
	<button type="button"class="btn btn-primary btn-large" value="next" onclick="$('#step2').fadeOut(500,function(){$('#step1').fadeIn(500);});"><< Back</button>
	<button type="submit"class="btn btn-success btn-large" name="submit" value="submit">Done !!</button>
	</div>
	</form>
</body>
</html>

