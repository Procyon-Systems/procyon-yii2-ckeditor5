/******************************************************************
 * Custom loader script to load CKEditor into the browser.
 * This script will load and configure CKEditor5 so it may be used
 * by your application.
 * 
 * If you decide to override this script, by creating your own,
 * the following variables will be populated for you:
 * 
 * editorOptions: containing the configuration object for CKEditor.
 * editorType: the editor type to use
 * editorId: the DOM ID of the element to apply the editor to
 * 
 * @file load_editor.js
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD-3-Clause
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 ******************************************************************/

if (typeof(editorOptions) == "undefined") {
    alert("WARNING: editor options were not set! Aborting CKEditor load.");
    return;
} else if (typeof(CKEDITOR) == "undefined") {
    alert("WARNING: could not find CKEditor! Did you set $ckeditorPath? Aborting CKEditor load.");
    return;
}

/**
 * A reference to the CKEditor object.
 * 
 * To prevent any naming-mishaps, this is prefix with "procyon".
 * You may use this variable in your scripts.
 * 
 * @type editorType
 */
let procyonCkeditor = null;

/**
 * Basic error handler function for CKEDITOR instantiation.
 * 
 * @param {*} error 
 */
function editorErrorHandler(error) {
    console.log(error);
}

/**
 * Instantiates the CKEDITOR.
 */
function instantiateCkeditor() {
    switch (editorType) {
        case "ClassicEditor":
            procyonCkeditor = ClassicEditor.create(document.querySelector(`#${editorId}`, editorOptions)).catch(editorErrorHandler);
            break;
        case "InlineEditor":
            procyonCkeditor = InlineEditor.create(document.querySelector(`#${editorId}`, editorOptions)).catch(editorErrorHandler);
            break;
        default:
            editorErrorHandler(`Unknown editor type ${editorType}! Cannot instantiate CKEditor!`);
            break;
    }
}

instantiateCkeditor();
