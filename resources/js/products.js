document.addEventListener("DOMContentLoaded", function () {
    // Búsqueda de productos
    document
        .getElementById("search-form")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            fetchProducts();
        });

    // Paginación de productos
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("paginate-link")) {
            e.preventDefault();
            fetchProducts(e.target.dataset.page);
        }
    });

    // Eliminación de productos
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-product")) {
            e.preventDefault();
            deleteProduct(e.target.dataset.id);
        }
    });

    // Edición de productos
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("edit-product")) {
            e.preventDefault();
            const productId = e.target.dataset.id;
            window.location.href = `/products/${productId}/edit`;
        }
    });

    // Función para obtener productos mediante AJAX
    function fetchProducts(page = 1) {
        const searchQuery = document.getElementById("search-input").value;
        fetch(`/products?page=${page}&search=${searchQuery}`)
            .then((response) => response.text())
            .then((html) => {
                document.getElementById("products-table").innerHTML = html;
            })
            .catch((error) => console.error("Error:", error));
    }

    // Función para eliminar producto mediante AJAX
    function deleteProduct(id) {
        fetch(`/products/destroy/${id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    alert(data.message);
                    window.location.href = `/products`;
                    fetchProducts();
                } else {
                    alert("Error eliminando el producto");
                }
            })
            .catch((error) => console.error("Error:", error));
    }
});
