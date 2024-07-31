<?php

// Import the GenericPlugin class from the PKP library
import('lib.pkp.classes.plugins.GenericPlugin');

// Define the FavoritesPlugin class, extending from GenericPlugin
class FavoritesPlugin extends GenericPlugin {
    
    // Register the plugin, overriding the register method
    function register($category, $path, $mainContextId = null) {
        // If the parent class registers successfully
        if (parent::register($category, $path, $mainContextId)) {
            // Register a hook to add the favorites button to the template display
            HookRegistry::register('TemplateManager::display', array($this, 'callbackAddFavoritesButton'));
            return true;
        }
        return false;
    }

    // Return the display name of the plugin
    function getDisplayName() {
        return __('Favorites Plugin');
    }

    // Return the description of the plugin
    function getDescription() {
        return __('This plugin allows users to add articles to their favorites list.');
    }

    // Callback function to add the favorites button to the template
    function callbackAddFavoritesButton($hookName, $params) {
        // Get the TemplateManager object from the parameters
        $templateMgr = $params[0];
        // Reference to the output parameter
        $output =& $params[2];

        // Define the favorites button HTML
        $favoritesButton = '<button class="button add-to-favorites" onclick="addToFavorites()">Add to Favorites</button>';
        // Assign the favorites button HTML to a variable in the template
        $templateMgr->assign('favoritesButton', $favoritesButton);

        return false;
    }
}
