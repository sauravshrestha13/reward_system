@extends('layouts.email')

@section('body')

    <p style="font-size: 18px; font-weight: 800; line-height: 24px; color: #333333;">
        Hello {{ $user->name }},
    </p>
    <div style="font-size: 16px; font-weight: 400; line-height: 24px; color: #333333;">

        You recently registered {{ $user->email }} as your email address for your account. To verify that this email address belongs to you, please click on the link below and then sign in using this email and password.
        <div style="text-align:center;margin:20px">
            <a href="{{ $url }}" style="background-color:#028dc8;color:#ffffff;display:inline-block;font-family:brandon-grotesque;text-transform: uppercase;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Confirm Email</a>
        </div>
        If you did not make this registration, you can ignore this email.

    </div>
    <p style="font-size: 16px; font-weight: 600; line-height: 24px; color: #333333;">                              
    Thanks,<br>
    {{ env('APP_NAME','Laravel') }} Team
    </p>
@endsection