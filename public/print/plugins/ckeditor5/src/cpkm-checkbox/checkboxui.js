import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import { ButtonView, ContextualBalloon } from '@ckeditor/ckeditor5-ui';

export default class CpkmInputUI extends Plugin {
    static get requires() {
        return [ ContextualBalloon ];
    }

    init() {
        this._balloon = this.editor.plugins.get( ContextualBalloon );
        this._defineSchema();
    }

    _defineSchema() {                                                          // ADDED
        const schema = this.editor.model.schema;
        const editor = this.editor;
        const t = editor.t;

        schema.register( 'cpkmCheckbox', {
            isLimit: true,
            isInline: true,
            allowIn: [ '$root', '$container' ],
            inheritAllFrom: '$inlineObject',
            allowAttributes: [ 'checked', 'disabled'],
        });
        
        // The "simpleBox" button must be registered among the UI components of the editor
        // to be displayed in the toolbar.
        editor.ui.componentFactory.add( 'cpkmCheckbox', locale => {
            // The state of the button will be bound to the widget command.
            const command = editor.commands.get( 'insertCpkmCheckbox' );

            // The button will be an instance of ButtonView.
            const buttonView = new ButtonView( locale );

            buttonView.set( {
                label: "勾選框",
                withText: true,
                tooltip: true
            } );

            // Bind the state of the button to the command.
            buttonView.bind( 'isOn', 'isEnabled' ).to( command );

            // Execute the command when the button is clicked (executed).
            let checked = false;
            this.listenTo( buttonView, 'execute', () => {
                editor.execute( 'insertCpkmCheckbox' ,{checked})
            } );

            return buttonView;
        } );
    }
}
