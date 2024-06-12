// abbreviation/abbreviationview.js

import {
    View,
    LabeledFieldView,				// ADDED
    createLabeledInputText,			// ADDED
    ButtonView,
    submitHandler										
    } from '@ckeditor/ckeditor5-ui';
import { icons } from '@ckeditor/ckeditor5-core';
import { FocusTracker, KeystrokeHandler } from '@ckeditor/ckeditor5-utils';

export default class FormView extends View {
    constructor( locale ) {
        super( locale );
        this.targetInputView = this._createInput( '輸入帶入參數' );
        this.widthInputView = this._createInput( '輸入寬度' );

        this.saveButtonView = this._createButton(
            '確定', icons.check, 'ck-button-save'
        );
        // Set the type to 'submit', which will trigger
        // the submit event on entire form when clicked.
        this.saveButtonView.type = 'submit';

        this.cancelButtonView = this._createButton(
            '取消', icons.cancel, 'ck-button-cancel'
        );

        this.focusTracker = new FocusTracker();
        this.keystrokes = new KeystrokeHandler();

        this.cancelButtonView.delegate( 'execute' ).to( this, 'cancel' );

        this.childViews = this.createCollection( [
            this.targetInputView,
            this.widthInputView,
            this.saveButtonView,
            this.cancelButtonView
        ] );

        this.setTemplate( {
            tag: 'form',
            attributes: {
                class: [ 'ck', 'ck-cpkm-basic-form' ],
                tabindex: '-1'
            },
            children: this.childViews
        } );
    }

    render() {
        super.render();

        // Submit the form when the user clicked the save button
        // or pressed enter in the input.
        submitHandler( {
            view: this
        } );
        
    }

    focus() {
        this.childViews.first.focus();
    }

    _createInput( label ) {
        const labeledInput = new LabeledFieldView( this.locale, createLabeledInputText );

        labeledInput.label = label;

        return labeledInput;
    }

    _createButton( label, icon, className ) {
        const button = new ButtonView();

        button.set( {
            label,
            icon,
            tooltip: true,
            class: className
        } );

        return button;
    }
}
