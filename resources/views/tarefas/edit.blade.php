<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CRUD tarefas</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Editar Tarefa</h2>
        <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
            @csrf
            @method('PUT') 
            <div class="form-group mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $tarefa->nome }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="custo">Custo</label>
                <input type="number" step="0.01" class="form-control" id="custo" name="custo" value="{{ $tarefa->custo }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="{{ $tarefa->data }}">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Tarefa</button>
        </form>
    </div>

    @if(session('error'))
    <script>
        alert("Esse nome já existe. Escolha um nome diferente.");
    </script>
    @endif

</body>
</html>
