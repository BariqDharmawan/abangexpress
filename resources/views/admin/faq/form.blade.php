<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    <div class="form-group">
        <label for="question">Question</label>
        <input type="text" class="form-control" name="question"
        placeholder="Put the question here" id="question" @if($data) 
        value="{{ $data->question }}" @endif required>
    </div>
    <div class="form-group">
        <label for="answer">Answer</label>
        <textarea name="answer" id="answer" class="form-control"
        placeholder="Please make it shorter an effective" rows="8" required>{{ $data ? $data->answer : '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>