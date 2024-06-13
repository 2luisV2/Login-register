document.addEventListener('DOMContentLoaded', (event) => {
    const dateInput = document.getElementById('date');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const entriesList = document.getElementById('entries-list');
    
    const today = new Date().toISOString().split('T')[0];
    dateInput.value = today;
  
    document.getElementById('save-entry').addEventListener('click', () => {
      const title = titleInput.value.trim();
      const content = contentInput.value.trim();
  
      if (title && content) {
        const entry = {
          date: dateInput.value,
          title: title,
          content: content
        };
  
        saveEntry(entry);
        renderEntries();
        titleInput.value = '';
        contentInput.value = '';
      } else {
        alert('Por favor, completa todos los campos.');
      }
    });
  
    document.getElementById('load-entry').addEventListener('click', () => {
      const selectedEntry = entriesList.querySelector('.selected');
      if (selectedEntry) {
        const entry = JSON.parse(selectedEntry.dataset.entry);
        titleInput.value = entry.title;
        contentInput.value = entry.content;
      } else {
        alert('Por favor, selecciona una entrada para cargar.');
      }
    });
  
    document.getElementById('delete-entry').addEventListener('click', () => {
      const selectedEntry = entriesList.querySelector('.selected');
      if (selectedEntry) {
        deleteEntry(selectedEntry.dataset.entryId);
        renderEntries();
        titleInput.value = '';
        contentInput.value = '';
      } else {
        alert('Por favor, selecciona una entrada para borrar.');
      }
    });
  
    entriesList.addEventListener('click', (event) => {
      const li = event.target.closest('li');
      if (li) {
        entriesList.querySelectorAll('li').forEach(item => item.classList.remove('selected'));
        li.classList.add('selected');
      }
    });
  
    function saveEntry(entry) {
      let entries = JSON.parse(localStorage.getItem('entries')) || [];
      entries.push(entry);
      localStorage.setItem('entries', JSON.stringify(entries));
    }
  
    function deleteEntry(entryId) {
      let entries = JSON.parse(localStorage.getItem('entries')) || [];
      entries = entries.filter((entry, index) => index !== parseInt(entryId, 10));
      localStorage.setItem('entries', JSON.stringify(entries));
    }
  
    function renderEntries() {
      let entries = JSON.parse(localStorage.getItem('entries')) || [];
      entriesList.innerHTML = '';
      entries.forEach((entry, index) => {
        const li = document.createElement('li');
        li.textContent = `${entry.date}: ${entry.title}`;
        li.dataset.entryId = index;
        li.dataset.entry = JSON.stringify(entry);
        entriesList.appendChild(li);
      });
    }
  
    renderEntries();
  });
  