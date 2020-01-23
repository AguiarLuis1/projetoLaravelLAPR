<link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
<script src="https://js.stripe.com/v3/"></script>
<h2>Total a pagar:{{$total}}</h2>
<form action="{{ route('books.checkout') }}" method="post" id="payment-form">
    <div class="form-row">
        <p><input type="hidden" name="amount" value="{{$total}}"></p>
        <p><input type="email" name="email" placeholder="Insira o seu e-mail" /></p>
        <label for="card-element">
        Informações de cartão e código postal:
        </label>
        <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <button class="btn btn-success float-right">Fazer pagamento</button>
    {{ csrf_field() }}
</form>
<script>
var publishable_key = '{{ env('STRIPE_PUBLISHABLE_KEY') }}';
</script>
<script src="{{ asset('/js/card.js') }}"></script>
