document.addEventListener("DOMContentLoaded", function () {
    let payButton = document.getElementById("pay-button");

    if (payButton) {
        payButton.addEventListener("click", function () {
            let productId = payButton.getAttribute("data-product-id");

            fetch(`/purchase/${productId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            })
                .then(response => response.json())
                .then(data => {
                    window.snap.pay(data, {
                        onSuccess: function (result) {
                            alert("Payment success!");
                            console.log(result);

                            // Update tombol menjadi "Download"
                            let actionContainer = document.getElementById("action-container");
                            actionContainer.innerHTML = `
                                <a href="/products/download/${productId}" id="download-button">
                                    Download
                                </a>
                            `;

                            // Kirim permintaan ke server untuk memperbarui status transaksi
                            fetch("/update-transaction-status", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                },
                                body: JSON.stringify({
                                    product_id: productId,
                                    status: "paid"
                                })
                            });
                        },
                        onPending: function (result) {
                            alert("Waiting for your payment!");
                            console.log(result);
                        },
                        onError: function (result) {
                            alert("Payment failed!");
                            console.log(result);
                        },
                        onClose: function () {
                            alert("You closed the popup without finishing the payment");
                        }
                    });
                });
        });
    }
});
