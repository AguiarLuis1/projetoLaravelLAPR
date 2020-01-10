@component('mail::message')

<strong>Nome:</strong> {{ $data['name'] }}
<strong>Email:</strong> {{ $data['email'] }}

<strong>Message:</strong>

{{ $data['message'] }}
@endcomponent
