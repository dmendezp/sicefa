<link rel="stylesheet" href="{{ asset('agrocefa/css/footer.css') }}">
<br>
<footer id="footer">
    <section id="footer_container" class="container">
        <nav id="nav_footer">
            <div id="title_and_tagline">
                <h2 id="footer_title">{{ trans('agrocefa::footer."La Angostura" Agro-Industrial Training Center') }}</h2>
                <h2 id="footer_newsletter">{{ trans('agrocefa::footer.Farming Data With Code!') }}</h2>
            </div>
        </nav>
    </section>
    <section id="footer_copy" class="container">
        <ul id="nav_link_footer">
            <li id="nav_item_start">
                <a href="{{ route('agrocefa.index') }}" id="nav_link_start">{{ trans('agrocefa::footer.Start') }}</a>
            </li>
            <li id="nav_item_developers">
                <a href="{{ route('agrocefa.desarrolladores.index') }}"
                    id="nav_link_developers">{{ trans('agrocefa::footer.Developers') }}</a>
            </li>
            <li id="nav_item_about">
                <a href="{{ route('agrocefa.usuario.index') }}"
                    id="nav_link_about">{{ trans('agrocefa::footer.About AGROCEFA') }}</a>
            </li>
            <li id="nav_item_reports">
                <a href="#r" id="nav_link_reports">{{ trans('agrocefa::footer.Reports') }}</a>
            </li>
        </ul>
        <div id="footer_social">
            <a href="https://www.facebook.com/cefahuila" id="footer_icon_facebook">
                <img src="{{ asset('agrocefa/images/footer/facebook.svg') }}" id="footer_img_facebook">
            </a>
            <a href="https://twitter.com/CEFAcomunica" id="footer_icon_twitter">
                <img src="{{ asset('agrocefa/images/footer/twiter.svg') }}" id="footer_img_twitter">
            </a>
        </div>
        <h3 id="footer_copyright_text">{{ trans('agrocefa::footer.All rights reserved') }} &copy; AGROCEFA</h3>
    </section>
</footer>
