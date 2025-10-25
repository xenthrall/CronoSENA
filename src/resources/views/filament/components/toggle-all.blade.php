<div style="display: flex; justify-content: flex-end; margin-bottom: 0.5rem;">
    <button
        type="button"
        x-data
        x-on:click="
            const checkboxes = document.querySelectorAll('input[type=checkbox]');
            const allChecked = Array.from(checkboxes).every(c => c.checked);
            checkboxes.forEach(c => c.checked = !allChecked);
        "
        style="
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: white;
            background-color: #4f46e5;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        "
        onmouseover="this.style.backgroundColor='#4338ca'"
        onmouseout="this.style.backgroundColor='#4f46e5'"
    >
        Seleccionar / Deseleccionar todos
    </button>
</div>
