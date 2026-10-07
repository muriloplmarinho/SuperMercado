<?php
$produtos = [
    ['id' => 1, 'nome' => 'Arroz branco', 'unidade' => 'Pacote de 1 kg', 'preco' => 699, 'imagem' => 'arroz.jpg'],
    ['id' => 2, 'nome' => 'Leite integral', 'unidade' => '1 litro', 'preco' => 479, 'imagem' => 'leite.jpg'],
    ['id' => 3, 'nome' => 'Pão artesanal', 'unidade' => 'Pacote de 500 g', 'preco' => 850, 'imagem' => 'pao.jpg'],
    ['id' => 4, 'nome' => 'Banana', 'unidade' => '1 kg', 'preco' => 599, 'imagem' => 'banana.jpg'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado | Lojas AmeriKanas</title>
    <link rel="stylesheet" href="assets/mercado.css">
    <script src="assets/js/lucide.min.js" defer></script>
    <script src="assets/js/mercado.js" defer></script>
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="index.php">
                <i data-lucide="shopping-basket" aria-hidden="true"></i>
                Lojas AmeriKanas
            </a>
            <nav aria-label="Menu principal">
                <a href="index.php" aria-current="page">Mercado</a>
                <a href="view/produto/listar.php?msg=Lista%20de%20produtos">Produtos</a>
                <a href="view/fornecedor/listar.php?msg=Lista%20de%20fornecedores">Fornecedores</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="page-heading">
            <h1>Mercado</h1>
            <span class="test-label"><i data-lucide="flask-conical" aria-hidden="true"></i> Ambiente de teste</span>
        </div>
        <div class="market-layout">
            <section aria-labelledby="products-heading">
                <div class="section-heading">
                    <h2 id="products-heading">Produtos</h2>
                    <span>4 itens</span>
                </div>
                <div class="product-grid">
                    <?php foreach ($produtos as $produto): ?>
                        <article class="product">
                            <img class="product-image" src="assets/images/<?= $produto['imagem'] ?>" alt="<?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?>" width="640" height="400">
                            <div class="product-content">
                                <h3><?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?></h3>
                                <p class="product-unit"><?= $produto['unidade'] ?></p>
                                <div class="product-bottom">
                                    <strong class="product-price">R$ <?= number_format($produto['preco'] / 100, 2, ',', '.') ?></strong>
                                    <button class="add-button" type="button" data-add="<?= $produto['id'] ?>" aria-label="Adicionar <?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?> ao carrinho">
                                        <i data-lucide="plus" aria-hidden="true"></i> Adicionar
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <aside class="cart" aria-labelledby="cart-heading">
                <div class="cart-heading">
                    <h2 id="cart-heading"><i data-lucide="shopping-cart" aria-hidden="true"></i> Sua compra</h2>
                    <span id="cart-count">0 itens</span>
                </div>
                <div class="empty-cart" id="empty-cart">
                    <i data-lucide="shopping-basket" aria-hidden="true"></i>
                    <p>Seu carrinho está vazio.</p>
                </div>
                <ul class="cart-items" id="cart-items" aria-label="Itens do carrinho"></ul>
                <div class="cart-total"><span>Total</span><strong id="cart-total">R$ 0,00</strong></div>
                <button type="button" class="checkout-button" id="checkout" disabled>
                    <i data-lucide="check" aria-hidden="true"></i> Finalizar compra
                </button>
                <p class="cart-note">Compra de teste · Sem pagamento real</p>
            </aside>
        </div>
        <p id="feedback" class="feedback" role="status" aria-live="polite" aria-atomic="true"></p>
    </main>

    <footer class="container site-footer">Lojas AmeriKanas &copy; <?= date('Y') ?></footer>

    <template id="cart-item-template">
        <li class="cart-item">
            <div class="cart-item-top"><strong class="item-name"></strong><strong class="item-subtotal"></strong></div>
            <div class="cart-item-bottom">
                <div class="quantity-control" role="group">
                    <button type="button" data-action="decrease" title="Diminuir quantidade"><i data-lucide="minus" aria-hidden="true"></i></button>
                    <output class="item-quantity"></output>
                    <button type="button" data-action="increase" title="Aumentar quantidade"><i data-lucide="plus" aria-hidden="true"></i></button>
                </div>
                <button type="button" class="remove-button" data-action="remove" title="Remover produto"><i data-lucide="trash-2" aria-hidden="true"></i></button>
            </div>
        </li>
    </template>
    <script type="application/json" id="catalog-data"><?= json_encode($produtos, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
</body>
</html>
