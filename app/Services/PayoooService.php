<?php

namespace App\Services;

/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 12/21/2020
 * Time: 5:50 PM
 */
Class PayoooService
{
    private $NotifyData = "";
    private $Signature = "";
    private $PayooSessionID = "";
    private $KeyFields = "";

    public function __construct($NotifyData)
    {
        $this->NotifyData = $NotifyData;
        $doc = new \DOMDocument();
        $doc->loadXML($this->NotifyData);

        $this->NotifyData = ($doc->getElementsByTagName("Data")->item(0)->nodeValue);
        $this->Signature = ($doc->getElementsByTagName("Signature")->item(0)->nodeValue);
        $this->PayooSessionID = $doc->getElementsByTagName("PayooSessionID")->item(0);
        $this->KeyFields = $doc->getElementsByTagName("KeyFields")->item(0)->nodeValue;

    }

    function GetNotifyData()
    {
        return $this->NotifyData;
    }

    function GetSignature()
    {
        return $this->Signature;
    }

    function GetKeyFields()
    {
        return $this->KeyFields;
    }

    function GetPaymentNotify()
    {
        if (trim($this->NotifyData) == "") {
            return;
        }
        $doc = new \DOMDocument();
        $dataValue = base64_decode($this->NotifyData);
        $doc->loadXML($dataValue);

        $invoice = new PayooPaymentService();;

        if ($this->ReadNodeValue($doc, "BillingCode") == '') {
            $invoice->setSession($this->ReadNodeValue($doc, "session"));
            $invoice->setBusinessUsername($this->ReadNodeValue($doc, "username"));
            $invoice->setShopID($this->ReadNodeValue($doc, "shop_id"));
            $invoice->setShopTitle($this->ReadNodeValue($doc, "shop_title"));
            $invoice->setShopDomain($this->ReadNodeValue($doc, "shop_domain"));
            $invoice->setShopBackUrl($this->ReadNodeValue($doc, "shop_back_url"));
            $invoice->setOrderNo($this->ReadNodeValue($doc, "order_no"));
            $invoice->setOrderCashAmount($this->ReadNodeValue($doc, "order_cash_amount"));
            $invoice->setStartShippingDate($this->ReadNodeValue($doc, "order_ship_date"));
            $invoice->setShippingDays($this->ReadNodeValue($doc, "order_ship_days"));
            $invoice->setOrderDescription(urldecode(($this->ReadNodeValue($doc, "order_description"))));
            $invoice->setNotifyUrl($this->ReadNodeValue($doc, "notify_url"));
            $invoice->setState($this->ReadNodeValue($doc, "State"));
            $invoice->setPaymentMethod($this->ReadNodeValue($doc, "PaymentMethod"));
            $invoice->setPaymentExpireDate($this->ReadNodeValue($doc, "validity_time"));
        } else {
            $invoice->setBillingCode($this->ReadNodeValue($doc, "BillingCode"));
            $invoice->setOrderNo($this->ReadNodeValue($doc, "OrderNo"));
            $invoice->setOrderCashAmount($this->ReadNodeValue($doc, "OrderCashAmount"));
            $invoice->setState($this->ReadNodeValue($doc, "State"));
            $invoice->setPaymentMethod($this->ReadNodeValue($doc, "PaymentMethod"));
            $invoice->setShopID($this->ReadNodeValue($doc, "ShopId"));
            $invoice->setPaymentExpireDate($this->ReadNodeValue($doc, "PaymentExpireDate"));
        }
        return $invoice;
    }

    function ReadNodeValue($Doc, $TagName)
    {
        $nodeList = $Doc->getElementsByTagname($TagName);
        $tempNode = $nodeList->item(0);
        if ($tempNode == null)
            return '';
        return $tempNode->nodeValue;
    }
}