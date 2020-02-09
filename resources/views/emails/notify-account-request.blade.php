@component('mail::message')
# SDSSU University Online Reporting System
Your account has been reviewed by the administrator you can now login your account 

@component('mail::button', ['url' => 'http://university-quarterly.herokuapp.com/campus/login', 'color' => 'green'])
    Sign In
@endcomponent

Thanks,<br>
Administrator
@endcomponent