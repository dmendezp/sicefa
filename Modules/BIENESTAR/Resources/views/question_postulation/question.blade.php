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
                        <input type="hidden" class="form-control" id="question" name="question" value="{{ $question->id }}" readonly>
                        <select class="form-control" id="answer" name="answer[]">
                            <option value="">Seleccion una respuesta</option>
                            @foreach ($answers as $answer)
                            @if ($answer->question_id == $question->id)
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
                    <input type="file" class="custom-file-input" id="docpicker" accept=".doc, .docx" onchange="updateFileName()">
                    <label class="custom-file-label" for="docpicker">Seleccionar archivo</label>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateFileName() {
        var input = document.getElementById('docpicker');
        var fileName = input.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    }
</script>