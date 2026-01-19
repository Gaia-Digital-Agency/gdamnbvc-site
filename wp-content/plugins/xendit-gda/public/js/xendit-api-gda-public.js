(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready(() => {
		const grabCart = () => {
			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "gda_req_cart",
				},
				method: "POST",
				success: res => {
					console.log(res)
					const json = JSON.parse(res)
					if(res && json && json['_rp_sc']) {
						Cookies.set('_rp_sc', json['_rp_sc'])
					}
					// Cookies.set('_rp_sc', res)
				}
			})
		}
		if(Cookies.get('_rp_sc')) {
			$.ajax("/wp-admin/admin-ajax.php", {
				data: {
					action: "gda_ver_cart",
					cart: Cookies.get('_rp_sc')
				},
				method: "POST",
				success: (res) => {
					const json = JSON.parse(res)
					if(json.status) return
					Cookies.remove('_rp_sc')
					grabCart()
				}
			})
			return;
		}

		grabCart()
	})

	$(document).ready(() => {
		const form = document.querySelector('#credit-card-form')
		Xendit.setPublishableKey('xnd_public_development_L9PqSaNPfi_pgffBjGM2k7nnDoyDBAIXVqZze1fnKoD1DUuJsnB8Tpw6bS06pmJ')
		console.log(form)
		form.addEventListener("submit", e => {
			e.preventDefault()
			const cardData = {
				card_number: document.getElementById('card_number').value.replace(/\s/g, ''),
				expiry_month: '07',
				expiry_year: '2028',
				cvn: document.getElementById('cvn').value,
				cardholder_first_name: document.getElementById('cardholder_first-name').value,
				cardholder_last_name: document.getElementById('cardholder_last-name').value,
				cardholder_email: document.getElementById('cardholder_email').value,
				cardholder_phone_number: document.getElementById('cardholder_phone-number').value,
				payment_session_id: document.getElementById('session_id').value,
			};
			console.log(cardData)
			Xendit.payment.collectCardData(cardData, (res) => {
				console.log(res, 'res')
			});
			console.log($(form).serialize())
		})
	});

	$(document).ready(() => {
		const fetchData = async (data) => {
			const headers = new Headers({
				"Authorization": "Basic " + btoa('xnd_public_development_L9PqSaNPfi_pgffBjGM2k7nnDoyDBAIXVqZze1fnKoD1DUuJsnB8Tpw6bS06pmJ:')
			})
			const res = await fetch('https://api.xendit.co/v2/credit_card_tokens', {
				method: "POST",
				headers: {
					Authorization: "Basic " + btoa('xnd_public_development_L9PqSaNPfi_pgffBjGM2k7nnDoyDBAIXVqZze1fnKoD1DUuJsnB8Tpw6bS06pmJ:'),
					"Content-Type": "application/json;charset=UTF-8"
				},
				body: JSON.stringify(data)
			})
			return res.json()
		}
		const form = document.querySelector('#tokenize-card-form')
		Xendit.setPublishableKey('xnd_public_development_L9PqSaNPfi_pgffBjGM2k7nnDoyDBAIXVqZze1fnKoD1DUuJsnB8Tpw6bS06pmJ')
		console.log(form)
		form.addEventListener("submit", e => {
			e.preventDefault()
			const cardData = {
				is_single_use: true,
				card_data: {
					account_number: document.getElementById('tokenize_card_number').value.replace(/\s/g, ''),
					exp_month: document.getElementById('tokenize_expiration_date_month').value,
					exp_year: document.getElementById('tokenize_expiration_date_year').value,
					// account_number: '4000000000001091',
					// exp_month: '12',
					// exp_year: '2040',
					cvn: document.getElementById('tokenize_cvn').value,
				},
				amount: "75000",
				external_id: Cookies.get('_rp_sc'),
				should_authenticate: true
				// cardholder_first_name: document.getElementById('tokenize_cardholder_first-name').value,
				// cardholder_last_name: document.getElementById('tokenize_cardholder_last-name').value,
				// cardholder_email: document.getElementById('tokenize_cardholder_email').value,
				// cardholder_phone_number: document.getElementById('tokenize_cardholder_phone-number').value,
			};
			console.log(cardData)
			// Xendit.payment.collectCardData(cardData, (res) => {
			// 	console.log(res, 'res')
			// });

			fetchData(cardData)

			console.log($(form).serialize())
		})
	});

})( jQuery );
