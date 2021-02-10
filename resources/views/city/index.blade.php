<x-app-layout>
    <x-slot name="header">

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-disc">
                        <div style="width:1250px;margin:0 auto;">
                            @foreach($data as $code => $city)
                                <div style="width:300px;height:130px;margin:0 10px 10px 0;font-size:12px;float:left">
                                    <div style="width:100%;margin-left:25px;font-weight:bold;">{{$city['station']['name'].' ('.$code.')'}} </div>
                                    <div style="width:70px;height:70px;margin-right:30px;float:left;"><img width="70" height="70" src="{{asset($city['picture'])}}"></div>
                                    <div style="width:50%;height:70px;float:left;">
                                        <div style="height:20px;margin:0 0 5px 0;">
                                            <div style="width:45%;float:left;">Temperature,C</div>
                                            <div style="width:45%;float:right;text-align:center">{{$city['temperature']['celsius']}} </div>
                                        </div>

                                        <div style="height:20px;margin:0 0 5px 0;">
                                            <div style="width:45%;float:left;">Wind,m/s</div>
                                            @if(isset($city['wind']))
                                                <div style="width:45%;float:right;text-align:center">{{  $city['wind']['speed_mps']}} </div>
                                            @else
                                                <div style="width:45%;float:right;text-align:center">{{'-'}} </div>
                                            @endif
                                        </div>

                                        <div style="height:20px;margin:0 0 5px 0;">
                                            <div style="width:45%;float:left;">Humidity,%</div>
                                            <div style="width:45%;float:right;text-align:center">{{$city['humidity']['percent']}} </div>
                                        </div>
                                    </div>

                                    @if(Auth::check())
                                        @if ($city['favorite'] == false)
                                            <div style="width:120px;margin:0 auto;"><a href="/update/{{$code}}"><button type="button" class="btn-sm btn-warning">ADD TO FAVOR</button></a></div>
                                        @else
                                            <div style="width:130px;margin:0 auto;"><a href="/update/{{$code}}"><button type="button" class="btn-sm btn-secondary">REMOVE FM FAV</button></a></div>
                                        @endif
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
