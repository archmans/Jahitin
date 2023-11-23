var debounceTimer;

function debounceSearchTailorAdmin(page) {
    clearTimeout(debounceTimer);
    
    debounceTimer = setTimeout(function () {
        console.log("Debounce");
        searchTailorAdmin(page);
    }, 500);
}

function searchTailorAdmin(page) {
    var keyword = document.getElementById("search-term").value;
    var sort = document.getElementById("sort-Alphabet").value;
    var filter = document.getElementById("filter-tailor").value;
    var tailorResult = document.getElementById("search-results-list");

    var form = new FormData();
    form.append("keyword", keyword);
    form.append("sort", sort);
    form.append("filter", filter);
    form.append("page", page);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            tailorResult.innerHTML = xhr.responseText;
        }
    }
    xhr.open("POST", "ajax/searchAdmin.php", true);
    xhr.send(form);
}

function resetSearchAdmin() {
    document.getElementById("search-term").value = "";
    document.getElementById("sort-Alphabet").selectedIndex = 0;
    document.getElementById("filter-tailor").selectedIndex = 0;
    searchTailorAdmin(1);
}