<!DOCTYPE html>
<html lang="ru">
<head>
	<script type="text/javascript">
			</script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "Главная"); ?></title>
	<base href="{{base_url}}" />
	<?php echo isset($sitemapUrls) ? generateCanonicalUrl($sitemapUrls) : ""; ?>	
	
						<meta name="viewport" content="width=device-width, initial-scale=1" />
					<meta name="description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Главная"); ?>" />
			<meta name="keywords" content="<?php echo htmlspecialchars((isset($seoKeywords) && $seoKeywords !== "") ? $seoKeywords : "Главная"); ?>" />
		
	<!-- Facebook Open Graph -->
		<meta property="og:title" content="<?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "Главная"); ?>" />
			<meta property="og:description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Главная"); ?>" />
			<meta property="og:image" content="<?php echo htmlspecialchars((isset($seoImage) && $seoImage !== "") ? "{{base_url}}".$seoImage : ""); ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:url" content="{{curr_url}}" />
		<!-- Facebook Open Graph end -->

			<script src="js/common-bundle.js?ts=20240313103312" type="text/javascript"></script>
	<script src="js/a188dd97b25a006512cf352b6ac6ad7e-bundle.js?ts=20240313103312" type="text/javascript"></script>
	<link href="css/common-bundle.css?ts=20240313103312" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,200,300,400,500,600,700,800,900&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese" rel="stylesheet" type="text/css" />
	<link href="css/a188dd97b25a006512cf352b6ac6ad7e-bundle.css?ts=20240313103312" rel="stylesheet" type="text/css" id="wb-page-stylesheet" />
	<ga-code/>
	<script type="text/javascript">
	window.useTrailingSlashes = true;
	window.disableRightClick = false;
	window.currLang = 'ru';
</script>
		
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<![endif]-->

		<script type="text/javascript">
		$(function () {
<?php $wb_form_send_success = popSessionOrGlobalVar("wb_form_send_success"); ?>
<?php if (($wb_form_send_state = popSessionOrGlobalVar("wb_form_send_state"))) { ?>
	<?php if (($wb_form_popup_mode = popSessionOrGlobalVar("wb_form_popup_mode")) && (isset($wbPopupMode) && $wbPopupMode)) { ?>
		if (window !== window.parent && window.parent.postMessage) {
			var data = {
				event: "wb_contact_form_sent",
				data: {
					state: "<?php echo str_replace('"', '\"', $wb_form_send_state); ?>",
					type: "<?php echo $wb_form_send_success ? "success" : "danger"; ?>"
				}
			};
			window.parent.postMessage(data, "<?php echo str_replace('"', '\"', popSessionOrGlobalVar("wb_target_origin")); ?>");
		}
	<?php $wb_form_send_success = false; $wb_form_send_state = null; $wb_form_popup_mode = false; ?>
	<?php } else { ?>
		wb_show_alert("<?php echo str_replace(array('"', "\r", "\n"), array('\"', "", "<br/>"), $wb_form_send_state); ?>", "<?php echo $wb_form_send_success ? "success" : "danger"; ?>");
	<?php } ?>
<?php } ?>
});    </script>
</head>


<body class="site site-lang-ru<?php if (isset($wbPopupMode) && $wbPopupMode) echo ' popup-mode'; ?> " <?php ?>><div id="wb_root" class="root wb-layout-vertical"><div class="wb_sbg"></div><div id="wb_header_a188dd97b25a006512cf352b6ac6ad7e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a18e36ef01e00076a3ccb1b8fa79b941" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a328043999f1d1a92cbd5184" class="wb_element wb-menu wb-prevent-layout-click wb-menu-mobile" data-plugin="Menu"><a class="btn btn-default btn-collapser"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><ul class="hmenu" dir="ltr"><li class="wb_this_page_menu_item"><a href="{{base_url}}">Главная</a></li><li class=""><a>Великолепные подарки</a></li><li class="wb_this_page_menu_item" data-anchor="Shop"><a href="#Shop">Магазин</a></li><li class=""><a>Наша история</a></li><li class="wb_this_page_menu_item" data-anchor="Contact us"><a href="#Contact+us">Контакты</a></li></ul><div class="clearfix"></div></div><div id="a188dd97a3280575487b9ace968b869b" class="wb_element wb-prevent-layout-click wb-store-cart" data-plugin="StoreCart"><?php StoreCartElement::render(StoreModule::$storeNav, (object) array(
	'id' => 'a188dd97a3280575487b9ace968b869b',
	'name' => null,
	'icon' => (object) array(
		'family' => 'FontAwesome',
		'prefix' => 'fa fa-',
		'icon' => 'shopping-cart',
		'character' => 'f07a',
		'xOffset' => 65.501415,
		'baseLine' => 1537.02,
		'width' => 1793.982,
		'height' => 1793.982,
		'fontSize' => 1792
	),
	'iconWidth' => '30px',
	'iconHeight' => 'auto',
	'iconColor' => '#454545',
	'translations' => array()
)); ?></div></div></div></div></div><div id="wb_main_a188dd97b25a006512cf352b6ac6ad7e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a328075f9c9c399e4734cbd6" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a3280831ed758697855fc460" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a32809f4addbcdf18e6ca3a6" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h1 class="wb-stl-heading1" style="text-align: center;"><font color="#ffffff">Но сперва, кружечка чая</font></h1>
</div><div id="a188dd97a3280a01a76346c76ace7782" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h3 class="wb-stl-heading3" style="text-align: center;"><span style="color:rgba(255,255,255,1);">Здесь вы найдёте самую...</span></h3>
</div></div></div></div></div><div id="a188dd97a3280c4c83d61ff35d06a76d" class="wb_element wb-layout-element" data-plugin="LayoutElement"><a name="Gifts" class="wb_anchor"></a><div class="wb_content wb-layout-horizontal"><div id="a188dd97a3280d7f8b6b2140e19e5da0" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a3280ec644e6c4b24c23f837" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"></div></div><div id="a188dd97a3280fe4172362dfc6cbec08" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a32810f21050fd1f622994f2" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2"><strong>Добавьте ваш продукт</strong></h2>
</div><div id="a188dd97a32811be54c2d697528db965" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: justify;"><span style="color:rgba(0,0,0,1);">Добавьте описание своего продукта, которое будет полезно для ваших клиентов. Добавьте эксклюзивные свойства вашего продукта, которые заставят клиентов покупать его. Напишите свой собственный текст и настройте его в настройках магазина в вкладке Стилизовать.</span></p>
</div><div id="a188dd97a328125ec5c85431fc3c09a2" class="wb_element" data-plugin="Button"><a class="wb_button" href="#Shop"><span>Купить сейчас</span></a></div></div></div></div></div><div id="a188dd97a32813ad2efd5c6279c0b4a4" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a32814102cac72bb827ed34e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"></div></div><div id="a188dd97a328157434d898334d29be05" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a32816ace5c5814f68011f10" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2"><strong>Добавьте ваш продукт</strong></h2>
</div><div id="a188dd97a328171ec758a943c9f90e9c" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: justify;"><span style="color:rgba(0,0,0,1);">Добавьте описание своего продукта, которое будет полезно для ваших клиентов. Добавьте эксклюзивные свойства вашего продукта, которые заставят клиентов покупать его. Напишите свой собственный текст и настройте его в настройках магазина в вкладке Стилизовать.</span></p>
</div><div id="a188dd97a328184146f0fa997c791cf0" class="wb_element" data-plugin="Button"><a class="wb_button" href="#Shop"><span>Купить сейчас</span></a></div></div></div></div></div><div id="a188dd97a32819c533b4bdab3169eb51" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a3281a589214a4d1ed3e5b7d" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"></div></div><div id="a188dd97a3281ba80b3cf5917df9597d" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a3281c186f07849a21e10fa7" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2"><strong>Добавьте ваш продукт</strong></h2>
</div><div id="a188dd97a3281dc162da0ec53647ed06" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: justify;"><span style="color:rgba(0,0,0,1);">Добавьте описание своего продукта, которое будет полезно для ваших клиентов. Добавьте эксклюзивные свойства вашего продукта, которые заставят клиентов покупать его. Напишите свой собственный текст и настройте его в настройках магазина в вкладке Стилизовать.</span></p>
</div><div id="a188dd97a3281e38790a7fede34ab3b2" class="wb_element" data-plugin="Button"><a class="wb_button" href="#Shop"><span>Купить сейчас</span></a></div></div></div></div></div><div id="a188dd97a3281f8ae2c96917d0acd154" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a328205ba78d8ab80f19acf3" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"></div></div><div id="a188dd97a3282112003102f433633c62" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a3282260c1035d11f9cb458f" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2"><strong>Добавьте ваш продукт</strong></h2>
</div><div id="a188dd97a328236c19dcdb7758ca1555" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal" style="text-align: justify;"><span style="color:rgba(0,0,0,1);">Добавьте описание своего продукта, которое будет полезно для ваших клиентов. Добавьте эксклюзивные свойства вашего продукта, которые заставят клиентов покупать его. Напишите свой собственный текст и настройте его в настройках магазина в вкладке Стилизовать.</span></p>
</div><div id="a188dd97a32824644bf1635dc6d9c88c" class="wb_element" data-plugin="Button"><a class="wb_button" href="#Shop"><span>Купить сейчас</span></a></div></div></div></div></div></div></div><div id="a188dd97a32825528214985a30d8b41e" class="wb_element wb-prevent-layout-click wb_gallery" data-plugin="Gallery"><script type="text/javascript">
			$(function() {
				(function(GalleryLib) {
					var el = document.getElementById("a188dd97a32825528214985a30d8b41e");
					var lib = new GalleryLib({"id":"a188dd97a32825528214985a30d8b41e","height":"auto","type":"slideshow","trackResize":true,"interval":10,"speed":400,"images":[{"thumb":"gallery\/Tea 1.mp4","src":"gallery\/Tea 1.mp4?ts=1710318792","width":200,"height":200,"title":"","link":null,"description":"","address":""},{"thumb":"gallery\/Tea_2.mp4","src":"gallery\/Tea_2.mp4?ts=1710318792","width":200,"height":200,"title":"","link":null,"description":"","address":""}],"border":{"border":"5px none #ffffff"},"padding":0,"thumbWidth":64,"thumbHeight":64,"thumbAlign":"left","thumbPadding":6,"thumbAnim":"","thumbShadow":"","imageCover":true,"disablePopup":false,"controlsArrow":"none","controlsArrowSize":14,"controlsArrowStyle":{"normal":{"color":"#FFFFFF","shadow":{"angle":135,"distance":0,"size":0,"blur":1,"color":"#000000","forText":true,"css":{"text-shadow":"0px 0px 1px #000000"}}},"hover":{"color":"#DDDDDD","shadow":{"angle":135,"distance":0,"size":0,"blur":1,"color":"#222222","forText":true,"css":{"text-shadow":"0px 0px 1px #222222"}}},"active":{"color":"#FFFFFF","shadow":{"angle":135,"distance":0,"size":0,"blur":1,"color":"#000000","forText":true,"css":{"text-shadow":"0px 0px 1px #000000"}}}},"slideOpacity":100,"showPictureCaption":"always","captionIncludeDescription":false,"captionPosition":"center bottom","mapTypeId":"","markerIconTypeId":"","zoom":16,"mapCenter":"","key":"AIzaSyChpsOrBxEG_GeV-KIABgsxtIZ-IXneudg","theme":"default","color":"#eeeeee","showSatellite":true,"showZoom":true,"showStreetView":true,"showFullscreen":true,"allowDragging":true,"showRoads":true,"showLandmarks":true,"showLabels":true,"locale":"ru_RU"});
					lib.appendTo(el);
				})(window.wbmodGalleryLib);
			});
		</script></div><div id="a188dd97a32828a3d1ee0939000d0ded" class="wb_element wb-layout-element" data-plugin="LayoutElement"><a name="About+us" class="wb_anchor"></a><div class="wb_content wb-layout-horizontal"><div id="a188dd97a32829aa5b85e8a8bd9e7a76" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"></div></div><div id="a188dd97a3282a2817ceebe2461f9b90" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a3282b89a649a0ed13b86409" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"></div></div><div id="a188dd97a3282cceff61acf397a2faa9" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2">О нас</h2>
</div><div id="a188dd97a3282dcb19fe4247ec118898" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal">На этой странице вы найдете самую последнюю информацию о нас. Наша компания постоянно развивается и растет.
Мы предоставляем широкий спектр услуг обеспечивающий прекрасный...</p>

<p class="wb-stl-normal"> </p>

<p class="wb-stl-normal">Вставьте своё бизнес-мотто, поделитесь философией и ценностями, чтобы другие знали, почему вы начали этот бизнес. Расскажите клиентам, что вы улучшите их жизнь с помощью своего продукта или услуги. Добавьте свой собственный текст, отредактируйте его и нажмите Готово.</p>
</div></div></div></div></div><div id="a188dd97a3282e8e09d9f532f9c86178" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a3282f4b0464bfbc21739439" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a32830f85e75e2072618d17a" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2">Наша история</h2>
</div><div id="a188dd97a3283165355cd5edc6710fe6" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal">На этой странице вы найдете самую последнюю информацию о нас. Наша компания постоянно развивается и растет.
Мы предоставляем широкий спектр услуг обеспечивающий прекрасный...</p>

<p class="wb-stl-normal"> </p>

<p class="wb-stl-normal">Вставьте своё бизнес-мотто, поделитесь философией и ценностями, чтобы другие знали, почему вы начали этот бизнес. Расскажите клиентам, что вы улучшите их жизнь с помощью своего продукта или услуги. Добавьте свой собственный текст, отредактируйте его и нажмите Готово.</p>
</div></div></div><div id="a188dd97a32832f85bf2755957e9a5ed" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"></div></div></div></div><div id="a188dd97a32833b169e9edd72b7d8e5d" class="wb_element wb-layout-element" data-plugin="LayoutElement"><a name="Contact+us" class="wb_anchor"></a><div class="wb_content wb-layout-vertical"><div id="a188dd97a32834928589098010f492cf" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"><div id="a188dd97a3283512025a35d366906658" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a32836ac2d427b4cd633ced1" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><h2 class="wb-stl-heading2">Контакты</h2>
</div><div id="a188dd97a328372619031895b10e0c01" class="wb_element wb_text_element" data-plugin="TextArea" style=" line-height: normal;"><p class="wb-stl-normal"><strong>Адрес:</strong><br>
Башня Федерация<br>
ул. Пресненская наб., 12<br>
Москва</p>

<p class="wb-stl-normal"> </p>

<p class="wb-stl-normal"><strong>Тел.:</strong><br>
<a href="tel:+1 212 736 3100"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;"><span dir="ltr" style="direction: ltr;">+7 495 695 37 76</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></a><br>
<strong>Почта:</strong><br>
<a href="mailto:info@example.com">info@example.com</a></p>

<p class="wb-stl-normal"> </p>

<p class="wb-stl-normal">Здесь вы найдёте самую свежую информацию о нашей...</p>
</div></div></div><div id="a188dd97a32838b82c85e167e0a9ae6a" class="wb_element" data-plugin="Form"><form id="a188dd97a32838b82c85e167e0a9ae6a_form" class="wb_form wb_mob_form wb_form_ltr wb_form_vertical" method="post" enctype="multipart/form-data" action="__wb_curr_url__"><input type="hidden" name="wb_form_id" value="ca4a8800"><input type="hidden" name="wb_form_uuid" value="25b852fd"><textarea name="message" rows="3" cols="20" class="hpc" autocomplete="off"></textarea><table><tr><th>Имя<span class="text-danger">&nbsp;*</span></th><td><input type="hidden" name="wb_input_0" value="Имя"><div><input class="form-control form-field" type="text" value="" placeholder="" maxlength="255" name="wb_input_0" required="required"></div></td></tr><tr><th>Эл. почта<span class="text-danger">&nbsp;*</span></th><td><input type="hidden" name="wb_input_1" value="Эл. почта"><div><input class="form-control form-field" type="text" value="" placeholder="" maxlength="255" name="wb_input_1" required="required"></div></td></tr><tr class="area-row"><th>Сообщение<span class="text-danger">&nbsp;*</span></th><td><input type="hidden" name="wb_input_2" value="Сообщение"><div><textarea class="form-control form-field form-area-field" rows="4" placeholder="" name="wb_input_2" required="required"></textarea></div></td></tr><tr class="form-footer"><td colspan="2" class="text-right"><button type="submit" class="btn btn-default"><span>Отправить</span></button></td></tr></table><?php if (isset($wbPopupMode) && $wbPopupMode): ?><input type="hidden" name="wb_popup_mode" value="1" /><?php endif; ?></form><script type="text/javascript">
			<?php $wb_form_id = sessionOrGlobalVar("wb_form_id"); if ($wb_form_id == "ca4a8800") { ?>
				<?php popSessionOrGlobalVar("wb_form_id"); ?>
				var formValues = <?php echo json_encode(popSessionOrGlobalVar("post")); ?>;
				var formErrors = <?php echo json_encode(popSessionOrGlobalVar("formErrors")); ?>;
				wb_form_validateForm("ca4a8800", formValues, formErrors);
			<?php } ?>
			</script></div></div></div></div></div><div id="a188dd97a32839d2f185e5f2bc37ee17" class="wb_element wb-map wb-prevent-layout-click" data-plugin="GoogleMaps"><div class="wb_google_maps_overlay"><div>Get <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">API key from Google</a> and insert it to plugin properties to enable maps on your website.</div></div><script type="text/javascript">
				(function() {
					var resizeFunc = function() {
						var elem = $("#a188dd97a32839d2f185e5f2bc37ee17");
						var w = elem.width(), h = elem.height();
						elem.find("div > div:first").css("zoom", Math.max(0.5, Math.min(1, ((w * h) / 120000))));
					};
					$(window).on("resize", resizeFunc);
					resizeFunc();
				})();
			</script></div><div id="a18e36f1508c002cce4130f99e3b911a" class="wb_element wb_element_picture" data-plugin="Picture" title=""><div class="wb_picture_wrap"><div class="wb-picture-wrapper"><img alt="" src="gallery_gen/cd0df0cce139d68392d3b89ae1695123_608x608_fit.png?ts=1710318793"></div></div></div></div></div><div id="wb_footer_a188dd97b25a006512cf352b6ac6ad7e" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-vertical"><div id="a188dd97a3283c24b4821a9490bc77e1" class="wb_element wb-layout-element" data-plugin="LayoutElement"><div class="wb_content wb-layout-horizontal"></div></div><div id="wb_footer_c" class="wb_element" data-plugin="WB_Footer" style="text-align: center; width: 100%;"><div class="wb_footer"></div><script type="text/javascript">
			$(function() {
				var footer = $(".wb_footer");
				var html = (footer.html() + "").replace(/^\s+|\s+$/g, "");
				if (!html) {
					footer.parent().remove();
					footer = $("#footer, #footer .wb_cont_inner");
					footer.css({height: ""});
				}
			});
			</script></div></div></div>
<div class="wb_pswp pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg" style="opacity: 0.7;"></div>
	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>
		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>
				<button class="pswp__button pswp__button--close" title="Закрыть"></button>
				<button class="pswp__button pswp__button--zoom" title="Увеличение/уменьшение масштаба"></button>
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div> 
			</div>
			<button class="pswp__button pswp__button--arrow--left" title="Предыдущий"></button>
			<button class="pswp__button pswp__button--arrow--right" title="Следующий"></button>
			<div class="pswp__caption"><div class="pswp__caption__center"></div></div>
		</div>
	</div>
</div>
</div>{{hr_out}}</body>
</html>
