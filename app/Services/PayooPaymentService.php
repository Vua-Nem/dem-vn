<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrderVoucher;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 12/21/2020
 * Time: 5:50 PM
 */
Class PayooPaymentService
{
    var $PaymentMethod = "";
    var $State = "";
    var $Session= "";
    var $BusinessUsername="";
    var $ShopID =0;
    var $ShopTitle="";
    var $ShopDomain="";
    var $ShopBackUrl="";
    var $OrderNo="";
    var $OrderCashAmount=0;
    var $StartShippingDate=""; //Format: dd/mm/yyyy
    var $ShippingDays= 0;
    var $OrderDescription="";
    var $NotifyUrl = "";
    var $BillingCode="";
    var $PaymentExpireDate = "";

    function setPaymentMethod($PaymentMethod)
    {
        $this->PaymentMethod = $PaymentMethod;
    }
    function getPaymentMethod()
    {
        return $this->PaymentMethod;
    }
    function setState($State)
    {
        $this->State = $State;
    }
    function getState()
    {
        return $this->State;
    }

    function getSession()
    {
        return $this->Session;
    }
    function getBusinessUsername()
    {
        return $this->BusinessUsername;
    }
    function getShopID()
    {
        return $this->ShopID;
    }
    function getShopTitle()
    {
        return $this->ShopTitle;
    }
    function getShopDomain()
    {
        return $this->ShopDomain;
    }
    function getShopBackUrl()
    {
        return $this->ShopBackUrl;
    }
    function getOrderNo()
    {
        return $this->OrderNo;
    }
    function getOrderCashAmount()
    {
        return $this->OrderCashAmount;
    }
    function getStartShippingDate()
    {
        return $this->StartShippingDate;
    }
    function getShippingDays()
    {
        return $this->ShippingDays;
    }
    function getOrderDescription()
    {
        return $this->OrderDescription;
    }
    function getNotifyUrl()
    {
        return $this->NotifyUrl;
    }
    function setSession($Session)
    {
        $this->Session = $Session;
    }
    function setBusinessUsername($BusinessUsername)
    {
        $this->BusinessUsername = $BusinessUsername;
    }
    function setShopID($ShopID)
    {
        $this->ShopID = $ShopID;
    }
    function setShopTitle($ShopTitle)
    {
        $this->ShopTitle = $ShopTitle;
    }
    function setShopDomain($ShopDomain)
    {
        $this->ShopDomain = $ShopDomain;
    }
    function setShopBackUrl($ShopBackUrl)
    {
        $this->ShopBackUrl = $ShopBackUrl;
    }
    function setOrderNo($OrderNo)
    {
        $this->OrderNo = $OrderNo;
    }
    function setOrderCashAmount($OrderCashAmount)
    {
        $this->OrderCashAmount = $OrderCashAmount;
    }
    function setStartShippingDate($StartShippingDate)
    {
        $this->StartShippingDate = $StartShippingDate;
    }
    function setShippingDays($ShippingDays)
    {
        $this->ShippingDays = $ShippingDays;
    }
    function setOrderDescription($OrderDescription)
    {
        $this->OrderDescription = $OrderDescription;
    }
    function setNotifyUrl($NotifyUrl)
    {
        $this->NotifyUrl = $NotifyUrl;
    }
    function setBillingCode($BillingCode)
    {
        $this->BillingCode = $BillingCode;
    }
    function getBillingCode()
    {
        return $this->BillingCode;
    }
    function setPaymentExpireDate($PaymentExpireDate)
    {
        $this->PaymentExpireDate = $PaymentExpireDate;
    }
    function getPaymentExpireDate()
    {
        return $this->PaymentExpireDate;
    }
}