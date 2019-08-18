@component('mail::message')
{{-- # Verify email --}}

# التحقق من البريد الإلكترونى

هذه الرسالة من  {{ config('app.name') }} للتحقق من بريدك الإلكترونى أنه بريد صحيح لديك بالفعل.

@component('mail::button', ['url' => $data['url']])
{{-- Click here to create a new password --}}
اضغط هنا لتفعيل بريدك الإلكترونى
@endcomponent

<br>
<div style="text-align: center;">
{{-- ---------------OR--------------- --}}
---------------أو---------------
</div>
<br>
<br>
{{-- Go to this link: <a href="{{ $data['url'] }}" _blank="target">{{ $data['url'] }}</a> --}}
اضغط على هذا الرابط: <a href="{{ $data['url'] }}" _blank="target">{{ $data['url'] }}</a>

{{-- Thanks,<br> --}}
شكرا لتسجيلك فى موقعنا <a href="{{ url('/') }}" _blank="target">{{ config('app.name') }}</a>
@endcomponent
