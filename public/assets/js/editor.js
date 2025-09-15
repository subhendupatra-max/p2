class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'YOUR_UPLOAD_URL', true); // Replace with your upload URL
                xhr.responseType = 'json';

                xhr.onload = () => {
                    if (xhr.status === 200) {
                        resolve({ default: xhr.response.url }); // Adjust based on your server response
                    } else {
                        reject(`Upload failed: ${xhr.statusText}`);
                    }
                };

                xhr.onerror = () => reject('Upload failed');
                xhr.send(file);
            }));
    }

    abort() {
        // Implement abort logic if needed
    }
}
function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
}
function SpecialCharactersEmoji( editor ) {
    editor.plugins.get( 'SpecialCharacters' ).addItems( 'Emoji', [
        { title: 'smiley face', character: '😊' },
        { title: 'rocket', character: '🚀' },
        { title: 'wind blowing face', character: '🌬️' },
        { title: 'floppy disk', character: '💾' },
        { title: 'heart', character: '❤️' },
        { character: '🙈', title: 'See-No-Evil Monkey' },
        { character: '🙄', title: 'Face With Rolling Eyes' },
        { character: '🙃', title: 'Upside Down Face' },
        { character: '🙂', title: 'Slightly Smiling Face' },
        { character: '😴', title: 'Sleeping Face' },
        { character: '😳', title: 'Flushed Face' },
        { character: '😱', title: 'Face Screaming in Fear' },
        { character: '😭', title: 'Loudly Crying Face' },
        { character: '😬', title: 'Grimacing Face' },
        { character: '😩', title: 'Weary Face' },
        { character: '😢', title: 'Crying Face' },
        { character: '😡', title: 'Pouting Face' },
        { character: '😞', title: 'Disappointed Face' },
        { character: '😜', title: 'Face with Stuck-Out Tongue and Winking Eye' },
        { character: '😚', title: 'Kissing Face With Closed Eyes' },
        { character: '😘', title: 'Face Throwing a Kiss' },
        { character: '😔', title: 'Pensive Face' },
        { character: '😒', title: 'Unamused Face' },
        { character: '😑', title: 'Expressionless Face' },
        { character: '😐', title: 'Neutral Face' },
        { character: '😏', title: 'Smirking Face' },
        { character: '😎', title: 'Smiling Face with Sunglasses' },
        { character: '😍', title: 'Smiling Face with Heart-Eyes' },
        { character: '😌', title: 'Relieved Face' },
        { character: '😋', title: 'Face Savoring Delicious Food' },
        { character: '😊', title: 'Smiling Face with Smiling Eyes' },
        { character: '😉', title: 'Winking Face' },
        { character: '😈', title: 'Smiling Face With Horns' },
        { character: '😇', title: 'Smiling Face with Halo' },
        {
            character: '😆',
            title: 'Smiling Face with Open Mouth and Tightly-Closed Eyes'
        },
        { character: '😅', title: 'Smiling Face with Open Mouth and Cold Sweat' },
        { character: '😄', title: 'Smiling Face with Open Mouth and Smiling Eyes' },
        { character: '😃', title: 'Smiling Face with Open Mouth' },
        { character: '😂', title: 'Face with Tears of Joy' },
        { character: '😁', title: 'Grinning Face with Smiling Eyes' },
        { character: '😀', title: 'Grinning Face' },
        { character: '🥺', title: 'Pleading Face' },
        { character: '🥵', title: 'Hot Face' },
        { character: '🥴', title: 'Woozy Face' },
        { character: '🥳', title: 'Partying Face' },
        { character: '🥰', title: 'Smiling Face with Hearts' },
        { character: '🤭', title: 'Face with Hand Over Mouth' },
        { character: '🤪', title: 'Zany Face' },
        { character: '🤩', title: 'Grinning Face with Star Eyes' },
        { character: '🤦', title: 'Face Palm' },
        { character: '🤤', title: 'Drooling Face' },
        { character: '🤣', title: 'Rolling on the Floor Laughing' },
        { character: '🤔', title: 'Thinking Face' },
        { character: '🤞', title: 'Crossed Fingers' },
        { character: '🙏', title: 'Person with Folded Hands' },
        { character: '🙌', title: 'Person Raising Both Hands in Celebration' },
        { character: '🙋', title: 'Happy Person Raising One Hand' },
        { character: '🤷', title: 'Shrug' },
        { character: '🤗', title: 'Hugging Face' },
        { character: '🖤', title: 'Black Heart' },
        { character: '🔥', title: 'Fire' },
        { character: '💰', title: 'Money Bag' },
        { character: '💯', title: 'Hundred Points Symbol' },
        { character: '💪', title: 'Flexed Biceps' },
        { character: '💩', title: 'Pile of Poo' },
        { character: '💥', title: 'Collision' },
        { character: '💞', title: 'Revolving Hearts' },
        { character: '💜', title: 'Purple Heart' },
        { character: '💚', title: 'Green Heart' },
        { character: '💙', title: 'Blue Heart' },
        { character: '💗', title: 'Growing Heart' },
        { character: '💖', title: 'Sparkling Heart' },
        { character: '💕', title: 'Two Hearts' },
        { character: '💔', title: 'Broken Heart' },
        { character: '💓', title: 'Beating Heart' },
        { character: '💐', title: 'Bouquet' },
        { character: '💋', title: 'Kiss Mark' },
        { character: '💀', title: 'Skull' },
        { character: '👑', title: 'Crown' },
        { character: '👏', title: 'Clapping Hands Sign' },
        { character: '👍', title: 'Thumbs Up Sign' },
        { character: '👌', title: 'OK Hand Sign' },
        { character: '👉', title: 'Backhand Index Pointing Right' },
        { character: '👈', title: 'Backhand Index Pointing Left' },
        { character: '👇', title: 'Backhand Index Pointing Down' },
        { character: '👀', title: 'Eyes' },
        { character: '🎶', title: 'Multiple Musical Notes' },
        { character: '🎊', title: 'Confetti Ball' },
        { character: '🎉', title: 'Party Popper' },
        { character: '🎈', title: 'Balloon' },
        { character: '🎂', title: 'Birthday Cake' },
        { character: '🎁', title: 'Wrapped Gift' },
        { character: '🌹', title: 'Rose' },
        { character: '🌸', title: 'Cherry Blossom' },
        { character: '🌞', title: 'Sun with Face' },
        { character: '❤️', title: 'Red Heart' },
        { character: '❣️', title: 'Heavy Heart Exclamation Mark Ornament' },
        { character: '✨', title: 'Sparkles' },
        { character: '✌️', title: 'Victory Hand' },
        { character: '✅', title: 'Check Mark Button' },
        { character: '♥️', title: 'Heart Suit' },
        { character: '☺️', title: 'Smiling Face' },
        { character: '☹️', title: 'Frowning Face' },
        { character: '☀️', title: 'Sun' }
    ], { label: 'Hanatutor Emojis' } );
}
function initializeEditor(fieldName) {
    const {
        ClassicEditor,Essentials,Bold,Italic,Font,Paragraph,Heading,BlockQuote,AutoLink,Link,Code,Image,ImageCaption,ImageStyle,ImageInsert,Base64UploadAdapter,
        ImageResizeEditing,ImageResizeHandles,ImageResizeButtons,ImageToolbar,ImageUpload,Indent,IndentBlock,TodoList,List,Alignment,CodeBlock,Table,TableToolbar,TableColumnResize,SourceEditing,HtmlEmbed,
        SpecialCharacters,SpecialCharactersEssentials,WordCount,PageBreak,MediaEmbed,Highlight,TableCaption,GeneralHtmlSupport
    } = CKEDITOR;
    ClassicEditor.create( document.querySelector( `#${fieldName}` ), {
        fullPage: true,
        allowedContent: true,
        licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3MzU4NjIzOTksImp0aSI6Ijc3NTYzNTRlLWMwMGMtNDcxZC05Njc5LTE5ODJhMzEzMmMxNSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6Ijg2YzhmYjMwIn0.cWQo9Su95bl2T_3GS2tDWoInaWlFqB26Xm5GK5_PHmhF1yC2j3aQeX_z7ZlVTDGxGSsbLUjZM7DQE4t5acQuTQ',
        plugins: [
            Indent, IndentBlock, TodoList, List, Alignment, CodeBlock, Image, ImageCaption, ImageStyle, ImageInsert, Base64UploadAdapter, /* MyCustomUploadAdapterPlugin,*/ ImageUpload, ImageResizeEditing, ImageResizeHandles, ImageToolbar, ImageResizeButtons,
            Code, Essentials, Bold, Italic, Font, Paragraph, Heading, BlockQuote, Link, AutoLink, Table, TableColumnResize, TableCaption, TableToolbar, SourceEditing,
            HtmlEmbed, SpecialCharacters, SpecialCharactersEssentials, SpecialCharactersEmoji, WordCount, PageBreak,
            MediaEmbed, Highlight, GeneralHtmlSupport
        ],
        toolbar: [
            'undo', 'redo', '|', 'bold', 'italic', '|',{
                label: 'Fonts',
                icon: 'text',
                items: [ 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor' ]
            }, '|',
            'heading', 'code', '|',
            'link', {
                label: 'Insert',
                icon: 'plus',
                items: [ 'insertImage', 'insertTable' ]
            }, 'blockQuote', 'codeBlock', 'alignment', '|',{
                label: 'Lists',
                icon: 'dragIndicator',
                items: [ 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent' ]
            }, 'sourceEditing', 'htmlEmbed', 'specialCharacters', 'pageBreak', 'mediaEmbed', 'highlight'
        ],
        image: {
            resizeOptions: [
                {
                    name: 'resizeImage:original',
                    value: null,
                    icon: 'original'
                },
                {
                    name: 'resizeImage:25',
                    value: '25',
                    icon: 'small'
                },
                {
                    name: 'resizeImage:50',
                    value: '50',
                    icon: 'medium'
                },
                {
                    name: 'resizeImage:75',
                    value: '75',
                    icon: 'large'
                }
            ],
            toolbar: [
                'resizeImage:25',
                'resizeImage:50',
                'resizeImage:75',
                'resizeImage:original',
                'resizeImage:custom',
                'imageStyle:block',
                'imageStyle:side',
                'imageStyle:margin-left',
                'imageStyle:margin-right',
                'imageStyle:inline',
                'toggleImageCaption',
                'imageTextAlternative',
            ],
            insert: {
                type: 'auto'
            }
        },
        table: {
            contentToolbar: [
                'toggleTableCaption'
            ]
        },
        link: {
            decorators: {
                openInNewTab: {
                    mode: 'manual',
                    label: 'Open in a new tab',
                    attributes: {
                        target: '_blank',
                        rel: 'noopener noreferrer'
                    }
                }
            }
        },
        shouldNotGroupWhenFull: true,
        sourceEditing: {
            allowCollaborationFeatures: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        indentBlock: {
            offset: 10,
            unit: 'px'
        },
        menuBar: {
            isVisible: true
        },
        wordCount: {
            onUpdate: stats => {
                console.log( `Characters: ${ stats.characters }\nWords: ${ stats.words }` );
            }
        }
    }, ).then(editor => {
        window[`${fieldName}editor`] = editor;
    }).catch(error => {
        console.error(error);
    });
}
