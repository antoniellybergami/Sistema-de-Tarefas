<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas - Lista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CRUDtarefas</a>
            <div class="d-flex">
                <a class="btn btn-sm btn-success" href="{{ route('tarefas.create') }}">Incluir Tarefa</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Tarefas</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Nome</th>
                    <th>Custo</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarefas as $tarefa)
                    <tr class="{{ $tarefa->custo >= 1000 ? 'table-warning' : '' }}">
                        <td>{{ $tarefa->id }}</td>
                        <td>{{ $tarefa->nome }}</td>
                        <td>R$ {{ number_format($tarefa->custo, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($tarefa->data)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('Tem certeza que deseja excluir essa tarefa? Essa ação é irreversível.')">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
