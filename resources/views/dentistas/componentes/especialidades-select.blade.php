@foreach(\App\Models\Especialidades::orderBy('nome','asc')->get() as $especialidade)
            <option value="{{$especialidade->id}}">{{$especialidade->nome}}</option>
@endforeach

