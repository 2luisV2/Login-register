document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById("date");
    const entryInput = document.getElementById("entry");
    const saveButton = document.getElementById("saveButton");
    const loadButton = document.getElementById("loadButton");
    const deleteButton = document.getElementById("deleteButton");
    const entriesSelect = document.getElementById("entries");

    const today = new Date().toISOString().substr(0, 10);
    dateInput.value = today;

    loadEntries();

    saveButton.addEventListener("click", function() {
        const entry = {
            date: dateInput.value,
            text: entryInput.value,
            user_id: getUserId()
        };
        fetch('save_entry.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(entry),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message);
            loadEntries();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar la entrada');
        });
    });

    function loadEntries() {
        fetch(`load_entries.php?user_id=${getUserId()}`)
            .then(response => response.json())
            .then(entries => {
                entriesSelect.innerHTML = "";
                entries.forEach(entry => {
                    const option = document.createElement("option");
                    option.value = entry.fecha;
                    option.text = `${entry.fecha}: ${entry.entrada.substr(0, 20)}...`;
                    entriesSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    function getUserId() {
        return 1; // Aquí debes obtener el user_id real desde la sesión
    }
});
