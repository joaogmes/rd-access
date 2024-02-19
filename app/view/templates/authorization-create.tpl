{include file="bs-header.tpl"}


{* {$accessList|var_dump} *}

<div class="container">
    <div class="span10 offset1">
        <div class="card">
  
            <div class="card-body">
                <form class="form-horizontal"  method="post">

                    <div class="control-group">
                        <label class="control-label">ID</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="id" type="text" placeholder="ID" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Ticket</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="ticket" type="text" placeholder="Ticket" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Type</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="type" type="text" placeholder="Type" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Code Core</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="codecore" type="text" placeholder="Code Core" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Code Prefix</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="codeprefix" type="text" placeholder="Code Prefix" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Code Suffix</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="codesuffix" type="text" placeholder="Code Suffix" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Auth Type</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="authtype" type="text" placeholder="Auth Type" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Range Start</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="rangestart" type="text" placeholder="Range Start" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Range End</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="rangeend" type="text" placeholder="Range End" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Creation Date</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="creationdate" type="text" placeholder="Creation Date" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Update Date</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="updatedate" type="text" placeholder="Update Date" value="">
                        </div>
                    </div>

                    <div class="form-actions">
                        <br/>
                        <button type="submit" method ="POST"  class="btn btn-success">Adicionar</button>
                        <a href="/" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                    {$msg}
                </form>
            </div>
        </div>
    </div>
</div>

 
{include file="bs-footer.tpl"}