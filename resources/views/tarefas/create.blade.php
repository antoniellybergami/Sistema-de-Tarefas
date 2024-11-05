<!DOCTYPE html>
<html>
<head>
    <title>Criar Nova Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Criar Nova Tarefa</h2>
        
        <!-- Exibição de mensagens de erro -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('tarefas.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group mb-3">
                <label for="custo">Custo</label>
                <input type="number" step="0.01" class="form-control" id="custo" name="custo" required>
            </div>
            <div class="form-group mb-3">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data">
            </div>
    
           
            <button type="submit" class="btn btn-primary">Salvar Tarefa</button>
        </form>
    </div>
</body>
</html>
