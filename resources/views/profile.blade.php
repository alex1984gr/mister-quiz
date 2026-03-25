@extends('app')

@section('content')

<a class="top-right-corner red-btn" href="{{ route('home') }}">Back ></a>

<div style="margin-top:100px">

    <div class="profile-header">
        <p class="title profile-name">{{ $user->username }}</p>
        <p class="title profile-email">{{ $user->email }}</p>
    </div>

    <div class="profile-header">
        <p class="title profile-xp">{{ $user->xp }} XP</p>
        <p class="title profile-rank">Rank: {{ $rank }}</p>
    </div>

    <div class="profile-stats">

        @foreach ($stats as $category => $data)
            <div class="category-box">
                <h3>{{ ucfirst($category) }}</h3>

                <p>Correct: {{ $data['correct'] }}</p>
                <p>Total: {{ $data['total'] }}</p>
                <p>Success: {{ $data['percentage'] }}%</p>
            </div>
        @endforeach

    </div>

</div>

@endsection
