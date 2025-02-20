@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/main.js') }}"></script>
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Prendre un Rendez-vous</h2>
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg m-3">
            <form id="regForm" action="{{ route('appointments.store') }}" method="post" class="space-y-6 flex flex-col items-center">
                @csrf
                <!-- Étape 1: Informations personnelles -->
                <div class="tab w-full max-w-md">
                    <input type="text" name="prenom" placeholder="Votre prénom" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="text" name="nom" placeholder="Votre nom" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4">
                </div>

                <!-- Étape 2: Contact -->
                <div class="tab w-full max-w-md" style="display:none;">
                    <input type="email" name="email" placeholder="Votre email" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="number" name="phone" placeholder="Votre numéro" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4">
                </div>

                <!-- Étape 3: Date du rendez-vous -->
                <div class="tab w-full max-w-md" style="display:none;">
                    <input type="date" name="date" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <select id="timeSelect" name="horraire" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4 hidden">
                    </select>
                </div>

                <!-- Boutons de navigation -->
                <div class="w-full max-w-md flex justify-between mt-3   ">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)"
                            class="bg-gray-400 text-white font-bold p-3 rounded-lg hover:bg-gray-500 transition hidden">
                        Précédent
                    </button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)"
                            class="bg-blue-600 text-white font-bold p-3 rounded-lg hover:bg-blue-500 transition">
                        Suivant
                    </button>
                </div>

                <!-- Indicateurs de progression -->
                <div class="text-center mt-4">
                    <span class="step bg-gray-300 inline-block h-3 w-3 rounded-full mx-1"></span>
                    <span class="step bg-gray-300 inline-block h-3 w-3 rounded-full mx-1"></span>
                    <span class="step bg-gray-300 inline-block h-3 w-3 rounded-full mx-1"></span>
                </div>
            </form>
        </div>

        <script>
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

        </script>

@endsection
