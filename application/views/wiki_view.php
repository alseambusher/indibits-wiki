<?$this->load->model("wiki_acc");?>
<div class='container table-bordered' >
  <div class="row">
    <div class="span4">
      <div class="btn-toolbar">
      <div class='btn-group'>
      <?
		if(wiki_acc::isLoggedIn()){
			echo "<a class='btn btn-primary' href='".base_url().index_page()."/user_home?tab=wikis'><< Back</a>";
			echo "<a class='btn' href='".base_url().index_page()."/wiki/edit?id=".$_GET['id']."&version=".$_GET['version']."'>Edit</a>";
		}
		else
			echo "<a class='btn btn-primary' href='".base_url()."'><< Back</a>";	
		?>
	</div>
      <div class='btn-group'>
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Select Version <span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?
		echo "<li><a href='?id=".$_GET['id']."&version=0'>Latest</a></li>";
		echo "<li><a href='?id=".$_GET['id']."&version=1'>Original</a></li>";
		for($i=sizeof($this->db->query("select versionid from wiki_data where wikiid='".$_GET['id']."'")->result_array());$i>0;$i--)
			echo "<li><a href='?id=".$_GET['id']."&version=$i'>Version $i</a></li>";
		?>
		</ul>
	</div>
	<div class='btn-group'>
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Compare with <span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?
		echo "<li><a href='wiki/compare?id=".$_GET['id']."&version1=0&version2=".$_GET['version']."'>Latest</a></li>";
		echo "<li><a href='wiki/compare?id=".$_GET['id']."&version1=1&version2=".$_GET['version']."'>Original</a></li>";
		for($i=sizeof($this->db->query("select versionid from wiki_data where wikiid='".$_GET['id']."'")->result_array());$i>0;$i--)
			echo "<li><a href='wiki/compare?id=".$_GET['id']."&version1=$i&version2=".$_GET['version']."'>Version $i</a></li>";
		?>
		</ul>
	</div>
   </div><!-- /btn-toolbar -->
   </div>
   </div>
<br>
<?
	echo "<h1>".$wiki_title."</h1><br>".$wiki_description."</div>";
	echo "<script type='text/javascript'>document.title='".$wiki_title."'</script>";
?>
</div>
