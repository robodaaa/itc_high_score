@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center p-10 md:w-1/2 md:mx-auto">
    <a class="mx-auto" href="/">
        <img class="w-full mx-auto -mb-16 lg:w-1/2" src="{{asset('images/logo.png')}}" alt="logo">
    </a>
    <livewire:games-list game="all" />

    <div class="w-full">
        <p class="p-0 m-0 text-sm text-gray-500">Összevont</p>
        <livewire:score-list game='all' />
    </div>

    <p class="mt-10 text-xs text-center text-gray-300">2023 © <a class="" href="https://itcrendszerhaz.hu" target="_blank">ITC Kft.</a></p>
</div>
@endsection
