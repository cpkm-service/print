import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import CpkmBasicUI from './basicui.js';
import CpkmBasicEditing from './basicediting.js';

export default class CpkmBasic extends Plugin {
    static get requires() {
        return [ CpkmBasicEditing, CpkmBasicUI ];
    }
}