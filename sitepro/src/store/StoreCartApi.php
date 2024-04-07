<?php

class StoreCartApi {
	const PHONE_FIELD_VISIBLE = true;
	const PHONE_FIELD_REQUIRED = true;

	protected function calcTotalsAction(StoreNavigation $request) {
		$data = $request->getBodyAsJson();
		if (!is_object($data) || !$data) $data = (object) array();
		
		$res = new StoreCartTotals();
		
		$discountOnly = (isset($data->discountOnly) && $data->discountOnly);
		$modified = false;
		$cartData = StoreData::getCartData(0);
		$tmpShippingMethodId = $cartData->shippingMethodId;
		if (isset($data->shippingMethodId)) {
			$cartData->shippingMethodId = $data->shippingMethodId;
			if ($tmpShippingMethodId != $cartData->shippingMethodId) $modified = true;
		}
		$prevCouponCode = $cartData->couponCode;
		if (isset($data->couponCode) && is_string($data->couponCode)) {
			$cartData->couponCode = '';
			foreach (StoreData::getCoupons() as $c) {
				if ($c->code == $data->couponCode) {
					$cartData->couponCode = $c->code;
					break;
				}
			}
			if ($prevCouponCode != $cartData->couponCode) $modified = true;
			if (!$cartData->couponCode && $data->couponCode) {
				$res->couponError = StoreModule::__("Invalid coupon code");
			}
		}
		
		self::calcTaxesAndShipping($res, $cartData, $modified, $discountOnly);
		if ($modified) StoreData::setCartData($cartData);

		$cartData = StoreData::getCartData(0);
		$res->coupon = $cartData->serializeCouponForJs();
		$res->items = $cartData->serializeItemsForJs();
		
		StoreModule::respondWithJson($res);
	}
	
	protected function billingInfoAction(StoreNavigation $request) {
		$data = $request->getBodyAsJson();
		if (!is_object($data) || !$data) $data = (object) array();
		$useSame = isset($data->useSame) && $data->useSame;

		$res = new StoreCartTotals();
		$billingShippingRequired = StoreData::getBillingShippingRequired();
		$cartData = StoreData::getCartData(0);

		if ($billingShippingRequired) {
			$res->forceShowDeliveryInfo = false;
			if( StoreData::getTermsCheckboxEnabled() ) {
				if (isset($data->userAgreedToTerms))
					$cartData->userAgreedToTerms = $data->userAgreedToTerms;
				if( !$cartData->userAgreedToTerms )
					$res->generalErrors["userAgreedToTerms"] = StoreModule::__('You must agree to terms and conditions');
			}
			
			$cartData->billingInfo = StoreBillingInfo::fromJson($data->billingInfo);
			if ($useSame) {
				$cartData->deliveryInfo = clone $cartData->billingInfo;
			} else {
				$cartData->deliveryInfo = StoreBillingInfo::fromJson($data->deliveryInfo);
			}

			if (isset($data->billingInfo) && is_object($data->billingInfo) && $data->billingInfo) {
				$this->handleBillingInfo(
						$cartData->billingInfo,
						$res->billingInfoErrors,
						self::PHONE_FIELD_VISIBLE && self::PHONE_FIELD_REQUIRED, // Phone field MUST be required in billing info when it is required in shipping info
						false,
						$res->forceShowDeliveryInfo
					);
			}

			if (isset($data->deliveryInfo) && is_object($data->deliveryInfo) && $data->deliveryInfo) {
				$this->handleBillingInfo(
						$cartData->deliveryInfo,
						$res->deliveryInfoErrors,
						self::PHONE_FIELD_VISIBLE && self::PHONE_FIELD_REQUIRED,
						true,
						$res->forceShowDeliveryInfo
					);
			}
		}
		if (isset($data->orderComment)) {
			$cartData->orderComment = $data->orderComment;
		}

		if (empty($res->billingInfoErrors)) $res->billingInfoErrors = null;
		if (empty($res->deliveryInfoErrors)) $res->deliveryInfoErrors = null;
		if (empty($res->generalErrors)) $res->generalErrors = null;

		$res->billingInfo = $cartData->billingInfo ? $cartData->billingInfo->jsonSerialize() : null;
		$res->deliveryInfo = $cartData->deliveryInfo ? $cartData->deliveryInfo->jsonSerialize() : null;
		
		self::calcTaxesAndShipping($res, $cartData);
		StoreData::setCartData($cartData);

		$cartData = StoreData::getCartData(0);
		$res->coupon = $cartData->serializeCouponForJs();
		$res->items = $cartData->serializeItemsForJs();
		
		StoreModule::respondWithJson($res);
	}
	
	/**
	 * @param bool $modified
	 * @return void
	 */
	public static function calcTaxesAndShipping(StoreCartTotals &$res, StoreCartData $cartData, &$modified = false, $discountOnly = false) {
		$billingShippingRequired = StoreData::getBillingShippingRequired() && !$discountOnly;
		if ($cartData->billingInfo && $billingShippingRequired) {
			$taxRules = StoreData::getTaxRules($cartData->billingInfo);
		} else {
			/** @var \Profis\SitePro\controller\StoreDataTaxRule[] */
			$taxRules = array();
		}
		
		if ($cartData->deliveryInfo && $billingShippingRequired) {
			$mShippingMethods = StoreData::getShippingMethods($cartData->deliveryInfo);
		} else {
			$mShippingMethods = array();
			$cartData->shippingMethodId = 0;
		}
		
		$po = StoreData::getPriceOptions();
		$dp = pow(10, (isset($po->decimalPlaces) && ($po->decimalPlaces >= 0)) ? intval($po->decimalPlaces) : 2);
		
		// calc subtotal
		$subTotalPrice = 0; $totalWeight = 0;
		$subTotalByCategory = [];
		$hasDiscounted = false;
		$singleItemType = null;
		foreach ($cartData->items as $item) {
			if (!isset($item->quantity) || $item->quantity < 1) $item->quantity = 1;
			$fullItemPrice = $item->quantity * $item->price;
			$subTotalPrice += $fullItemPrice;
			$itemType = (isset($item->itemType) && StoreData::isUID($item->itemType, true))
				? ((string) $item->itemType)
				: '';
			if (!isset($subTotalByCategory[(string) $itemType])) {
				$subTotalByCategory[(string) $itemType] = $fullItemPrice;
			} else {
				$subTotalByCategory[(string) $itemType] += $fullItemPrice;
			}

			if (isset($item->weight)) $totalWeight += $item->quantity * $item->weight;
			if ($item->discount > 0) $hasDiscounted = true;
			if (is_null($singleItemType)) {
				$singleItemType = $itemType;
			} else if (!empty($singleItemType) && $singleItemType != $itemType) {
				$singleItemType = '';
			}
		}
		if ($subTotalPrice > 0) $subTotalPrice = round($subTotalPrice * $dp) / $dp;
		
		$usableTotalPrice = $subTotalPrice;

		// calc coupon discounts
		$discountPrice = 0;
		$coupon = $cartData->couponCode ? StoreData::findCouponByCode($cartData->couponCode) : null;
		if ($coupon && (!$hasDiscounted || $coupon->applyToDiscounted)
				&& ($singleItemType == $coupon->itemType || empty($coupon->itemType))) {
			if ($coupon->type == StoreCoupon::TYPE_FIXED_AMOUNT) {
				$discountPrice = round($coupon->value * $dp) / $dp;
			} else {
				$discountPrice = round(($usableTotalPrice * ($coupon->value / 100)) * $dp) / $dp;
			}
			if ($discountPrice >= $usableTotalPrice) {
				$discountPrice = 0;
				$cartData->couponCode = '';
				$res->couponError = StoreModule::__("This coupon is not applicable");
				$modified = true;
			} else {
				foreach ($subTotalByCategory as $c => $v) {
					$partDiscount = round(($v * $discountPrice / $usableTotalPrice) * $dp) / $dp;
					$subTotalByCategory[$c] = $v - $partDiscount;
				}
				$usableTotalPrice -= $discountPrice;
			}
		} else if ($cartData->couponCode) {
			$cartData->couponCode = '';
			$res->couponError = StoreModule::__("This coupon is not applicable");
			$modified = true;
		}

		// build applicable shipping methods list
		$shippingMethods = [];
		$shippingPricesIndex = [];
		foreach ($mShippingMethods as $method) {
			if ($method->type == 0) { // FREE = 0
				$shippingMethods[] = $method;
				$shippingPricesIndex[$method->id] = 0;
			} else if ($method->type == 1) { // FLAT_RATE = 1
				$shippingMethods[] = $method;
				$shippingPricesIndex[$method->id] = isset($method->ranges[0]->value) ? $method->ranges[0]->value*1 : 0;
			} else if ($method->type == 2) { // BY_WEIGHT = 2
				foreach ($method->ranges as $range) {
					if (!isset($range->from) || !isset($range->to) || !isset($range->value)) continue;
					if ($range->from <= $totalWeight && $totalWeight <= $range->to) {
						$shippingMethods[] = $method;
						$shippingPricesIndex[$method->id] = $range->value*1;
						break;
					}
				}
			}
			else if ($method->type == 3 && isset($method->ranges) && is_array($method->ranges)) { // BY_SUBTOTAL = 3
				foreach ($method->ranges as $range) {
					if (!isset($range->from) || !isset($range->to) || !isset($range->value)) continue;
					if ($range->from <= $usableTotalPrice && $usableTotalPrice <= $range->to) {
						$shippingMethods[] = $method;
						$shippingPricesIndex[$method->id] = $range->value*1;
						break;
					}
				}
			}
		}

		// ensure that the chosen shipping method in cart is valid
		$shippingMethod = null;
		if ($cartData->shippingMethodId) {
			foreach ($shippingMethods as $method) {
				if ($method->id == $cartData->shippingMethodId) {
					$shippingMethod = $method;
					break;
				}
			}
		}
		if (!$shippingMethod && !empty($shippingMethods)) {
			$shippingMethod = $shippingMethods[0];
		}

		// calc shipping price
		if ($shippingMethod) {
			$cartData->shippingMethodId = $shippingMethod->id;
			$shippingPrice = isset($shippingPricesIndex[$shippingMethod->id]) ? round($shippingPricesIndex[$shippingMethod->id] * $dp) / $dp : 0;
		} else {
			$cartData->shippingMethodId = 0;
			$shippingPrice = 0;
		}
		
		// calc taxes
		/** @var StoreCartTotalsTax[] */
		$taxes = [];
		foreach ($taxRules as $rule) {
			if ($rule->minOrderAmount > 0 && $rule->minOrderAmount > $usableTotalPrice) {
				continue;
			}
			$key = 'p'.($rule->appliesToProducts ? '0' : '1')
				.'s'.($rule->appliesToShipping ? '0' : '1')
				.'c'.($rule->appliesToProducts ? (string) $rule->categoryId : '0');
			$shippingOnly = (!$rule->appliesToProducts && $rule->appliesToShipping);
			if (isset($taxes[$key])) {
				$tax = $taxes[$key];
				if (!$shippingOnly) $tax->shippingOnly = false;
			} else {
				$tax = $taxes[$key] = new StoreCartTotalsTax($shippingOnly);
			}

			$taxablePrice = 0;
			if ($rule->appliesToProducts) {
				$taxablePrice += (!empty($rule->categoryId))
					? (isset($subTotalByCategory[(string) $rule->categoryId])
						? $subTotalByCategory[(string) $rule->categoryId]
						: 0)
					: $usableTotalPrice;
			}
			if ($rule->appliesToShipping) $taxablePrice += $shippingPrice;

			foreach ($rule->rates as $rate) {
				$tax->rate += $rate->rate / 100.0;
				$tax->amount += $taxablePrice * ($rate->rate / 100.0);
			}
		}
		$taxes = array_filter($taxes, function(StoreCartTotalsTax $tax) { return $tax->amount > 0; });
		
		// calc total
		$totalPrice = $usableTotalPrice + $shippingPrice;
		foreach ($taxes as $tax) {
			$tax->update($dp);
			$totalPrice += $tax->amount;
		}
		
		$res->shippingMethods = $shippingMethods;
		$res->shippingMethodId = $cartData->shippingMethodId;
		$res->subTotalPrice = $subTotalPrice;
		$res->shippingPrice = $shippingPrice;
		$res->shippingMethod = $shippingMethod ? $shippingMethod->name : null;
		$res->taxes = array_values($taxes);
		$res->discountPrice = $discountPrice;
		$res->totalWeight = $totalWeight;
		$res->totalPrice = $totalPrice;
	}

	/**
	 * @param StoreModuleOrder $order
	 * @param StoreCartData $cartData
	 * @return StoreModuleOrderItem[]
	 */
	public static function buildCartItemList(StoreModuleOrder $order, StoreCartData $cartData) {
		$items = array();
		foreach ($cartData->items as $item)
			$items[] = StoreModuleOrderItem::fromCartItem($order, $item);
		return $items;
	}
	
	protected function addAction(StoreNavigation $request) {
		try {
			$itemId = $request->getArg(2);
			if (!$itemId) throw new Exception("No item ID");

			$quantity = intval($request->getQueryParam("quantity", 1));
			if ($quantity <= 0) throw new Exception("No quantity");

			$variantId = $request->getQueryParam("variant", "");

			$item = StoreData::findItemById($itemId);
			if (!$item) throw new Exception("No item");
			if ((!$item->hasVariants && $variantId)
					|| ($item->hasVariants && !$variantId)) {
				throw new Exception("Variant mismatch");
			}
			if ($item->hasVariants) {
				$variant = StoreData::findItemVariantById($item, $variantId);
				if (!$variant) throw new Exception("No variant");
				$item->cartId = StoreData::applyItemVariant($item, $variant);
			} else {
				$variant = null;
				$item->cartId = $item->id;
			}

			$cartData = StoreData::getCartData();
			$cItem = $cartData->findItemById($item->cartId);

			if ($cItem) {
				$isNew = false;
				$newQuantity = StoreData::cartItemQuantity($cItem) + $quantity;
			} else {
				$isNew = true;
				$newQuantity = $quantity;
				$cItem = clone $item;
			}

			if ($item->stockManaged && $newQuantity > $item->quantity) {
				throw new Exception(StoreModule::__("Out of stock"));
			}

			$cItem->quantity = $newQuantity;
			if ($isNew) $cartData->items[] = $cItem;
			StoreData::setCartData($cartData);

			StoreModule::respondWithJson(array(
				'total' => StoreData::countCartItems(),
			));
		} catch (Exception $ex) {
			StoreModule::respondWithJson(array(
				'total' => StoreData::countCartItems(),
				'error' => $ex->getMessage(),
			));
		}
	}
	
	protected function updateAction(StoreNavigation $request) {
		try {
			$cartItemId = $request->getArg(2);
			if (!$cartItemId) throw new Exception("No item ID");

			$newQuantity = ($v = $request->getArg(3)) ? intval($v) : 0;
			if ($newQuantity <= 0) throw new Exception("No quantity");

			$cartData = StoreData::getCartData();
			$cartItem = $cartData->findItemById($cartItemId, true);
			if (!$cartItem) throw new Exception("No cart item");

			$item = StoreData::findItemById($cartItem->id);
			if (!$item) throw new Exception("No item");

			$variant = StoreData::detectItemVariant($item, $cartItem);
			if ($variant) {
				StoreData::applyItemVariant($item, $variant);
			}

			if ($item->stockManaged && ($newQuantity > $item->quantity)) {
				throw new Exception(StoreModule::__('Out of stock'));
			}

			$cartItem->quantity = $newQuantity;
			StoreData::setCartData($cartData);

			StoreModule::respondWithJson(array(
				'total' => StoreData::countCartItems(),
			));
		} catch (Exception $ex) {
			StoreModule::respondWithJson(array(
				'total' => StoreData::countCartItems(),
				'quantity' => (isset($cartItem) ? $cartItem->quantity : 0),
				'error' => $ex->getMessage(),
			));
		}
	}
	
	protected function removeAction(StoreNavigation $request) {
		try {
			$cartItemId = $request->getArg(2);
			if (!$cartItemId) throw new Exception("No item ID");

			$cartData = StoreData::getCartData();
			if ($cartData->removeItemById($cartItemId, true)) {
				StoreData::setCartData($cartData);
			}

			StoreModule::respondWithJson(array(
				'total' => StoreData::countCartItems(),
			));
		} catch (Exception $ex) {
			StoreModule::respondWithJson(array(
				'total' => StoreData::countCartItems(),
				'error' => $ex->getMessage(),
			));
		}
	}
	
	protected function clearAction() {
		self::clearStoreCart();
		StoreModule::respondWithJson(array('total' => StoreData::countCartItems()));
	}
	
	public function process(StoreNavigation $request) {
		$actionArg = $request->getArg(1);
		if( empty($actionArg) )
			return true;
		$cartAction = array_map('ucfirst', explode('-', strtolower(preg_replace('#[^a-zA-Z0-9\-]+#', '', $actionArg ?: ''))));
		$cartAction[0] = strtolower($cartAction[0]);
		$method = implode('', $cartAction).'Action';
		if (method_exists($this, $method)) {
			call_user_func(array($this, $method), $request);
			return true;
		}
		return false;
	}
	
	private static function handleBillingInfo(StoreBillingInfo &$info, &$errors = array(), $needPhone = false, $validateCountryAndRegion = false, &$showDeliveryInfo = false) {
		$billingForm = StoreData::getBillingForm();

		$countryRequired = false;
		$regionRequired = false;
		$countryInvalid = false;
		$regionInvalid = false;
		/**
		 * @var StoreCountry|null $country
		 * @var StoreRegion|null $region
		 */
		list($country, $region) = StoreCountry::findCountryAndRegion($info->countryCode, $info->region);
		if (!$country) {
			$countryRequired = StoreModule::__("Field '%s' is required");
		}
		else {
			$info->country = $country->name;
			if (!empty($country->regions) && !$region) {
				$fieldLabel = (in_array($country->code, array("US", "NG"))) ? StoreModule::__('State / Province') : StoreModule::__('Region');
				$regionRequired = sprintf(StoreModule::__("Field '%s' is required"), $fieldLabel);
			}

			if ($region)
				$info->regionCode = $region->code;
			if ($validateCountryAndRegion && !isset($countryErrors["country"]) && !isset($countryErrors["region"])) {
				$allowed = StoreData::getAvailableShippingCountryAndRegionCodes();
				if (!empty($allowed)) {
					if (!isset($allowed[$country->code])) {
						$countryInvalid = StoreModule::__("Delivery to specified destination is not supported");
						$showDeliveryInfo = true;
					} else if (!empty($allowed[$country->code]) && !in_array($region->code, $allowed[$country->code])) {
						$regionInvalid = StoreModule::__("Delivery to specified destination is not supported");
						$showDeliveryInfo = true;
					}
				}
			}
		}

		if (isset($billingForm->content->fields)) {
			$fields = $billingForm->content->fields;
			foreach ($fields as $idx => $field) {
				$fieldName = "wb_input_$idx";
				if ($field->enabled) {
					switch ($field->type) {
						case 'wb_store_isCompany':
							break;
						case 'wb_store_email':
							if ($field->required && (!$info->email || !preg_match('#^[^ @]+@[^ @]+\.[^\ \.]+$#', $info->email))) {
								$errors['email'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							break;
						case 'wb_store_phone':
							if ($needPhone && $field->required && (!isset($info->phone) || !$info->phone)) {
								$errors['phone'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							break;
						case 'wb_store_firstName':
							if (!$info->isCompany) {
								if ($field->required && !$info->firstName) {
									$errors['firstName'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
								}
							}
							break;
						case 'wb_store_lastName':
							if (!$info->isCompany) {
								if ($field->required && !$info->lastName) {
									$errors['lastName'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
								}
							}
							break;
						case 'wb_store_companyName':
							if ($info->isCompany) {
								if ($field->required && !$info->companyName) {
									$errors['companyName'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
								}
							}
							break;
						case 'wb_store_companyCode':
							if ($info->isCompany) {
								if ($field->required && !$info->companyCode) {
									$errors['companyCode'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
								}
							}
							break;
						case 'wb_store_companyVatCode':
							if ($info->isCompany) {
								if ($field->required && !$info->companyVatCode) {
									$errors['companyVatCode'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
								}
							}
							break;
						case 'wb_store_address1':
							if ($field->required && !$info->address1) {
								$errors['address1'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							break;
						case 'wb_store_city':
							if ($field->required && !$info->city) {
								$errors['city'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							break;
						case 'wb_store_postCode':
							if ($field->required && !$info->postCode) {
								$errors['postCode'] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							break;
						case 'wb_store_countryCode':
							if ($countryRequired && $field->required) {
								$errors['country'] = sprintf($countryRequired, StoreModule::__tr($field->name));
							} else if ($countryInvalid) {
								$errors['country'] = $countryInvalid;
							}
							break;
						case 'wb_store_region':
							if ($regionRequired && $field->required) {
								$errors['region'] = $regionRequired;
							} else if ($regionInvalid) {
								$errors['region'] = $regionInvalid;
							}
							break;
						case 'email':
							if ($field->required && (!isset($info->{$fieldName}) || !$info->{$fieldName})) {
								$errors[$fieldName] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							if (!empty($info->{$fieldName}) && !preg_match('#^[^ @]+@[^ @]+\.[^\ \.]+$#', $info->{$fieldName})) {
								$errors[$fieldName] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							break;
						case 'phone':
							if ($needPhone && $field->required && (!isset($info->{$fieldName}) || !$info->{$fieldName})) {
								$errors[$fieldName] = sprintf(StoreModule::__("Field '%s' is required"), StoreModule::__tr($field->name));
							}
							break;
						default:
							if ($field->required && (!isset($info->{$fieldName}) || (!$info->{$fieldName} && $info->{$fieldName} !== 0))) {
								$fieldNameText = StoreModule::__htmlToText(StoreModule::__tr($field->name));
								$errors[$fieldName] = sprintf(StoreModule::__("Field '%s' is required"), $fieldNameText);
							}
							break;
					}
				}
			}
		}
	}
	
	public static function clearStoreCart() {
		$cartData = StoreData::getCartData();
		$cartData->items = array();
		$cartData->orderComment = '';
		StoreData::setCartData($cartData);
	}
	
}
