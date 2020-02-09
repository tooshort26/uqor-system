@component('mail::message')
# SDSSU University Online Reporting System
We're very sorry but the account that you've request is rejected by the administrator.

@component('mail::button', ['url' => 'http://university-quarterly.herokuapp.com/campus/login', 'color' => 'blue'])
    Try Again
@endcomponent

Thanks,<br>
Administrator
@endcomponent