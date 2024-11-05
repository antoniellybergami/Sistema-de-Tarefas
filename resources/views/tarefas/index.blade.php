<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tarefas - Lista</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    
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

        <table class="table" id="tarefas">
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
                    <tr data-id="{{ $tarefa->id }}">
                        <td>{{ $tarefa->id }}</td>
                        <td>{{ $tarefa->nome }}</td>
                        <td>R$ {{ number_format($tarefa->custo, 2, ',', '.') }}</td>
                        <td>{{ date('d/m/Y', strtotime($tarefa->data)) }}</td>
                        <td>
                            <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('Tem certeza que deseja excluir essa tarefa?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('#tarefas tbody').sortable({
                items: 'tr',
                update: function(event, ui) {
                    let ordem = $(this).sortable('toArray', { attribute: 'data-id' });
    
                    $.ajax({
                        url: '{{ route('tarefas.reordenar') }}',
                        method: 'POST',
                        data: {
                            ordem: ordem, 
                            _token: '{{ csrf_token() }}' 
                        },
                        success: function(response) {
                            alert(response.message);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseJSON);
                            alert('Erro ao atualizar a ordem das tarefas.');
                        }
                    });


                }
            });
        });

</script>


</body>
</html>
