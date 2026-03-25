@extends('app')

@section('content')

<h1 class = " center title">Leaderboard</h1>

<table class="leaderboard-table">
    <thead>
        <tr>
            <th>Rank</th>
            <th>Username</th>
            <th>XP</th>
            <th>Correct Answers</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->xp }}</td>
                <td>{{ $user->total_correct }}</td>
            </tr>
        @endforeach
    </tbody>

</table>

@endsection
