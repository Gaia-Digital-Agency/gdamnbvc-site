<?php
add_filter('acf/fields/wysiwyg/toolbars', function($toolbars) {
    $toolbars['Full'] = array();
    $toolbars['Full'][1] = array(
        'formatselect', 'styleselect', 'italic', 'underline', 'link', 'unlink', 'bullist', 'numlist', 'aligncenter', 'alignleft', 'alignright', 'alignjustify'
    );
    return $toolbars;
});

add_action('acf/input/admin_footer', function(){
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            acf.addFilter('wysiwyg_tinymce_settings', function( mceInit, id, field ){

                // mceInit.setup = function(editor) {
                //     console.log(editor.getContent(), editor)
                //     editor.on('ApplyFormat', function(e) {
                //         if (e.format && e.format.classes && e.format.classes.startsWith('split-text')) {
                //             const content = editor.getContent();
                //             if (content.includes('<!-- pagebreak -->')) {
                //                 const newContent = content.replace(/<!-- pagebreak -->/g, '');
                //                 editor.setContent(newContent);
                //                 alert('Page break removed due to animation being applied.');
                //             }
                //         }
                //     });
                // };

                mceInit.block_formats = 'Paragraph=p;Secondary=p.secondary;Huge=p.huge;Big=p.big;Heading 1=h1.text-h1;Heading 2=h2.text-h2;Heading 3=h3.text-h3;Subtext 1=p.subtext-1;Subtext 2=p.subtext-2;Caption=p.caption';
                mceInit.formats = {
                    'p': {
                        block: 'p',
                        classes: ['text-body']
                    },
                    'p.secondary': {
                        block: 'p',
                        classes: ['text-body-secondary']
                    },
                    'p.huge': {
                        block: 'p',
                        classes: ['text-large-1']
                    },
                    'p.big': {
                        block: 'p',
                        classes: ['text-large-2']
                    },
                    'h1.text-h1': {
                        block: 'h1',
                        classes: ['text-h1']
                    },
                    'h2.text-h2': {
                        block: 'h2',
                        classes: ['text-h2']
                    },
                    'h3.text-h3': {
                        block: 'h3',
                        classes: ['text-h3']
                    },
                    'p.subtext-1': {
                        block: 'p',
                        classes: ['text-cta-large']
                    },
                    'p.subtext-2': {
                        block: 'p',
                        classes: ['text-cta']
                    }, 
                    "p.caption": {
                        block: 'p',
                        classes: ['text-caption']
                    }
                }

                mceInit.style_formats = [
                    {
                        title: 'Colors',
                        items: [
                            { title: 'White', inline: 'span', classes: 'text-white' },
                            { title: 'black', inline: 'span', classes: 'text-theme-black' },
                            { title: 'grey', inline: 'span', classes: 'text-theme-grey-2' },
                            { title: 'beige', inline: 'span', classes: 'text-theme-beige' },
                        ]
                    },
                    {
                        title: 'Font Weight',
                        items: [
                            { title: 'Bold', inline: 'span', classes: 'font-bold' },
                            { title: 'Medium', inline: 'span', classes: 'font-medium' },
                            { title: 'Light', inline: 'span', classes: 'font-light' },
                        ]
                    },
                ];
                return mceInit;
            });
        })
    </script>
    <?php
});