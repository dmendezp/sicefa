@foreach ($results as $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">{{ trans('bienestar::menu.Question')}}</label>
                            <input type="text" class="form-control" id="nombre" value="{{ $question->question }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tipo_pregunta">{{ trans('bienestar::menu.Answer')}}</label>
                            <div class="form-group">
                                <select class="form-control" id="tipo_pregunta" readonly>
                                    @foreach ($answers as $answer)
                                    @if ($answer->question_id == $question->id)
                                    <option value="{{ $answer->id }}">{{ $answer->answer }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach