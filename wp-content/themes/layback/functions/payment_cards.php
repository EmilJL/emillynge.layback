<?php

	function paymentcards(){
		$payment_cards = get_field('payment_cards', 'option');
		if($payment_cards)
		{
			echo '<ul class="payment_cards">';
			foreach ($payment_cards as $cards) {
				echo '<li>';
				if($cards == 'Dankort')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/dankort.svg" />';
				}
				if($cards == 'Visa')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/visa.svg" />';
				}
				if($cards == 'Visa Electron')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/visa-electron.svg" />';
				}
				if($cards == 'Mastercard')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/mastercard.svg" />';
				}
				if($cards == 'Maestro')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/maestro.svg" />';
				}
				if($cards == 'MobilePay')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/mobilepay.svg" />';
				}
				if($cards == 'Apple Pay')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/apple-pay.svg" />';
				}
				if($cards == 'Google Pay')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/google-pay.svg" />';
				}
				if($cards == 'Samsung Pay')
				{
					echo '<img src="' . get_template_directory_uri() . '/lib/img/payment-cards/samsung-pay.svg" />';
				}
				
				// echo '<li>' . $cards . '</li>';

				echo '</li>';
				
			}
			echo '</ul>';
		}
	}