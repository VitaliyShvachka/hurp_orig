<?php
/**
 * @var string $title
 * @var StoreModuleOrder $order
 * @var string $invoiceUrl
 * @var string $gatewayName
 * @var string $typeText
 * @var string $phraseText
 */
?>

<h1><?php echo StoreModule::__('Order_payment'); ?> #<?php echo $order->getTransactionId(); ?><?php echo $typeText ? ' ('.$typeText.')' : ''; ?></h1>

<?php if ($phraseText) echo '<p>'.$phraseText.'</p>'; ?>

<?php if( $order->getInvoiceDocumentNumber() ) { ?>
	<p>
		<?php echo StoreModule::__('You can download invoice in PDF format by following this link'); ?>: <br />
		<a target="_blank" href="<?php echo htmlspecialchars($invoiceUrl); ?>" style="color: blue;"><?php echo htmlspecialchars($invoiceUrl); ?></a>
	</p>
<?php } ?>

<h3><?php echo StoreModule::__('Order Details'); ?>:</h3>

<table cellspacing="5" cellpadding="0">
	<tr>
		<td><strong><?php echo StoreModule::__('Order ID'); ?>:</strong>&nbsp;</td>
		<td><?php echo $order->getTransactionId(); ?></td>
	</tr>
	<?php if ($order->getInvoiceDocumentNumber()) { ?>
		<tr>
			<td><strong><?php echo StoreModule::__('Invoice document number'); ?>:</strong>&nbsp;</td>
			<td><a target="_blank" href="<?php echo htmlspecialchars($invoiceUrl); ?>" style="color: blue;"><?php echo $order->getInvoiceDocumentNumber(); ?></a></td>
		</tr>
	<?php } ?>
	<?php if ($order->getCompleteDateTime()) { ?>
		<tr>
			<td><strong><?php echo StoreModule::__('Time'); ?>:</strong>&nbsp;</td>
			<td><?php echo $order->getCompleteDateTime(); ?></td>
		</tr>
	<?php } ?>
	<?php if ($gatewayName || $order->getGatewayId()) { ?>
		<tr>
			<td><strong><?php echo StoreModule::__('Payment gateway'); ?>:</strong>&nbsp;</td>
			<td><?php echo ($gatewayName ? $gatewayName : $order->getGatewayId()); ?></td>
		</tr>
	<?php } ?>

	<tr><td>&nbsp;</td></tr>

	<?php if ($order->getBuyer() && $order->getBuyer()->getData()) { ?>
		<?php echo StorePaymentApi::buildInfoHtmlTableRows(StoreModule::__('Payer (from gateway)'), $order->getBuyer()->getData()); ?>
	<?php } ?>
	<?php if ($order->getBillingInfo()) { ?>
		<?php echo StorePaymentApi::buildInfoHtmlTableRows(StoreModule::__('Billing Information'), $order->getBillingInfo()->jsonSerialize(), true); ?>
	<?php } ?>
	<?php if ($order->getDeliveryInfo()) { ?>
		<?php echo StorePaymentApi::buildInfoHtmlTableRows(StoreModule::__('Delivery Information'), $order->getDeliveryInfo()->jsonSerialize(), true); ?>
	<?php } ?>
	<?php if ($order->getOrderComment()) { ?>
		<?php echo StorePaymentApi::buildInfoHtmlTableRows(StoreModule::__('Order Comments'), nl2br(htmlspecialchars($order->getOrderComment()))); ?>
	<?php } ?>
	<?php if ($order->getShippingDescription()) { ?>
		<tr><td colspan="2"><h3><?php echo StoreModule::__('Shipping Method'); ?>:</h3></td></tr>
		<tr><td colspan="2"><?php echo $order->getShippingDescription(); ?></td></tr>
		<tr><td>&nbsp;</td></tr>
	<?php } ?>
	<?php if ($order->getItems()) { ?>
		<tr><td colspan="2"><h3><?php echo StoreModule::__('Purchase details'); ?>:</h3></td></tr>
		<?php foreach ($order->getItems() as $item) { ?>
			<tr><td colspan="2"><?php echo StorePaymentApi::safeEmailText((string)$item); ?></td></tr>
		<?php } ?>
		<tr><td>&nbsp;</td></tr>
	<?php } ?>
	<?php if ($order->getPrice() && ($order->getShippingAmount() || $order->getFullTaxAmount() > 0 || $order->getDiscountAmount())) { ?>
		<tr>
			<td><strong><?php echo StoreModule::__('Subtotal'); ?>:</strong></td>
			<td><strong><?php echo StorePaymentApi::getFormattedPrice($order->getPrice() + $order->getDiscountAmount() - $order->getFullTaxAmount() - $order->getShippingAmount()); ?></strong></td>
		</tr>
	<?php } ?>
	<?php if ($order->getDiscountAmount()) { ?>
		<tr>
			<td><strong><?php echo StoreModule::__('Discount'); ?>:</strong></td>
			<td><strong><?php echo '-'.StorePaymentApi::getFormattedPrice($order->getDiscountAmount()); ?></strong></td>
		</tr>
	<?php } ?>
	<?php if ($order->getShippingAmount()) { ?>
		<tr>
			<td><strong><?php echo StoreModule::__('Shipping amount'); ?>:</strong></td>
			<td><strong><?php echo StorePaymentApi::getFormattedPrice($order->getShippingAmount()); ?></strong></td>
		</tr>
	<?php } ?>
	<?php if ($order->getFullTaxAmount() > 0): ?>
		<?php foreach ($order->getTaxes() as $tax): ?>
		<tr>
			<td><strong><?php
				echo ($tax->shippingOnly ? StoreModule::__('Shipping Tax') : StoreModule::__('Tax'))
					.($tax->rate > 0 ? " ({$tax->getRatePercent()}%)" : "");
			?>:</strong></td>
			<td><strong><?php echo StorePaymentApi::getFormattedPrice($tax->amount); ?></strong></td>
		</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php if ($order->getPrice()) { ?>
		<tr>
			<td><strong><?php echo StoreModule::__('Total')?>:</strong></td>
			<td><strong><?php echo StorePaymentApi::getFormattedPrice($order->getPrice()); ?></strong></td>
		</tr>
	<?php } ?>
</table>
