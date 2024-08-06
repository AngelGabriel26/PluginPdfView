<?php

import('lib.pkp.classes.plugins.GenericPlugin');

class FavoritesPlugin extends GenericPlugin {

    function register($category, $path, $mainContextId = null) {
        if (!parent::register($category, $path, $mainContextId)) return false;

        if ($this->getEnabled()) {
            HookRegistry::register('TemplateManager::display', array($this, 'callbackAddTemplate'));
        }

        return true;
    }

    function getDisplayName() {
        return __('plugins.generic.fav.displayName');
    }

    function getDescription() {
        return __('plugins.generic.fav.description');
    }

    function callbackAddTemplate($hookName, $params) {
        $templateMgr = $params[0];

        // Pass the variable 'pluginEnabled' to the template
        $templateMgr->assign('pluginEnabled', true);
    }
}
?>