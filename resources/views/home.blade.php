
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Formulaire</h2>

                        <form class="grid grid-cols-2 gap-6">
                            <div class="flex flex-col">
                                <input type="text" name="prenom" placeholder="Prénom" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col">
                                <input type="text" name="nom" placeholder="Nom" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col">
                                <input type="email" name="email" placeholder="Email" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col">
                                <input type="date" name="date" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col col-span-2">
                                <input type="number" name="phone" placeholder="Téléphone" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="col-span-2 flex justify-center">
                                <button type="submit"
                                        class="w-full bg-blue-800 text-black font-bold p-3 rounded-lg hover:bg-blue-600 transition">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-screen flex items-center justify-center">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Prendre un Rendez-vous</h2>
            <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg m-3">
                <form id="regForm" action="" method="post" class="space-y-6 flex flex-col items-center">
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

        </div>
    </div>
</div>
@endsection

