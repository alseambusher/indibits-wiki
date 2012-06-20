<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->model("wiki_acc");
if(wiki_acc::isLoggedIn()){
?>
	<div class="btn-group">
		<button class="btn" id="notifications"><i class="icon-exclamation-sign"></i> Notifications</button>
		<button class="btn" id="editors"><i class="icon-user"></i> Editors</button>
		<button class="btn"id="wikis"><i class="icon-pencil"></i> Wikis</button>
		<button class="btn"id="about"><i class="icon-home"></i> About application</button>
	</div>
	<script type="text/javascript">
		function setActive(){
			document.getElementById('<? echo $pageId;?>').setAttribute('class',' btn active');
		}
		setTimeout('setActive();',0);
	</script>
<?
}
?>
