@component('mail::message')
# Hello,{{$user->name}}

{{$lineText}}

@component('mail::button', ['url' => $actionUrl])
{{$actionText}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@component('mail::subcopy')
    If you’re having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below
    into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endcomponent
