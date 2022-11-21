<x-mail::message>
# You've been invited to the screening process!

Congratulations! You've been invited to the screening process.<br/>
Please click the link below to start!

<x-mail::button :url="''">
I'm ready, let's start!
</x-mail::button>

Thanks,<br/>
{{ config('app.name') }}
</x-mail::message>
