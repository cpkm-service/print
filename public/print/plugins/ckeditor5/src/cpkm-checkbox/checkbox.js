import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import CpkmCheckboxUI from './checkboxui.js';
import CpkmCheckboxEditing from './checkboxediting.js';

export default class CpkmInput extends Plugin {
    static get requires() {
        return [ CpkmCheckboxEditing, CpkmCheckboxUI ];
    }
}