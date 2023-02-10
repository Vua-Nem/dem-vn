<div class="count-down countdown">
    <div class="title">{{$countDowns->title}}</div>   
    <div class="content">
        <div class="label">{{$countDowns->name}}</div>
        <div class="time" id="countdown">
            <div class="deals-time day">
                <div class="num-time" id="num-day">00</div>
                <div class="title-time">ngày</div>
            </div>
            <div class="deals-time hours">
                <div class="num-time" id="num-hours">00</div>
                <div class="title-time">giờ</div>
            </div>
            <div class="deals-time minutes">
                <div class="num-time" class="num-minutes">00</div>
                <div class="title-time">phút</div>
            </div>
            <div class="deals-time seconds">
                <div class="num-time" class="num-seconds">00</div>
                <div class="title-time">giây</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    CountDownTimer('{{ $countDowns->end_date }}', 'countdown', '{{ $countDowns->start_hour }}');
</script>
@endpush