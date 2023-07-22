{if $login}
  <script src="{$includePath}scripts/login.js"></script>
{/if}
{if !empty($components)}
  {foreach from=$components item=component}
    {if $component.script}
      <script src="{$component.script}"></script>
    {/if}
  {/foreach}
{/if}

<!-- Developed by Joao Gomes. Contact through joao-pedrogomes@hotmail.com or +55 17 99747 6427 -->

<body>