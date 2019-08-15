@component('mail::message')
# Reset Password

This message from {{ config('app.name') }} to change your password.

@component('mail::button', ['url' => $data['url']])
Click here to create a new password
@endcomponent

<br>
<div style="text-align: center;">
---------------OR---------------
</div>
<br>
<br>
Go to this link: <a href="{{ $data['url'] }}" _blank="target">{{ $data['url'] }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
