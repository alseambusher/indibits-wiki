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
			<input type="hidden" name="admin_username" value='1'>
			<input type="hidden" name="admin_password" value='1'>
			<input type="hidden" name="admin_password_confirm" value='1'>
		<tr>
		<td>Copyright of the wiki application</td>
		<td><textarea rows="5" name="copyright"style="width:100%;"></textarea></td>
		</tr>
		<tr>
		<td>Terms and conditions for using this application</td>
		<td><textarea rows="5" name="terms"style="width:100%;"></textarea></td>
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
			<td><input type="text" class="span2" name="timezone"style="font-size:12pt;height:30px;width:400px;"placeholder="time zone" data-provide="typeahead"
			data-items="4" data-source='["AFGHANISTAN","ALAND ISLANDS","ALBANIA","ALGERIA","AMERICAN SAMOA","ANDORRA","ANGOLA","ANGUILLA","ANTARCTICA","ANTIGUA AND BARBUDA","ARGENTINA","ARMENIA","ARUBA","AUSTRALIA","AUSTRIA","AZERBAIJAN","BAHAMAS","BAHRAIN","BANGLADESH","BARBADOS","BELARUS","BELGIUM","BELIZE","BENIN","BERMUDA","BHUTAN","BOLIVIA PLURINATIONAL STATE OF","BONAIRE SINT EUSTATIUS AND SABA","BOSNIA AND HERZEGOVINA","BOTSWANA","BOUVET ISLAND","BRAZIL","BRITISH INDIAN OCEAN TERRITORY","BRUNEI DARUSSALAM","BULGARIA","BURKINA FASO","BURUNDI","CAMBODIA","CAMEROON","CANADA","CAPE VERDE","CAYMAN ISLANDS","CENTRAL AFRICAN REPUBLIC","CHAD","CHILE","CHINA","CHRISTMAS ISLAND","COCOS KEELING) ISLANDS","COLOMBIA","COMOROS","CONGO","CONGO THE DEMOCRATIC REPUBLIC OF THE","COOK ISLANDS","COSTA RICA","COTE D\"IVOIRE","CROATIA","CUBA","CURACAO","CYPRUS","CZECH REPUBLIC","DENMARK","DJIBOUTI","DOMINICA","DOMINICAN REPUBLIC","ECUADOR","EGYPT","EL SALVADOR","EQUATORIAL GUINEA","ERITREA","ESTONIA","ETHIOPIA","FALKLAND ISLANDS MALVINAS","FAROE ISLANDS","FIJI","FINLAND","FRANCE","FRENCH GUIANA","FRENCH POLYNESIA","FRENCH SOUTHERN TERRITORIES","GABON","GAMBIA","GEORGIA","GERMANY","GHANA","GIBRALTAR","GREECE","GREENLAND","GRENADA","GUADELOUPE","GUAM","GUATEMALA","GUERNSEY","GUINEA","GUINEA-BISSAU","GUYANA","HAITI","HEARD ISLAND AND MCDONALD ISLANDS","HOLY SEE VATICAN CITY STATE","HONDURAS","HONG KONG","HUNGARY","ICELAND","INDIA","INDONESIA","IRAN ISLAMIC REPUBLIC OF","IRAQ","IRELAND","ISLE OF MAN","ISRAEL","ITALY","JAMAICA","JAPAN","JERSEY","JORDAN","KAZAKHSTAN","KENYA","KIRIBATI","KOREA DEMOCRATIC PEOPLE\"S REPUBLIC OF","KOREA REPUBLIC OF","KUWAIT","KYRGYZSTAN","LAO PEOPLE\"S DEMOCRATIC REPUBLIC","LATVIA","LEBANON","LESOTHO","LIBERIA","LIBYAN ARAB JAMAHIRIYA","LIECHTENSTEIN","LITHUANIA","LUXEMBOURG","MACAO","MACEDONIA THE FORMER YUGOSLAV REPUBLIC OF","MADAGASCAR","MALAWI","MALAYSIA","MALDIVES","MALI","MALTA","MARSHALL ISLANDS","MARTINIQUE","MAURITANIA","MAURITIUS","MAYOTTE","MEXICO","MICRONESIA FEDERATED STATES OF","MOLDOVA REPUBLIC OF","MONACO","MONGOLIA","MONTENEGRO","MONTSERRAT","MOROCCO","MOZAMBIQUE","MYANMAR","NAMIBIA","NAURU","NEPAL","NETHERLANDS","NEW CALEDONIA","NEW ZEALAND","NICARAGUA","NIGER","NIGERIA","NIUE","NORFOLK ISLAND","NORTHERN MARIANA ISLANDS","NORWAY","OMAN","PAKISTAN","PALAU","PALESTINIAN TERRITORY OCCUPIED","PANAMA","PAPUA NEW GUINEA","PARAGUAY","PERU","PHILIPPINES","PITCAIRN","POLAND","PORTUGAL","PUERTO RICO","QATAR","REUNION","ROMANIA","RUSSIAN FEDERATION","RWANDA","SAINT BARTHELEMY","SAINT HELENA ASCENSION AND TRISTAN DA CUNHA","SAINT KITTS AND NEVIS","SAINT LUCIA","SAINT MARTIN FRENCH PART","SAINT PIERRE AND MIQUELON","SAINT VINCENT AND THE GRENADINES","SAMOA","SAN MARINO","SAO TOME AND PRINCIPE","SAUDI ARABIA","SENEGAL","SERBIA","SEYCHELLES","SIERRA LEONE","SINGAPORE","SINT MAARTEN DUTCH PART","SLOVAKIA","SLOVENIA","SOLOMON ISLANDS","SOMALIA","SOUTH AFRICA","SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS","SPAIN","SRI LANKA","SUDAN","SURINAME","SVALBARD AND JAN MAYEN","SWAZILAND","SWEDEN","SWITZERLAND","SYRIAN ARAB REPUBLIC","TAIWAN PROVINCE OF CHINA","TAJIKISTAN","TANZANIA UNITED REPUBLIC OF","THAILAND","TIMOR-LESTE","TOGO","TOKELAU","TONGA","TRINIDAD AND TOBAGO","TUNISIA","TURKEY","TURKMENISTAN","TURKS AND CAICOS ISLANDS","TUVALU","UGANDA","UKRAINE","UNITED ARAB EMIRATES","UNITED KINGDOM","UNITED STATES","UNITED STATES MINOR OUTLYING ISLANDS","URUGUAY","UZBEKISTAN","VANUATU","VENEZUELA BOLIVARIAN REPUBLIC OF","VIET NAM","VIRGIN ISLANDS BRITISH","VIRGIN ISLANDS U.S.","WALLIS AND FUTUNA","WESTERN SAHARA","YEMEN","ZAMBIA","ZIMBABWE"]'></td>
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

