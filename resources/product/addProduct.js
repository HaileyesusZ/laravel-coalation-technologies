function createProduct(data) {
    fetch("/products", {
        method: "post",
        body: data,
    }).then(function (response) {
        if (response.ok) {
            location.replace("/products");
        }
    });
}

function registerEvents() {
    const addProductForm = document.getElementById("add-product-form");
    if (!addProductForm) return;
    addProductForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const data = new FormData(event.target);
        createProduct(data);
    });
}

registerEvents();
