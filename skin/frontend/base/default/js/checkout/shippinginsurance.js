// Small fix to extend Checkout class functionality (opcheckoout.js), and do not change original files
(function(gotoSection) {
    Checkout.prototype.gotoSection = function (section, reloadProgressBlock) {
        // call original function
        gotoSection.call(this, section, reloadProgressBlock);

        // my extended code here
        if (section === 'shipping_method') {
            // Refresh shipping insurance container visibility when 'Shipping method' step opens.
            shippingInsurance.onShippingMethodChange();
        }
    };
}(Checkout.prototype.gotoSection));


ShippingInsurance = Class.create();
ShippingInsurance.prototype = {

    _allowedMethods: [],

    _currentMethod: false,

    initialize: function (allowedMethods, currentMethod) {
        this._allowedMethods = allowedMethods;
        this._currentMethod = currentMethod;
        this._setObservers();
    },

    getShippingMethodValue: function () {
        var elem = $$('input[name=shipping_method]:checked');
        if (elem.length > 0) {
            var selectedValue = elem[0].value;
            var pos = selectedValue.indexOf('_');
            if (pos >= 0) {
                return selectedValue.substr(0, pos);
            }
        }

        return false;
    },

    _isAllowedMethod: function (methodName) {
        return (this._allowedMethods.indexOf(methodName) >= 0);
    },

    _setObservers: function () {
        // Set event observer for entire container instead of set it to all radio inputs
        // due they loads dynamically.
        Event.observe($('checkout-shipping-method-load'), 'change', this.onShippingMethodChange.bindAsEventListener(this));

        Event.observe($('shipping-insurance-applied'), 'change', this.onShippingInsuranceChange.bindAsEventListener(this));
    },

    _setInsuranceContainerVisibility: function(isAllowedMethod) {
        var container = $('checkout-shipping-insurance-container');
        var insuranceCheckbox = $('shipping-insurance-applied');
        var insuranceFeeValue = $('checkout-shipping-insurance-value');

        if (!isAllowedMethod) {
            // Hide container, uncheck checkbox and reset method
            container.hide();
            insuranceCheckbox.setValue(false);
            insuranceFeeValue.update('');
            this._currentMethod = false;
            return;
        }

        var selectedMethod = this.getShippingMethodValue();
        if (this._currentMethod !== selectedMethod) {
            container.show();
            this.onShippingInsuranceChange();
            this._currentMethod = selectedMethod;
        }
    },

    onShippingMethodChange: function () {
        // check which method is selected
        var selectedMethod = this.getShippingMethodValue();
        // check which method is selected
        var isAllowedMethod = this._isAllowedMethod(selectedMethod);
        this._setInsuranceContainerVisibility(isAllowedMethod);
    },

    onShippingInsuranceChange: function () {
        var elem = $('shipping-insurance-applied');
        if (!elem.checked) {
            return false;
        }

        //TODO: Ajax call to request shipping insurance fee.
    }

};
