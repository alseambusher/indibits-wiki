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
<body onload="$('#step2').fadeOut(0);$('#step3').fadeOut(0);">
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
		<tr>
		<td>Copyright of the wiki application</td>
		<td><textarea rows="5" name="copyright"style="width:50%;"></textarea></td>
		</tr>
		<tr>
		<td>Terms and conditions for using this application</td>
		<td><textarea rows="5" name="terms"style="width:50%;"></textarea></td>
		</tr>
	</table>
	<button type="button"class="btn btn-primary btn-large" value="next" onclick="$('#step2').fadeOut(500,function(){$('#step1').fadeIn(500);});"><< Back</button>
	<button type="button"class="btn btn-primary btn-large" value="next" onclick="$('#step2').fadeOut(500,function(){$('#step3').fadeIn(500);});">Next >></button>
	</div>
	
	<div class="container" id="step3">
    <h1>Step 3</h1>
    <h3>This will create the first owner account in this wiki application</h3><br>
	<table class="table table-striped">
		<tr>
			<td><input type="text" class="span2" name="first_name"style="font-size:12pt;height:30px;width:400px;"placeholder="First Name"></td>
			<td><input type="text" class="span2" name="last_name"style="font-size:12pt;height:30px;width:400px;"placeholder="Last Name"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" class="span2" name="email"style="font-size:12pt;height:30px;width:400px;"placeholder="Eg: abc@de.com"></td>
		</tr>
		<tr>
			<td>Time Zone</td>
			<td><input type="text" class="span2" name="time_zone"style="font-size:12pt;height:30px;width:400px;"placeholder="india"></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" class="span2" name="username"style="font-size:12pt;height:30px;width:400px;"></td>
		</tr>
		<tr>
			<td><input type="password" class="span2" name="password"style="font-size:12pt;height:30px;width:400px;"placeholder="Password"></td>
			<td><input type="password" class="span2" name="confirm_password"style="font-size:12pt;height:30px;width:400px;"placeholder="Confirm Password"></td>
		</tr>
	</table>
	<button type="button"class="btn btn-primary btn-large" value="next" onclick="$('#step3').fadeOut(500,function(){$('#step2').fadeIn(500);});"><< Back</button>
	<button type="submit"class="btn btn-success btn-large" name="submit" value="submit">Done !!</button>
	</div>
	
	</form>
</body>
</html>

