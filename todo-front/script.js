const API_URL = "http://localhost/api-todo"; // URL de base modifiée

// Charger les tâches dès le chargement
window.onload = fetchTasks;

// Fonction pour récupérer toutes les tâches (GET)
function fetchTasks() {
  fetch(`${API_URL}/tasks/get.php`)
    .then(response => response.json())
    .then(data => {
      const taskList = document.getElementById("task-list");
      taskList.innerHTML = "";
      data.forEach(task => {
        const li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        li.innerHTML = `
          <span>${task.title}</span>
          <button class="btn btn-sm btn-danger" onclick="deleteTask(${task.id})">🗑</button>
        `;
        taskList.appendChild(li);
      });
    })
    .catch(error => console.error("Erreur chargement tâches :", error));
}

// Fonction pour ajouter une tâche (POST)
function addTask(event) {
  event.preventDefault(); // Empêcher le rechargement de la page
  const input = document.getElementById("new-task");
  const title = input.value.trim();

  if (!title) return alert("Veuillez entrer une tâche.");

  fetch(`${API_URL}/tasks/create.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ title })
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Erreur réseau');
      }
      return response.json();
    })
    .then(() => {
      input.value = "";
      fetchTasks(); // Recharger la liste
    })
    .catch(error => {
      console.error("Erreur ajout tâche :", error);
      alert("Erreur lors de l'ajout de la tâche");
    });
}

// Fonction pour supprimer une tâche (DELETE)
function deleteTask(id) {
  fetch(`${API_URL}/tasks/delete.php`, {
    method: "DELETE",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  })
    .then(response => response.json())
    .then(() => fetchTasks())
    .catch(error => console.error("Erreur suppression tâche :", error));
}
