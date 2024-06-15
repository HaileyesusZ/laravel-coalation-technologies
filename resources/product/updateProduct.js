function updateProduct(data) {
    const productId = data.get("id");
    fetch(`/products/${productId}`, {
        method: "post",
        headers: {
            "X-CSRF-TOKEN": data.get("_token"),
        },
        body: data,
    }).then(function (response) {
        if (response.ok) {
            location.replace("/products");
        }
    });
}

function registerEvents() {
    const addProductForm = document.getElementById("edit-product-form");
    if (!addProductForm) return;
    addProductForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const data = new FormData(event.target);
        updateProduct(data);
    });
}

registerEvents();
