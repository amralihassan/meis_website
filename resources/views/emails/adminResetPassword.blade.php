@component('mail::message')
# Reset Account
Welcome {{$data['data']->name}}

The body of your message.

@component('mail::button', ['url' => aurl("reset/password/".$data["token"])])
Click Here
@endcomponent
or <br>
click this link
<a href='{{aurl("reset/password/".$data["token"])}}'>{{aurl("reset/password/".$data["token"])}}</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
