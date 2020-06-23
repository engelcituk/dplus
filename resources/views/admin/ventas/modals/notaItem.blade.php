<div class="modal fade" id="modalNotaItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloNotaItemModal"></h5> <span id="positionItemModalNote" class="d-none"> </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="areaNotaItem">Añada o modifique la nota</label>
                        <textarea class="form-control" id="areaNotaItem" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect waves-themed mr-auto" data-dismiss="modal"> <i class="fal fa-window-close fs-xl"></i> Cerrar</button>
                <button type="button" class="btn btn-success waves-effect waves-themed" onclick="addNoteToItemTicket()"> <i class="fal fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>