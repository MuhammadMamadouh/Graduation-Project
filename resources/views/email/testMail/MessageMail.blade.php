@component('mail::message')
# Hello

We are Happy cause you can send this email by laravel

You can go to your page in facebook from here
@component('mail::button', ['url' => 'https://www.facebook.com/m.mamdouh7'])
Go To My Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
