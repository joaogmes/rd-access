{include file="bs-header.tpl"}

<h1>INDEX</h1>
{* {$accessList|var_dump} *}
<ul>
    {foreach from=$accessList.results item=entity}
        <li>{$entity->code}</li>
    {/foreach}
</ul>
<p>Parágrafo</p>
{include file="bs-footer.tpl"}