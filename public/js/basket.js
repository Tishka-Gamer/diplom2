const csrfToken = document.getElementById('csrf-token').value;
        // Дальше используйте csrfToken в вашем JavaScript коде

document.addEventListener('DOMContentLoaded', function() {

    const cartItems = document.getElementById('cart-items');
    const totalCostElement = document.getElementById('total-cost');

    cartItems.addEventListener('click', async function(event) {
        const target = event.target;

        if (target.classList.contains('plus')) {

            const productId = target.dataset.id;
            const countElement = target.parentNode.querySelector('.count');
            const count = 1;
            let tr = '';
            try {
                tr = 'plus';
                const response = await fetch(`/update-cart/${productId}/${tr}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ count })
                });
                console.log(11111);
                const data = await response.json();
                if (data.success) {
                    countElement.value = data.count;
                    updateTotalCost();
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        } else if (target.classList.contains('minus')) {
            const productId = target.dataset.id;
            const countElement = target.parentNode.querySelector('.count');
            const count = 1;

            try {
                tr = 'minus'
                const response = await fetch(`/update-cart/${productId}/${tr}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ count })
                });

                const data = await response.json();
                if (data.success) {
                    countElement.value = data.count;
                    updateTotalCost();
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        } else if (target.classList.contains('del')) {
            const productId = target.dataset.id;

            try {
                const response = await fetch(`/remove-from-cart/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();
                if (data.success) {
                    target.closest('.product-item').remove();
                    updateTotalCost();
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    });

    function updateTotalCost() {
        const countElements = document.querySelectorAll('.count');
        let totalCost = 0;
        countElements.forEach(function(countElement) {
            const count = parseInt(countElement.value);
            const price = parseInt(document.querySelector('.price').innerText);
            console.log(price);
            totalCost += count * price;
        });
        totalCostElement.innerText = `Общая стоимость: ${totalCost}₽`;
    }

});
const check = document.getElementById('flexCheckChecked');


check.addEventListener('change', function() {
    const button = document.getElementById('haid');
    if (this.checked) {
        button.style.display = 'none';
    } else {
        button.style.display = 'inline';
    }
});
