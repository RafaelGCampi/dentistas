@extends('layouts.app')

@section('content')
<section>
    <h2>Dentistas</h2>

    <form id="search_dentista" name="search_dentista" class="form mt-3 w-100"  enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-lg-4">
                <label  for="nome_filter">Nome</label>
                <input class="form-control" id="nome_filter" name="nome_filter" >
            </div>

            <div class="form-group col-lg-4">
                <label  for="cro_filter">CRO</label>
                <input class="form-control" id="cro_filter" name="cro_filter" >
            </div>

            <div class="form-group col-lg-4">
                <label  for="especialidade_filter">Especialidade</label>
                <select class="form-control" id="especialidade_filter" name="especialidade_filter">
                    <option selected value="0">(qualquer)</option>
                    @include('dentistas.componentes.especialidades-select')
                </select>

            </div>
        </div>

        <button id="buscar_dentista" class="btn btn-primary"  onclick="_search_dentista()" type='button' >Buscar</button>


    </form>
    <br>
    <section>
        <button class="btn btn-primary" onclick="dentista_open_create()" type='button'>Criar Dentista</button><br><br>
        <div id="list">
            @include('dentistas.table')
        </div>

    </section>
</section>
@endsection
@section('scripts')
    <script src="{{asset('js/dentista.js')}}" defer></script>
@endsection
