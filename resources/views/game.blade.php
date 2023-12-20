@extends('layouts.app')

@section('content')
<div class="p-10 flex flex-col justify-center items-center md:w-1/2 md:mx-auto">
    <a class="mx-auto" href="/">
        <img class="w-full mx-auto -mb-16 lg:w-1/2" src="{{asset('images/logo.png')}}" alt="logo">
    </a>
    <livewire:games-list game="{{$game->slug}}" />

    <div class="w-full">
        <p class="m-0 p-0 text-sm text-gray-500">{{$game->name}}</p>
        <livewire:score-list game='{{$game->slug}}' />
    </div>

    <p class="text-xs text-gray-300 mt-10">2023 © <a class="" href="https://itcrendszerhaz.hu" target="_blank">ITC Kft.</a></p>
</div>
@endsection
