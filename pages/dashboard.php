<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowTask - Tarefas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6C63FF, #48C6EF);
            color: #fff;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
        }

        header h1 {
            font-size: 1.6rem;
        }

        header button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background: #fff;
            color: #6C63FF;
            cursor: pointer;
            font-weight: bold;
            transition: .3s;
        }
        header button:hover {
            background: #6C63FF;
            color: #fff;
        }

        .calendar {
            margin: 30px auto;
            width: 90%;
            max-width: 1100px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            color: #fff;
        }

        th {
            padding: 10px;
            font-size: 1.1rem;
            border-bottom: 2px solid rgba(255,255,255,0.3);
        }

        td {
            border: 1px solid rgba(255,255,255,0.1);
            height: 60px;
            cursor: pointer;
            transition: .3s;
            position: relative;
        }

        td:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .task {
            background: #fff;
            color: #6C63FF;
            border-radius: 10px;
            padding: 4px 6px;
            font-size: .8rem;
            font-weight: bold;
            margin: 2px;
            cursor: pointer;
            transition: .3s;
        }

        .task:hover {
            background: #FF4E4E;
            color: #fff;
        }

        /* Modal */
        .modal-bg {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
        }
        .modal {
            background: #f7f7f7;
            color: #333;
            border-radius: 20px;
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        .modal input {
            width: 100%;
            padding: 10px;
            border-radius: 15px;
            border: none;
            margin-bottom: 15px;
        }
        .modal button {
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 15px;
            font-weight: bold;
            cursor: pointer;
            background: #6C63FF;
            color: #fff;
        }
    </style>
</head>

<body>

<header>
    <h1>Bem-vindo ao FlowTask!</h1>
    <button onclick="logout()">Sair</button>
</header>

<section class="calendar">
    <table id="weekTable">
        <thead>
            <tr>
                <th>Horário</th>
                <th>Segunda</th>
                <th>Terça</th>
                <th>Quarta</th>
                <th>Quinta</th>
                <th>Sexta</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <!-- Gera horários automaticamente -->
        </tbody>
    </table>
</section>

<!-- Modal -->
<div class="modal-bg" id="modalBg">
    <div class="modal">
        <h3>Nova tarefa</h3>
        <input type="text" id="taskInput" placeholder="Título da tarefa">
        <button onclick="addTask()">Adicionar</button>
    </div>
</div>

<script>
const tbody = document.querySelector("tbody");
const modalBg = document.getElementById("modalBg");
const taskInput = document.getElementById("taskInput");
let selectedCell = null;

// Cria tabela e células (com data-day e data-hour)
function buildTable() {
    tbody.innerHTML = ""; // limpa
    for (let hour = 0; hour <= 23; hour++) {
        const row = document.createElement("tr");
        const timeCell = document.createElement("td");
        timeCell.textContent = hour + ":00";
        row.appendChild(timeCell);

        for (let d = 0; d < 7; d++) {
            const td = document.createElement("td");
            td.dataset.day = d;
            td.dataset.hour = hour;
            td.addEventListener("click", () => openModal(td));
            row.appendChild(td);
        }

        tbody.appendChild(row);
    }
}

// Abre modal para adicionar
function openModal(cell) {
    selectedCell = cell;
    modalBg.style.display = "flex";
    taskInput.value = "";
    taskInput.focus();
}

// Salva tarefa no servidor e anexa na célula com data-id
async function addTask() {
    const text = taskInput.value.trim();
    if (!text) return;

    const day = selectedCell.dataset.day;
    const hour = selectedCell.dataset.hour;

    const form = new FormData();
    form.append("task", text);
    form.append("day", day);
    form.append("hour", hour);

    const res = await fetch("../actions/save_task.php", { method: "POST", body: form });
    const json = await res.json();

    if (json.success) {
        // cria div com id do banco
        const div = document.createElement("div");
        div.classList.add("task");
        div.textContent = text;
        div.dataset.id = json.id;

        // impedir que o clique na div abra o modal da célula
        div.addEventListener("click", e => {
            e.stopPropagation();
            confirmDelete(div.dataset.id, div);
        });

        selectedCell.appendChild(div);
        modalBg.style.display = "none";
        taskInput.value = "";
    } else {
        alert("Erro ao salvar: " + (json.message || "Unknown"));
    }
}

// Carrega todas as tasks do backend e coloca nas células corretas
async function loadTasks() {
    // rebuild table (limpa células e cria de novo)
    buildTable();

    const res = await fetch("../actions/load_task.php");
    let tasks = [];
    try {
        tasks = await res.json();
    } catch (e) {
        console.error("Erro parse ../actions/load_task:", e);
        return;
    }

    tasks.forEach(t => {
        // Seleciona a célula pela combinação day/hour
        const cell = document.querySelector(`td[data-day='${t.day_index}'][data-hour='${t.hour}']`);
        if (!cell) return;

        const div = document.createElement("div");
        div.classList.add("task");
        div.textContent = t.task_text;
        div.dataset.id = t.id;

        div.addEventListener("click", async (e) => {
    e.stopPropagation();

    if (!confirm("Deseja excluir esta tarefa?")) return;

    let formData = new FormData();
    formData.append("id", div.dataset.id);

    const req = await fetch("../actions/delete_task.php", {
        method: "POST",
        body: formData
    });

    const res = await req.json();

    if (res.success) {
        div.remove();
    } else {
        alert("Erro ao deletar!");
    }
});

        cell.appendChild(div);
    });
}

// Pergunta confirmação e chama delete
async function confirmDelete(id, element) {
    if (!confirm("Excluir esta tarefa?")) return;
    const form = new FormData();
    form.append("id", id);

    const res = await fetch("../actions/delete_task.php", { method: "POST", body: form });
    const json = await res.json();

    if (json.success) {
        element.remove();
    } else {
        alert("Erro ao deletar: " + (json.message || "Unknown"));
    }
}

// Fecha modal ao clicar no fundo
modalBg.addEventListener("click", e => {
    if (e.target === modalBg) modalBg.style.display = "none";
});

// Inicia tudo ao carregar a página
document.addEventListener("DOMContentLoaded", loadTasks);

// (Se você tiver botão que chama addTask, garanta que chame addTask())
function logout() {
    window.location.href = "../actions/logout.php";
}
</script>

</body>
</html>
