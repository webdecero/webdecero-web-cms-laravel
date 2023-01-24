

<script src="{{ asset('storage-webcms/manager/contentbuilder/contentbuilder.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('storage-webcms/manager/assets/minimalist-blocks/content.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage-webcms/manager/contentbuilder/lang/en.js')}}" type="text/javascript"></script>

<script>
    var builder = new ContentBuilder({
        container: '.container-builder',
        slider: 'glide',
        sidePanel: 'left',
        toolbarAddSnippetButton: true,
        snippetPath: 'storage-webcms/manager/assets/minimalist-blocks/', // Location of snippets' assets
        modulePath: 'storage-webcms/manager/assets/modules/',
        assetPath: 'storage-webcms/manager/assets/',
        fontAssetPath: '/storage-webcms/manager/assets/fonts/',
        buttons: ['bold', 'italic', 'createLink', 'align', 'color', 'formatPara', 'font', 'formatting', 'list', 'textsettings', 'image', 'tags', 'removeFormat', 'zoom'],
        // buttonsMore: ['icon', 'html', 'preferences'],
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
        pluginPath: 'storage-webcms/manager/contentbuilder/',
        themes: [
            ['#ffffff','',''],
            ['#282828','dark','storage-webcms/manager/contentbuilder/themes/dark.css'],
            ['#0088dc','colored','storage-webcms/manager/contentbuilder/themes/colored-blue.css'],
            ['#006add','colored','storage-webcms/manager/contentbuilder/themes/colored-blue6.css'],
            ['#0a4d92','colored','storage-webcms/manager/contentbuilder/themes/colored-darkblue.css'],
            ['#96af16','colored','storage-webcms/manager/contentbuilder/themes/colored-green.css'],
            ['#f3522b','colored','storage-webcms/manager/contentbuilder/themes/colored-orange.css'],

            ['#b92ea6','colored','storage-webcms/manager/contentbuilder/themes/colored-magenta.css'],
            ['#e73171','colored','storage-webcms/manager/contentbuilder/themes/colored-pink.css'],
            ['#782ec5','colored','storage-webcms/manager/contentbuilder/themes/colored-purple.css'],
            ['#ed2828','colored','storage-webcms/manager/contentbuilder/themes/colored-red.css'],
            ['#f9930f','colored','storage-webcms/manager/contentbuilder/themes/colored-yellow.css'],
            ['#13b34b','colored','storage-webcms/manager/contentbuilder/themes/colored-green4.css'],
            ['#333333','colored-dark','storage-webcms/manager/contentbuilder/themes/colored-dark.css'],

            ['#dbe5f5','light','storage-webcms/manager/contentbuilder/themes/light-blue.css'],
            ['#fbe6f2','light','storage-webcms/manager/contentbuilder/themes/light-pink.css'],
            ['#dcdaf3','light','storage-webcms/manager/contentbuilder/themes/light-purple.css'],
            ['#ffe9e0','light','storage-webcms/manager/contentbuilder/themes/light-red.css'],
            ['#fffae5','light','storage-webcms/manager/contentbuilder/themes/light-yellow.css'],
            ['#ddf3dc','light','storage-webcms/manager/contentbuilder/themes/light-green.css'],
            ['#c7ebfd','light','storage-webcms/manager/contentbuilder/themes/light-blue2.css'],

            ['#ffd5f2','light','storage-webcms/manager/contentbuilder/themes/light-pink2.css'],
            ['#eadafb','light','storage-webcms/manager/contentbuilder/themes/light-purple2.css'],
            ['#c5d4ff','light','storage-webcms/manager/contentbuilder/themes/light-blue3.css'],
            ['#ffefb1','light','storage-webcms/manager/contentbuilder/themes/light-yellow2.css'],
            ['#fefefe','light','storage-webcms/manager/contentbuilder/themes/light-gray3.css'],
            ['#e5e5e5','light','storage-webcms/manager/contentbuilder/themes/light-gray2.css'],
            ['#dadada','light','storage-webcms/manager/contentbuilder/themes/light-gray.css'],

            ['#3f4ec9','colored','storage-webcms/manager/contentbuilder/themes/colored-blue2.css'],
            ['#6779d9','colored','storage-webcms/manager/contentbuilder/themes/colored-blue4.css'],
            ['#10b9d7','colored','storage-webcms/manager/contentbuilder/themes/colored-blue3.css'],
            ['#006add','colored','storage-webcms/manager/contentbuilder/themes/colored-blue5.css'],
            ['#e92f94','colored','storage-webcms/manager/contentbuilder/themes/colored-pink3.css'],
            ['#a761d9','colored','storage-webcms/manager/contentbuilder/themes/colored-purple2.css'],
            ['#f9930f','colored','storage-webcms/manager/contentbuilder/themes/colored-yellow2.css'],

            ['#f3522b','colored','storage-webcms/manager/contentbuilder/themes/colored-red3.css'],
            ['#36b741','colored','storage-webcms/manager/contentbuilder/themes/colored-green2.css'],
            ['#00c17c','colored','storage-webcms/manager/contentbuilder/themes/colored-green3.css'],
            ['#fb3279','colored','storage-webcms/manager/contentbuilder/themes/colored-pink2.css'],
            ['#ff6d13','colored','storage-webcms/manager/contentbuilder/themes/colored-orange2.css'],
            ['#f13535','colored','storage-webcms/manager/contentbuilder/themes/colored-red2.css'],
            ['#646464','colored','storage-webcms/manager/contentbuilder/themes/colored-gray.css'],

            ['#3f4ec9','dark','storage-webcms/manager/contentbuilder/themes/dark-blue.css'],
            ['#0b4d92','dark','storage-webcms/manager/contentbuilder/themes/dark-blue2.css'],
            ['#006add','dark','storage-webcms/manager/contentbuilder/themes/dark-blue3.css'],
            ['#5f3ebf','dark','storage-webcms/manager/contentbuilder/themes/dark-purple.css'],
            ['#e92f69','dark','storage-webcms/manager/contentbuilder/themes/dark-pink.css'],
            ['#4c4c4c','dark','storage-webcms/manager/contentbuilder/themes/dark-gray.css'],
            ['#ed2828','dark','storage-webcms/manager/contentbuilder/themes/dark-red.css'],

            ['#006add','colored','storage-webcms/manager/contentbuilder/themes/colored-blue8.css'],
            ['#ff7723','colored','storage-webcms/manager/contentbuilder/themes/colored-orange3.css'],
            ['#ff5722','colored','storage-webcms/manager/contentbuilder/themes/colored-red5.css'],
            ['#f13535','colored','storage-webcms/manager/contentbuilder/themes/colored-red4.css'],
            ['#00bd79','colored','storage-webcms/manager/contentbuilder/themes/colored-green5.css'],
            ['#557ae9','colored','storage-webcms/manager/contentbuilder/themes/colored-blue7.css'],
            ['#fb3279','colored','storage-webcms/manager/contentbuilder/themes/colored-pink4.css'],
        ],
        imageSelect: 'assets.html',
        fileSelect: 'assets.html',
        videoSelect: 'assets.html'
    });


    window.addEventListener('message', async (event) => {
        var request = event.data.split("#");
        switch (request[0]) {
            case 'html':
                result = await getHtml(request[1], request);
                break;
            case 'clear':
                clearTemplate();
                result = 'Plantilla reiniciada';
                break;
            case 'destroy':
                destroyTemplate();
                result = 'Se ha destruido la plantila';
                break;
            case 'settings':
                openSettingsEditor();
                result = 'Menú de configuraciones';
                break;
            case 'Snippets':
                openSnippets();
                result = 'Menú de Snippets';
                break;
            case 'noEdit':
                noEdit();
                break;
            default:
                console.log('Lo lamentamos, por el momento no disponemos de ' + event.data + '.');
        }

        event.source.postMessage(result, '*');
    }, false);


    function noEdit() {
        const grideditor = document.querySelector('.header-section');
        grideditor.setAttribute('data-noedit', '');
        grideditor.contentEditable = false;
    }
    
    async function getHtml (token) {
        //var html = builder.html();
        //var data = [];
        var html;
        builder.saveImages('', function(){

            html = builder.html(document.querySelector('.main')); // get HTML (you will need this for saving purpose)
            
        }, (img, base64, filename) => {
            var name = filename.split('.').slice(0, -1).join('.');
            var ext = filename.split('.').pop();
            
            var mimeType = detectMimeType(base64);
            
            /*data.push({
                name: name,
                thumbName: 'thumb-' + name,
                originalName: filename,
                alt: 'Imagen Uploaded',
                title: 'Image',
                extension: mimeType,
                width: img.width,
                height: img.height,
                orientation: 'default',
                format: ext,
                isPublic: true,
                image: base64
            });*/
            

            axios({
                method: 'post',
                url: '/api-webcms/images/base-64',
                data: {
                    name: name,
                    thumbName: 'thumb-' + name,
                    originalName: filename,
                    alt: 'Imagen Uploaded',
                    title: 'Image',
                    extension: mimeType,
                    width: img.width,
                    height: img.height,
                    orientation: 'default',
                    format: ext,
                    isPublic: true,
                    image: base64
                },
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(function (response) {
                if(response.data.success) {
                    const uploadedImageUrl = response.data.data.pathFile;
                    img.setAttribute('src', uploadedImageUrl); // Update image src
                }
            });
        });
        await new Promise(r => setTimeout(r, 2000));
        
        return html;
    }

    function detectMimeType(b64) {
        var signatures = {
                JVBERi0: "application/pdf",
                R0lGODdh: "image/gif",
                R0lGODlh: "image/gif",
                iVBORw0KGgo: "image/png",
                "/9j/": "image/jpg"
            };

        for (var s in signatures) {
            if (b64.indexOf(s) === 0) {
            return signatures[s];
            }
        }
    }

    function clearTemplate () {
        builder = new ContentBuilder({ // Init
            container: '.container-builder',

            plugins: ['preview','wordcount', 'buttoneditor', 'symbols'], 
            pluginPath: 'storage-webcms/manager/contentbuilder/',
            imageSelect: 'storage-webcms/manager/assets.html',

            // imageSelect: 'images.html',
            fileSelect: 'storage-webcms/manager/files.html',
            
            themes: [
                ['#fff','',''],
                ['#111','dark','storage-webcms/manager/contentbuilder/contentbuilder-dark.css'],
                ['#0093dc','colored','storage-webcms/manager/contentbuilder/contentbuilder-blue.css'],
                ['#01acb7','colored','storage-webcms/manager/contentbuilder/contentbuilder-cyan.css'],
                ['#0a4d92','colored','storage-webcms/manager/contentbuilder/contentbuilder-darkblue.css'],
                ['#96af16','colored','storage-webcms/manager/contentbuilder/contentbuilder-green.css'],
                ['#cc016f','colored','storage-webcms/manager/contentbuilder/contentbuilder-magenta.css'],
                ['#e65800','colored','storage-webcms/manager/contentbuilder/contentbuilder-orange.css'],
                ['#de4ea4','colored','storage-webcms/manager/contentbuilder/contentbuilder-pink.css'],
                ['#782ec5','colored','storage-webcms/manager/contentbuilder/contentbuilder-purple.css'],
                ['#c10001','colored','storage-webcms/manager/contentbuilder/contentbuilder-red.css'],
                ['#e8ae00','colored','storage-webcms/manager/contentbuilder/contentbuilder-yellow.css']
            ],
        });
    }

    function destroyTemplate () {
        builder.destroy(); // Destroy
        builder = null;
    }

    function openSettingsEditor () {
        builder.viewConfig();
    }
    
    function openSnippets () {
        builder.viewSnippets(); // Open Snippets dialog

    }
</script>

@stack('bodyClass')

{{-- </body> --}}
