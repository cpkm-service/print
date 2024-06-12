import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import InputCommand from './inputcommand.js';
import './theme/input.css';
import {  toWidget } from '@ckeditor/ckeditor5-widget';

export default class CpkmInputNoneEditing extends Plugin {

    init() {
        this._defineConverters();
        this.editor.commands.add( 'insertCpkmInputNone', new InputCommand( this.editor ) );
    }

    _defineConverters() {                                                      // ADDED
        const conversion = this.editor.conversion;

        conversion.for( 'upcast' ).elementToElement( {
            view: {
                name: 'span',
                classes: [ 'cpkm-input-none' ],
                attributes: {
                    contenteditable: true,
                }
            },
            model:  ( viewElement, { writer: modelWriter } ) => {
                const target = viewElement.getAttribute( 'data-target' );
                const width = viewElement.getAttribute( 'data-width' );
                return modelWriter.createElement( 'cpkmInputNone' ,{
                    "data-target": target,
                    "data-width": width,
                });
            }
        } );

        conversion.for( 'dataDowncast' ).elementToElement( {
            model: 'cpkmInputNone',
            view: ( modelItem, { writer: viewWriter } ) => createView( modelItem, viewWriter )
        } );
        conversion.for( 'editingDowncast' ).elementToElement( {
            model: 'cpkmInputNone',
            view: ( modelItem, { writer: viewWriter } ) => {
                // Note: You use a more specialized createEditableElement() method here.
                const widgetElement = createView( modelItem, viewWriter );
                return toWidget( widgetElement, viewWriter );
            }
        } );
        
        function createView( modelItem, viewWriter ) {
            const target = modelItem.getAttribute( 'data-target' );
            const width = modelItem.getAttribute( 'data-width' );

            let extend = {

            };
            if(width) {
                extend.style = `min-width:${width}px;`;
                extend["data-width"] = width;
            }

            if(target) {
                extend["data-target"] = target;
            }

            const CpkmView = viewWriter.createContainerElement( 'span', {
                class: 'cpkm-input-none',
                contenteditable: true,
                ...extend
            } );


            return CpkmView;
        }

    }
}
