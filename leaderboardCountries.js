const countrySelect = document.getElementById("countrySelect");

countrySelect.addEventListener("change", () => {
    countrySelect.form.submit();
});