// Function to add an article to favorites
function addToFavorites(articleId, articleTitle) {
    // Retrieve the current list of favorites from localStorage, or initialize as an empty array
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    
    // Check if the article is already in the list of favorites
    let existing = favorites.find(favorite => favorite.id === articleId);
    if (existing) {
        alert('El artículo ya está en favoritos');
        return;
    }
    
    // Add the new article to the list of favorites
    favorites.push({ id: articleId, title: articleTitle });
    // Save the updated list of favorites back to localStorage
    localStorage.setItem('favorites', JSON.stringify(favorites));
    alert('Artículo añadido a favoritos');
}

// Function to display the list of favorites
function showFavorites() {
    // Retrieve the current list of favorites from localStorage, or initialize as an empty array
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    
    // Create the HTML structure for the list of favorites
    let favoritesList = '<ul>';
    favorites.forEach(function(favorite) {
        favoritesList += `<li>${favorite.title} 
            <button class="remove-from-favorites" onclick="removeFromFavorites('${favorite.id}')">
                <i class="fas fa-trash-alt"></i>
            </button>
        </li>`;
    });
    favoritesList += '</ul>';
    
    // Find the container element for the favorites list and set its inner HTML to the generated list
    let favoritesContainer = document.getElementById('favorites-list');
    favoritesContainer.innerHTML = favoritesList;
    
    // Make the container for the favorites list visible
    document.getElementById('favorites-list-container').style.display = 'block';
}

// Function to remove an article from favorites
function removeFromFavorites(articleId) {
    // Retrieve the current list of favorites from localStorage, or initialize as an empty array
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    
    // Filter out the article with the specified ID from the list of favorites
    favorites = favorites.filter(favorite => favorite.id !== articleId);
    // Save the updated list of favorites back to localStorage
    localStorage.setItem('favorites', JSON.stringify(favorites));
    
    // Refresh the display of the favorites list
    showFavorites();
    alert('Artículo eliminado de favoritos');
}
