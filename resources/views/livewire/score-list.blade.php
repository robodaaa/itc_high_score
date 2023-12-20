<div class="mt-1 mb-5 w-full">
    @if (count($list) > 0)
        @php
            $i = 1;
        @endphp
        @foreach ($list as $item)
            <div
                @if ($i == 1)
                    class="border rounded-md p-2 flex flex-row justify-between items-center my-1 bg-yellow-100 border-yellow-500"
                @else
                    class="border rounded-md p-2 flex flex-row justify-between items-center my-1">
                @endif
                <div class="mx-3 w-8 h-8 border rounded-md flex justify-center items-center bg-slate-200 text-gray-600">
                    <span class="text-xs uppercase">{{$item['user']->name[0]}}</span>
                </div>
                <p class="text-sm text-gray-700 mr-2 font-bold">{{$item['user']->name}}</p>
                <p class="text-sm text-gray-600"><span class="">{{$item['rounds']}}</span> kör</p>
                <p class=""><span class="font-bold">{{$item['points']}}</span><span class="text-sm text-gray-500 ml-1">pont</span></p>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    @else
        <div class="border rounded-md py-5 flex flex-col justify-between items-center my-1 text-gray-400">
            <span class="material-symbols-outlined">
                warning
            </span>
            <p>Nincs elem</p>
        </div>
    @endif
</div>
