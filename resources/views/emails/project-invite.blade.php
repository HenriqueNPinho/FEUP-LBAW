@component('mail::message')
# Project Invite

You have been invited to work on a project: {{$project->name}}. To accept click the button bellow, and to decline just ignore this email.
This invite is only valid for 7 days.

@component('mail::button', ['url' => $url])
Accept
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
