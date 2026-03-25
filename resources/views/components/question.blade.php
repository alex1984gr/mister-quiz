@props(['question'=>$question])

<div class="mb4">
    <p class="center title">{{ $question->question }}</p>

    <div class="checkboxes-wrapper" class="center">
        @foreach ($question->answers as $answer)
            <label class= "answer-option">
                <input
                    type="radio"
                    name="{{ $question->id }}"
                    value="{{ $answer->answer }}"
                >
                {{ $answer->answer }}
            </label>
        @endforeach
    </div>

    <div class="center line"></div>
</div>
