@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex flex-row justify-content-start">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i> DICSENA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ url('lang', ['es']) }}" class="dropdown-item">Español</a>
                        <a href="{{ url('lang', ['en']) }}" class="dropdown-item">English</a>
                        <a href="{{ route('cefa.welcome') }}" class="dropdown-item">Volver a SICEFA</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.home.index') }}">Traductor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.guide')}}">Guia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.gloss')}}">Glosario</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @if(Auth::user())
                @if(Auth::user()->havePermission('dicsena.instructor.menu'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dicsena.instructor.menu') }}">Panel</a>
                </li>
                @endif
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="wrapper">
        <div class="text-input">
            <textarea spellcheck="false" class="from-text" placeholder="Ingresa el texto a traducir"></textarea>
            <textarea spellcheck="false" readonly disabled class="to-text" placeholder="Traducción"></textarea>
        </div>
        <ul class="controls">
            <li class="row from">
                <div class="icons">
                    <i id="from" class="fas fa-volume-up"></i>
                    <i id="from" class="fas fa-copy"></i>
                </div>
                <select></select>
            </li>
            <li class="exchange"><i class="fas fa-exchange-alt"></i></li>
            <li class="row to">
                <select></select>
                <div class="icons">
                    <i id="to" class="fas fa-volume-up"></i>
                    <i id="to" class="fas fa-copy"></i>
                </div>
            </li>
        </ul>
    </div>
    <button>Traducir el Texto</button>
</div>
<script src="{{ asset('modules/dicsena/js/countries.js') }}"></script>
<script>
    const fromText = document.querySelector(".from-text"),
        toText = document.querySelector(".to-text"),
        exchageIcon = document.querySelector(".exchange"),
        selectTag = document.querySelectorAll("select"),
        icons = document.querySelectorAll(".row i");
    translateBtn = document.querySelector("button"),

        selectTag.forEach((tag, id) => {
            for (let country_code in countries) {
                let selected = id == 0 ? country_code == "es-ES" ? "selected" : "" : country_code == "en-GB" ? "selected" : "";
                let option = `<option ${selected} value="${country_code}">${countries[country_code]}</option>`;
                tag.insertAdjacentHTML("beforeend", option);
            }
        });

    exchageIcon.addEventListener("click", () => {
        let tempText = fromText.value,
            tempLang = selectTag[0].value;
        fromText.value = toText.value;
        toText.value = tempText;
        selectTag[0].value = selectTag[1].value;
        selectTag[1].value = tempLang;
    });

    fromText.addEventListener("keyup", () => {
        if (!fromText.value) {
            toText.value = "";
        }
    });

    translateBtn.addEventListener("click", () => {
        let text = fromText.value.trim(),
            translateFrom = selectTag[0].value,
            translateTo = selectTag[1].value;
        if (!text) return;
        toText.setAttribute("placeholder", "Traduciendo...");
        let apiUrl = `https://api.mymemory.translated.net/get?q=${text}&langpair=${translateFrom}|${translateTo}`;
        fetch(apiUrl).then(res => res.json()).then(data => {
            toText.value = data.responseData.translatedText;
            data.matches.forEach(data => {
                if (data.id === 0) {
                    toText.value = data.translation;
                }
            });
            toText.setAttribute("placeholder", "Traducción");
        });
    });

    icons.forEach(icon => {
        icon.addEventListener("click", ({
            target
        }) => {
            if (!fromText.value || !toText.value) return;
            if (target.classList.contains("fa-copy")) {
                if (target.id == "from") {
                    navigator.clipboard.writeText(fromText.value);
                } else {
                    navigator.clipboard.writeText(toText.value);
                }
            } else {
                let utterance;
                if (target.id == "from") {
                    utterance = new SpeechSynthesisUtterance(fromText.value);
                    utterance.lang = selectTag[0].value;
                } else {
                    utterance = new SpeechSynthesisUtterance(toText.value);
                    utterance.lang = selectTag[1].value;
                }
                speechSynthesis.speak(utterance);
            }
        });
    });
</script>
@endsection