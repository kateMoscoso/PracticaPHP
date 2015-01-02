<?php 

if(isset($_POST['nespass'])){
    echo "nespass";
}
        ?>
<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Cambiar contraseña</h4>
            </div>
            <div class="modal-body">
                <form  method="post" action="views/cambiarPassword.php" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Antigua Contraseña</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="oldpass" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nueva Contraseña</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="newpass" onChange="comprobar();" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Repita nueva Contraseña</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="newpass2" onChange="comprobar();" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-3">
                            <button type="submit" class="btn btn-default">Cambiar Contraseña</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
