<?php

class StoreCountry extends StoreRegion {
	/** @var string */
	public $isoCode3 = null;
	/** @var StoreRegion[] */
	public $regions = array();

	public function setISOCode3($code) {
		$this->isoCode3 = $code;
		return $this;
	}

	/**
	 * @param StoreRegion $region
	 * @return StoreCountry
	 */
	public function addRegion(StoreRegion $region) {
		$this->regions[] = $region;
		return $this;
	}
	
	/**
	 * @param string $code country code.
	 * @return StoreCountry
	 */
	public static function findByCode($code) {
		if ($code) foreach (self::buildList() as $li) {
			if ($li->code == $code) return $li;
		}
		return null;
	}

	/**
	 * @param string $isoCode3 country code.
	 * @return StoreCountry
	 */
	public static function findByIsoCode3($isoCode3) {
		if ($isoCode3) foreach (self::buildList() as $li) {
			if ($li->isoCode3 == $isoCode3) return $li;
		}
		return null;
	}


	/**
	 * @param string $countryCode country code.
	 * @param string $regionName region name.
	 * @return array
	 */
	public static function findCountryAndRegion($countryCode, $regionName) {
		$country = $region = null;
		if ($countryCode) {
			foreach (self::buildList() as $li) {
				if ($li->code == $countryCode) {
					$country = $li;
					if( $regionName ) {
						foreach( $country->regions as $r ) {
							if( $r->name == $regionName ) {
								$region = $r;
								break;
							}
						}
					}
					break;
				}
			}
		}
		return array($country, $region);
	}

	/** @return StoreCountry[] */
	public static function buildList() {
		$list = array(
			StoreCountry::create('AF', 'Афганистан')->setISOCode3('AFG'),
			StoreCountry::create('AX', 'Аландские о-ва')->setISOCode3('ALA'),
			StoreCountry::create('AL', 'Албания')->setISOCode3('ALB'),
			StoreCountry::create('DZ', 'Алжир')->setISOCode3('DZA'),
			StoreCountry::create('AS', 'Американское Самоа')->setISOCode3('ASM'),
			StoreCountry::create('AD', 'Андорра')->setISOCode3('AND'),
			StoreCountry::create('AO', 'Ангола')->setISOCode3('AGO'),
			StoreCountry::create('AI', 'Ангилья')->setISOCode3('AIA'),
			StoreCountry::create('AQ', 'Антарктида')->setISOCode3('ATA'),
			StoreCountry::create('AG', 'Антигуа и Барбуда')->setISOCode3('ATG'),
			StoreCountry::create('AR', 'Аргентина')->setISOCode3('ARG'),
			StoreCountry::create('AM', 'Армения')->setISOCode3('ARM'),
			StoreCountry::create('AW', 'Аруба')->setISOCode3('ABW'),
			StoreCountry::create('AU', 'Австралия')->setISOCode3('AUS'),
			StoreCountry::create('AT', 'Австрия')->setISOCode3('AUT'),
			StoreCountry::create('AZ', 'Азербайджан')->setISOCode3('AZE'),
			StoreCountry::create('BS', 'Багамские о-ва')->setISOCode3('BHS'),
			StoreCountry::create('BH', 'Бахрейн')->setISOCode3('BHR'),
			StoreCountry::create('BD', 'Бангладеш')->setISOCode3('BGD'),
			StoreCountry::create('BB', 'Барбадос')->setISOCode3('BRB'),
			StoreCountry::create('BY', 'Беларусь')->setISOCode3('BLR')
				->addRegion(new StoreRegion('HM', 'Город Минск'))
				->addRegion(new StoreRegion('BR', 'Брестская область'))
				->addRegion(new StoreRegion('HO', 'Гомельская область'))
				->addRegion(new StoreRegion('HR', 'Гродненская область'))
				->addRegion(new StoreRegion('MA', 'Могилёвская область'))
				->addRegion(new StoreRegion('MI', 'Минская область'))
				->addRegion(new StoreRegion('VI', 'Витебская область')),
			StoreCountry::create('BE', 'Бельгия')->setISOCode3('BEL'),
			StoreCountry::create('BZ', 'Белиз')->setISOCode3('BLZ'),
			StoreCountry::create('BJ', 'Бенин')->setISOCode3('BEN'),
			StoreCountry::create('BM', 'Бермудские о-ва')->setISOCode3('BMU'),
			StoreCountry::create('BT', 'Бутан')->setISOCode3('BTN'),
			StoreCountry::create('BO', 'Боливия')->setISOCode3('BOL'),
			StoreCountry::create('BA', 'Босния и Герцеговина')->setISOCode3('BIH'),
			StoreCountry::create('BW', 'Ботсвана')->setISOCode3('BWA'),
			StoreCountry::create('BV', 'Остров Буве')->setISOCode3('BVT'),
			StoreCountry::create('BR', 'Бразилия')->setISOCode3('BRA'),
			StoreCountry::create('BQ', 'Бонэйр, Синт-Эстатиус и Саба')->setISOCode3('BES'),
			StoreCountry::create('IO', 'Британская территория в Индийском океане')->setISOCode3('IOT'),
			StoreCountry::create('VG', 'Виргинские о-ва (Британские)')->setISOCode3('VGB'),
			StoreCountry::create('BN', 'Бруней-Даруссалам')->setISOCode3('BRN'),
			StoreCountry::create('BG', 'Болгария')->setISOCode3('BGR'),
			StoreCountry::create('BF', 'Буркина-Фасо')->setISOCode3('BFA'),
			StoreCountry::create('BI', 'Бурунди')->setISOCode3('BDI'),
			StoreCountry::create('KH', 'Камбоджа')->setISOCode3('KHM'),
			StoreCountry::create('CM', 'Камерун')->setISOCode3('CMR'),
			StoreCountry::create('CA', 'Канада')->setISOCode3('CAN')
				->addRegion(new StoreRegion('ON', 'Онтарио'))
				->addRegion(new StoreRegion('QC', 'Квебек'))
				->addRegion(new StoreRegion('NS', 'Новая Шотландия'))
				->addRegion(new StoreRegion('NB', 'Нью-Брансуик'))
				->addRegion(new StoreRegion('MB', 'Манитоба'))
				->addRegion(new StoreRegion('BC', 'Британская Колумбия'))
				->addRegion(new StoreRegion('PE', 'Остров Принца Эдуарда'))
				->addRegion(new StoreRegion('SK', 'Саскачеван'))
				->addRegion(new StoreRegion('AB', 'Альберта'))
				->addRegion(new StoreRegion('NL', 'Ньюфаундленд и Лабрадор'))
				->addRegion(new StoreRegion('NT', 'Северо-западные территории'))
				->addRegion(new StoreRegion('YT', 'Юкон'))
				->addRegion(new StoreRegion('NU', 'Нунавут')),
			StoreCountry::create('CV', 'Кабо-Верде')->setISOCode3('CPV'),
			StoreCountry::create('KY', 'Каймановы о-ва')->setISOCode3('CYM'),
			StoreCountry::create('CF', 'ЦАР')->setISOCode3('CAF'),
			StoreCountry::create('TD', 'Чад')->setISOCode3('TCD'),
			StoreCountry::create('CL', 'Чили')->setISOCode3('CHL'),
			StoreCountry::create('CN', 'Китай')->setISOCode3('CHN'),
			StoreCountry::create('CX', 'о-в Рождества')->setISOCode3('CXR'),
			StoreCountry::create('CO', 'Колумбия')->setISOCode3('COL'),
			StoreCountry::create('KM', 'Коморские о-ва')->setISOCode3('COM'),
			StoreCountry::create('CG', 'Конго - Браззавиль')->setISOCode3('COG'),
			StoreCountry::create('CD', 'Конго - Киншаса')->setISOCode3('COD'),
			StoreCountry::create('CK', 'о-ва Кука')->setISOCode3('COK'),
			StoreCountry::create('CR', 'Коста-Рика')->setISOCode3('CRI'),
			StoreCountry::create('CI', 'Кот-д’Ивуар')->setISOCode3('CIV'),
			StoreCountry::create('HR', 'Хорватия')->setISOCode3('HRV'),
			StoreCountry::create('CU', 'Куба')->setISOCode3('CUB'),
			StoreCountry::create('CY', 'Кипр')->setISOCode3('CYP'),
			StoreCountry::create('CZ', 'Чехия')->setISOCode3('CZE'),
			StoreCountry::create('DK', 'Дания')->setISOCode3('DNK'),
			StoreCountry::create('DJ', 'Джибути')->setISOCode3('DJI'),
			StoreCountry::create('DM', 'Доминика')->setISOCode3('DMA'),
			StoreCountry::create('DO', 'Доминиканская Республика')->setISOCode3('DOM'),
			StoreCountry::create('EC', 'Эквадор')->setISOCode3('ECU'),
			StoreCountry::create('EG', 'Египет')->setISOCode3('EGY'),
			StoreCountry::create('SV', 'Сальвадор')->setISOCode3('SLV'),
			StoreCountry::create('GQ', 'Экваториальная Гвинея')->setISOCode3('GNQ'),
			StoreCountry::create('ER', 'Эритрея')->setISOCode3('ERI'),
			StoreCountry::create('EE', 'Эстония')->setISOCode3('EST'),
			StoreCountry::create('ET', 'Эфиопия')->setISOCode3('ETH'),
			StoreCountry::create('FK', 'Фолклендские о-ва')->setISOCode3('FLK'),
			StoreCountry::create('FO', 'Фарерские о-ва')->setISOCode3('FRO'),
			StoreCountry::create('FJ', 'Фиджи')->setISOCode3('FJI'),
			StoreCountry::create('FI', 'Финляндия')->setISOCode3('FIN'),
			StoreCountry::create('FR', 'Франция')->setISOCode3('FRA'),
			StoreCountry::create('GF', 'Французская Гвиана')->setISOCode3('GUF'),
			StoreCountry::create('PF', 'Французская Полинезия')->setISOCode3('PYF'),
			StoreCountry::create('TF', 'Французские Южные Территории')->setISOCode3('ATF'),
			StoreCountry::create('GA', 'Габон')->setISOCode3('GAB'),
			StoreCountry::create('GM', 'Гамбия')->setISOCode3('GMB'),
			StoreCountry::create('GE', 'Грузия')->setISOCode3('GEO'),
			StoreCountry::create('DE', 'Германия')->setISOCode3('DEU'),
			StoreCountry::create('GH', 'Гана')->setISOCode3('GHA'),
			StoreCountry::create('GI', 'Гибралтар')->setISOCode3('GIB'),
			StoreCountry::create('GR', 'Греция')->setISOCode3('GRC'),
			StoreCountry::create('GL', 'Гренландия')->setISOCode3('GRL'),
			StoreCountry::create('GD', 'Гренада')->setISOCode3('GRD'),
			StoreCountry::create('GP', 'Гваделупа')->setISOCode3('GLP'),
			StoreCountry::create('GU', 'Гуам')->setISOCode3('GUM'),
			StoreCountry::create('GT', 'Гватемала')->setISOCode3('GTM'),
			StoreCountry::create('GG', 'Гернси')->setISOCode3('GGY'),
			StoreCountry::create('GN', 'Гвинея')->setISOCode3('GIN'),
			StoreCountry::create('GW', 'Гвинея-Бисау')->setISOCode3('GNB'),
			StoreCountry::create('GY', 'Гайана')->setISOCode3('GUY'),
			StoreCountry::create('HT', 'Гаити')->setISOCode3('HTI'),
			StoreCountry::create('HM', 'Остров Херд и острова Макдональд')->setISOCode3('HMD'),
			StoreCountry::create('HN', 'Гондурас')->setISOCode3('HND'),
			StoreCountry::create('HK', 'Гонконг (особый район)')->setISOCode3('HKG'),
			StoreCountry::create('HU', 'Венгрия')->setISOCode3('HUN'),
			StoreCountry::create('IS', 'Исландия')->setISOCode3('ISL'),
			StoreCountry::create('IN', 'Индия')->setISOCode3('IND'),
			StoreCountry::create('ID', 'Индонезия')->setISOCode3('IDN'),
			StoreCountry::create('IR', 'Иран')->setISOCode3('IRN'),
			StoreCountry::create('IQ', 'Ирак')->setISOCode3('IRQ'),
			StoreCountry::create('IE', 'Ирландия')->setISOCode3('IRL'),
			StoreCountry::create('IM', 'О-в Мэн')->setISOCode3('IMN'),
			StoreCountry::create('IL', 'Израиль')->setISOCode3('ISR'),
			StoreCountry::create('IT', 'Италия')->setISOCode3('ITA'),
			StoreCountry::create('JM', 'Ямайка')->setISOCode3('JAM'),
			StoreCountry::create('JP', 'Япония')->setISOCode3('JPN'),
			StoreCountry::create('JE', 'Джерси')->setISOCode3('JEY'),
			StoreCountry::create('JO', 'Иордания')->setISOCode3('JOR'),
			StoreCountry::create('KZ', 'Казахстан')->setISOCode3('KAZ')
				->addRegion(new StoreRegion('ABA', 'Абайский район'))
				->addRegion(new StoreRegion('AKM', 'Акмолинская область'))
				->addRegion(new StoreRegion('AKT', 'Актюбинская область'))
				->addRegion(new StoreRegion('ALA', 'Алматы'))
				->addRegion(new StoreRegion('ALM', 'Алматинская область'))
				->addRegion(new StoreRegion('ATY', 'Атырауская область'))
				->addRegion(new StoreRegion('BAY', 'Байконур'))
				->addRegion(new StoreRegion('VOS', 'Восточно-Казахстанская область'))
				->addRegion(new StoreRegion('ZHA', 'Жамбылская область'))
				->addRegion(new StoreRegion('JET', 'Джетисуский район'))
				->addRegion(new StoreRegion('KAR', 'Карагандинская область'))
				->addRegion(new StoreRegion('KUS', 'Костанайская область'))
				->addRegion(new StoreRegion('KZY', 'Кызылординская область'))
				->addRegion(new StoreRegion('MAN', 'Мангистауская область'))
				->addRegion(new StoreRegion('SEV', 'Северо-Казахстанская область'))
				->addRegion(new StoreRegion('AST', 'Нур-Султан'))
				->addRegion(new StoreRegion('PAV', 'Павлодарская область'))
				->addRegion(new StoreRegion('SHY', 'Шымкент'))
				->addRegion(new StoreRegion('YUZ', 'Туркестанская область'))
				->addRegion(new StoreRegion('ULY', 'Улытауский район'))
				->addRegion(new StoreRegion('ZAP', 'Западно-Казахстанская область')),
			StoreCountry::create('KE', 'Кения')->setISOCode3('KEN'),
			StoreCountry::create('KI', 'Кирибати')->setISOCode3('KIR'),
			StoreCountry::create('KW', 'Кувейт')->setISOCode3('KWT'),
			StoreCountry::create('KG', 'Киргизия')->setISOCode3('KGZ'),
			StoreCountry::create('LA', 'Лаос')->setISOCode3('LAO'),
			StoreCountry::create('LV', 'Латвия')->setISOCode3('LVA'),
			StoreCountry::create('LB', 'Ливан')->setISOCode3('LBN'),
			StoreCountry::create('LS', 'Лесото')->setISOCode3('LSO'),
			StoreCountry::create('LR', 'Либерия')->setISOCode3('LBR'),
			StoreCountry::create('LY', 'Ливия')->setISOCode3('LBY'),
			StoreCountry::create('LI', 'Лихтенштейн')->setISOCode3('LIE'),
			StoreCountry::create('LT', 'Литва')->setISOCode3('LTU'),
			StoreCountry::create('LU', 'Люксембург')->setISOCode3('LUX'),
			StoreCountry::create('MO', 'Макао (особый район)')->setISOCode3('MAC'),
			StoreCountry::create('MK', 'Северная Македония')->setISOCode3('MKD'),
			StoreCountry::create('MG', 'Мадагаскар')->setISOCode3('MDG'),
			StoreCountry::create('MW', 'Малави')->setISOCode3('MWI'),
			StoreCountry::create('MY', 'Малайзия')->setISOCode3('MYS'),
			StoreCountry::create('MV', 'Мальдивские о-ва')->setISOCode3('MDV'),
			StoreCountry::create('ML', 'Мали')->setISOCode3('MLI'),
			StoreCountry::create('MT', 'Мальта')->setISOCode3('MLT'),
			StoreCountry::create('MH', 'Маршалловы о-ва')->setISOCode3('MHL'),
			StoreCountry::create('MQ', 'Мартиника')->setISOCode3('MTQ'),
			StoreCountry::create('MR', 'Мавритания')->setISOCode3('MRT'),
			StoreCountry::create('MU', 'Маврикий')->setISOCode3('MUS'),
			StoreCountry::create('YT', 'Майотта')->setISOCode3('MYT'),
			StoreCountry::create('MX', 'Мексика')->setISOCode3('MEX'),
			StoreCountry::create('FM', 'Федеративные Штаты Микронезии')->setISOCode3('FSM'),
			StoreCountry::create('MD', 'Молдова')->setISOCode3('MDA'),
			StoreCountry::create('MC', 'Монако')->setISOCode3('MCO'),
			StoreCountry::create('MN', 'Монголия')->setISOCode3('MNG'),
			StoreCountry::create('ME', 'Черногория')->setISOCode3('MNE'),
			StoreCountry::create('MS', 'Монтсеррат')->setISOCode3('MSR'),
			StoreCountry::create('MA', 'Марокко')->setISOCode3('MAR'),
			StoreCountry::create('MZ', 'Мозамбик')->setISOCode3('MOZ'),
			StoreCountry::create('MM', 'Мьянма (Бирма)')->setISOCode3('MMR'),
			StoreCountry::create('NA', 'Намибия')->setISOCode3('NAM'),
			StoreCountry::create('NR', 'Науру')->setISOCode3('NRU'),
			StoreCountry::create('NP', 'Непал')->setISOCode3('NPL'),
			StoreCountry::create('NL', 'Нидерланды')->setISOCode3('NLD'),
			StoreCountry::create('NC', 'Новая Каледония')->setISOCode3('NCL'),
			StoreCountry::create('NZ', 'Новая Зеландия')->setISOCode3('NZL'),
			StoreCountry::create('NI', 'Никарагуа')->setISOCode3('NIC'),
			StoreCountry::create('NE', 'Нигер')->setISOCode3('NER'),
			StoreCountry::create('NG', 'Нигерия')->setISOCode3('NGA')
				->addRegion(new StoreRegion('AB', 'Abia'))
				->addRegion(new StoreRegion('AD', 'Adamawa'))
				->addRegion(new StoreRegion('AK', 'Akwa Ibom'))
				->addRegion(new StoreRegion('AN', 'Anambra'))
				->addRegion(new StoreRegion('BA', 'Bauchi'))
				->addRegion(new StoreRegion('BY', 'Bayelsa'))
				->addRegion(new StoreRegion('BE', 'Benue'))
				->addRegion(new StoreRegion('BO', 'Borno'))
				->addRegion(new StoreRegion('CR', 'Cross River'))
				->addRegion(new StoreRegion('DE', 'Delta'))
				->addRegion(new StoreRegion('EB', 'Ebonyi'))
				->addRegion(new StoreRegion('ED', 'Edo'))
				->addRegion(new StoreRegion('EK', 'Ekiti'))
				->addRegion(new StoreRegion('EN', 'Enugu'))
				->addRegion(new StoreRegion('GO', 'Gombe'))
				->addRegion(new StoreRegion('IM', 'Imo'))
				->addRegion(new StoreRegion('JI', 'Jigawa'))
				->addRegion(new StoreRegion('KD', 'Kaduna'))
				->addRegion(new StoreRegion('KN', 'Kano'))
				->addRegion(new StoreRegion('KT', 'Katsina'))
				->addRegion(new StoreRegion('KE', 'Kebbi'))
				->addRegion(new StoreRegion('KO', 'Kogi'))
				->addRegion(new StoreRegion('KW', 'Kwara'))
				->addRegion(new StoreRegion('LA', 'Lagos'))
				->addRegion(new StoreRegion('NA', 'Nasarawa'))
				->addRegion(new StoreRegion('NI', 'Niger'))
				->addRegion(new StoreRegion('OG', 'Ogun'))
				->addRegion(new StoreRegion('ON', 'Ondo'))
				->addRegion(new StoreRegion('OS', 'Osun'))
				->addRegion(new StoreRegion('OY', 'Oyo'))
				->addRegion(new StoreRegion('PL', 'Plateau'))
				->addRegion(new StoreRegion('RI', 'Rivers'))
				->addRegion(new StoreRegion('SO', 'Sokoto'))
				->addRegion(new StoreRegion('TA', 'Taraba'))
				->addRegion(new StoreRegion('YO', 'Yobe'))
				->addRegion(new StoreRegion('ZA', 'Zamfara')),
			StoreCountry::create('NU', 'Ниуэ')->setISOCode3('NIU'),
			StoreCountry::create('NF', 'о-в Норфолк')->setISOCode3('NFK'),
			StoreCountry::create('KP', 'КНДР')->setISOCode3('PRK'),
			StoreCountry::create('MP', 'Северные Марианские о-ва')->setISOCode3('MNP'),
			StoreCountry::create('NO', 'Норвегия')->setISOCode3('NOR'),
			StoreCountry::create('OM', 'Оман')->setISOCode3('OMN'),
			StoreCountry::create('PK', 'Пакистан')->setISOCode3('PAK'),
			StoreCountry::create('PW', 'Палау')->setISOCode3('PLW'),
			StoreCountry::create('PS', 'Palestinian Territories')->setISOCode3('PSE'),
			StoreCountry::create('PA', 'Панама')->setISOCode3('PAN'),
			StoreCountry::create('PG', 'Папуа – Новая Гвинея')->setISOCode3('PNG'),
			StoreCountry::create('PY', 'Парагвай')->setISOCode3('PRY'),
			StoreCountry::create('PE', 'Перу')->setISOCode3('PER'),
			StoreCountry::create('PH', 'Филиппины')->setISOCode3('PHL'),
			StoreCountry::create('PL', 'Польша')->setISOCode3('POL'),
			StoreCountry::create('PT', 'Португалия')->setISOCode3('PRT'),
			StoreCountry::create('PR', 'Пуэрто-Рико')->setISOCode3('PRI'),
			StoreCountry::create('QA', 'Катар')->setISOCode3('QAT'),
			StoreCountry::create('RE', 'Реюньон')->setISOCode3('REU'),
			StoreCountry::create('RO', 'Румыния')->setISOCode3('ROU'),
			StoreCountry::create('RU', 'Россия')->setISOCode3('RUS'),
			StoreCountry::create('RW', 'Руанда')->setISOCode3('RWA'),
			StoreCountry::create('BL', 'Сен-Бартельми')->setISOCode3('BLM'),
			StoreCountry::create('SH', 'О-в Св. Елены')->setISOCode3('SHN'),
			StoreCountry::create('KN', 'Сент-Китс и Невис')->setISOCode3('KNA'),
			StoreCountry::create('LC', 'Сент-Люсия')->setISOCode3('LCA'),
			StoreCountry::create('MF', 'Сен-Мартен')->setISOCode3('MAF'),
			StoreCountry::create('PM', 'Сен-Пьер и Микелон')->setISOCode3('SPM'),
			StoreCountry::create('VC', 'Сент-Винсент и Гренадины')->setISOCode3('VCT'),
			StoreCountry::create('WS', 'Самоа')->setISOCode3('WSM'),
			StoreCountry::create('SM', 'Сан-Марино')->setISOCode3('SMR'),
			StoreCountry::create('ST', 'Сан-Томе и Принсипи')->setISOCode3('STP'),
			StoreCountry::create('SA', 'Саудовская Аравия')->setISOCode3('SAU'),
			StoreCountry::create('SN', 'Сенегал')->setISOCode3('SEN'),
			StoreCountry::create('RS', 'Сербия')->setISOCode3('SRB'),
			StoreCountry::create('SC', 'Сейшельские о-ва')->setISOCode3('SYC'),
			StoreCountry::create('SL', 'Сьерра-Леоне')->setISOCode3('SLE'),
			StoreCountry::create('SG', 'Сингапур')->setISOCode3('SGP'),
			StoreCountry::create('SK', 'Словакия')->setISOCode3('SVK'),
			StoreCountry::create('SI', 'Словения')->setISOCode3('SVN'),
			StoreCountry::create('SB', 'Соломоновы о-ва')->setISOCode3('SLB'),
			StoreCountry::create('SO', 'Сомали')->setISOCode3('SOM'),
			StoreCountry::create('ZA', 'ЮАР')->setISOCode3('ZAF'),
			StoreCountry::create('GS', 'Южная Георгия и Южные Сандвичевы о-ва')->setISOCode3('SGS'),
			StoreCountry::create('KR', 'Республика Корея')->setISOCode3('KOR'),
			StoreCountry::create('ES', 'Испания')->setISOCode3('ESP')
				->addRegion(new StoreRegion('VI', 'Álava'))
				->addRegion(new StoreRegion('AB', 'Albacete'))
				->addRegion(new StoreRegion('A', 'Alicante'))
				->addRegion(new StoreRegion('AL', 'Almería'))
				->addRegion(new StoreRegion('O', 'Asturias'))
				->addRegion(new StoreRegion('AV', 'Ávila'))
				->addRegion(new StoreRegion('BA', 'Badajoz'))
				->addRegion(new StoreRegion('B', 'Barcelona'))
				->addRegion(new StoreRegion('BU', 'Burgos'))
				->addRegion(new StoreRegion('CC', 'Cáceres'))
				->addRegion(new StoreRegion('CA', 'Cádiz'))
				->addRegion(new StoreRegion('S', 'Cantabria'))
				->addRegion(new StoreRegion('CS', 'Castellón de la Plana'))
				->addRegion(new StoreRegion('CE', 'Ceuta'))
				->addRegion(new StoreRegion('CR', 'Ciudad Real'))
				->addRegion(new StoreRegion('CO', 'Córdoba'))
				->addRegion(new StoreRegion('CU', 'Cuenca'))
				->addRegion(new StoreRegion('GI', 'Gerona'))
				->addRegion(new StoreRegion('GR', 'Granada'))
				->addRegion(new StoreRegion('GU', 'Guadalajara'))
				->addRegion(new StoreRegion('SS', 'Guipúzcoa'))
				->addRegion(new StoreRegion('H', 'Huelva'))
				->addRegion(new StoreRegion('HU', 'Huesca'))
				->addRegion(new StoreRegion('PM', 'Islas Baleares'))
				->addRegion(new StoreRegion('J', 'Jaén'))
				->addRegion(new StoreRegion('C', 'La Coruña'))
				->addRegion(new StoreRegion('LO', 'La Rioja'))
				->addRegion(new StoreRegion('GC', 'Las Palmas (Islas Canarias)'))
				->addRegion(new StoreRegion('LE', 'León'))
				->addRegion(new StoreRegion('L', 'Lérida'))
				->addRegion(new StoreRegion('LU', 'Lugo'))
				->addRegion(new StoreRegion('M', 'Madrid'))
				->addRegion(new StoreRegion('MA', 'Málaga'))
				->addRegion(new StoreRegion('ML', 'Melilla'))
				->addRegion(new StoreRegion('MU', 'Murcia'))
				->addRegion(new StoreRegion('NA', 'Navarra'))
				->addRegion(new StoreRegion('OR', 'Orense'))
				->addRegion(new StoreRegion('P', 'Palencia'))
				->addRegion(new StoreRegion('PO', 'Pontevedra'))
				->addRegion(new StoreRegion('SA', 'Salamanca'))
				->addRegion(new StoreRegion('TF', 'Santa Cruz de Tenerife (Islas Canarias)'))
				->addRegion(new StoreRegion('SG', 'Segovia'))
				->addRegion(new StoreRegion('SE', 'Sevilla'))
				->addRegion(new StoreRegion('SO', 'Soria'))
				->addRegion(new StoreRegion('T', 'Tarragona'))
				->addRegion(new StoreRegion('TE', 'Teruel'))
				->addRegion(new StoreRegion('TO', 'Toledo'))
				->addRegion(new StoreRegion('V', 'Valencia'))
				->addRegion(new StoreRegion('VA', 'Valladolid'))
				->addRegion(new StoreRegion('BI', 'Vizcaya'))
				->addRegion(new StoreRegion('ZA', 'Zamora'))
				->addRegion(new StoreRegion('Z', 'Zaragoza')),
			StoreCountry::create('LK', 'Шри-Ланка')->setISOCode3('LKA'),
			StoreCountry::create('SD', 'Судан')->setISOCode3('SDN'),
			StoreCountry::create('SR', 'Суринам')->setISOCode3('SUR'),
			StoreCountry::create('SZ', 'Эсватини (Свазиленд)')->setISOCode3('SWZ'),
			StoreCountry::create('SE', 'Швеция')->setISOCode3('SWE'),
			StoreCountry::create('CH', 'Швейцария')->setISOCode3('CHE'),
			StoreCountry::create('SY', 'Сирия')->setISOCode3('SYR'),
			StoreCountry::create('TW', 'Тайвань')->setISOCode3('TWN'),
			StoreCountry::create('TJ', 'Таджикистан')->setISOCode3('TJK'),
			StoreCountry::create('TZ', 'Танзания')->setISOCode3('TZA'),
			StoreCountry::create('TH', 'Таиланд')->setISOCode3('THA'),
			StoreCountry::create('TL', 'Восточный Тимор')->setISOCode3('TLS'),
			StoreCountry::create('TG', 'Того')->setISOCode3('TGO'),
			StoreCountry::create('TK', 'Токелау')->setISOCode3('TKL'),
			StoreCountry::create('TO', 'Тонга')->setISOCode3('TON'),
			StoreCountry::create('TT', 'Тринидад и Тобаго')->setISOCode3('TTO'),
			StoreCountry::create('TN', 'Тунис')->setISOCode3('TUN'),
			StoreCountry::create('TR', 'Турция')->setISOCode3('TUR'),
			StoreCountry::create('TM', 'Туркменистан')->setISOCode3('TKM'),
			StoreCountry::create('TC', 'О-ва Тёркс и Кайкос')->setISOCode3('TCA'),
			StoreCountry::create('TV', 'Тувалу')->setISOCode3('TUV'),
			StoreCountry::create('UM', 'Внешние малые о-ва (США)')->setISOCode3('UMI'),
			StoreCountry::create('VI', 'Виргинские о-ва (США)')->setISOCode3('VIR'),
			StoreCountry::create('UG', 'Уганда')->setISOCode3('UGA'),
			StoreCountry::create('UA', 'Украина')->setISOCode3('UKR'),
			StoreCountry::create('AE', 'ОАЭ')->setISOCode3('ARE'),
			StoreCountry::create('GB', 'Великобритания')->setISOCode3('GBR'),
			StoreCountry::create('US', 'США')->setISOCode3('USA')
				->addRegion(new StoreRegion('AL', 'Алабама'))
				->addRegion(new StoreRegion('AK', 'Аляска'))
				->addRegion(new StoreRegion('AZ', 'Аризона'))
				->addRegion(new StoreRegion('AR', 'Арканзас'))
				->addRegion(new StoreRegion('CA', 'Калифорния'))
				->addRegion(new StoreRegion('CO', 'Колорадо'))
				->addRegion(new StoreRegion('CT', 'Коннектикут'))
				->addRegion(new StoreRegion('DE', 'Делавэр'))
				->addRegion(new StoreRegion('FL', 'Флорида'))
				->addRegion(new StoreRegion('GA', 'Джорджия'))
				->addRegion(new StoreRegion('HI', 'Гавайи'))
				->addRegion(new StoreRegion('ID', 'Айдахо'))
				->addRegion(new StoreRegion('IL', 'Иллинойс'))
				->addRegion(new StoreRegion('IN', 'Индиана'))
				->addRegion(new StoreRegion('IA', 'Айова'))
				->addRegion(new StoreRegion('KS', 'Канзас'))
				->addRegion(new StoreRegion('KY', 'Кентукки'))
				->addRegion(new StoreRegion('LA', 'Луизиана'))
				->addRegion(new StoreRegion('ME', 'Мэн'))
				->addRegion(new StoreRegion('MD', 'Мэриленд'))
				->addRegion(new StoreRegion('MA', 'Массачусетс'))
				->addRegion(new StoreRegion('MI', 'Мичиган'))
				->addRegion(new StoreRegion('MN', 'Миннесота'))
				->addRegion(new StoreRegion('MS', 'Миссисипи'))
				->addRegion(new StoreRegion('MO', 'Миссури'))
				->addRegion(new StoreRegion('MT', 'Монтана'))
				->addRegion(new StoreRegion('NE', 'Небраска'))
				->addRegion(new StoreRegion('NV', 'Невада'))
				->addRegion(new StoreRegion('NH', 'Нью-Гемпшир'))
				->addRegion(new StoreRegion('NJ', 'Нью-Джерси'))
				->addRegion(new StoreRegion('NM', 'Нью-Мексико'))
				->addRegion(new StoreRegion('NY', 'Нью-Йорк'))
				->addRegion(new StoreRegion('NC', 'Северная Каролина'))
				->addRegion(new StoreRegion('ND', 'Северная Дакота'))
				->addRegion(new StoreRegion('OH', 'Огайо'))
				->addRegion(new StoreRegion('OK', 'Оклахома'))
				->addRegion(new StoreRegion('OR', 'Орегон'))
				->addRegion(new StoreRegion('PA', 'Пенсильвания'))
				->addRegion(new StoreRegion('RI', 'Род-Айленд'))
				->addRegion(new StoreRegion('SC', 'Южная Каролина'))
				->addRegion(new StoreRegion('SD', 'Северная Дакота'))
				->addRegion(new StoreRegion('TN', 'Теннесси'))
				->addRegion(new StoreRegion('TX', 'Техас'))
				->addRegion(new StoreRegion('UT', 'Юта'))
				->addRegion(new StoreRegion('VT', 'Вермонт'))
				->addRegion(new StoreRegion('VA', 'Вирджиния'))
				->addRegion(new StoreRegion('WA', 'Вашингтон'))
				->addRegion(new StoreRegion('DC', 'Вашингтон (округ Колумбия)'))
				->addRegion(new StoreRegion('WV', 'Западная Виргиния'))
				->addRegion(new StoreRegion('WI', 'Висконсин'))
				->addRegion(new StoreRegion('WY', 'Вайоминг')),
			StoreCountry::create('UY', 'Уругвай')->setISOCode3('URY'),
			StoreCountry::create('UZ', 'Узбекистан')->setISOCode3('UZB'),
			StoreCountry::create('VU', 'Вануату')->setISOCode3('VUT'),
			StoreCountry::create('VA', 'Ватикан')->setISOCode3('VAT'),
			StoreCountry::create('VE', 'Венесуэла')->setISOCode3('VEN'),
			StoreCountry::create('VN', 'Вьетнам')->setISOCode3('VNM'),
			StoreCountry::create('WF', 'Уоллис и Футуна')->setISOCode3('WLF'),
			StoreCountry::create('EH', 'Западная Сахара')->setISOCode3('ESH'),
			StoreCountry::create('YE', 'Йемен')->setISOCode3('YEM'),
			StoreCountry::create('ZM', 'Замбия')->setISOCode3('ZMB'),
			StoreCountry::create('ZW', 'Зимбабве')->setISOCode3('ZWE')
		);
		usort($list, function(StoreCountry $a, StoreCountry $b) {
			return ($a->name > $b->name) ? 1 : -1;
		});
		return $list;
	}
	
}
