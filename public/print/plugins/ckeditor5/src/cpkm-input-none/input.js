import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import CpkmInputNoneUI from './inputui.js';
import CpkmInputNoneEditing from './inputediting.js';

export default class CpkmInputNone extends Plugin {
    static get requires() {
        return [ CpkmInputNoneEditing, CpkmInputNoneUI ];
    }
}