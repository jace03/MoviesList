function handleActorInput(input) {
    const container = document.getElementById('actor-inputs');
    const inputs = container.querySelectorAll('.actor-name');
    const lastInput = inputs[inputs.length - 1];

    if (input === lastInput && input.value.trim() !== '') {
        const newDiv = document.createElement('div');
        newDiv.classList.add('mb-3');

        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.className = 'w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 actor-name';
        newInput.placeholder = 'Actor Name';
        newInput.setAttribute('oninput', 'handleActorInput(this)');

        newDiv.appendChild(newInput);
        container.appendChild(newDiv);
    }
}

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


