const { Input } = require("postcss");

require("./bootstrap");

//Nav active

if (document.title == "Home") {
    document.getElementById("navbar-home").classList.add("active");
    document.getElementById("formSearch").classList.remove("invisible");
} else if (document.title == "Shop") {
    document.getElementById("navbar-shop").classList.add("active");
} else if (document.title == "Collectors Angel") {
    document.getElementById("navbar-collectors").classList.add("active");
} else if (document.title == "Friends") {
    document.getElementById("navbar-friends").classList.add("active");
}

//Toast notification
const Toast = document.getElementById("toast");
const close_btn = document.getElementById("close_toast");

close_btn?.addEventListener("click", () => {
    Toast.classList.remove("show");
});

//Hobbies
const hobbyFieldContainer = document.getElementById("hobby-field-container");
const addFieldBtn = document.getElementById("add-field-btn");

addFieldBtn?.addEventListener("click", () => {
    const newField = document.createElement("input");
    newField.type = "text";
    newField.className = "form-control mb-1";
    newField.name = "hobbies[]";
    newField.placeholder = "Enter your hobby";
    newField.required = true;
    hobbyFieldContainer.appendChild(newField);
});

//Filter
const gender = document.getElementById("genderSelect");
const querySearch = document.getElementById("queryInput");
const formSearch = document.getElementById("formSearch");
const genderFinal = document.getElementById("gender-key");
const searchFinal = document.getElementById("search-key");
const formFilter = document.getElementById("formFilter");

formFilter?.addEventListener("submit", (e) => {
    e.preventDefault();
    genderFinal?.setAttribute("value", gender.value);
    searchFinal?.setAttribute("value", querySearch.value);
    formFilter.submit();
});

gender?.addEventListener("change", () => {
    genderFinal?.setAttribute("value", gender.value);
    searchFinal?.setAttribute("value", querySearch.value);
    formFilter.submit();
});

formSearch?.addEventListener("submit", (e) => {
    e.preventDefault();
    genderFinal?.setAttribute("value", gender.value);
    searchFinal?.setAttribute("value", querySearch.value);
    formFilter.submit();
});

//gift
const giftBtn = Array.from(document.querySelectorAll(".gift-btn"));
const giftInput = Array.from(document.querySelectorAll(".gift-input"));
giftBtn?.forEach((e) => {
    var avatar = e.getAttribute("avatar");
    e.addEventListener("click", () => {
        giftInput?.forEach((e) => {
            e.value = avatar;
        });
    });
});
