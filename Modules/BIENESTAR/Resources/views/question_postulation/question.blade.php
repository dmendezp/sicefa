@foreach ($questions as $question)
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="question">
                                <h4>{{ $question->question }}</h4>
                            </label>
                            <input type="hidden" class="form-control" name="question[{{ $question->question_id }}]" value="{{ $question->question_id }}" readonly>
                            <select class="form-control" name="answer[{{ $question->question_id }}]" required>
                                <option value="">Selecciona una respuesta</option>
                                @foreach ($answers as $answer)
                                    @if ($answer->question_id == $question->question_id)
                                        <option value="{{ $answer->answer }}">{{ $answer->answer }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <p>Suba el formato Registro Socio Economico</p>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="socioeconomicFile" name="socioeconomicFile" accept=".doc, .docx" onchange="updateFileName()" required>
                    <label class="custom-file-label" for="socioeconomicFile">Seleccionar archivo</label>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateFileName() {
        var input = document.getElementById('socioeconomicFile');
        var fileName = input.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    }
</script>