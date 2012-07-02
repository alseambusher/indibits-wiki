<?$this->load->model("wiki_acc");?>
<div class='container table-bordered' >
	<div class='btn-group'>
	<?
	if(wiki_acc::isLoggedIn())
		echo "<a class='btn btn-primary' href='".base_url().index_page()."/user_home?tab=wikis'><< Back</a>";
	else
		echo "<a class='btn btn-primary' href='".base_url().index_page()."'><< Back</a>";	
	?>
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Select Version <span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?
		echo "<li><a href='?id=".$_GET['id']."&version=0'>Latest</a></li>";
		for($i=sizeof($this->db->query("select versionid from wiki_data where wikiid='".$_GET['id']."'")->result_array());$i>0;$i--)
			echo "<li><a href='?id=".$_GET['id']."&version=$i'>Version $i</a></li>";
		?>
		</ul>
	</div>
<br>
<?
	echo "<h1>".$wiki_title."</h1><br>".$wiki_description."</div>";
	echo "<script type='text/javascript'>document.title='".$wiki_title."'</script>";
?>
</div>
