<?php

import('lib.pkp.classes.plugins.GenericPlugin');

/**
 * AnnotatePreviewPlugin
 *
 * This plugin allows users to annotate documents in preview mode.
 */
class AnnotatePreviewPlugin extends GenericPlugin {

    /**
     * Plugin registration in OJS.
     *
     * @param string $category The plugin category.
     * @param string $path The plugin path.
     * @param int|null $mainContextId The main context ID.
     * @return bool True if the plugin was registered successfully, False otherwise.
     */
    public function register($category, $path, $mainContextId = null) {
        if (parent::register($category, $path, $mainContextId)) {
            // Register the hook to add scripts and styles.
            HookRegistry::register('TemplateManager::display', array($this, 'addAnnotateScripts'));
            error_log('AnnotatePreviewPlugin registered'); // Debug message
            return true;
        }
        return false;
    }

    /**
     * Gets the plugin name.
     *
     * @return string The plugin name.
     */
    public function getDisplayName() {
        return __('Annotate Preview Plugin');
    }

    /**
     * Gets the plugin description.
     *
     * @return string The plugin description.
     */
    public function getDescription() {
        return __('Allows users to annotate documents in preview mode.');
    }

    /**
     * Adds the necessary scripts and styles for annotations.
     *
     * @param string $hookName The hook name.
     * @param array $args The hook arguments.
     * @return bool False to continue processing the hook.
     */
    public function addAnnotateScripts($hookName, $args) {
        error_log('addAnnotateScripts hook called'); // Debug message
        $templateMgr = $args[0];
        $request = Application::get()->getRequest();
        $router = $request->getRouter();
        $page = $router->getRequestedPage($request);

        error_log('Current page: ' . $page); // Debug message

        // Check if the current page is an article preview.
        if ($page === 'article') {
            error_log('Current page is article'); // Debug message
            $templateMgr->addJavaScript('annotateJs', $this->getPluginPath() . '/js/annotate.js');
            $templateMgr->addStyleSheet('annotateCss', $this->getPluginPath() . '/css/style.css');

            // Load the toolbar template.
            $output = $templateMgr->fetch($this->getTemplatePath() . 'annotatePreview.tpl');
            $templateMgr->assign('annotateToolbar', $output);
        }

        return false;
    }

    /**
     * Gets the plugin template path.
     *
     * @return string The template path.
     */
    public function getTemplatePath() {
        return parent::getTemplatePath() . 'templates/';
    }
}
?>
