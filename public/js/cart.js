document.addEventListener("DOMContentLoaded", function () {
    // Оновлення кількості товарів у кошику
    function updateCartCount() {
        fetch("/cart")
            .then(response => response.text())
            .then(html => {
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, "text/html");
                let newCartCount = doc.querySelector("#cart-count").textContent;
                document.querySelector("#cart-count").textContent = newCartCount;
            });
    }

    // Делегування події на body для обробки кнопок видалення товару з кошика
    document.body.addEventListener("click", function (event) {
        // Перевіряємо, чи клікнули на кнопку видалення товару
        if (event.target && event.target.classList.contains("remove-from-cart")) {
            let cartItemId = event.target.dataset.key;

            fetch(`/cart/remove/${cartItemId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        event.target.closest(".cart-item").remove();  // Видаляємо товар з DOM
                        alert(data.message);
                        updateCartCount(); // Оновлюємо кількість товарів в кошику
                    } else {
                        alert("Не вдалося видалити товар з кошика");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Сталася помилка при видаленні товару");
                });
        }

        // Перевірка для очищення кошика
        if (event.target && event.target.id === "clear-cart") {
            fetch("/cart/clear", {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(() => {
                    location.reload(); // Оновлення сторінки після очищення кошика
                });
        }

        // Перевірка для кнопки додавання товару в кошик
        if (event.target && event.target.id === 'add-to-cart-btn') {
            let productId = document.getElementById('product-id').value;
            let selectedColor = document.querySelector('.color-btn.active')?.dataset.colorId;
            let selectedSize = document.querySelector('.size-btn.active')?.dataset.sizeId;
            let quantity = document.getElementById('quantity-input').value;

            if (!selectedColor || !selectedSize) {
                alert('Будь ласка, оберіть колір і розмір перед додаванням у кошик.');
                return;
            }

            fetch(`/cart/add`, {
                method: "POST",
                body: JSON.stringify({
                    product_id: productId,
                    color_id: selectedColor,
                    size_id: selectedSize,
                    quantity: quantity
                }),
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Content-Type": "application/json"
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Товар додано в кошик!");
                        updateCartCount(); // Оновлюємо кількість товарів в кошику
                    } else {
                        alert("Помилка: " + data.message);
                    }
                })
                .catch(error => console.error('Помилка:', error));
        }
    });

    // Отримуємо вибір кольору та розміру, якщо він збережений
    fetch('/get-selection')
        .then(response => response.json())
        .then(data => {
            if (data.product_id) {
                let selectedColor = data.color_id;
                let selectedSize = data.size_id;
                document.getElementById('quantity-input').value = data.quantity;

                // Додаємо клас 'selected' для вибраного кольору та розміру
                document.querySelector(`.color-btn[data-color-id="${selectedColor}"]`).classList.add('selected');
                document.querySelector(`.size-btn[data-size-id="${selectedSize}"]`).classList.add('selected');

                updatePrice(); // Оновлюємо ціну після вибору
            }
        });

    // Функція для оновлення ціни
    function updatePrice() {
        // Логіка для оновлення ціни в залежності від вибраного кольору та розміру
    }
});
