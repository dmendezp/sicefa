<footer class="footer">
    <section class="footer_container container">
    <nav class="nav nav--footer">
    <h2 class="footer_title">{{trans('agrocefa::footer."La Angostura" Agro-Industrial Training Center')}}</h2>
    <ul class="nav_link nav_link--footer">
        <li class="nav_items">
            <a href="{{ route('agrocefa.index') }}" class="nav_links" id="fin">{{trans('agrocefa::footer.Start')}}</a>
        </li>
        <li class="nav_items">
            <a href="{{ route('agrocefa.desarrolladores.index') }}" class="nav_links">{{trans('agrocefa::footer.Developers')}}</a>
        </li><li class="nav_items">
            <a href="{{ route('agrocefa.usuario.index') }}" class="nav_links">{{trans('agrocefa::footer.About AGROCEFA')}}</a>
        </li>
        <li class="nav_items">
            <a href="#r" class="nav_links">{{trans('agrocefa::footer.Reports')}}</a>
        </li>  
    </ul>
    </nav>
    <form  class="footer_form">
        <h2 class="footer_newsletter">{{trans('agrocefa::footer.Farming Data With Code!')}}</h2>
    </form>
    
    </section>
    <section class="footer_copy container">
        <div class="footer_social">
            <a href="https://www.facebook.com/cefahuila" class="footer_icons"><img src="{{ asset('agrocefa/images/footer/facebook.svg') }}" class="footer_img"></a>
            <a href="https://twitter.com/CEFAcomunica" class="footer_icons"><img src="{{ asset('agrocefa/images/footer/twiter.svg') }}"></a>
        </div>
        <h3 class="footer_copyright">{{trans('agrocefa::footer.All rights reserved')}} &copy; AGROCEFA</h3>
    </section>
    </footer>
    