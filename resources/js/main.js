
console.log("Fichier main.js bien chargé !");

    let currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
    let tabs = document.getElementsByClassName("tab");
    tabs[n].style.display = "block";
    document.getElementById("prevBtn").style.display = (n == 0) ? "none" : "inline-block";
    document.getElementById("nextBtn").innerHTML = (n == tabs.length - 1) ? "Confirmer" : "Suivant";
    updateSteps(n);
}

    function nextPrev(n) {
    let tabs = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    tabs[currentTab].style.display = "none";
    currentTab += n;
    if (currentTab >= tabs.length) {
    document.getElementById("regForm").submit();
    return false;
}
    showTab(currentTab);
}

    function validateForm() {
    let tabs = document.getElementsByClassName("tab")[currentTab].getElementsByTagName("input");
    for (let i = 0; i < tabs.length; i++) {
    if (tabs[i].value === "") {
    tabs[i].classList.add("border-red-500");
    return false;
}
}
    return true;
}

    function updateSteps(n) {
    let steps = document.getElementsByClassName("step");
    for (let i = 0; i < steps.length; i++) {
    steps[i].classList.remove("bg-blue-500");
}
    steps[n].classList.add("bg-blue-500");
}

    document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.querySelector("input[name='date']");
    const timeSelect = document.getElementById("timeSelect");

    dateInput.addEventListener("change", function () {
    if (dateInput.value) {
    timeSelect.innerHTML = "";

    fetch(`/get-schedule-hours?date=${dateInput.value}`)
    .then(response => response.json())
    .then(data => {
    console.log("Horaires reçus:", data);

    if (data.available_times && data.available_times.length > 0) {
    const availableTimes = data.available_times;

    availableTimes.forEach(time => {
    const option = document.createElement("option");
    option.value = time;
    option.textContent = time;
    timeSelect.appendChild(option);
});

    timeSelect.classList.remove("hidden");
} else {
    const option = document.createElement("option");
    option.value = "";
    option.textContent = "Aucun horaire disponible";
    timeSelect.appendChild(option);
}
})
    .catch(error => {
    console.error("Erreur lors de la récupération des horaires:", error);
});
}
});
});


