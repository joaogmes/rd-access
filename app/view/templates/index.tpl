{include file="bs-header.tpl"}


{* {$accessList|var_dump} *}
<ul>
    {foreach from=$accessList.results item=entity}
        <li>{$entity->code}</li>
    {/foreach}
</ul>



    <div class="container">
      
        <div class="row">
            <p>
                <a href="/authorization/create" class="btn btn-success">Adicionar Ticket</a>
            </p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">ticket</th>
                        <th scope="col">type</th>
                        <th scope="col">codecore</th>
                        <th scope="col">codePrefix</th>
                        <th scope="col">codeSufix</th>
                        <th scope="col">authType</th>
                        <th scope="col">rangStart</th>
                        <th scope="col">rangeEnd</th>
                        <th scope="col">creationDate</th>
                        <th scope="col">updateDate</th>
                    </tr>
                </thead>
                <tbody>

                    {foreach from=$accessList['results'] item=$list}
                        <tr>
                            <td>
                                {$list->id}
                            </td>
                            <td>
                                {$list->ticket}
                            </td>
                            <td>
                                {$list->type}
                            </td>
                            <td>
                                {$list->codeCore}
                            </td>
                            <td>
                                {$list->codePrefix}
                            </td>
                            <td>
                                {$list->codeSufix}
                            </td>
                            <td>
                                {$list->authType}
                            </td>
                            <td>
                                {$list->rangStart}
                            </td>
                            <td>
                                {$list->rangeEnd}
                            </td>
                            <td>
                                {$list->creationDate}
                            </td>
                            <td>
                                {$list->updateDate}
                            </td>
                        </tr>
                    {/foreach}

                </tbody>
            </table>
        </div>
    </div>
   

{include file="bs-footer.tpl"}