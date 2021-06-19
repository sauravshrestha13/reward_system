@if($mno == 0)
    <p class="notification-text font-small-3 text-muted text-xs-center" style="margin:20px">No new messages</p>
@endif
@foreach($messages as $m)
    <?php 
    $interval = \Carbon\Carbon::createFromTimeStamp(strtotime($m->created_at))->diffForHumans();
    ?>
    <a href="{{ route('contact-us-messages.show',$m->id) }}" class="list-group-item">
    <div class="media">
        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="/admin-assets/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span></div>
        <div class="media-body">
        <h6 class="media-heading">{{ $m->name }}</h6>
        <p class="notification-text font-small-3 text-muted" style="line-height:1.2em">Says "{{ $m->subject }}"</p><small>
            <time class="media-meta text-muted">{{ $interval }}</time></small>
        </div>
    </div>
    </a>
@endforeach