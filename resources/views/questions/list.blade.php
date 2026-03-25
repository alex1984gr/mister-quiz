@extends('app')

@section('content')

<form action="{{ route('quiz') }}" method="post">
    @csrf

    @foreach ($questions as $question)
        <x-question :question="$question" />
    @endforeach

    <button type="submit" class="center green-btn">Submit</button>
</form>


@endsection