<div class="flex flex-col items-stretch justify-start w-full mt-1 mb-5">
    @if (count($list) > 0)
        @php
            $i = 1;
        @endphp
        @foreach ($list as $item)
            <div
                @if ($i == 1)
                    class="flex flex-row items-center justify-between p-2 my-1 bg-yellow-100 border border-yellow-500 rounded-md"
                @else
                    class="flex flex-row items-center justify-between p-2 my-1 border rounded-md"
                @endif
            >
                <div class="flex items-center justify-center w-8 h-8 mx-3 text-gray-600 border rounded-md bg-slate-200">
                    <span class="text-xs uppercase">{{$item['user']->name[0]}}</span>
                </div>
                <p class="mr-2 text-sm font-bold text-gray-700">{{$item['user']->name}}</p>
                <p class="text-sm text-gray-600"><span class="">{{$item['rounds']}}</span> kör</p>
                <p class=""><span class="font-bold">{{$item['points']}}</span><span class="ml-1 text-sm text-gray-500">pont</span></p>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    @else
        <div class="flex flex-col items-center justify-between py-5 my-1 text-gray-400 border rounded-md">
            <span class="material-symbols-outlined">
                warning
            </span>
            <p>Nincs elem</p>
        </div>
    @endif
</div>
