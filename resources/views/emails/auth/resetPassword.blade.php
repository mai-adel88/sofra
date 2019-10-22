@component('mail::message')
# Introduction

Sofra Reset Password

{{-- @component('mail::button', ['url' => ''])
Button
@endcomponent --}}

<p>your reset code is {{$user->pin_code}}</p> 

Thanks,<br>
{{ config('app.name') }}
@endcomponent
