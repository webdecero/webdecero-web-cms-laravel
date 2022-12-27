

<script src="{{ asset('contentbuilder/contentbuilder.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/minimalist-blocks/content.js') }}" type="text/javascript"></script>
<script src="{{ asset('contentbuilder/lang/en.js')}}" type="text/javascript"></script>

<script>
    var builder = new ContentBuilder({
        container: '.container',
        slider: 'glide',
        toolbarAddSnippetButton: true,
        snippetPath: 'assets/minimalist-blocks/', // Location of snippets' assets
        modulePath: 'assets/modules/',
        assetPath: 'assets/',
        fontAssetPath: '/assets/fonts/',
        buttons: ['bold', 'italic', 'createLink', 'align', 'color', 'formatPara', 'font', 'formatting', 'list', 'textsettings', 'image', 'tags', 'removeFormat'],
        buttonsMore: ['icon', 'html', 'preferences'],
        row: 'row',
        cols: ['col-md-1', 'col-md-2', 'col-md-3', 'col-md-4', 'col-md-5', 'col-md-6', 'col-md-7', 'col-md-8', 'col-md-9', 'col-md-10', 'col-md-11', 'col-md-12'],
        plugins: [
          { name: 'preview', showInMainToolbar: true, showInElementToolbar: true },
          { name: 'wordcount', showInMainToolbar: true, showInElementToolbar: true },
          { name: 'symbols', showInMainToolbar: true, showInElementToolbar: true },
          { name: 'buttoneditor', showInMainToolbar: true, showInElementToolbar: true }
        ],
        snippetOpen: true,
        useLightbox: true,
        pluginPath: 'contentbuilder/',
        themes: [
            ['#ffffff','',''],
            ['#282828','dark','contentbuilder/themes/dark.css'],
            ['#0088dc','colored','contentbuilder/themes/colored-blue.css'],
            ['#006add','colored','contentbuilder/themes/colored-blue6.css'],
            ['#0a4d92','colored','contentbuilder/themes/colored-darkblue.css'],
            ['#96af16','colored','contentbuilder/themes/colored-green.css'],
            ['#f3522b','colored','contentbuilder/themes/colored-orange.css'],

            ['#b92ea6','colored','contentbuilder/themes/colored-magenta.css'],
            ['#e73171','colored','contentbuilder/themes/colored-pink.css'],
            ['#782ec5','colored','contentbuilder/themes/colored-purple.css'],
            ['#ed2828','colored','contentbuilder/themes/colored-red.css'],
            ['#f9930f','colored','contentbuilder/themes/colored-yellow.css'],
            ['#13b34b','colored','contentbuilder/themes/colored-green4.css'],
            ['#333333','colored-dark','contentbuilder/themes/colored-dark.css'],

            ['#dbe5f5','light','contentbuilder/themes/light-blue.css'],
            ['#fbe6f2','light','contentbuilder/themes/light-pink.css'],
            ['#dcdaf3','light','contentbuilder/themes/light-purple.css'],
            ['#ffe9e0','light','contentbuilder/themes/light-red.css'],
            ['#fffae5','light','contentbuilder/themes/light-yellow.css'],
            ['#ddf3dc','light','contentbuilder/themes/light-green.css'],
            ['#c7ebfd','light','contentbuilder/themes/light-blue2.css'],

            ['#ffd5f2','light','contentbuilder/themes/light-pink2.css'],
            ['#eadafb','light','contentbuilder/themes/light-purple2.css'],
            ['#c5d4ff','light','contentbuilder/themes/light-blue3.css'],
            ['#ffefb1','light','contentbuilder/themes/light-yellow2.css'],
            ['#fefefe','light','contentbuilder/themes/light-gray3.css'],
            ['#e5e5e5','light','contentbuilder/themes/light-gray2.css'],
            ['#dadada','light','contentbuilder/themes/light-gray.css'],

            ['#3f4ec9','colored','contentbuilder/themes/colored-blue2.css'],
            ['#6779d9','colored','contentbuilder/themes/colored-blue4.css'],
            ['#10b9d7','colored','contentbuilder/themes/colored-blue3.css'],
            ['#006add','colored','contentbuilder/themes/colored-blue5.css'],
            ['#e92f94','colored','contentbuilder/themes/colored-pink3.css'],
            ['#a761d9','colored','contentbuilder/themes/colored-purple2.css'],
            ['#f9930f','colored','contentbuilder/themes/colored-yellow2.css'],

            ['#f3522b','colored','contentbuilder/themes/colored-red3.css'],
            ['#36b741','colored','contentbuilder/themes/colored-green2.css'],
            ['#00c17c','colored','contentbuilder/themes/colored-green3.css'],
            ['#fb3279','colored','contentbuilder/themes/colored-pink2.css'],
            ['#ff6d13','colored','contentbuilder/themes/colored-orange2.css'],
            ['#f13535','colored','contentbuilder/themes/colored-red2.css'],
            ['#646464','colored','contentbuilder/themes/colored-gray.css'],

            ['#3f4ec9','dark','contentbuilder/themes/dark-blue.css'],
            ['#0b4d92','dark','contentbuilder/themes/dark-blue2.css'],
            ['#006add','dark','contentbuilder/themes/dark-blue3.css'],
            ['#5f3ebf','dark','contentbuilder/themes/dark-purple.css'],
            ['#e92f69','dark','contentbuilder/themes/dark-pink.css'],
            ['#4c4c4c','dark','contentbuilder/themes/dark-gray.css'],
            ['#ed2828','dark','contentbuilder/themes/dark-red.css'],

            ['#006add','colored','contentbuilder/themes/colored-blue8.css'],
            ['#ff7723','colored','contentbuilder/themes/colored-orange3.css'],
            ['#ff5722','colored','contentbuilder/themes/colored-red5.css'],
            ['#f13535','colored','contentbuilder/themes/colored-red4.css'],
            ['#00bd79','colored','contentbuilder/themes/colored-green5.css'],
            ['#557ae9','colored','contentbuilder/themes/colored-blue7.css'],
            ['#fb3279','colored','contentbuilder/themes/colored-pink4.css'],
        ],
        imageSelect: 'assets.html',
        fileSelect: 'assets.html',
        videoSelect: 'assets.html'
    });
</script>

{{-- @yield('scripts') --}}

@stack('scripts')

</body>
