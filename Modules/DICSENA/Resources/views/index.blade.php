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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        <i class="fas fa-globe"></i> DICSENA
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ route('cefa.welcome') }}" class="dropdown-item">Return to SICEFA</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.home.index') }}" style="color: white;">Translator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.guide')}}" style="color: white;">Guide</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.gloss')}}" style="color: white;">Glossary</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cefa.dicsena.aprendiz') }}" data-toggle="tooltip" data-placement="top" data-title="¿Necesitas ayuda en el uso?" data-color="#ffffff" style="color: white;">
                        <i class="fas fa-book-open"></i> Help
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @if(Auth::user())
                @if(Auth::user()->havePermission('dicsena.instructor.menu'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dicsena.instructor.menu') }}" style="color: white;">Panel</a>
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
    <button class="buttontranslate">Translate the Text</button>
</div>
<style>
    /* Import Google Font - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    footer {
        text-align: center;
        padding: 3px;
        background-color: #dddddd;
        color: white;
    }

    a {
        color: white;
    }


    .conttraduction-select {
        max-width: 690px;
        width: 100%;
        padding: 30px;
        background: #fff;
        border-radius: 7px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.01);
    }

    .wrapper .text-input {
        display: flex;
        border-bottom: 1px solid #ccc;
    }

    .text-input .to-text {
        border-radius: 0px;
        border-left: 1px solid #ccc;
    }

    .text-input textarea {
        height: 250px;
        width: 100%;
        border: none;
        outline: none;
        resize: none;
        background: none;
        font-size: 18px;
        padding: 10px 15px;
        border-radius: 5px;
    }

    .text-input textarea::placeholder {
        color: #b7b6b6;
    }

    .controls,
    li,
    .icons,
    .icons i {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .controls {
        list-style: none;
        padding: 12px 15px;
    }

    .controls .row .icons {
        width: 38%;
    }

    .controls .row .icons i {
        width: 50px;
        color: #adadad;
        font-size: 14px;
        cursor: pointer;
        transition: transform 0.2s ease;
        justify-content: center;
    }

    .controls .row.from .icons {
        padding-right: 15px;
        border-right: 1px solid #ccc;
    }

    .controls .row.to .icons {
        padding-left: 15px;
        border-left: 1px solid #ccc;
    }

    .controls .row select {
        color: #333;
        border: none;
        outline: none;
        font-size: 18px;
        background: none;
        padding-left: 5px;
    }

    .text-input textarea::-webkit-scrollbar {
        width: 4px;
    }

    .controls .row select::-webkit-scrollbar {
        width: 8px;
    }

    .text-input textarea::-webkit-scrollbar-track,
    .controls .row select::-webkit-scrollbar-track {
        background: #fff;
    }

    .text-input textarea::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 8px;
    }

    .controls .row select::-webkit-scrollbar-thumb {
        background: #999;
        border-radius: 8px;
        border-right: 2px solid #ffffff;
    }

    .controls .exchange {
        color: #adadad;
        cursor: pointer;
        font-size: 16px;
        transition: transform 0.2s ease;
    }

    .controls i:active {
        transform: scale(0.9);
    }

    .container button {
        width: 100%;
        padding: 14px;
        outline: none;
        border: none;
        color: #fff;
        cursor: pointer;
        margin-top: 20px;
        font-size: 17px;
        border-radius: 5px;
        background: #1c80bb;
    }

    @media (max-width: 660px) {
        .conttraduction {
            padding: 20px;
        }

        .wrapper .text-input {
            flex-direction: column;
        }

        .text-input .to-text {
            border-left: 0px;
            border-top: 1px solid #ccc;
        }

        .text-input textarea {
            height: 200px;
        }

        .controls .row .icons {
            display: none;
        }

        .container button {
            padding: 13px;
            font-size: 16px;
        }

        .controls .row select {
            font-size: 16px;
        }

        .controls .exchange {
            font-size: 14px;
        }

        .translation-select {
            color: #333;
            border: none;
            outline: none;
            font-size: 18px;
            background: none;
            padding-left: 5px;
        }


    }
</style>
<script src="{{ asset('modules/dicsena/js/countries.js') }}"></script>
<script src="{{ asset('modules/dicsena/js/script.js') }}"></script>

@endsection