<form name="section_form" onsubmit="store_dentista(this)" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input hidden class="form-control" name="id" id="id">
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="name">Nome:</label>
            <input class="form-control" name="nome" id="nome" type="text" required placeholder="Digite o nome">
        </div>

        <div class="form-group col-6">
            <label class="col-form-label" for="name">Email:</label>
            <input class="form-control" id="email" name="email" type="email" required
                placeholder="Digite o email">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="name">CRO:</label>
            <input class="form-control" id="cro" name="cro" type="text" required placeholder="Digite o cro">
        </div>
        <div class="form-group col-6">
            <label class="col-form-label" for="name">CRO UF:</label>
            <input class="form-control" id="cro_uf" name="cro_uf" type="text" maxlength="2" required placeholder="Digite o cro UF">
        </div>
    </div>

    <div class="form-group">
        <label for="usuarios">Incluir especialidades:</label>
        <select class="form-control" id="especialidades" name="especialidades[]" multiple="multiple">
            @include('dentistas.componentes.especialidades-select')
        </select>
    </div>


    <div class="alert-danger" id="erro"></div>
    <button type="submit" style="float:right" class="btn btn-primary">Salvar</button>
</form>
