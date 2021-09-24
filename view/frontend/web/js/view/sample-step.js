/**
 * @author Andre Santos <flp_andre@yahoo.com.br>
 */

define([
    'ko',
    'uiComponent',
    'underscore',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
    'Magento_Checkout/js/model/quote'
], function (ko, Component, _, stepNavigator, $t, quote) {
    'use strict';

    /**
     * Sample Step - demonstration of a new checkout step
     */
    return Component.extend({
        defaults: {
            template: 'Andre_M2Sample/sample-step'
        },
        sampleMessage: window.checkoutConfig.sampleMessage,

        isVisible: ko.observable(false),

        /**
         * @returns {*}
         */
        initialize: function () {
            this._super();

            console.log(quote.getItems());
            if (this.isStepVisible()) {
                this.isVisible(true);

                stepNavigator.registerStep(
                    'sample_step',
                    null,
                    this.getTitle(),
                    this.isVisible,
                    _.bind(this.navigate, this),
                    15
                );
            }

            return this;
        },

        isStepVisible: function () {
            let items = quote.getItems();

            for (let i = 0; i < items.length; i++) {
                if (items[i].product.prop65 !== "0") {
                    return true;
                }
            }

            return false;
        },

        /**
         * Get step title
         * @returns {*}
         */
        getTitle: function () {
            return $t('Sample Step');
        },

        /**
         * Handles navigation logic
         */
        navigate: function () {
            this.isVisible(true);
        },

        /**
         * @returns void
         */
        navigateToNextStep: function () {
            stepNavigator.next();
        },

        /**
         * Get config message from admin
         *
         * @returns {*}
         */
        getConfigMessage: function () {
            return this.sampleMessage;
        }
    });
});
