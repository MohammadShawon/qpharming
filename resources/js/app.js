/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#fcr',
    data: {

        given_chicks_quantity: 0,
        chicks_rate: 0,
        sold_quantity: 0,
        sold_kg: 0,
        farm_loose_quantity: 0,
        farm_loose_kg: 0,
        farm_stock_quantity: 0,
        farm_stock_kg: 0,
        cartoon_dead: 0,
        farm_dead: 0,
        farm_loose_rate: 0,
        selling_rate:0,
        excess_feed_cutting: 0,
        report_book_cutting: 30,
        transport_cost: 0,
        stamp_cost: 100,
        advance_payment: 0,
        previous_due: 0,
        others_cutting: 0,
        feed_eaten_sacks: 0,

    },
    computed: {
        average_weight() {
            return Number(this.sold_kg / this.sold_quantity).toFixed(5);
        },
        missing_quantity() {
            return Number(this.given_chicks_quantity) - (Number(this.sold_quantity) + Number(this.farm_loose_quantity) + Number(this.farm_stock_quantity) + Number(this.farm_dead) + Number(this.cartoon_dead));
        },
        missing_kg() {
            return Number((Number(this.given_chicks_quantity) - (Number(this.sold_quantity) + Number(this.farm_loose_quantity) + Number(this.farm_stock_quantity) + Number(this.farm_dead) + Number(this.cartoon_dead))) * Number(this.average_weight)).toFixed(5);
        },
        bonus_chicks() {
            return Number(Number(this.given_chicks_quantity) * 0.03)
        },
        bonus_chicks_money() {
            return Number(Number(this.chicks_rate) * Number(this.bonus_chicks))
        },
        excess_dead() {
            if (Number(this.farm_dead) < Number(this.bonus_chicks))
            {
                return (Number(Number(this.bonus_chicks) - Number(this.farm_dead)) * -1);
            }
            return Math.abs(Number(Number(this.bonus_chicks) - Number(this.farm_dead)));

        },
        farm_loose_cutting() {
            return Number(Number(this.farm_loose_kg) * Number(this.farm_loose_rate));
        },
        farm_stock_cutting() {
            return Number(Number(this.farm_stock_kg) * Number(this.selling_rate))
        },
        excess_dead_cutting() {

            return Number(Number(this.excess_dead) * Number(this.chicks_rate));

        },
        missing_chicks_cutting() {
            return Number(Number(this.missing_quantity) * Number(this.average_weight) * Number(this.selling_rate));
        },
        fcr() {
            return Number((Number(this.sold_kg)+ Number(this.farm_loose_kg) + Number(this.farm_stock_kg)) / Number(this.feed_eaten_sacks)).toFixed(5);
        },
        commission_rate() {
            if (Number(this.fcr) >= 33)
            {
                return Number(12);
            }
            else if(Number(this.fcr) >= 31.75 && Number(this.fcr) < 33)
            {
                return Number(11);
            }
            else if(Number(this.fcr) >= 30.75 && Number(this.fcr) < 31.75)
            {
                return Number(10);
            }
            else if(Number(this.fcr) >= 29.75 && Number(this.fcr) < 30.75)
            {
                return Number(8);
            }
            else
            {
                return 0;
            }
        },

        sub_total() {
            return Number((Number(this.sold_kg) + Number(this.farm_loose_kg) + Number(this.farm_stock_kg)) * Number(this.commission_rate));
        },
        total_cutting_amount() {
            return Number(Number(this.farm_loose_cutting) + Number(this.farm_stock_cutting) + Number(this.excess_dead_cutting) + Number(this.missing_chicks_cutting) + Number(this.excess_feed_cutting) + Number(this.report_book_cutting) + Number(this.transport_cost) + Number(this.stamp_cost) + Number(this.advance_payment) + Number(this.previous_due) + Number(this.others_cutting));
        },
        grand_total() {
            return Number(Number(this.sub_total) - Number(this.total_cutting_amount));
        }

    }
});

