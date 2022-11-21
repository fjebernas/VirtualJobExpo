<x-mail::message>
# You've been invited to the screening process!

Congratulations {{ $student->first_name }}!<br/>
You've been invited to the screening process for the following job:<br/>

<x-mail::panel>
Company: {{ $job_post->company->name }}<br/>
Position: {{ $job_post->position }}<br/>
</x-mail::panel>

Please click the button below to start!

<x-mail::button :url="''">
I'm ready, let's start!
</x-mail::button>

God bless and good luck!

Wishing you the best,<br/>
{{ config('app.name') }}
</x-mail::message>
