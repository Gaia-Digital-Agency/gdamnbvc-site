<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://gaiada.com
 * @since      1.0.0
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container h-screen">
    <div class="credit-card-form">
            <form id="credit-card-form">
                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" class="text-theme-black" id="card_number" name="card-number" value="4889 5010 2499 6295" placeholder="1234 5678 9012 3456" required />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_first-name">Cardholder First Name</label>
                    <input type="text" class="text-theme-black" id="cardholder_first-name" value="Reva Athallah" name="cardholder-first-name" placeholder="John" required />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_last-name">Cardholder Last Name</label>
                    <input type="text" class="text-theme-black" id="cardholder_last-name" value="Rizky" name="cardholder-last-name" placeholder="Doe" required />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_email">Cardholder Email</label>
                    <input type="text" class="text-theme-black" id="cardholder_email" value="revaathallah86@gmail.com" name="cardholder-email" placeholder="john@mail.co" />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_phone-number">Cardholder Phone Number</label>
                    <input type="text" class="text-theme-black" id="cardholder_phone-number" value="+6281239146435" name="cardholder-phone-number" placeholder="+62123123123" />
                </div>
    
                <div class="form-group">
                    <label for="expiration-date">Expiration Date</label>
                    <input type="month" class="text-theme-black" id="expiration_date" value="06/28" name="expiration-date" required />
                </div>
                <div class="form-group">
                    <label for="expiration-date">session</label>
                    <input type="text" class="text-theme-black" id="session_id" name="session-id" />
                </div>
    
                <div class="form-group">
                    <label for="cvn">CVN</label>
                    <input type="text" class="text-theme-black" id="cvn" name="cvn" value="865" placeholder="123" />
                </div>
    
                <div class="form-group">
                    <label for="save-card-payment-token">Save Card Payment Token</label>
                    <input type="checkbox" class="text-theme-black" id="save-card-payment-token" name="save-card-payment-token" />
                </div>
    
                <div class="form-group">
                    <button type="submit" class="" id="submit-button">Submit</button>
                </div>
            </form>
        </div>
        <br>
    <hr>
    <br>
    <div class="tokenize-card-form">
            <form id="tokenize-card-form">
                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" class="text-theme-black" id="tokenize_card_number" name="card-number" value="4889501024996295" placeholder="1234 5678 9012 3456" required />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_first-name">Cardholder First Name</label>
                    <input type="text" class="text-theme-black" id="tokenize_cardholder_first-name" value="Reva Athallah" name="cardholder-first-name" placeholder="John" required />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_last-name">Cardholder Last Name</label>
                    <input type="text" class="text-theme-black" id="tokenize_cardholder_last-name" value="Rizky" name="cardholder-last-name" placeholder="Doe" required />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_email">Cardholder Email</label>
                    <input type="text" class="text-theme-black" id="tokenize_cardholder_email" value="revaathallah86@gmail.com" name="cardholder-email" placeholder="john@mail.co" />
                </div>
    
                <div class="form-group">
                    <label for="cardholder_phone-number">Cardholder Phone Number</label>
                    <input type="text" class="text-theme-black" id="tokenize_cardholder_phone-number" value="+6281239146435" name="cardholder-phone-number" placeholder="+62123123123" />
                </div>
    
                <div class="form-group">
                    <label for="expiration-date">Expiration Date</label>
                    <input type="month" class="text-theme-black" id="tokenize_expiration_date_month" value="06" name="expiration-date" required />
                </div>
                <div class="form-group">
                    <label for="expiration-date">Expiration Date</label>
                    <input type="month" class="text-theme-black" id="tokenize_expiration_date_year" value="2027" name="expiration-date" required />
                </div>
                <div class="form-group">
                    <label for="expiration-date">amount</label>
                    <input type="number" class="text-theme-black" id="tokenize_amount" name="amount" value="75000" />
                </div>
    
                <div class="form-group">
                    <label for="cvn">CVN</label>
                    <input type="text" class="text-theme-black" id="tokenize_cvn" name="cvn" value="865" placeholder="123" />
                </div>
    
                <div class="form-group">
                    <label for="save-card-payment-token">Save Card Payment Token</label>
                    <input type="checkbox" class="text-theme-black" id="tokenize_save-card-payment-token" name="save-card-payment-token" />
                </div>
    
                <div class="form-group">
                    <button type="submit" class="" id="tokenize_submit-button">Submit</button>
                </div>
            </form>
        </div>
</div>