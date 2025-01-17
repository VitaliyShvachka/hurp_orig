<?php
/**
 * @var StoreInvoiceApi $this
 * @var StoreInvoice $pdf
 * @var StoreModuleOrder $order
 * @var string|string[]|null $sellerCompanyInfo
 * @var string|string[]|null $invoiceTextBeginning
 * @var string|string[]|null $invoiceTextEnding
 * @var string|string[]|null $invoiceTitlePhrase
 * @var string|null $logoImage
 * @var string|null $logoImageAlign
 * @var string|null $logoImageHeight
 * @var string|null $formattedDate
 */
?>

<?php if ($logoImage): ?>
<p style="text-align: <?php echo $logoImageAlign ?>;">
	<img src="<?php echo $logoImage ?>" height="<?php echo $logoImageHeight ?>">
</p>
<?php endif; ?>

<p style="text-align: center;">
	<strong style="font-size: 12;"><?php echo StoreInvoice::fontize(htmlspecialchars(trim(tr_(isset($invoiceTitlePhrase) ? $invoiceTitlePhrase : StoreModule::__('Invoice'))))); ?> <?php echo StoreInvoice::fontize(htmlspecialchars($order->getInvoiceDocumentNumber())); ?></strong><br />
	<?php echo $formattedDate; ?>
</p>
<p></p>

<?php if (isset($invoiceTextBeginning) && $invoiceTextBeginning && ($v = trim(tr_($invoiceTextBeginning)))): ?>
<div><?php echo StoreInvoice::fontize($v); ?></div>
<?php endif; ?>

<table border="0" cellpadding="3">
	<tbody>
		<tr>
			<td width="50%">
				<strong><?php echo StoreInvoice::fontize(StoreModule::__('Seller')); ?></strong><br />
				<?php echo nl2br(StoreInvoice::fontize(htmlspecialchars(trim(tr_(isset($sellerCompanyInfo) ? $sellerCompanyInfo : "", null, ""))))); ?><br />
			</td>
			<td width="50%">
				<strong><?php echo StoreInvoice::fontize(StoreModule::__('Buyer')); ?></strong><br />

				<?php foreach ($order->getBillingInfo()->jsonSerialize() as $key => $value) {?>
					<?php if (empty($value)) continue; ?>
					<?php if ( ($field = StorePaymentApi::getBillingFieldByKey($key)) && $field->type === 'file') continue; ?>
					<?php $fieldName = StorePaymentApi::getInfoHtmlTableFieldName($key); ?>
					<?php $fieldValue = StorePaymentApi::getInfoHtmlTableFieldValue($value, $key); ?>
					<?php if ($fieldName === null) continue; ?>

					<?php echo StoreInvoice::fontize($fieldName) . ': ' . StoreInvoice::fontize($fieldValue); ?><br/>
				<?php } ?>
			</td>
		</tr>
	</tbody>
</table>

<table border="1" cellpadding="3">
	<thead>
		<tr>
			<th style="width: 15%; font-weight: bold;"><?php echo StoreInvoice::fontize(StoreModule::__('SKU')); ?></th>
			<th style="width: 60%; font-weight: bold;"><?php echo StoreInvoice::fontize(StoreModule::__('Product description')); ?></th>
			<th style="width: 10%; font-weight: bold;"><?php echo StoreInvoice::fontize(StoreModule::__('Qty')); ?></th>
			<th style="width: 15%; font-weight: bold;"><?php echo StoreInvoice::fontize(StoreModule::__('Price')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $order->getItems() as $item ) { ?>
			<tr style="page-break-inside: avoid;">
				<td style="width: 15%;"><?php echo StoreInvoice::fontize(htmlspecialchars($item->sku)); ?></td>
				<td style="width: 60%;"><?php echo StoreInvoice::fontize(htmlspecialchars(tr_($item->name))); ?></td>
				<td style="width: 10%;"><?php echo $item->quantity; ?></td>
				<td style="width: 15%;"><?php echo StoreInvoice::fontize(htmlspecialchars($item->getFormattedPrice())); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<p></p>
<table border="1" cellpadding="3" style="page-break-inside: avoid;">
	<tbody>
		<?php if ($order->getFullTaxAmount() > 0 || $order->getShippingAmount() || $order->getDiscountAmount()) { ?>
		<tr>
			<td style="width: 85%;"><strong><?php echo StoreInvoice::fontize(StoreModule::__('Subtotal')); ?>:</strong></td>
			<td style="width: 15%;"><?php echo StoreInvoice::fontize(htmlspecialchars(StoreData::formatPrice($order->getPrice() + $order->getDiscountAmount() - $order->getFullTaxAmount() - $order->getShippingAmount(), $order->getPriceOptions(), $order->getCurrency()))); ?></td>
		</tr>
		<?php } ?>
		<?php if ($order->getDiscountAmount()) { ?>
			<tr>
				<td style="width: 85%;"><strong><?php echo StoreInvoice::fontize(StoreModule::__('Discount')); ?>:</strong></td>
				<td style="width: 15%;"><?php echo StoreInvoice::fontize(htmlspecialchars('-'.StoreData::formatPrice($order->getDiscountAmount(), $order->getPriceOptions(), $order->getCurrency()))); ?></td>
			</tr>
		<?php } ?>
		<?php if( $order->getShippingAmount() ) { ?>
			<tr>
				<td style="width: 85%;"><strong><?php echo StoreInvoice::fontize(StoreModule::__('Shipping')); ?>:</strong> (<?php echo StoreInvoice::fontize(htmlspecialchars($order->getShippingDescription())); ?>)</td>
				<td style="width: 15%;"><?php echo StoreInvoice::fontize(htmlspecialchars(StoreData::formatPrice($order->getShippingAmount(), $order->getPriceOptions(), $order->getCurrency()))); ?></td>
			</tr>
		<?php } ?>
		<?php if ($order->getFullTaxAmount() > 0): ?>
			<?php foreach ($order->getTaxes() as $tax): ?>
			<tr>
				<td style="width: 85%;"><strong><?php
					echo StoreInvoice::fontize(($tax->shippingOnly ? StoreModule::__('Shipping Tax') : StoreModule::__('Tax')))
						.($tax->rate > 0 ? " ({$tax->getRatePercent()}%)" : "");
				?>:</strong></td>
				<td style="width: 15%;"><?php
					echo StoreInvoice::fontize(htmlspecialchars(StoreData::formatPrice($tax->amount, $order->getPriceOptions(), $order->getCurrency())));
				?></td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<tr>
			<td style="width: 85%;"><strong><?php echo StoreInvoice::fontize(StoreModule::__('Total')); ?>:</strong></td>
			<td style="width: 15%;"><?php echo StoreInvoice::fontize(htmlspecialchars(StoreData::formatPrice($order->getPrice(), $order->getPriceOptions(), $order->getCurrency()))); ?></td>
		</tr>
	</tbody>
</table>

<?php if (isset($invoiceTextEnding) && $invoiceTextEnding && ($v = trim(tr_($invoiceTextEnding)))): ?>
<div><?php echo StoreInvoice::fontize($v); ?></div>
<?php endif; ?>

<?php /* Following code is used to stress test support for different languages. Source: http://www.columbia.edu/~fdc/utf8/index.html ?>

<p>
<?php
// spell-checker: ignore fontize
// spell-checker: disable
echo nl2br(StoreInvoice::fontize(<<<EOT
Sanskrit: ﻿काचं शक्नोम्यत्तुम् । नोपहिनस्ति माम् ॥
Sanskrit (standard transcription): kācaṃ śaknomyattum; nopahinasti mām.
Classical Greek: ὕαλον ϕαγεῖν δύναμαι· τοῦτο οὔ με βλάπτει.
Greek (monotonic): Μπορώ να φάω σπασμένα γυαλιά χωρίς να πάθω τίποτα.
Greek (polytonic): Μπορῶ νὰ φάω σπασμένα γυαλιὰ χωρὶς νὰ πάθω τίποτα. 
Etruscan: (NEEDED)
Latin: Vitrum edere possum; mihi non nocet.
Old French: Je puis mangier del voirre. Ne me nuit.
French: Je peux manger du verre, ça ne me fait pas mal.
Provençal / Occitan: Pòdi manjar de veire, me nafrariá pas.
Québécois: J'peux manger d'la vitre, ça m'fa pas mal.
Walloon: Dji pou magnî do vêre, çoula m' freut nén må. 
Champenois: (NEEDED) 
Lorrain: (NEEDED)
Picard: Ch'peux mingi du verre, cha m'foé mie n'ma. 
Corsican/Corsu: (NEEDED) 
Jèrriais: (NEEDED)
Kreyòl Ayisyen (Haitï): Mwen kap manje vè, li pa blese'm.
Basque: Kristala jan dezaket, ez dit minik ematen.
Catalan / Català: Puc menjar vidre, que no em fa mal.
Spanish: Puedo comer vidrio, no me hace daño.
Aragonés: Puedo minchar beire, no me'n fa mal . 
Aranés: (NEEDED) 
Mallorquín: (NEEDED)
Galician: Eu podo xantar cristais e non cortarme.
European Portuguese: Posso comer vidro, não me faz mal.
Brazilian Portuguese (8): Posso comer vidro, não me machuca.
Caboverdiano/Kabuverdianu (Cape Verde): M' podê cumê vidru, ca ta maguâ-m'.
Papiamentu: Ami por kome glas anto e no ta hasimi daño.
Italian: Posso mangiare il vetro e non mi fa male.
Milanese: Sôn bôn de magnà el véder, el me fa minga mal.
Roman: Me posso magna' er vetro, e nun me fa male.
Napoletano: M' pozz magna' o'vetr, e nun m' fa mal.
Venetian: Mi posso magnare el vetro, no'l me fa mae.
Zeneise (Genovese): Pòsso mangiâ o veddro e o no me fà mâ.
Sicilian: Puotsu mangiari u vitru, nun mi fa mali. 
Campinadese (Sardinia): (NEEDED) 
Lugudorese (Sardinia): (NEEDED)
Romansch (Grischun): Jau sai mangiar vaider, senza che quai fa donn a mai. 
Romany / Tsigane: (NEEDED)
Romanian: Pot să mănânc sticlă și ea nu mă rănește.
Esperanto: Mi povas manĝi vitron, ĝi ne damaĝas min. 
Pictish: (NEEDED) 
Breton: (NEEDED)
Cornish: Mý a yl dybry gwéder hag éf ny wra ow ankenya.
Welsh: Dw i'n gallu bwyta gwydr, 'dyw e ddim yn gwneud dolur i mi.
Manx Gaelic: Foddym gee glonney agh cha jean eh gortaghey mee.
Old Irish (Ogham): ᚛᚛ᚉᚑᚅᚔᚉᚉᚔᚋ ᚔᚈᚔ ᚍᚂᚐᚅᚑ ᚅᚔᚋᚌᚓᚅᚐ᚜
Old Irish (Latin): Con·iccim ithi nglano. Ním·géna.
Irish: Is féidir liom gloinne a ithe. Ní dhéanann sí dochar ar bith dom.
Ulster Gaelic: Ithim-sa gloine agus ní miste damh é.
Scottish Gaelic: S urrainn dhomh gloinne ithe; cha ghoirtich i mi.
Anglo-Saxon (Runes): ᛁᚳ᛫ᛗᚨᚷ᛫ᚷᛚᚨᛋ᛫ᛖᚩᛏᚪᚾ᛫ᚩᚾᛞ᛫ᚻᛁᛏ᛫ᚾᛖ᛫ᚻᛖᚪᚱᛗᛁᚪᚧ᛫ᛗᛖ᛬
Anglo-Saxon (Latin): Ic mæg glæs eotan ond hit ne hearmiað me.
Middle English: Ich canne glas eten and hit hirtiþ me nouȝt.
English: I can eat glass and it doesn't hurt me.
English (IPA): [aɪ kæn iːt glɑːs ænd ɪt dɐz nɒt hɜːt miː] (Received Pronunciation)
English (Braille): ⠊⠀⠉⠁⠝⠀⠑⠁⠞⠀⠛⠇⠁⠎⠎⠀⠁⠝⠙⠀⠊⠞⠀⠙⠕⠑⠎⠝⠞⠀⠓⠥⠗⠞⠀⠍⠑
Jamaican: Mi kian niam glas han i neba hot mi.
Lalland Scots / Doric: Ah can eat gless, it disnae hurt us. 
Glaswegian: (NEEDED)
Gothic (4): ЌЌЌ ЌЌЌЍ Ќ̈ЍЌЌ, ЌЌ ЌЌЍ ЍЌ ЌЌЌЌ ЌЍЌЌЌЌЌ.
Old Norse (Runes): ᛖᚴ ᚷᛖᛏ ᛖᛏᛁ ᚧ ᚷᛚᛖᚱ ᛘᚾ ᚦᛖᛋᛋ ᚨᚧ ᚡᛖ ᚱᚧᚨ ᛋᚨᚱ
Old Norse (Latin): Ek get etið gler án þess að verða sár.
Norsk / Norwegian (Nynorsk): Eg kan eta glas utan å skada meg.
Norsk / Norwegian (Bokmål): Jeg kan spise glass uten å skade meg.
Føroyskt / Faroese: Eg kann eta glas, skaðaleysur.
Íslenska / Icelandic: Ég get etið gler án þess að meiða mig.
Svenska / Swedish: Jag kan äta glas utan att skada mig.
Dansk / Danish: Jeg kan spise glas, det gør ikke ondt på mig.
Sønderjysk: Æ ka æe glass uhen at det go mæ naue.
Frysk / Frisian: Ik kin glês ite, it docht me net sear.
Nederlands / Dutch: Ik kan glas eten, het doet mĳ geen kwaad.
Kirchröadsj/Bôchesserplat: Iech ken glaas èèse, mer 't deet miech jing pieng.
Afrikaans: Ek kan glas eet, maar dit doen my nie skade nie.
Lëtzebuergescht / Luxemburgish: Ech kan Glas iessen, daat deet mir nët wei.
Deutsch / German: Ich kann Glas essen, ohne mir zu schaden.
Ruhrdeutsch: Ich kann Glas verkasematuckeln, ohne dattet mich wat jucken tut.
Langenfelder Platt: Isch kann Jlaas kimmeln, uuhne datt mich datt weh dääd.
Lausitzer Mundart ("Lusatian"): Ich koann Gloos assn und doas dudd merr ni wii.
Odenwälderisch: Iech konn glaasch voschbachteln ohne dass es mir ebbs daun doun dud.
Sächsisch / Saxon: 'sch kann Glos essn, ohne dass'sch mer wehtue.
Pfälzisch: Isch konn Glass fresse ohne dasses mer ebbes ausmache dud.
Schwäbisch / Swabian: I kå Glas frässa, ond des macht mr nix!
Deutsch (Voralberg): I ka glas eassa, ohne dass mar weh tuat.
Bayrisch / Bavarian: I koh Glos esa, und es duard ma ned wei.
Allemannisch: I kaun Gloos essen, es tuat ma ned weh.
Schwyzerdütsch (Zürich): Ich chan Glaas ässe, das schadt mir nöd.
Schwyzerdütsch (Luzern): Ech cha Glâs ässe, das schadt mer ned. 
Plautdietsch: (NEEDED)
Hungarian: Meg tudom enni az üveget, nem lesz tőle bajom.
Suomi / Finnish: Voin syödä lasia, se ei vahingoita minua.
Sami (Northern): Sáhtán borrat lása, dat ii leat bávččas.
Erzian: Мон ярсан суликадо, ды зыян эйстэнзэ а ули.
Northern Karelian: Mie voin syvvä lasie ta minla ei ole kipie.
Southern Karelian: Minä voin syvvä st'oklua dai minule ei ole kibie. 
Vepsian: (NEEDED) 
Votian: (NEEDED) 
Livonian: (NEEDED)
Estonian: Ma võin klaasi süüa, see ei tee mulle midagi.
Latvian: Es varu ēst stiklu, tas man nekaitē.
Lithuanian: Aš galiu valgyti stiklą ir jis manęs nežeidžia 
Old Prussian: (NEEDED) 
Sorbian (Wendish): (NEEDED)
Czech: Mohu jíst sklo, neublíží mi.
Slovak: Môžem jesť sklo. Nezraní ma.
Polska / Polish: Mogę jeść szkło i mi nie szkodzi.
Slovenian: Lahko jem steklo, ne da bi mi škodovalo.
Bosnian, Croatian, Montenegrin and Serbian (Latin): Ja mogu jesti staklo, i to mi ne šteti.
Bosnian, Montenegrin and Serbian (Cyrillic): Ја могу јести стакло, и то ми не штети.
Macedonian: Можам да јадам стакло, а не ме штета.
Russian: Я могу есть стекло, оно мне не вредит.
Belarusian (Cyrillic): Я магу есці шкло, яно мне не шкодзіць.
Belarusian (Lacinka): Ja mahu jeści škło, jano mne ne škodzić.
Ukrainian: Я можу їсти скло, і воно мені не зашкодить.
Bulgarian: Мога да ям стъкло, то не ми вреди.
Georgian: მინას ვჭამ და არა მტკივა.
Armenian: Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։
Albanian: Unë mund të ha qelq dhe nuk më gjen gjë.
Turkish: Cam yiyebilirim, bana zararı dokunmaz.
Turkish (Ottoman): جام ييه بلورم بڭا ضررى طوقونمز
Bangla / Bengali: আমি কাঁচ খেতে পারি, তাতে আমার কোনো ক্ষতি হয় না।
Marathi: मी काच खाऊ शकतो, मला ते दुखत नाही.
Kannada: ನನಗೆ ಹಾನಿ ಆಗದೆ, ನಾನು ಗಜನ್ನು ತಿನಬಹುದು
Hindi: मैं काँच खा सकता हूँ और मुझे उससे कोई चोट नहीं पहुंचती.
Tamil: நான் கண்ணாடி சாப்பிடுவேன், அதனால் எனக்கு ஒரு கேடும் வராது.
Telugu: నేను గాజు తినగలను మరియు అలా చేసినా నాకు ఏమి ఇబ్బంది లేదు
Sinhalese: මට වීදුරු කෑමට හැකියි. එයින් මට කිසි හානියක් සිදු නොවේ.
Urdu(3): میں کانچ کھا سکتا ہوں اور مجھے تکلیف نہیں ہوتی ۔
Pashto(3): زه شيشه خوړلې شم، هغه ما نه خوږوي
Farsi / Persian(3): .من می توانم بدونِ احساس درد شيشه بخورم
Arabic(3): أنا قادر على أكل الزجاج و هذا لا يؤلمني. 
Aramaic: (NEEDED)
Maltese: Nista' niekol il-ħġieġ u ma jagħmilli xejn.
Hebrew(3): אני יכול לאכול זכוכית וזה לא מזיק לי.
Yiddish(3): איך קען עסן גלאָז און עס טוט מיר נישט װײ. 
Judeo-Arabic: (NEEDED) 
Ladino: (NEEDED) 
Gǝʼǝz: (NEEDED) 
Amharic: (NEEDED)
Twi: Metumi awe tumpan, ɜnyɜ me hwee.
Hausa (Latin): Inā iya taunar gilāshi kuma in gamā lāfiyā.
Hausa (Ajami) (2): إِنا إِىَ تَونَر غِلَاشِ كُمَ إِن غَمَا لَافِىَا
Yoruba(4): Mo lè je̩ dígí, kò ní pa mí lára.
Lingala: Nakokí kolíya biténi bya milungi, ekosála ngáí mabé tɛ́.
(Ki)Swahili: Naweza kula bilauri na sikunyui.
Malay: Saya boleh makan kaca dan ia tidak mencederakan saya.
Tagalog: Kaya kong kumain nang bubog at hindi ako masaktan.
Chamorro: Siña yo' chumocho krestat, ti ha na'lalamen yo'.
Fijian: Au rawa ni kana iloilo, ia au sega ni vakacacani kina.
Javanese: Aku isa mangan beling tanpa lara.
Burmese: က္ယ္ဝန္‌တော္‌၊က္ယ္ဝန္‌မ မ္ယက္‌စားနုိင္‌သည္‌။ ၎က္ရောင္‌့ ထိခုိက္‌မ္ဟု မရ္ဟိပာ။ (9)
Vietnamese (quốc ngữ): Tôi có thể ăn thủy tinh mà không hại gì.
Vietnamese (nôm) (4): 些 ࣎ 世 咹 水 晶 ও 空 ࣎ 害 咦
Khmer: ខ្ញុំអាចញុំកញ្ចក់បាន ដោយគ្មានបញ្ហារ
Lao: ຂອ້ຍກິນແກ້ວໄດ້ໂດຍທີ່ມັນບໍ່ໄດ້ເຮັດໃຫ້ຂອ້ຍເຈັບ.
Thai: ฉันกินกระจกได้ แต่มันไม่ทำให้ฉันเจ็บ
Mongolian (Cyrillic): Би шил идэй чадна, надад хортой биш
Mongolian (Classic) (5): ᠪᠢ ᠰᠢᠯᠢ ᠢᠳᠡᠶᠦ ᠴᠢᠳᠠᠨᠠ ᠂ ᠨᠠᠳᠤᠷ ᠬᠣᠤᠷᠠᠳᠠᠢ ᠪᠢᠰᠢ 
Dzongkha: (NEEDED)
Nepali: ﻿म काँच खान सक्छू र मलाई केहि नी हुन्‍न् ।
Tibetan: ཤེལ་སྒོ་ཟ་ནས་ང་ན་གི་མ་རེད།
Chinese: 我能吞下玻璃而不伤身体。
Chinese (Traditional): 我能吞下玻璃而不傷身體。
Taiwanese(6): Góa ē-tàng chia̍h po-lê, mā bē tio̍h-siong.
Japanese: 私はガラスを食べられます。それは私を傷つけません。
Korean: 나는 유리를 먹을 수 있어요. 그래도 아프지 않아요
Bislama: Mi save kakae glas, hemi no save katem mi.
Hawaiian: Hiki iaʻu ke ʻai i ke aniani; ʻaʻole nō lā au e ʻeha.
Marquesan: E koʻana e kai i te karahi, mea ʻā, ʻaʻe hauhau.
Inuktitut (10): ᐊᓕᒍᖅ ᓂᕆᔭᕌᖓᒃᑯ ᓱᕋᙱᑦᑐᓐᓇᖅᑐᖓ
Chinook Jargon: Naika məkmək kakshət labutay, pi weyk ukuk munk-sik nay.
Navajo: Tsésǫʼ yishą́ągo bííníshghah dóó doo shił neezgai da. 
Cherokee (and Cree, Chickasaw, Cree, Micmac, Ojibwa, Lakota, Náhuatl, Quechua, Aymara, and other American languages): (NEEDED) 
Garifuna: (NEEDED) 
Gullah: (NEEDED)
Lojban: mi kakne le nu citka le blaci .iku'i le se go'i na xrani mi
Nórdicg: Ljœr ye caudran créneþ ý jor cẃran.
EOT
));
// spell-checker: enable
?>
</p>

*/