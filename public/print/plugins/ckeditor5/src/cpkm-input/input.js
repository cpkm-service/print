import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import CpkmInputUI from './inputui.js';
import CpkmInputEditing from './inputediting.js';

export default class CpkmInput extends Plugin {
    static get requires() {
        return [ CpkmInputEditing, CpkmInputUI ];
    }
}