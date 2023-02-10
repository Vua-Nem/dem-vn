document.addEventListener('DOMContentLoaded', function () {
    gaee_mini.sendProductImpression('body');
    gaee_mini.productDetail();
    $('.js-ga-add-to-cart').click(function () {
        return gaee_mini.onBuyProduct($(this));
    });
    $(".js-ga-begin-checkout").click(function () {
        gaee_mini.checkoutStep('minicart', 'checkout_step1');
    });
    $(".js-ga-click-address").click(function () {
        gaee_mini.checkoutStep('page-checkout', 'address_info');
    });
    $(".js-ga-click-payment").click(function () {
        gaee_mini.checkoutStep('page-payment', 'payment_info');
    });

    gaee_mini.success('page-success');
});
var gaee_mini = {
    sendProductImpression: function (parent) {
        let listItems = [];
        let items = $('.js-gaee-product-data', parent);
        if (items.length <= 0) {
            return;
        }
        let count = 0;
        for (let i = 0; i < items.length; i++) {
            let obj = $(items[i]);
            let is_sent = obj.attr('data-ga-sent');
            if (typeof is_sent === 'undefined') {
                obj.attr('data-ga-sent', 1);
                obj.attr('data-ga-position', count);
                listItems.push({
                    'item_id': obj.attr('data-product-id'),
                    'item_name': obj.attr('data-product-name'),
                    'price': parseFloat(obj.attr('data-product-price')),
                    'index': count,
                });

                obj.click(function () {
                    return gaee_mini.onProductClick($(this));
                });

                count++;
            }
        }
        dataLayer.push({ ecommerce: null });
        if (count > 0) {
            dataLayer.push({'event': 'view_item_list', 'ecommerce': {'items': listItems}});
        }
    },
    onProductClick: function (obj) {
        obj = $(obj);
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            'event': 'select_item',
            'ecommerce': {
                'items': [{
                    'item_id': obj.attr('data-product-id'),
                    'item_name': obj.attr('data-product-name'),
                    'price': parseFloat(obj.attr('data-product-price')),
                    'index': obj.attr('data-product-position')
                }]
            }
        });

        setTimeout(function () {
            window.location = obj.attr('data-url');
        }, 500);

        return false;
    },
    productDetail: function () {
        obj = $(".js-ga-product-data");
        dataLayer.push({ ecommerce: null });
        if (obj.length > 0) {
            dataLayer.push({
                'event': 'view_item',
                'ecommerce': {
                    'items': [{
                        'item_name': obj.attr('data-product-name'),
                        'item_id': obj.attr('data-product-id'),
                        'price': parseFloat(obj.attr('data-product-price')),
                        'item_brand': obj.attr('data-product-brand'),
                        'index': 0
                    }]
                }
            });

            dataLayer.push({
                'dr_event_type' : 'view_item',
                'dr_value' : obj.attr('data-product-price'),   // product price
                'dr_items' : [{
                    'id': obj.attr('data-product-id'),   // should be the same as the id in Google Merchant Center,
                    'google_business_vertical': 'retail'
                    }],
                'event':'dynamic_remarketing'
            });
        }
    },
    onBuyProduct: function (obj) {
        obj = $(obj);
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            'event': 'add_to_cart',
            'ecommerce': {
                'items': [{
                    'item_name': obj.attr('data-product-name'),
                    'item_id': obj.attr('data-product-variant'),
                    'price': parseFloat(obj.attr('data-product-price')),
                    'item_brand': obj.attr('data-product-brand'),
                    'item_variant': obj.attr('data-product-variant'),
                    'index': 0,
                    'quantity': parseFloat($("#quantity").val())
                }]
            }
        });
        dataLayer.push({
            'dr_event_type' : 'add_to_cart',
            'dr_value' : obj.attr('data-product-price'),   // cart total
            'dr_items' : [{
                'id': obj.attr('data-product-variant'),   // should be the same as id in Google Merchant Center,
                'google_business_vertical': 'retail'
            }],
            'event':'dynamic_remarketing'
        });
    },
    checkoutStep: function (parent, event) {
        let listItems = [];
        let listItemsRemarketing = [];
        let items = $('.' + parent + ' .js-ga-checkout-product-data');
        if (items.length <= 0) {
            return;
        }
        let count = 0;
        for (let i = 0; i < items.length; i++) {
            let obj = $(items[i]);
            let is_sent = obj.attr('data-ga-sent');
            if (typeof is_sent === 'undefined') {
                obj.attr('data-ga-sent', 1);
                obj.attr('data-ga-position', count);
                listItems.push({
                    'item_name': obj.attr('data-product-name'),
                    'item_id': obj.attr('data-product-variant'),
                    'price': parseFloat(obj.attr('data-product-price')),
                    'item_variant': obj.attr('data-product-variant'),
                    'index': count,
                    'quantity': parseFloat(obj.attr('data-product-qty')),
                });

                listItemsRemarketing.push({
                    'id': obj.attr('data-product-variant'),
                    'google_business_vertical': 'retail'
                });

                count++;
            }
        }
        dataLayer.push({ ecommerce: null });
        if (count > 0) {
            dataLayer.push({
                'event': event,
                'ecommerce': {
                    'items': listItems
                }
            });
            if (event == 'payment_info') {
                dataLayer.push({
                    'dr_event_type' : 'purchase',
                    'dr_value' : $(".js-ga-total").attr('data-product-total-amount'),  // purchase  total
                    'dr_items' : listItemsRemarketing,
                    'event':'dynamic_remarketing'
                });
            }
        }
    },
    success: function (parent) {
        let listItems = [];
        let items = $('.' + parent + ' .js-ga-success-product-data');
        if (items.length <= 0) {
            return;
        }
        let count = 0;
        for (let i = 0; i < items.length; i++) {
            let obj = $(items[i]);
            let is_sent = obj.attr('data-ga-sent');
            if (typeof is_sent === 'undefined') {
                obj.attr('data-ga-sent', 1);
                obj.attr('data-ga-position', count);
                listItems.push({
                    'item_name': obj.attr('data-product-name'),
                    'item_id': obj.attr('data-product-variant'),
                    'price': parseFloat(obj.attr('data-product-price')),
                    'item_variant': obj.attr('data-product-variant'),
                    'quantity': parseFloat(obj.attr('data-product-qty')),
                });

                count++;
            }
        }
        dataLayer.push({ ecommerce: null });
        if (count > 0) {
            dataLayer.push({
                'event': 'purchase',
                'ecommerce': {
                    'transaction_id': $(".js-ga-success-id").attr('data-order-id'),
                    'affiliation': 'Online Store',
                    'value': $(".js-ga-success-total-amount").attr('data-product-total-amount'),
                    'shipping': '0',
                    'currency': 'VND',
                    'items': listItems
                }
            });

            dataLayer.push({
                'transactionId': $(".js-ga-success-id").attr('data-order-id'),
                'transactionTotal': $(".js-ga-success-total-amount").attr('data-product-total-amount'),
                'event': 'purchase_completed'
            });
        }
    }
};
