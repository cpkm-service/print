
import { Command } from 'ckeditor5/src/core';
/**
 * The page break command.
 *
 * The command is registered by {@link module:page-break/pagebreakediting~PageBreakEditing} as `'pageBreak'`.
 *
 * To insert a page break at the current selection, execute the command:
 *
 *		editor.execute( 'pageBreak' );
 */
export default class CpkmBasicCommand extends Command {
    /**
     * @inheritDoc
     */
    refresh() {
        const model = this.editor.model;
        const selection = model.document.selection;
        const isAllowed = model.schema.checkChild( selection.focus.parent, 'CpkmBasic' );
        this.isEnabled = true;
    }
    /**
     * Executes the command.
     *
     * @fires execute
     */
    execute({target, width}) {
        const model = this.editor.model;
        const selection = editor.model.document.selection;
        model.change(writer => {
            const BasicInsertElement = writer.createElement('CpkmBasic',  {
                ...Object.fromEntries( selection.getAttributes() ),
                "data-target": target,
                "data-width": width,
            });
            model.insertObject(BasicInsertElement, null, null, { setSelection: 'on' });
            // const selection = editor.model.document.selection;
            // const insertPosition = selection.getFirstPosition();

            // editor.model.change(writer => {
            // writer.insertElement(BasicInsertElement, insertPosition);
            // });
        });
    }
}