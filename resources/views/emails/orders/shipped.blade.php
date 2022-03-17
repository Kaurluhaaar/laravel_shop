@component('mail::message')
# **THANK YOU**


We thank you for your purchase, and hope to see you soon.

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Back to our store
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
