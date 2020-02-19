<?php

use GuzzleHttp\Psr7\Response;

/**
 * Class SagepayTestTrait
 *
 * This trait defines a number of helper functions for testing the Sagepay integration.
 */
trait SagepayTestTrait {

    protected function getNewContributionPage($processorID) {
        return [
            "title" => "Help Support CiviCRM!",
            "financial_type_id" => 1,
            "is_monetary" => TRUE,
            "is_pay_later" => 0,
            "is_quick_config" => TRUE,
            "is_allow_other_amount" => 1,
            "min_amount" => 10.00,
            "max_amount" => 10000.00,
            "goal_amount" => 100000.00,
            "is_email_receipt" => 1,
            "is_active" => 1,
            "amount_block_is_active" => 1,
            "currency" => "GBP",
            "is_billing_required" => 0,
            "payment_processor" => $processorID,
        ];
    }

    protected function getQfKey() {
        return "0e28675d3513bdfba43fca5";
    }

    protected function getNewTransaction() {
        return [
            "amount" => 20.00,
            "currency" => "GBP",
            "description" => "33333-99999-Donation",
            "transactionId" => "99999",
            "clientIp" => "111.111.111.111",
            "returnUrl" => "https://civi.example.org/civicrm/payment/ipn/99999/1",
            "cancelUrl" => "https://civi.example.org/civicrm/contribute/transact?_qf_Main_display=1&qfKey=" . $this->getQfkey(),
            "notifyUrl" => "https://civi.example.org/civicrm/payment/ipn/99999/1",
            "card" => [
                "firstName" => "Emmy",
                "lastName" => "Noether",
                "email" => "emmynoether@sagepayexample.org",
                "billingAddress1" => "Mathe Strasse",
                "billingAddress2" => "",
                "billingCity" => "Erlangen",
                "billingPostcode" => "ERLNGN",
                "billingState" => "",
                "billingCountry" => "DE",
                "billingPhone" => "",
                "company" => "",
                "type" => "",
                "shippingAddress1" => "Mathe Strasse",
                "shippingAddress2" => "",
                "shippingCity" => "Erlangen",
                "shippingPostcode" => "ERLNGN",
                "shippingState" => "",
                "shippingCountry" => "DE",
                "cvv" => "",
                "number" => "",
            ],
            "cardReference" => null,
            "transactionReference" => null,
            "cardTransactionType" => null,
        ];
    }

    protected function getContributionPageSubmission($contributionPageID, $processorID, $priceSetID) {
        $newTransaction = $this->getNewTransaction();

        return [
            "id" => $contributionPageID,
            "email-5" => $newTransaction["card"]["email"],
            "payment_processor_id" => $processorID,
            "amount" => $newTransaction["amount"],
            "currencyID" => $newTransaction["currency"],
            "is_quick_config" => 1,
            "price_set_id" => $priceSetID,
        ];
    }

    protected function getSagepayTransactionSecret() {
        return [
            "VPSProtocol" => "3.00",
            "Status" => "OK",
            "StatusDetail" => "2014 : The Transaction was Registered Successfully.",
            "VPSTxId" => "{C46AF0B5-E2D2-6477-4EE4-991BC04B44C4}",
            "SecurityKey" => "POW8PD7OPZ",
            "NextURL" => "https://test.sagepay.com/gateway/service/cardselection?vpstxid={C46AF0B5-E2D2-6477-4EE4-991BC04B44C4",
        ];
    }

    protected function getSagepayPaymentConfirmation() {
        return [
            "q" => "civicrm/payment/ipn/99999/1",
            "processor_id" => "1",
            "VPSProtocol" => "3.00",
            "TxType" => "PAYMENT",
            "VendorTxCode" => "99999",
            "VPSTxId" => "{C46AF0B5-E2D2-6477-4EE4-991BC04B44C4}",
            "Status" => "OK",
            "StatusDetail" => "0000 : The Authorisation was Successful.",
            "TxAuthNo" => "4898041",
            "AVSCV2" => "SECURITY CODE MATCH ONLY",
            "AddressResult" => "NOTMATCHED",
            "PostCodeResult" => "NOTMATCHED",
            "CV2Result" => "MATCHED",
            "GiftAid" => "0",
            "3DSecureStatus" => "NOTCHECKED",
            "CardType" => "VISA",
            "Last4Digits" => "0006",
            "VPSSignature" => "911718238EB7744144122288060CAEC7",
            "DeclineCode" => "00",
            "ExpiryDate" => "0123",
            "BankAuthCode" => "999777",
            "IDS_request_uri" => "/civicrm/payment/ipn/99999/1",
            "IDS_user_agent" => "SagePay-Notifier/1.0",
        ];
    }

}
