<div>
    <div class="table-responsive">
        <table id="programs" class="display table  table-striped ">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Número Trimestres</th>
                    <th class="text-center">Linea</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center ">Competencias</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $p->name }}</td>
                        <td class="text-center">{{ $p->quarter_number }}</td>
                        <td class="text-center">{{ $p->knowledge_network->name }}</td>
                        <td class="text-center">{{ $p->program_type }}</td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route('sigac.academic_coordination.competences.index', ['program_id' => $p->id]) }}">
                                <i class="fa-solid fa-outdent"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




