import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import ElectronicSignUI from './electronic-signui.js';
import ElectronicSignEditing from './electronic-signediting.js';

export default class ElectronicSign extends Plugin {
    static get requires() {
        return [ ElectronicSignEditing, ElectronicSignUI ];
    }
}