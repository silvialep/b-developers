import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import.meta.glob([
    '../img/**'
])

var button = document.querySelector('#submit-button');

braintree.dropin.create({
    authorization: 'sandbox_9q5b3ysf_vh227kz76xftxhz9',
    selector: '#dropin-container'
}, function (err, instance) {
    button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
            // Submit payload.nonce to your server
            // console.log(err);
        });
    })
});