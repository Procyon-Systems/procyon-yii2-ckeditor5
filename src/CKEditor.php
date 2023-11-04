<?php

/*********************************************************
 * @file CkEditor.php
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 * @brief Contains the implementation of a base class for
 *        the Procyon CKEditor Yii2 plugin.
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD 3-Clause
 *********************************************************/

namespace ProcyonSystems\ProcyonYii2Ckeditor5;

use Yii;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * This widget provides the required functions to emit an input element containing a CKEditor.
 *
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD 3-Clause
 */
class CKEditor extends InputWidget {

    /**
     * The type of editor currently being implemented.
     *
     * @var EditorType
     */
    public EditorType $editorType = EditorType::ClassicEditor;

    /**
     * @var EditorOptions
     */
    public EditorOptions $ckOptions;

    /** @inheritDoc */
    public function run() {
        $this->registerAssets($this->getView());
    }

    /**
     * Registers all required assets for the CKEditor.
     *
     * @param View $view The view.
     */
    protected function registerAssets(View $view) {
        $assetBundle = EditorAssets::register($view);
        $assetBundle->setup($this->ckOptions);

        switch ($this->editorType) {
            default:
            case EditorType::ClassicEditor:
                $view->registerJsVar("editorType", "ClassicEditor");
                break;
            case EditorType::InlineEditor:
                $view->registerJsVar("editorType", "InlineEditor");
                break;
        }

        // Register our JS file.
        // We're not doing this in the AssetBundle so that we don't have any mixups
        // in the array order.
        if ($this->ckOptions->customJsLoader !== null) {
            $view->registerJsFile($this->ckOptions->customJsLoader);
        } else {
            $view->registerJsFile(__DIR__."/assets/load_editor.js");
        }
    }

    /**
     * Emits the CKEDITOR widget to the output stream.
     */
    protected function emitCkeditor() {
        switch ($this->editorType) {
            default:
            case EditorType::ClassicEditor:
                if (!$this->hasModel()) {
                    echo Html::textarea($this->name, $this->value, $this->options);
                } else {
                    echo Html::activeTextarea($this->model, $this->attribute, $this->options);
                }
                break;
            // TODO: Handle other editor types.
        }
    }

}
