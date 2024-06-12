import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';

export default class CustomPlugin extends Plugin {
  init() {
    const editor = this.editor;

    editor.model.schema.extend('$text', { allowAttributes: 'inputData' });

    editor.conversion.for('upcast').elementToAttribute({
      view: {
        name: 'input',
        classes: 'custom-input'
      },
      model: {
        key: 'inputData',
        value: viewElement => viewElement.getAttribute('data-input-data')
      }
    });

    editor.conversion.for('downcast').attributeToElement({
      model: 'inputData',
      view: (modelAttributeValue, viewWriter) => {
        return viewWriter.createEmptyElement('input', {
          class: 'custom-input',
          'data-input-data': modelAttributeValue
        });
      }
    });

    editor.commands.add('insertCustomInput', {
      execute: () => {
        const selection = editor.model.document.selection;
        const insertPosition = selection.getFirstPosition();

        editor.model.change(writer => {
          writer.insertElement('input', { inputData: 'Sample Input' }, insertPosition);
        });
      }
    });

    editor.ui.componentFactory.add('insertCustomInputButton', locale => {
    //   const button = editor.ui.view.toolbarComponentFactory.createButton('insertCustomInput');
    const button = new ButtonView( locale );
      button.set({
        label: 'Insert Input',
        tooltip: true
      });
      this.listenTo( button, 'execute', () => editor.execute( 'insertCustomInput' ) );

      return button;
    });
  }
}
