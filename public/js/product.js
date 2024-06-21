document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const resultsBody = document.getElementById("results-body");

    function fetchData(query = '') {
        let url = '/search';
        if (query) {
            url += `?query=${encodeURIComponent(query)}`;
        }
        console.log(`Fetch URL: ${url}`);

        fetch(url)
            .then((response) => {
                console.log("Response received:", response);
                return response.json();
            })
            .then((data) => {
                console.log("Fetched data:", data);
                resultsBody.innerHTML = "";
                data.forEach((product) => {
                    const row = document.createElement("tr");

                    const idCell = document.createElement("th");
                    idCell.setAttribute("scope", "row");
                    idCell.textContent = product.id;

                    const imageCell = document.createElement("td");
                    const image = document.createElement("img");
                    image.setAttribute("src", "/image/" + product.photo);
                    image.setAttribute("width", "100px");
                    image.setAttribute("height", "100px");
                    image.setAttribute("alt", product.id);
                    imageCell.appendChild(image);

                    const nameCell = document.createElement("td");
                    nameCell.textContent = product.name;

                    const countCell = document.createElement("td");
                    countCell.textContent = product.count;

                    const priceCell = document.createElement("td");
                    priceCell.textContent = product.price;

                    const descriptionCell = document.createElement("td");
                    descriptionCell.textContent = product.description;

                    const structureCell = document.createElement("td");
                    structureCell.textContent = product.structure;

                    const caloriesCell = document.createElement("td");
                    caloriesCell.textContent = product.callories;

                    const bguCell = document.createElement("td");
                    bguCell.textContent = product.bgu;

                    const categoryCell = document.createElement("td");
                    categoryCell.textContent = product.category;

                    const redForm = document.createElement("form");
                    redForm.setAttribute("action", "/redp");
                    const redButton = document.createElement("button");
                    redButton.setAttribute("class", "btn btn-primary");
                    redButton.setAttribute("name", "btn");
                    redButton.setAttribute("value", product.id);
                    redButton.textContent = "red";
                    redForm.appendChild(redButton);
                    const redCell = document.createElement("td");
                    redCell.appendChild(redForm);

                    const delForm = document.createElement("form");
                    delForm.setAttribute("action", "/delprod");
                    const delButton = document.createElement("button");
                    delButton.setAttribute("class", "btn btn-primary");
                    delButton.setAttribute("name", "id");
                    delButton.setAttribute("type", "submit");
                    delButton.setAttribute("value", product.id);
                    delButton.textContent = "del";
                    delForm.appendChild(delButton);
                    const delCell = document.createElement("td");
                    delCell.appendChild(delForm);

                    row.appendChild(idCell);
                    row.appendChild(imageCell);
                    row.appendChild(nameCell);
                    row.appendChild(countCell);
                    row.appendChild(priceCell);
                    row.appendChild(descriptionCell);
                    row.appendChild(structureCell);
                    row.appendChild(caloriesCell);
                    row.appendChild(bguCell);
                    row.appendChild(categoryCell);
                    row.appendChild(redCell);
                    row.appendChild(delCell);

                    resultsBody.appendChild(row);
                });
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    }

    searchInput.addEventListener("input", function () {
        const query = searchInput.value;
        console.log(`Search query: ${query}`);

        if (query.length < 1) {
            fetchData(); // Fetch all data when the input is empty
        } else {
            fetchData(query); // Fetch filtered data based on the query
        }
    });

    fetchData(); // Initial fetch to load all data when the page loads
});
