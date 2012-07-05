<script type="text/javascript">
	function launch_modal(header,body){
			document.getElementById("modal_header").innerHTML=header;
			document.getElementById("modal_body").innerHTML="<h4>Copy and paste from here</h4>"+body;
			$('#myModal').modal('show');
		}
	function preview(){
		var xhr;
		xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4) {
				document.getElementById("preview_field").innerHTML="<a class='btn btn-primary' onclick='back();'><< Back</a>"+xhr.responseText;
				$('#edit_field').fadeOut(0);
				$('#preview_field').fadeIn(100);
			}
		}
		xhr.open('POST', '<? echo $this->config->base_url().index_page()."/wiki/preview";?>');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send('wiki_title=<? echo $wiki_title;?>&wiki_description='+document.getElementById("wiki_description").value);
	}
	function back(){
		$('#preview_field').fadeOut(0);
		$('#edit_field').fadeIn(100);
	}
	setTimeout("$('#preview_field').fadeOut(0);",0);
</script>
<div class='container'>
<div id='edit_field'>
<div class="btn-toolbar">
	<div class='btn-group'>
	<a class='btn btn-primary' href='<? echo base_url().index_page()."/user_home/?tab=wikis";?>'><< Back</a>
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
</div>
<div class='btn-group'>
	<button class='btn btn-info' onclick="launch_modal('General Symbols','– — ° ″ ′ ≈ ≠ ≤ ≥ ± − × ÷ ← → · §<br>~ | ¡ ¿ † ‡ ↔ ↑ ↓ • ¶   # ½ ⅓ ⅔ ¼ ¾ ⅛ ⅜ ⅝ ⅞ ∞   ‘ ’ “ ” «»   ¤ ₳ ฿ ₵ ¢ ₡ ₢ $ ₫ ₯ € ₠ ₣ ƒ ₴ ₭ ₤ ℳ ₥ ₦ № ₧ ₰ £ ៛ ₨ ₪ ৳ ₮ ₩ ¥   ♠ ♣ ♥ ♦   m² m³   ♭ ♯ ♮   © ® ™');">General symbols</button>
	<button class='btn'onclick="launch_modal('Latin','A a Á á À à Â â Ä ä Ǎ ǎ Ă ă Ā ā Ã ã Å å Ą ą Æ æ Ǣ ǣ   B b   C c Ć ć Ċ ċ Ĉ ĉ Č č Ç ç   D d Ď ď Đ đ Ḍ ḍ Ð ð   E e É é È è Ė ė Ê ê Ë ë Ě ě Ĕ ĕ Ē ē Ẽ ẽ Ę ę Ə ə   F f   G g Ġ ġ Ĝ ĝ Ğ ğ Ģ ģ   H h Ĥ ĥ Ħ ħ Ḥ ḥ   I i İ ı Í í Ì ì Î î Ï ï Ǐ ǐ Ĭ ĭ Ī ī Ĩ ĩ Į į   J j Ĵ ĵ   K k Ķ ķ   L l Ĺ ĺ Ŀ ŀ Ľ ľ Ļ ļ Ł ł Ḷ ḷ Ḹ ḹ   M m Ṃ ṃ   N n Ń ń Ň ň Ñ ñ Ņ ņ Ṇ ṇ   O o Ó ó Ò ò Ô ô Ö ö Ǒ ǒ Ŏ ŏ Ō ō Õ õ Ǫ ǫ Ő ő Ø ø Œ œ   P p   Q q   R r Ŕ ŕ Ř ř Ŗ ŗ Ṛ ṛ Ṝ ṝ   S s Ś ś Ŝ ŝ Š š Ş ş Ș ș Ṣ ṣ ß   T t Ť ť Ţ ţ Ț ț Ṭ ṭ Þ þ   U u Ú ú Ù ù Û û Ü ü Ǔ ǔ Ŭ ŭ Ū ū Ũ ũ Ů ů Ų ų Ű ű Ǘ ǘ Ǜ ǜ Ǚ ǚ Ǖ ǖ   V v   W w Ŵ ŵ   X x   Y y Ý ý Ŷ ŷ Ÿ ÿ Ỹ ỹ Ȳ ȳ   Z z Ź ź Ż ż Ž ž   ß Ð ð Þ þ Ə ə');">Latin</button>
	<button class='btn btn-info'onclick="launch_modal('Greek','Ά ά Έ έ Ή ή Ί ί Ό ό Ύ ύ Ώ ώ   Α α Β β Γ γ Δ δ   Ε ε Ζ ζ Η η Θ θ   Ι ι Κ κ Λ λ Μ μ   Ν ν Ξ ξ Ο ο Π π   Ρ ρ Σ σ ς Τ τ Υ υ   Φ φ Χ χ Ψ ψ Ω ω');">Greek</button>
	<button class='btn 'onclick="launch_modal('Cyrillic','А а Б б В в Г г   Ґ ґ Ѓ ѓ Д д Ђ ђ   Е е Ё ё Є є Ж ж   З з Ѕ ѕ И и І і   Ї ї Й й Ј ј К к   Ќ ќ Л л Љ љ М м   Н н Њ њ О о П п   Р р С с Т т Ћ ћ   У у Ў ў Ф ф Х х   Ц ц Ч ч Џ џ Ш ш   Щ щ Ъ ъ Ы ы Ь ь   Э э Ю ю Я я');">Cyrillic</button>
	<button class='btn btn-info'onclick="launch_modal('IPA','̪ d̪ ʈ ɖ ɟ ɡ ɢ ʡ ʔ   ɸ ʃ ʒ ɕ ʑ ʂ ʐ ʝ ɣ ʁ ʕ ʜ ʢ ɦ   ɱ ɳ ɲ ŋ ɴ   ʋ ɹ ɻ ɰ   ʙ ʀ ɾ ɽ   ɫ ɬ ɮ ɺ ɭ ʎ ʟ   ɥ ʍ ɧ   ɓ ɗ ʄ ɠ ʛ   ʘ ǀ ǃ ǂ ǁ   ɨ ʉ ɯ   ɪ ʏ ʊ   ɘ ɵ ɤ   ə ɚ   ɛ ɜ ɝ ɞ ʌ ɔ   ɐ ɶ ɑ ɒ   ʰ ʷ ʲ ˠ ˤ ⁿ ˡ   ˈ ˌ ː ˑ ̪ ');">IPA</button>&nbsp;&nbsp;
	<a class='btn btn-warning' href='http://daringfireball.net/projects/markdown/syntax/' target='_blank'>Markdown Help</a>
</div>
<? echo form_open('wiki/edit?id='.$_GET["id"].'&version='.$_GET["version"]);?>
<textarea style="height:70%;width:100%;" name='wiki_description' id='wiki_description'><?echo $wiki_description;?></textarea><br>
<button type='submit' class='btn btn-primary' name='submit'>Save</button>
<a class='btn btn-danger' onclick="window.location.reload();">Reset</a>
<a class='btn' onclick="preview();">Preview</a>
</form>
</div>
<div id='preview_field'>
</div>
</div>
<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="modal_header">Modal header</h3>
  </div>
  <div class="modal-body" id="modal_body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="modal_close">Close</a>
  </div>
</div>
