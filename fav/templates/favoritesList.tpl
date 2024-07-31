{include file="frontend/components/header.tpl"}

<div id="favoritesList">
    <h2>Lista de Favoritos</h2>
    {if $favorites}
        <ul>
            {foreach from=$favorites item=favorite}
                <li>
                    <h3>{$favorite.title|escape}</h3>
                    <p>{$favorite.description|escape}</p>
                </li>
            {/foreach}
        </ul>
    {else}
        <p>No tienes artículos en tu lista de favoritos.</p>
    {/if}
</div>

{include file="frontend/components/footer.tpl"}
