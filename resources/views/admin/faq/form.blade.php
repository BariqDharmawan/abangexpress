<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @isset($data)
        @method('PUT')
    @endisset
    <div class="form-group">
        <label @empty($data) for="question" @else for="question_edit" @endempty>
            Question
        </label>
        <input type="text" class="form-control" placeholder="Put the question here"
        @empty($data) name="question" @else name="question_edit" @endempty
        @empty($data) id="question" @else id="question_edit" @endempty
        value="{{ isset($data) ? $data->question : old('question') }}"
        minlength="4" maxlength="100" required>

        @error(isset($data) ? 'question_edit' : 'question')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label @empty($data) for="answer" @else for="answer_edit" @endempty>Answer</label>
        <textarea @empty($data) name="answer" @else name="answer_edit" @endempty class="form-control" placeholder="Please make it shorter an effective"
        @empty($data) id="answer" @else id="answer_edit" @endempty
        rows="8" required>{{ isset($data) ? (old('answer_edit') ?? $data->answer) : 
        old('answer') }}</textarea>

        @error(isset($data) ? 'question_edit' : 'question')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>