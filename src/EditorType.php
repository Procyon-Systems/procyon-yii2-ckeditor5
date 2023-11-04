<?php

/*********************************************************
 * @file EditorType.php
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 * @brief Contains the implementation of a base class for
 *        the Procyon CKEditor Yii2 plugin.
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD 3-Clause
 *********************************************************/

namespace ProcyonSystems\ProcyonYii2Ckeditor5;

/**
 * Describes the different types of editors available with this plugin.
 *
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD 3-Clause
 */
enum EditorType {

    /**
     * The classic CKEditor widget.
     *
     * @link https://ckeditor.com/docs/ckeditor5/latest/api/module_editor-classic_classiceditor.html
     */
    case ClassicEditor;

    /**
     * The inline CKEditor widget.
     *
     * @link https://ckeditor.com/docs/ckeditor5/latest/api/module_editor-inline_inlineeditor.html
     */
    case InlineEditor;

}
