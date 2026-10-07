<?php
use App\Fornecedor;
require('../../vendor/autoload.php');
$fornecedor = Fornecedor::buscarPorId($_GET['id']);
include('../includes/cabecalho.php');
include('../includes/menu.php');
?>
<main class="container">
    <h2 class="text-center">Editar Fornecedor</h2>
    <form action="/supermercado/action/action_fornecedor.php?action=alterar&id=<?= $fornecedor->id ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $fornecedor->nome ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" value="<?= $fornecedor->cnpj ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= $fornecedor->telefone ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $fornecedor->email ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="<?= $fornecedor->endereco ?>">
        </div>
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</main>

