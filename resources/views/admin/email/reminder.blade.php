@component('mail::message')
# Attention !
{{ $msg }}.
@component('mail::button', ['url' => $url])
Click to subscribe again
@endcomponent
<code>Ignore this mail, if your already subscribed </code>
Thanks,<br>
{{ config('app.name') }}
@endcomponent