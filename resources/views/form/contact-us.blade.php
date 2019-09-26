@component('mail::message')


# Contact us form

<b>Name:</b>
{{ $data['name'] }}
<br>
<br>

<b>Email:</b>
{{ $data['email'] }}
<br>
<br>

<b>Phone:</b>
{{ $data['phone'] }}
<br>
<br>

<b>Message:</b>
{{ $data['message'] }}
<br>
<br>



@component('mail::button', ['url' => aurl('contact-us')])
    كل الرسائل من لوحة تحكم الموقع
@endcomponent

@endcomponent
