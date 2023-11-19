<div class="payment_method">
    <label><input name="payment_method" type="radio" id="paypal_radio">PAYPAL</label>
    <div class="panel panel-default credit-card-box mt-5" id="paypal_form">
        <div class="panel-body">

            @if (session('success'))
                <script>
                    // Swal.fire({
                    //     title: 'Thành công',
                    //     text: '{{ session('success') }}',
                    //     icon: 'success',
                    //     confirmButtonText: 'OK'
                    // });
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif

            <form role="form" action="{{ route('stripe_order',$totalPrice) }}" method="post" class="require-validation" data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                @csrf

                <div class='form-row row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                            type='text'>
                    </div>
                </div>

                <div class='form-row row'>
                    <div class='col-xs-12 form-group card required'>
                        <label class='control-label'>Card Number</label> <input autocomplete='off'
                            class='form-control card-number' size='20' type='text'>
                    </div>
                </div>

                <div class='form-row row'>
                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                        <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc'
                            placeholder='ex. 311' size='4' type='text'>
                    </div>
                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>Expiration Month</label> <input
                            class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                    </div>
                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>Expiration Year</label> <input
                            class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                    </div>
                </div>

                <div class='form-row row'>
                    <div class='col-md-12 error form-group hide'>
                        <div class='alert-danger alert'>Please correct the errors and
                            try
                            again.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-black" type="submit">Pay Now</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
    <script>
        // Lắng nghe sự kiện khi người dùng chọn phương thức thanh toán
        var paypalRadio = document.getElementById('paypal_radio');
        paypalRadio.addEventListener('change', function() {
            var paypalForm = document.getElementById('paypal_form');

            // Kiểm tra xem radio button đã được chọn hay chưa
            if (paypalRadio.checked) {
                // Hiển thị form thanh toán PayPal
                paypalForm.style.display = 'block';
            } else {
                // Ẩn form thanh toán PayPal
                paypalForm.style.display = 'none';
            }
        });

        // Lắng nghe sự kiện khi người dùng chọn phương thức thanh toán khác
        var otherRadio = document.querySelector('input[name="payment_method"]:not(#paypal_radio)');
        otherRadio.addEventListener('change', function() {
            var paypalForm = document.getElementById('paypal_form');

            // Ẩn form thanh toán PayPal
            paypalForm.style.display = 'none';
        });

    </script>
</div>
