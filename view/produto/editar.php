<?php
use App\Produto;
require('../../vendor/autoload.php');
$produto = Produto::buscarPorId($_GET['id']);
include('../includes/cabecalho.php');
include('../includes/menu.php');
?>
<main class="container">
    <h2 class="text-center">Editar Produto</h2>
    <form action="/supermercado/action/action_produto.php?action=alterar&id=<?= $produto->id ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $produto->nome ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label"> Descrição:</label>
           <input name="descricao" type="text" class="form-control" value="<?= $produto->descricao ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label"> Código</label>
            <input name="codigo" type="text" class="form-control" value="<?= $produto->codigo ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantidade</label>
            <input name="quantidade" type="text" class="form-control" value="<?= $produto->quantidade ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Preço:</label>
            <input name="preco" type="text" class="form-control" value="<?= $produto->preco ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Data Validade:</label>
            <input name="data_validade" type="date" class="form-control" value="<?= $produto->data_validade ?>">
        </div>
         <div class="mb-3">
            <label class="form-label">  Id Fornecedor:</label>
           <input name="id_fornecedor" type="text" class="form-control" value="<?= $produto->id_fornecedor ?>">
        </div>
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</main>

