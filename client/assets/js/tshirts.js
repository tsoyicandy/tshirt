let allTshirts = [];


function renderTshirts(tshirts) {
    let html = "";
    tshirts.forEach(function (t) {
        html += `
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="${"../assets"+t.image}" class="card-img-top" alt="${t.nom}" style="max-height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">${t.nom}</h5>
                        <p class="card-text">${t.description}</p>
                        <p class="text-primary fw-bold">${t.prix} €</p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="#" class="btn btn-outline-primary btn-sm show-detail" data-id="${t.id_tshirt}">
                                Afficher le détail
                            </a>

                            <button class="btn btn-dark btn-sm add-to-cart" data-id="${t.id_tshirt}" ${!isLoggedIn ? 'disabled' : ''}>
                                ${isLoggedIn ? 'Ajouter' : 'Connectez-vous'}
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
    });
    $("#catalogue").html(html);
}

function populateCategories(tshirts) {
    const categories = [...new Set(tshirts.map(t => t.categorie).filter(Boolean))];
    let select = '<select id="categorieFilter" class="form-select w-auto mb-4"><option value="">Toutes les catégories</option>';
    categories.forEach(cat => {
        select += `<option value="${cat}">${cat}</option>`;
    });
    select += '</select>';
    $("#filters").html(select);
}


$(document).ready(function () {
    $.getJSON("../src/php/ajax/fetch_tshirts.php", function (tshirts) {
        allTshirts = tshirts;
        populateCategories(tshirts);
        renderTshirts(tshirts);
    });

    $("#filters").on("change", "#categorieFilter", function () {
        const selected = $(this).val();
        if (selected) {
            const filtered = allTshirts.filter(t => t.categorie === selected);
            renderTshirts(filtered);
        } else {
            renderTshirts(allTshirts);
        }
    });

    $(document).on("click", ".add-to-cart", function () {
        const idTshirt = $(this).data("id");
        $.post("../src/php/ajax/add_to_cart.php", { id_tshirt: idTshirt }, function (response) {
            alert(response.message);
        }, "json");
    });
});

$(document).on("click", ".show-detail", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.getJSON("../src/php/ajax/get_tshirt.php", { id: id }, function (data) {
        if (data.error) {
            $("#tshirtModalBody").html("<p class='text-danger'>" + data.error + "</p>");
        } else {
            $("#tshirtModalLabel").text(data.nom);
            $("#tshirtModalBody").html(`
                <img src="${"../assets"+data.image}" alt="${data.nom}" class="img-fluid mb-3">
                <p><strong>Description :</strong> ${data.description}</p>
                <p><strong>Prix :</strong> ${data.prix} €</p>
                <p><strong>Stock :</strong> ${data.stock}</p>
                <p><strong>Couleur :</strong> ${data.couleur}</p>
            `);
        }
        const modal = new bootstrap.Modal(document.getElementById("tshirtModal"));
        modal.show();
    });
});


