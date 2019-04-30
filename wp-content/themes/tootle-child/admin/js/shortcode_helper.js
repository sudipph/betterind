(function() {
    tinymce.PluginManager.add('recentposts', function( editor, url ) {
    editor.addButton( 'recentposts', {
    text: tinyMCE_object.button_name,
    icon: false,
    onclick: function() {
    editor.windowManager.open( {
    title: tinyMCE_object.button_title,
    body: [
        {
            type   : 'listbox',
            name   : 'listbox',
            label  : 'listbox',
            values : [
            { text: 'Test1', value: 'test1' },
            { text: 'Test2', value: 'test2' },
            { text: 'Test3', value: 'test3' }
            ],
            value : 'test2' // Sets the default
        },
        {
        type   : 'combobox',
        name   : 'combobox',
        label  : 'combobox',
        values : [
        { text: 'Test', value: 'test' },
        { text: 'Test2', value: 'test2' }
        ]
        },
        {
        type   : 'tooltip',
        name   : 'tooltip',
        label  : 'tooltip ( you dont use it like this check textbox params )'
        },
        {
        type   : 'button',
        name   : 'button',
        label  : 'button ( i dont know the other params )',
        text   : 'My Button'
        },
        {
        type   : 'buttongroup',
        name   : 'buttongroup',
        label  : 'buttongroup ( i dont know the other params )',
        items  : [
        { text: 'Button 1', value: 'button1' },
        { text: 'Button 2', value: 'button2' }
        ]
        },
        {
        type   : 'radio',
        name   : 'radio',
        label  : 'radio ( defaults to checkbox, or i`m missing something )',
        text   : 'My Radio Button'
        }
    ],
    onsubmit: function( e ) {
    editor.insertContent( '[shortcode-name img="' + e.data.img + '" list="' + e.data.listbox + '" combo="' + e.data.combobox + '" text="' + e.data.textbox + '" check="' + e.data.checkbox + '" color="' + e.data.colorbox + '" color_2="' + e.data.colorpicker + '" radio="' + e.data.radio + '"]');
    }
    });
    },
    });
    });
    })();


    // body: [
    //     {
    //         type   : 'listbox',
    //         name   : 'listbox',
    //         label  : 'listbox',
    //         values : [
    //         { text: 'Test1', value: 'test1' },
    //         { text: 'Test2', value: 'test2' },
    //         { text: 'Test3', value: 'test3' }
    //         ],
    //         value : 'test2' // Sets the default
    //     },
    //     {
    //     type   : 'combobox',
    //     name   : 'combobox',
    //     label  : 'combobox',
    //     values : [
    //     { text: 'Test', value: 'test' },
    //     { text: 'Test2', value: 'test2' }
    //     ]
    //     },
    //     {
    //     type   : 'tooltip',
    //     name   : 'tooltip',
    //     label  : 'tooltip ( you dont use it like this check textbox params )'
    //     },
    //     {
    //     type   : 'button',
    //     name   : 'button',
    //     label  : 'button ( i dont know the other params )',
    //     text   : 'My Button'
    //     },
    //     {
    //     type   : 'buttongroup',
    //     name   : 'buttongroup',
    //     label  : 'buttongroup ( i dont know the other params )',
    //     items  : [
    //     { text: 'Button 1', value: 'button1' },
    //     { text: 'Button 2', value: 'button2' }
    //     ]
    //     },
    //     {
    //     type   : 'checkbox',
    //     name   : 'checkbox',
    //     label  : 'checkbox ( it doesn`t seem to accept more than 1 )',
    //     text   : 'My Checkbox',
    //     checked : true
    //     },
    //     {
    //     type   : 'colorbox',
    //     name   : 'colorbox',
    //     label  : 'colorbox ( i have no idea how it works )',
    //     // text   : '#fff',
    //     values : [
    //     { text: 'White', value: '#fff' },
    //     { text: 'Black', value: '#000' }
    //     ]
    //     },
    //     {
    //     type   : 'colorpicker',
    //     name   : 'colorpicker',
    //     label  : 'colorpicker'
    //     },
    //     {
    //     type   : 'radio',
    //     name   : 'radio',
    //     label  : 'radio ( defaults to checkbox, or i`m missing something )',
    //     text   : 'My Radio Button'
    //     }
    // ],