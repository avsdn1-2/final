<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cities') }}
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <!-- <a style="display:block;text-align:center;width:100px;height:25px;margin-bottom:5px;border:1px solid grey;" href="">Add Blog</a>-->

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-disc">
                    @foreach($data as $code => $city)
                        <div style="width:300px;height:100px;margin:0 10px 10px 0;border:1px solid green;float:left">
                            <div style="width:100%;">{{$city['station']['name'].' ('.$code.')'}} </div>
                            <div style="width:50%;height:50px;float:left;border:1px solid magenta;"></div>
                            <div style="width:50%;height:50px;float:left;border:1px solid yellow;">
                                <div style="width:100%;">{{'Temp '.$city['temperature']['celsius']}} </div>

                                <div style="width:100%;">{{'Wind '.$city['wind']['speed_mps']}} </div>
                                <div style="width:100%;">{{'Humidity '.$city['humidity']['percent']}} </div>
                            </div>
                        <!--
                            <div style="width:150px;float:right;">
                                <a style="display:block;text-align:center;width:60px;height:25px;border:1px solid grey;float:left;" href="">Edit</a>
                                <a style="display:block;text-align:center;width:60px;height:25px;border:1px solid grey;float:right;" href="">Delete</a>
                            </div>
                        -->
                        </div>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
