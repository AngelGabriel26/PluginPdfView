import('classes.handler.Handler');

class FavoritesHandler extends Handler {
    
    // Function to display the favorites index page
    function index($args, $request) {
        $templateMgr = TemplateManager::getManager($request); // Get the template manager
        $templateMgr->display($this->getTemplateResource('favorites.tpl')); // Display the favorites template
    }

    // Function to add an article to favorites
    function add($args, $request) {
        $title = $request->getUserVar('title'); // Get the title from the request
        $description = $request->getUserVar('description'); // Get the description from the request

        // Save the article in the database or user session
        // Here, we are using the user session as an example
        $session = $request->getSession(); // Get the user session
        $favorites = $session->getSessionVar('favorites'); // Retrieve the current list of favorites from the session
        if (!$favorites) {
            $favorites = array(); // Initialize as an empty array if no favorites are found
        }
        $favorites[] = array('title' => $title, 'description' => $description); // Add the new favorite to the list
        $session->setSessionVar('favorites', $favorites); // Save the updated list back to the session

        $json = new JSONMessage(true); // Create a new JSON response indicating success
        return $json->getString(); // Return the JSON response
    }

    // Function to list all favorites
    function list($args, $request) {
        $templateMgr = TemplateManager::getManager($request); // Get the template manager
        $session = $request->getSession(); // Get the user session
        $favorites = $session->getSessionVar('favorites'); // Retrieve the current list of favorites from the session
        $templateMgr->assign('favorites', $favorites); // Assign the list of favorites to the template
        $templateMgr->display($this->getTemplateResource('favoritesList.tpl')); // Display the favorites list template
    }
}
