<?php

/*********************************************************
 * @file EditorOptions.php
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 * @brief Contains the implementation of an options class
 *        for the CKEditor widget.
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD 3-Clause
 *********************************************************/

namespace ProcyonSystems\ProcyonYii2Ckeditor5;

use Stringable;

/**
 * Contains default and custom options for the currently implemented CKEditor widget.
 * 
 * @var string $ckEditorPath Expects ckeditor.js to be in the build/ subdirectory.
 *
 * @author Simon Cahill <s.cahill@procyon-systems.de>
 * @copyright ©️ 2023 Procyon Systems All Rights Reserved
 * @license BSD 3-Clause
 */
class EditorOptions implements Stringable {

    /**
     * Constructs a new instance of this object.
     *
     * @param string|null $editorPath The path to your custom CKEditor instance.
     */
    public function __construct(string|null $editorPath = null) {
        $this->ckeditorPath = $editorPath ??= realpath(__DIR__."/../ckeditor5");
    }

    /**
     * An optional field for the language of the CKEditor.
     *
     * @var string|null $ckeditorLanguage The language code. Default: en. See `build/translations` in $ckeditorPath for a list of all translations.
     */
    public string|null $ckeditorLanguage = null;

    /**
     * Gets or sets the location where your version of CKEditor is located.
     *
     * Set this property accordingly so the widget can find CKEditor.
     * CKEditor is not provided with this plugin by default, so you have the freedom to
     * choose and modify your custom CKEditor variant.
     *
     * This directory must contain a `build/` directory containing `ckeditor.js`!
     *
     * @var string ckEditorPath The path to **your** instance of CKEditor.
     */
    public string $ckeditorPath;

    /**
     * An optional list of custom stylesheets to include into the AssetBundle.
     *
     * @var string[]
     */
    public array $customStylesheets = [];

    /**
     * An optional list of custom scripts to include into the AssetBundle.
     *
     * @var string[]
     */
    public array $customScripts = [];

    /**
     * An optional list of AssetBundle names that are depended on.
     */
    public array $customDependencies = [];

    /**
     * An array of key-value pairs to pass to the CKEditor instance.
     *
     * @var array{key: string, value: mixed}
     */
    public array $options = [];

    /**
     * An optional array to (re-)configure the toolbar in CKEditor.
     *
     * See @link https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html for more information.
     *
     * @var string[] $toolbarItems
     */
    public array $toolbarItems = [];

    /**
     * An optional list of extra plugins to load.
     *
     * @var string[] $extraPlugins A list of plugins (functions) to load into CKEditor.
     */
    public array $extraPlugins = [];

    /**
     * Indicates whether or not the toolbar should group its items when it is full.
     *
     * @var bool|null $toolbarShouldNotGroupWhenFull If set to null, automatic mode will be used.
     */
    public bool|null $toolbarShouldNotGroupWhenFull = null;

    /**
     * Optionally define a custom loader script (full path) to load CKEditor.
     * 
     * @var string|null $customJsLoader
     */
    public string|null $customJsLoader = null;

    /**
     * The selector ID for the DOM element.
     *
     * @var string $editorId.
     */
    public string $editorId = "procyon-ckeditor5";

    /**
     * Adds a new item to the CKEditor toolbar.
     *
     * @param string $item The name of the item.
     * See @link https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html for more information.
     */
    public function addToolbarItem(string $item): void {
        $this->toolbarItems[] = $item;
    }

    /**
     * Adds a dropdown to the toolbar containing #$items.
     *
     * @param string $label The label for the new group
     * @param string $icon The name of the icon. E.g. threeVerticalDots
     * @param string[] $items A list of items to add to the group.
     * 
     * See @link https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#grouping-toolbar-items-in-drop-downs-nested-toolbars for more information.
     */
    public function addToolbarGroup(string $label, string|false $icon, array $items): void {
        $this->toolbarItems[] = (object)[
            "label" => $label,
            "icon" => $icon,
            "items" => $items
        ];
    }

    /**
     * Adds a separator to the toolbar.
     */
    public function addToolbarSeparator(): void {
        $this->toolbarItems[] = "|";
    }

    /**
     * Add a custom dependency to the EditorAsset class.
     *
     * Calling this function ensures the AssetBundle depends on yii\bootstrap$version\BootstrapAsset
     * so bootstrap classes are correctly displayed in the editor.
     *
     * @param int $version Default: 5
     */
    public function dependOnBootstrap(int $version = 5): void {
        $this->customDependencies[] = "yii\bootstrap$version\BootstrapAsset";
    }

    public function addOption(string $key, mixed $value): void {
        $this->options[$key] = $value;
    }

    /**
     * Converts the current state of this object to a JSON array, usable in JavaScript.
     *
     * @author Simon Cahill <s.cahill@procyon-systems.de>
     * @copyright ©️ 2023 Procyon Systems All Rights Reserved
     * @license BSD 3-Clause
     */
    public function __toString(): string {
        $options = $this->options;

        if (!array_key_exists("toolbar", $options) && !empty($this->toolbarItems)) {
            $options["toolbar"] = (object)[
                "items" => $this->toolbarItems,
                "shouldNotGroupWhenFull" => $this->toolbarShouldNotGroupWhenFull
            ];
        }

        if (!array_key_exists("language", $options) && $this->ckeditorLanguage !== null) {
            $options["language"] = $this->ckeditorLanguage;
        }

        if (!array_key_exists("extraPlugins", $options) && !empty($this->extraPlugins)) {
            $options["extraPlugins"] = $this->extraPlugins;
        }

        return json_encode($options);
    }

}