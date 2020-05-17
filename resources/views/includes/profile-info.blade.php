<div>
    <p class="text-left"><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp;&nbsp;Works at {{ $profile->work }}</p>
    <p class="text-left"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;Lives in {{ $profile->location }}</p>
    <p class="text-left"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grew up in {{ $profile->heritage }}</p>
    @if ($profile->relation_status && $profile->relation)
    <p class="text-left"><i class="fa fa-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;In relation with {{ $profile->relation }}</p>
    @elseif ($profile->relation_status)
    <p class="text-left"><i class="fa fa-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;In relationship</p>
    @else
    <p class="text-left"><i class="fa fa-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;No relationship</p>
    @endif
</div>