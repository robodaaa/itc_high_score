<div class="flex flex-col justify-center items-center md:flex-row my-5">
    @if (count($games) > 0)
        <div class="my-1 md:mx-3">
            <a
                @if ("all" == $selected)
                    class="underline text-sm text-gray-950 font-bold hover:text-gray-400"
                @else
                    class="text-sm text-gray-700 hover:text-gray-400"
                @endif
                href="/">
                    Összes
            </a>
        </div>
        @foreach ( $games as $game )
            <div class="my-1 md:mx-3">
                <a
                    @if ($game->slug == $selected)
                        class="underline text-sm text-gray-950 font-bold hover:text-gray-400"
                    @else
                        class="text-sm text-gray-700 hover:text-gray-400"
                    @endif
                    href="/game/{{$game->slug}}">
                        {{$game->name}}
                </a>
            </div>
        @endforeach
    @endif
</div>
