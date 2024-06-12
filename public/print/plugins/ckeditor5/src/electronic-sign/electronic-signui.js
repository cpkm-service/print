import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';

export default class ElectronicSignUI extends Plugin {

    init() {
        this._defineSchema();
    }

    _defineSchema() {                                                          // ADDED
        const schema = this.editor.model.schema;
        const editor = this.editor;
        const t = editor.t;

        schema.register( 'electronicSign', {
            isLimit: true,
            isInline: true,
            allowIn: [ '$root', '$container' ],
            inheritAllFrom: '$inlineObject'
        });
        
        // The "simpleBox" button must be registered among the UI components of the editor
        // to be displayed in the toolbar.
        editor.ui.componentFactory.add( 'electronicSign', locale => {
            // The state of the button will be bound to the widget command.
            const command = editor.commands.get( 'insertElectronicSign' );

            // The button will be an instance of ButtonView.
            const buttonView = new ButtonView( locale );

            buttonView.set( {
                // The t() function helps localize the editor. All strings enclosed in t() can be
                // translated and change when the language of the editor changes.
                label: "電子簽名",
                withText: true,
                tooltip: true
            } );

            // Bind the state of the button to the command.
            buttonView.bind( 'isOn', 'isEnabled' ).to( command, 'value', 'isEnabled' );

            // Execute the command when the button is clicked (executed).
            this.listenTo( buttonView, 'execute', () => editor.execute( 'insertElectronicSign' ) );

            return buttonView;
        } );
    }
}
