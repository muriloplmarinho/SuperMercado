const products = new Map(JSON.parse(document.querySelector('#catalog-data').textContent).map(product => [product.id, product]));
const cart = new Map();
const items = document.querySelector('#cart-items');
const template = document.querySelector('#cart-item-template');
const checkout = document.querySelector('#checkout');
const feedback = document.querySelector('#feedback');
const currency = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });
const money = cents => currency.format(cents / 100);
const icons = () => window.lucide?.createIcons();

function total() {
    return [...cart].reduce((sum, [id, quantity]) => sum + products.get(id).preco * quantity, 0);
}

function updateCart() {
    for (const row of [...items.children]) {
        if (!cart.has(Number(row.dataset.id))) row.remove();
    }

    let count = 0;
    for (const [id, quantity] of cart) {
        const product = products.get(id);
        let row = items.querySelector(`[data-id="${id}"]`);
        if (!row) {
            row = template.content.firstElementChild.cloneNode(true);
            row.dataset.id = id;
            row.querySelector('.item-name').textContent = product.nome;
            row.querySelector('.quantity-control').setAttribute('aria-label', `Quantidade de ${product.nome}`);
            for (const button of row.querySelectorAll('button')) {
                button.setAttribute('aria-label', `${button.title}: ${product.nome}`);
            }
            items.append(row);
        }
        row.querySelector('.item-quantity').textContent = quantity;
        row.querySelector('.item-subtotal').textContent = money(product.preco * quantity);
        row.querySelector('[data-action="increase"]').disabled = quantity >= 99;
        count += quantity;
    }

    document.querySelector('#empty-cart').hidden = count > 0;
    document.querySelector('#cart-count').textContent = `${count} ${count === 1 ? 'item' : 'itens'}`;
    document.querySelector('#cart-total').textContent = money(total());
    checkout.disabled = count === 0;
    icons();
}

document.querySelector('.product-grid').addEventListener('click', event => {
    const button = event.target.closest('[data-add]');
    if (!button) return;
    const id = Number(button.dataset.add);
    const quantity = cart.get(id) || 0;
    if (quantity >= 99) {
        feedback.textContent = 'Limite de 99 unidades por produto.';
        return;
    }
    cart.set(id, quantity + 1);
    updateCart();
    feedback.textContent = `${products.get(id).nome} adicionado ao carrinho.`;
});

items.addEventListener('click', event => {
    const button = event.target.closest('[data-action]');
    if (!button) return;
    const id = Number(button.closest('.cart-item').dataset.id);
    const quantity = cart.get(id);
    const action = button.dataset.action;
    if (action === 'remove' || (action === 'decrease' && quantity === 1)) {
        cart.delete(id);
        document.querySelector(`[data-add="${id}"]`).focus();
    } else {
        cart.set(id, action === 'increase' ? Math.min(99, quantity + 1) : quantity - 1);
    }
    updateCart();
    feedback.textContent = 'Carrinho atualizado.';
});

checkout.addEventListener('click', () => {
    if (!cart.size) return;
    const amount = money(total());
    cart.clear();
    updateCart();
    feedback.textContent = `Compra de teste concluída! Total: ${amount}.`;
    document.querySelector('[data-add]').focus();
});

icons();
