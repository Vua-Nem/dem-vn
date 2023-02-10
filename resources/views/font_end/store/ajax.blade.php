<?php $i = 1 ?>
@foreach($retailers as $retailer)
    <li class="result-item">
        <div class="heading" style="display: flex">
            <p class="name-label" style="flex: 1">
                <span>{{$i}}</span>. <strong>{{$retailer->name}}</strong>
{{--                <span>{{$i}}</span>. <strong>{{$retailer->name}} - @if(isset($retailer->distance) && $retailer->distance > -1) ({{$retailer->distance}} km)@endif</strong>--}}
            </p>
        </div>
        <div class="details">
            <p class="address" style="flex:1">
            <span> {{$retailer->address}}, {{$retailer->districts->name}}, {{$retailer->province->name}}
                <br>
                <span>Điện thoại :
                    <span>{{$retailer->phone_store}}</span>
                </span>
                <br>
                <span>Giờ mở cửa :
                    <span>{{ $retailer->opening_time }}</span>
                </span>
            </span>
            </p>

        </div>
    </li>
    <?php $i++; ?>
@endforeach