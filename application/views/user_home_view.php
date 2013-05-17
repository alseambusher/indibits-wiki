<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//FOR EDITORS ONLY NOTIFICATION AND WIKIS MUST BE AVAILABLE
$this->load->model("wiki_acc");
if(wiki_acc::isLoggedIn()){
?><br>
	<div class="btn-group">
		<button class="btn" id="notifications"onclick="switchActive(this);"><i class="icon-exclamation-sign"></i> Notifications</button>
		
		<?if($this->session->userdata('account_type')=="owner"){?>
		<button class="btn" id="editors" onclick="switchActive(this);" value="abavafva"><i class="icon-user"></i> Editors</button>
		<?}?>
		
		<button class="btn"id="wikis"onclick="switchActive(this);"><i class="icon-pencil"></i> Wikis</button>
		
		<?if($this->session->userdata('account_type')=="owner"){?>
		<button class="btn"id="accounts"onclick="switchActive(this);"><i class="icon-wrench"></i> Manage Accounts</button>
		<?}?>
		
		<a class="btn"id="refresh" href="<? echo $this->config->base_url().index_page()."/user_home";?>"><i class="icon-home"></i> Refresh Dashboard</a>
	</div>
	<style type="text/css">.empty{}</style>
	<script type="text/javascript">
		function setActive(){
			document.getElementById('notifications').setAttribute('class',' btn active');
			<?if($this->session->userdata('account_type')=="owner"){?>
			$('#editors_tab').fadeOut(0);
			$('#accounts_tab').fadeOut(0);
			<?}?>
			switch_wiki_mode(document.getElementById('view_mode'));
			$('#wikis_tab').fadeOut(0);
			<?if(isset($_GET['tab'])){
				echo "switchActive(".$_GET['tab'].");";
				}
			?>
		}
		function switchActive(button){
			document.getElementById('notifications').setAttribute('class',' btn');
			<?if($this->session->userdata('account_type')=="owner"){?>
			document.getElementById('editors').setAttribute('class',' btn');
			document.getElementById('accounts').setAttribute('class',' btn');
			<?}?>
			document.getElementById('wikis').setAttribute('class',' btn');
			button.setAttribute('class','btn active');
			$('#notifications_tab').fadeOut(0);
			<?if($this->session->userdata('account_type')=="owner"){?>
			$('#editors_tab').fadeOut(0);
			$('#accounts_tab').fadeOut(0);
			<?}?>
			$('#wikis_tab').fadeOut(0);
			$('#'+button.id+"_tab").fadeIn(500);
		}
		function launch_modal(header,body,form_action,args){
			document.getElementById("modal_header").innerHTML=header;
			document.getElementById("modal_body").innerHTML=body;
			document.getElementById("modal_form").action=form_action;
			$('#myModal').modal('show')
			if((args=='editor')||(args=='owner'))
				document.getElementById('new_account_type').value=args;
			else
				document.getElementById("delete_user").value=args;
		}
		<?if($this->session->userdata('account_type')=="owner"){?>
		function confirm_delete(uid){
			launch_modal('Are you sure you wan\'t to delete this user?','<p>Please note that this is irreversable!</p><input type="hidden" name="delete_user" id="delete_user">','<?echo $this->config->base_url().index_page()."/user_home/updateUsers";?>',uid);
		}
		function fetch_new_editor(){
			var xhr;
			xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
			if (xhr.readyState == 4) {
				//the new account is set only when it is saved after generation
				var status_array=xhr.responseText.split(':');
				if(status_array[0]=="success")
					launch_modal('New Editor Account Generated',status_array[1],'<?echo $this->config->base_url().index_page()."/user_home/save_generated_editor";?>','');
				else
					launch_modal('New Editor Account was not Generated',status_array[1],'?tab=accounts','');
			}
		}

			xhr.open('POST', '<? echo $this->config->base_url().index_page()."/user_home/generate_editor";?>');
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send('email='+document.getElementById("email").value+'&first_name='+document.getElementById("first_name").value+'&last_name='+document.getElementById("last_name").value+'&timezone='+document.getElementById("timezone").value);
		}
		<?}?>
		setTimeout('setActive();',0);
		function switch_wiki_mode(button){
			document.getElementById("view_mode").disabled=false;
			document.getElementById("edit_mode").disabled=false;
			document.getElementById(button.id).disabled=true;
			$("#view_mode_tab").fadeOut(0);
			$("#edit_mode_tab").fadeOut(0);
			$("#"+button.id+"_tab").fadeIn(0);
		}
	</script>

	<div id='notifications_tab'>
		<div class="row-fluid" style="height:80%;overflow-y:scroll;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
			<?
				foreach($notifications as $row){
					echo "<li><a>".$row['message'].'<em style="font-size:10px;color:gray;"> -'.$row['time']."</em></a></li>";
				}
			?>
			</ul>
			<br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br>
		  </div>
		</div>
	</div>
	
	
	<?if($this->session->userdata('account_type')=="owner"){?>
	<div id='editors_tab'>
	<table class="table">
		<tr><th>Editors</th><th>Owners</th></tr>
		<tr><td>
		<div class="row-fluid" style="height:500px;overflow-y:scroll;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
			<?
				$i=0;
				foreach($editors as $row){
					echo "<li><a href='#'id='editor_".$i."'class='empty'rel='popover' title='".wiki_acc::get_individual_user_data($row['id'],'fullname')."' data-content='<strong>username</strong>: ".$row['username']."<br><strong>email:</strong> ".$row['email']."<br><strong>number of wikis</strong>: ".wiki_acc::get_individual_user_data($row['id'],'number_of_wikis')."<br><strong>number of edits</strong>: ".wiki_acc::get_individual_user_data($row['id'],'number_of_edits')."<br>' 
					onmouseover='$(\"#\"+this.id).popover(\"show\");'>".$row['first_name'].' '.$row['last_name'].'<em style="font-size:10px;color:gray;"> -since: '.$row['signup_time']."</em></a></li>";
					$i++;
				}
			?>
			</ul>
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
		  </div>
		</div>
	  </td><td>
		<div class="row-fluid" style="height:500px;overflow-y:scroll;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
			<?
				$i=0;
				foreach($owners as $row){
					echo "<li><a href='#'id='owner_".$i."'class='empty'rel='popover' title='".wiki_acc::get_individual_user_data($row['id'],'fullname')."' data-content='<strong>username</strong>: ".$row['username']."<br><strong>email:</strong> ".$row['email']."<br><strong>number of wikis</strong>: ".wiki_acc::get_individual_user_data($row['id'],'number_of_wikis')."<br><strong>number of edits</strong>: ".wiki_acc::get_individual_user_data($row['id'],'number_of_edits')."<br>' 
					onmouseover='$(\"#\"+this.id).popover(\"show\");'>".$row['first_name'].' '.$row['last_name'].'<em style="font-size:10px;color:gray;"> -since: '.$row['signup_time']."</em></a></li>";
					$i++;
				}
			?>
			</ul>
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
		  </div>
		</div>
	  </div>
	  </td></tr>
	  </table>
	</div>
	<?}?>
	
	
	<div id='wikis_tab'>
	<? $this->load->model("wiki_acc");?>
		<br>
		<button class='btn btn-primary' id="view_mode" onclick="switch_wiki_mode(this);">View Mode</button>
		<button class='btn btn-primary' id="edit_mode" onclick="switch_wiki_mode(this);">Edit Mode</button>
		<a class='btn' href='<?echo $this->config->base_url().index_page()."/wiki/create";?>'>New Wiki</a><br>
		<div class="row-fluid" style="height:70%;overflow-y:scroll;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
            <div id="view_mode_tab">
			<?
				foreach($wiki_recent as $row){
					echo "<li><a href='".base_url().index_page()."/wiki?id=".$row['wikiid']."&version=0'>".$row['wiki_title'].' <a style="color:gray;">Originally by '.wiki_acc::get_individual_user_data($row['editors'],"fullname").'</a><em style="font-size:10px;color:gray;"> -'.$row['time']."</em></a></li>";
				}
			?>
			</div>
			<div id="edit_mode_tab">
			<?
				foreach($wiki_recent as $row){
					echo "<li><a href='".base_url().index_page()."/wiki/edit?id=".$row['wikiid']."&version=0'>".$row['wiki_title'].' <a style="color:gray;">Originally by '.wiki_acc::get_individual_user_data($row['editors'],"fullname").'</a><em style="font-size:10px;color:gray;"> -'.$row['time']."</em></a></li>";
				}
			?>
			</div>
			</ul>
			<br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br>
		  </div>
		</div>
	</div>
	
	
	<?if($this->session->userdata('account_type')=="owner"){?>
	<div id='accounts_tab'>
	<table class="table">
		<tr><th>Existng Users</th><th>Generate new editor account</th></tr>
		<tr><td>
		<div class="row-fluid" style="height:500px;overflow-y:scroll;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
			<?
				$i=0;
				foreach($all_users as $row){
					?>
					<li><a href='#' onclick="launch_modal('Edit user account','<input type=\'hidden\' name=\'uid\' value=\'<?echo $row['id'];?>\'<strong>Change Account type:</strong><br><select name=\'new_account_type\' id=\'new_account_type\'><option value=\'editor\'>Editor</option><option value=\'owner\'>Owner</option></select><br><a class=\'btn btn-danger\' onclick=\'confirm_delete(<?echo $row['id'];?>);\'>Delete this account</a>','<? echo $this->config->base_url().index_page()."/user_home/updateUsers";?>','<?echo $row['account_type'];?>');">
					<h3><?echo $row['account_type'];?></h3><?echo $row['first_name'].' '.$row['last_name'];?><em style="font-size:10px;color:gray;"> -since: <?echo $row['signup_time'];?></em></a></li>
					<?
					$i++;
				}
			?>
			</ul>
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
		  </div>
		</div>
	  </td><td>
		<table class='table'>
			<tr><td><input type="text" id="first_name"class="span3" style="font-size:12pt;height:30px;"placeholder="First Name"></td></tr>
			<tr><td><input type="text" id="last_name"class="span3" style="font-size:12pt;height:30px;"placeholder="Last Name"></td></tr>
			<tr><td><input type="text" id="timezone"class="span2" style="font-size:12pt;height:30px;"placeholder="Time Zone" data-provide="typeahead"
			data-items="4" data-source='["AFGHANISTAN","ALAND ISLANDS","ALBANIA","ALGERIA","AMERICAN SAMOA","ANDORRA","ANGOLA","ANGUILLA","ANTARCTICA","ANTIGUA AND BARBUDA","ARGENTINA","ARMENIA","ARUBA","AUSTRALIA","AUSTRIA","AZERBAIJAN","BAHAMAS","BAHRAIN","BANGLADESH","BARBADOS","BELARUS","BELGIUM","BELIZE","BENIN","BERMUDA","BHUTAN","BOLIVIA PLURINATIONAL STATE OF","BONAIRE SINT EUSTATIUS AND SABA","BOSNIA AND HERZEGOVINA","BOTSWANA","BOUVET ISLAND","BRAZIL","BRITISH INDIAN OCEAN TERRITORY","BRUNEI DARUSSALAM","BULGARIA","BURKINA FASO","BURUNDI","CAMBODIA","CAMEROON","CANADA","CAPE VERDE","CAYMAN ISLANDS","CENTRAL AFRICAN REPUBLIC","CHAD","CHILE","CHINA","CHRISTMAS ISLAND","COCOS KEELING) ISLANDS","COLOMBIA","COMOROS","CONGO","CONGO THE DEMOCRATIC REPUBLIC OF THE","COOK ISLANDS","COSTA RICA","COTE D\"IVOIRE","CROATIA","CUBA","CURACAO","CYPRUS","CZECH REPUBLIC","DENMARK","DJIBOUTI","DOMINICA","DOMINICAN REPUBLIC","ECUADOR","EGYPT","EL SALVADOR","EQUATORIAL GUINEA","ERITREA","ESTONIA","ETHIOPIA","FALKLAND ISLANDS MALVINAS","FAROE ISLANDS","FIJI","FINLAND","FRANCE","FRENCH GUIANA","FRENCH POLYNESIA","FRENCH SOUTHERN TERRITORIES","GABON","GAMBIA","GEORGIA","GERMANY","GHANA","GIBRALTAR","GREECE","GREENLAND","GRENADA","GUADELOUPE","GUAM","GUATEMALA","GUERNSEY","GUINEA","GUINEA-BISSAU","GUYANA","HAITI","HEARD ISLAND AND MCDONALD ISLANDS","HOLY SEE VATICAN CITY STATE","HONDURAS","HONG KONG","HUNGARY","ICELAND","INDIA","INDONESIA","IRAN ISLAMIC REPUBLIC OF","IRAQ","IRELAND","ISLE OF MAN","ISRAEL","ITALY","JAMAICA","JAPAN","JERSEY","JORDAN","KAZAKHSTAN","KENYA","KIRIBATI","KOREA DEMOCRATIC PEOPLE\"S REPUBLIC OF","KOREA REPUBLIC OF","KUWAIT","KYRGYZSTAN","LAO PEOPLE\"S DEMOCRATIC REPUBLIC","LATVIA","LEBANON","LESOTHO","LIBERIA","LIBYAN ARAB JAMAHIRIYA","LIECHTENSTEIN","LITHUANIA","LUXEMBOURG","MACAO","MACEDONIA THE FORMER YUGOSLAV REPUBLIC OF","MADAGASCAR","MALAWI","MALAYSIA","MALDIVES","MALI","MALTA","MARSHALL ISLANDS","MARTINIQUE","MAURITANIA","MAURITIUS","MAYOTTE","MEXICO","MICRONESIA FEDERATED STATES OF","MOLDOVA REPUBLIC OF","MONACO","MONGOLIA","MONTENEGRO","MONTSERRAT","MOROCCO","MOZAMBIQUE","MYANMAR","NAMIBIA","NAURU","NEPAL","NETHERLANDS","NEW CALEDONIA","NEW ZEALAND","NICARAGUA","NIGER","NIGERIA","NIUE","NORFOLK ISLAND","NORTHERN MARIANA ISLANDS","NORWAY","OMAN","PAKISTAN","PALAU","PALESTINIAN TERRITORY OCCUPIED","PANAMA","PAPUA NEW GUINEA","PARAGUAY","PERU","PHILIPPINES","PITCAIRN","POLAND","PORTUGAL","PUERTO RICO","QATAR","REUNION","ROMANIA","RUSSIAN FEDERATION","RWANDA","SAINT BARTHELEMY","SAINT HELENA ASCENSION AND TRISTAN DA CUNHA","SAINT KITTS AND NEVIS","SAINT LUCIA","SAINT MARTIN FRENCH PART","SAINT PIERRE AND MIQUELON","SAINT VINCENT AND THE GRENADINES","SAMOA","SAN MARINO","SAO TOME AND PRINCIPE","SAUDI ARABIA","SENEGAL","SERBIA","SEYCHELLES","SIERRA LEONE","SINGAPORE","SINT MAARTEN DUTCH PART","SLOVAKIA","SLOVENIA","SOLOMON ISLANDS","SOMALIA","SOUTH AFRICA","SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS","SPAIN","SRI LANKA","SUDAN","SURINAME","SVALBARD AND JAN MAYEN","SWAZILAND","SWEDEN","SWITZERLAND","SYRIAN ARAB REPUBLIC","TAIWAN PROVINCE OF CHINA","TAJIKISTAN","TANZANIA UNITED REPUBLIC OF","THAILAND","TIMOR-LESTE","TOGO","TOKELAU","TONGA","TRINIDAD AND TOBAGO","TUNISIA","TURKEY","TURKMENISTAN","TURKS AND CAICOS ISLANDS","TUVALU","UGANDA","UKRAINE","UNITED ARAB EMIRATES","UNITED KINGDOM","UNITED STATES","UNITED STATES MINOR OUTLYING ISLANDS","URUGUAY","UZBEKISTAN","VANUATU","VENEZUELA BOLIVARIAN REPUBLIC OF","VIET NAM","VIRGIN ISLANDS BRITISH","VIRGIN ISLANDS U.S.","WALLIS AND FUTUNA","WESTERN SAHARA","YEMEN","ZAMBIA","ZIMBABWE"]'
			></td></tr>
			<tr><td><input type="text" id="email"class="span3" style="font-size:12pt;height:30px;"placeholder="email"></td></tr>
		</table>
		<button class="btn btn-primary btn-large" onclick="fetch_new_editor();">Generate new Editor</button>
	  </td></tr>
	  </table>
	</div>
	<?}?>
<?
}
?>

<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="modal_header">Modal header</h3>
  </div>
  <form method="post" id="modal_form" action="#">
  <div class="modal-body" id="modal_body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="modal_close">Close</a>
    <button type="submit"href="#" class="btn btn-primary" id="modal_save">Save changes</button>
  </div>
  </form>
</div>
