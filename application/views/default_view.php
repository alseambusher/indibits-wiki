<?php include('config.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xm; charset=utf-8" />
<?header ('Content-type: text/html; charset=utf-8');?>
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
<script type="text/javascript">
//if type is 'simple' it will return only titles. if it is 'full' it will return everything
function remote_fetch(sentence,type){
	var xhr=false;
	xhr=new XMLHttpRequest()
	xhr.onreadystatechange = function() {
		if(type=='full'){
			$('#search_results').modal('show');
			document.getElementById("search_results_body").innerHTML="Searching....";
		}
		if (xhr.readyState == 4) {
			if(type=='simple'){
				var autocomplete = $('#search_wikis').typeahead();
				autocomplete.data("typeahead").source=xhr.responseText.split(",");
			}
			if(type=='full'){
				var result_array=xhr.responseText.split('~')[0].split(',');
				var url_array=xhr.responseText.split('~')[1].split(',');
				search_results_modal(result_array,url_array);
				if(xhr.responseText.length==1)
					document.getElementById("search_results_body").innerHTML="No Results Found";
			}
			return xhr.responseText.split(",");
		}
	}

	xhr.open('POST', '<? echo $this->config->base_url().index_page()."/welcome/search_wikis";?>');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send('sentence='+sentence+'&type='+type);
}
function search_wikis(event){
	var autocomplete = $('#search_wikis').typeahead();
	if(event.keyCode==13){
		remote_fetch(document.getElementById("search_wikis").value,'full');
	}
	remote_fetch(document.getElementById("search_wikis").value,'simple')
}
function search_results_modal(result_array,url_array){
			document.getElementById("search_results_body").innerHTML="";
			$('#search_results').modal('show');
			for(var i=0;i<result_array.length;i++){
				var list=document.createElement("li");
				var temp=document.createElement("a");
				temp.innerHTML=result_array[i];
				temp.href=url_array[i];
				list.appendChild(temp)
				document.getElementById("search_results_body").appendChild(list);
			}
		}
</script>
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
          <input type="text" id="search_wikis" onkeyup="search_wikis(event);"class="search-query" placeholder="Search wikis " style="font-size:11pt;height:25px;margin-top:5px;" data-provide="typeahead"
			data-items="8" data-source='[]'>
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
                <li><a href="http://www.indibits.com/about/" target="_blank">About Indibits</a></li>
                <li><a href="#">About Indibits-wiki</a></li>
                <?
				if($this->session->userdata('account_type')=="owner")
					echo '<li class="divider"></li>
                <li><a href="'.$this->config->base_url().index_page().'/install/settings" target="_blank"><i class="icon-wrench"></i> Settings</a></li>';//settings is shown only to owners
                ?>
                <li class="divider"></li>
                <li><a href="<? echo base_url().index_page()."/install/help";?>" target="_blank">Help</a></li>
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
              <li><a href="<? echo $this->config->base_url().index_page();?>/welcome/terms" target="_blank">Terms and Conditions</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>	
    <!-- Lower status bar ends -->
    <div class="container">
<!-- container class not closed!!! -->


<div class="modal hide fade" id="search_results">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Search Results</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid">
          <div class="well sidebar-nav">
            <ul class="nav nav-list" id="search_results_body">
            </ul>
           </div>
     </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="modal_close">Close</a>
  </div>
</div>
    
