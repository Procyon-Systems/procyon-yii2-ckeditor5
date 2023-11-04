<?php

/*********************************************************
 * @file EditorAssets.php
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 * @brief Contains the runtime assets required for CKEditor.
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD 3-Clause
 *********************************************************/

namespace ProcyonSystems\ProcyonYii2Ckeditor5;

use yii\web\AssetBundle;

/**
 * The AssetBundle class containing all required runtime assets
 */
class EditorAssets extends AssetBundle {

    public function setup(EditorOptions $options) {
        parent::__construct();

        $this->sourcePath = $options->ckeditorPath."/build";

        if (!empty($options->customStylesheets)) {
            $this->css = array_merge($this->css, $options->customStylesheets);
        }

        if (!empty($options->customScripts)) {
            $this->js = array_merge($this->js, $options->customScripts);
        }

        if (!empty($options->customDependencies)) {
            $this->depends = array_merge($this->depends, $options->customDependencies);
        }

        if ($options->ckeditorLanguage !== null) {
            $this->js[] = "translations/".$options->ckeditorLanguage.".js";
        }
    }

    /** @inheritDoc */
    public $sourcePath;

    /** @inheritDoc */
    public $css = [];

    /** @inheritDoc */
    public $js = [];

    /** @inheritDoc */
    public $depends = [];

}
