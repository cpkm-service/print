import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import CheckboxCommand from './checkboxcommand.js';
import './theme/input.css';
import {  toWidget } from '@ckeditor/ckeditor5-widget';

export default class CpkmInputEditing extends Plugin {

    init() {
        this._defineConverters();
        this.editor.commands.add( 'insertCpkmCheckbox', new CheckboxCommand( this.editor ) );
    }

    _defineConverters() {                                                      // ADDED
        const conversion = this.editor.conversion;

        conversion.for( 'upcast' ).elementToElement( {
            view: {
                name: 'input',
                classes: [ 'cpkm-checkbox' ],
                attributes: {
                    type: "checkbox",
                }
            },
            model:  ( viewElement, { writer: modelWriter } ) => {
                const checked = viewElement.getAttribute( 'checked' );
                return modelWriter.createElement( 'cpkmCheckbox' ,{
                    disabled: true,
                    "checked": checked,
                });
            }
        } );
        conversion.for( 'dataDowncast' ).elementToElement( {
            model: 'cpkmCheckbox',
            view: ( modelItem, { writer: viewWriter } ) => createView( modelItem, viewWriter, false )
        } );
        conversion.for( 'editingDowncast' ).elementToElement( {
            model: 'cpkmCheckbox',
            view: ( modelItem, { writer: viewWriter } ) => {
                // Note: You use a more specialized createEditableElement() method here.
                const widgetElement = createView( modelItem, viewWriter , true);
                return toWidget( widgetElement, viewWriter );
            }
        } );

        function createView( modelItem, viewWriter, output ) {
            const checked = modelItem.getAttribute( 'checked' );
            const disabled = modelItem.getAttribute( 'disabled' );
            let extend = {
            };
            
            if(checked) {
                extend.checked = checked;
            }

            if(disabled && output) {
                extend.disabled = true;
            }
            const CpkmView = viewWriter.createContainerElement( 'span', {
                class: 'cpkm-checkbox-span',
            },[
                viewWriter.createContainerElement( 'input', {
                    class: 'cpkm-checkbox',
                    type: "checkbox",
                    ...extend
                })
            ]);

            return CpkmView;
        }

    }
}
