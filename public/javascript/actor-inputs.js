// public/javascript/actor-inputs.js

// public/javascript/actor-inputs.js

function handleActorInput(el) {
    const container = document.getElementById('actor-inputs');
    const rows      = container.querySelectorAll('.actor-row');
    const lastRow   = rows[rows.length - 1];
    const textIn    = el.closest('.actor-row').querySelector('input.actor-name');

    // only act on the last row
    if (el.closest('.actor-row') !== lastRow) return;

    // only when there's some text
    const val = textIn.value.trim();
    if (!val) return;

    // only once per row
    if (textIn.dataset.cloned) return;
    textIn.dataset.cloned = '1';

    // now clone that last row
    const newRow = lastRow.cloneNode(true);

    // clear the hidden id and text value
    newRow.querySelector('input[name="actor_ids[]"]').value = '';
    const newText = newRow.querySelector('input.actor-name');
    newText.value = '';
    delete newText.dataset.cloned;

    // append & focus
    container.appendChild(newRow);
    newText.focus();
}
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('actor-inputs');
    const addBtn    = document.getElementById('add-actor-btn');

    addBtn.addEventListener('click', () => {
        const input = document.createElement('input');
        input.type        = 'text';
        input.name        = 'actor_names[]';
        input.placeholder = 'Actor Name';
        input.className   = 'actor-name w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500';

        container.appendChild(input);
        input.focus();
    });
});
function submitActor(name) {
    if (!name || !movieId) {
        alert('Missing actor name or movie ID');
        return;
    }

    fetch('/actors', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ name, movie_id: movieId })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Actor added');
            } else {
                alert(data.error || 'Failed to add actor');
            }
        })
        .catch(err => {
            console.error('Error adding actor:', err);
            alert('Something went wrong');
        });
}
function submitAllActors() {
    const names = Array.from(document.querySelectorAll('.actor-name'))
        .map(input => input.value.trim())
        .filter(name => name !== '');

    if (!movieId || names.length === 0) {
        alert('Missing movie ID or actor names');
        return;
    }

    fetch('/actors/bulk', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            movie_id: movieId,
            actors: names
        })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Actors updated');
            } else {
                alert(data.error || 'Failed to update actors');
            }
        })
        .catch(err => {
            console.error('Bulk actor update failed:', err);
            alert('Something went wrong');
        });
}

