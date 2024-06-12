import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import { ButtonView, ContextualBalloon, clickOutsideHandler } from '@ckeditor/ckeditor5-ui';
import FormView from './basicview';	

export default class CpkmBasicUI extends Plugin {
    static get requires() {
        return [ ContextualBalloon ];
    }

    init() {
        this._balloon = this.editor.plugins.get( ContextualBalloon );
        this.formView = this._createFormView();
        this._defineSchema();
    }

    _createFormView() {
        const editor = this.editor;
        const formView = new FormView( editor.locale );

        this.listenTo( formView, 'submit', () => {
            const target = formView.targetInputView.fieldView.element.value;
            const width = formView.widthInputView.fieldView.element.value;

            editor.model.change( writer => {
                editor.execute( 'insertCpkmBasic', {target, width});
                editor.editing.view.focus();
            } );
            this._hideUI();
        } );

        this.listenTo( formView, 'cancel', () => {
            this._hideUI();
        } );

        clickOutsideHandler( {
            emitter: formView,
            activator: () => this._balloon.visibleView === formView,
            contextElements: [ this._balloon.view.element ],
            callback: () => this._hideUI()
        });

        return formView;
    }

    _hideUI() {
        this.formView.targetInputView.fieldView.value = '';
        this.formView.widthInputView.fieldView.value = '';
        this.formView.element.reset();

        this._balloon.remove( this.formView );

        // Focus the editing view after closing the form view.
        this.editor.editing.view.focus();
    }

    _getBalloonPositionData() {
        const view = this.editor.editing.view;
        const viewDocument = view.document;
        let target = null;

        // Set a target position by converting view selection range to DOM.
        target = () => view.domConverter.viewRangeToDom(
            viewDocument.selection.getFirstRange()
        );

        return {
            target
        };
    }

    _showUI() {
        this._balloon.add( {
            view: this.formView,
            position: this._getBalloonPositionData()
        } );

        this.formView.focus();
    }

    _defineSchema() {                                                          // ADDED
        const schema = this.editor.model.schema;
        const editor = this.editor;
        const t = editor.t;

        schema.register( 'CpkmBasic', {
            isLimit: true,
            isInline: true,
            allowIn: [ '$root', '$container' ],
            inheritAllFrom: '$inlineObject',
            allowAttributes: [ 'data-target', 'data-width', 'contenteditable' ],
        });

        editor.editing.view.document.on( 'change:isFocused', ( evt, data, isFocused ) => {
            console.log( `View document is focused: ${ isFocused }.` );
        } );
        
        // The "simpleBox" button must be registered among the UI components of the editor
        // to be displayed in the toolbar.
        editor.ui.componentFactory.add( 'CpkmBasic', locale => {
            // The state of the button will be bound to the widget command.
            const command = editor.commands.get( 'insertCpkmBasic' );

            // The button will be an instance of ButtonView.
            const buttonView = new ButtonView( locale );

            buttonView.set( {
                // The t() function helps localize the editor. All strings enclosed in t() can be
                // translated and change when the language of the editor changes.
                label: "測試",
                withText: true,
                tooltip: true
            } );

            this.listenTo( buttonView, 'execute', () => {
                this._showUI();
            } );

            // Bind the state of the button to the command.
            buttonView.bind( 'isOn', 'isEnabled' ).to( command, 'value', 'isEnabled' );

            // Execute the command when the button is clicked (executed).
            // this.listenTo( buttonView, 'execute', () => {
            //     editor.execute( 'insertCpkmBasic')
            //     editor.editing.view.focus();
            // } );

            return buttonView;
        });
    }
}
