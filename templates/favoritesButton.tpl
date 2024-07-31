{literal}
<link rel="stylesheet" type="text/css" href="/plugins/generic/favorites/css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
{/literal}

<div id="favorites-button-container">
    <button id="add-to-favorites" class="favorites-button" data-article-id="{$article->getId()}">
        <i class="fas fa-star"></i> Añadir a favoritos
    </button>
    <button id="view-favorites" class="favorites-button">
        <i class="fas fa-list"></i> Ver favoritos
    </button>
</div>

<div id="favorites-list" style="display: none;">
    <ul id="favorites-list-content"></ul>
</div>

{literal}
<script src="/plugins/generic/favorites/js/favorites.js"></script>
{/literal}
