@extends('layouts.email')

@section('body')
    <p style="font-size: 18px; font-weight: 800; line-height: 24px; color: #333333;">
        Hello {{ $name }},
    </p>

    <div style="font-size: 16px; font-weight: 400; line-height: 24px; color: #333333;">
        You are receiving this email because we received a password reset request for your user account.
                            
        <div style="text-align:center;margin:20px">
            <a href="{{ route('password.reset', $token) }}" style="background-color:#028dc8;color:#ffffff;display:inline-block;font-family:brandon-grotesque;text-transform: uppercase;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Reset Password</a>
        </div>
        If you did not request a password reset, no further action is required.
    </div>

    <p style="font-size: 16px; font-weight: 600; line-height: 24px; color: #333333;">                              
        Thanks,<br>
        {{ env('APP_NAME','Laravel') }} Team
    </p>
@endsection