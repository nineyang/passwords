@component('mail::message')
# Hello,{{$user->name}}

{{$lineText}}

Your code:

@component('mail::button', ['url' => ''])
{{$code}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
