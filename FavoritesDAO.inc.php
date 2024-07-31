<?php

// Import the DAO class from the PKP library
import('lib.pkp.classes.db.DAO');

// Define the FavoritesDAO class, extending from DAO
class FavoritesDAO extends DAO {
    
    // Function to add a favorite article for a user
    function addFavorite($userId, $articleId) {
        // Execute an INSERT SQL query to add the favorite to the database
        $this->update(
            'INSERT INTO favorites (user_id, article_id) VALUES (?, ?)',
            [(int) $userId, (int) $articleId]
        );
    }

    // Function to delete a favorite article for a user
    function deleteFavorite($userId, $articleId) {
        // Execute a DELETE SQL query to remove the favorite from the database
        $this->update(
            'DELETE FROM favorites WHERE user_id = ? AND article_id = ?',
            [(int) $userId, (int) $articleId]
        );
    }

    // Function to retrieve all favorite articles for a user
    function getFavoritesByUserId($userId) {
        // Execute a SELECT SQL query to get the user's favorite articles
        $result = $this->retrieve(
            'SELECT * FROM favorites WHERE user_id = ?',
            [(int) $userId]
        );

        // Initialize an empty array to store the favorites
        $favorites = [];
        // Loop through the result set and add each row to the favorites array
        while (!$result->EOF) {
            $favorites[] = $result->GetRowAssoc(false);
            $result->MoveNext();
        }

        // Close the result set and return the favorites array
        $result->Close();
        return $favorites;
    }
}
