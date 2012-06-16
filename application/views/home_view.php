<?php include('config.php');?>
	<div id="notification">
		<div class="alert alert-success">
			<h1>About <?echo $wikiapp_name;?></h1><br>
			<pre class="alert alert-success	"style='font-family:"Sans-serif", Times, serif;'><em><?echo $wikiapp_description;?></em></pre>
		</div>
		<table class="table">
			<tr>
				<td>
					<div class="table-bordered">
<div class="row-fluid" style="max-height:200px;overflow-y:scroll;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">This will have all the wikis</li>
              <li class="active"><a href="#">Wiki 1</a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <li><a href="#">Wiki (not working)<em style="font-size:10px;color:gray;"> -10/10/2010 5pm IST</em></a></li>
              <?
				//$query=$this->db->query("select version from wiki where uid='".$_SESSION['uid']."' order by version asc");
				//foreach($query->result() as $row)
					//echo "<li><a href='".$this->config->base_url().index_page()."/writer?version=".$row->version."&uid=".$_SESSION['uid']."'>Version ".$row->version."</a></li>";
              ?>
            </ul>
          </div><!--/.well -->
					</div>
				</td>
				<td>
					<div class="table-bordered">
					This will have all the news n stuffs. <br>this will be notifications if user is logged in<br>
					wiki1<br>
					wiki1<br>
					wiki1<br>
					wiki1<br>
					wiki1<br>
					wiki1<br>
					wiki1<br>
					wiki1<br>
					</div>
				</td>
			</tr>
		</table>
	</div><!-- container closed -->
</body>
</html>

