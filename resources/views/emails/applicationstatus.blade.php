@extends('layouts.email')

@section('body')
    <p style="font-size: 18px; font-weight: 800; line-height: 24px; color: #333333;">
        Hello {{ $application->user->name }},
    </p>

    <div style="font-size: 16px; font-weight: 400; line-height: 24px; color: #333333;">
        @if($application->status == 'accepted')
            The Review Committee for the NSC Conference would like to inform you that, your abstract been accepted.  <br>
            We are grateful for your time and interest.

            <div style="text-align:center;margin:20px">
                <a href="{{ URL::to('/') }}" style="background-color:#028dc8;color:#ffffff;display:inline-block;font-family:brandon-grotesque;text-transform: uppercase;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Review</a>
            </div>
        @elseif($application->status == 'rejected')
            The Review Committee for the NSC Conference would like to inform you that, unfortunately, your abstract been rejected.
            
        @elseif($application->status == 'under review')
            The Review Committee for the NSC Conference would like to inform you that, your abstract is currently being reviewed. We will contact you again soon. <br>

        @endif
        
    </div>

    <p style="font-size: 16px; font-weight: 600; line-height: 24px; color: #333333;">                              
        Thanks,<br>
        {{ env('APP_NAME','Laravel') }} Team
    </p>
@endsection