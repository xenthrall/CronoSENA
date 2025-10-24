<div class="flex justify-end mb-2">
    <button
        type="button"
        x-data
        x-on:click="
            const checkboxes = document.querySelectorAll('input[type=checkbox]');
            const allChecked = Array.from(checkboxes).every(c => c.checked);
            checkboxes.forEach(c => c.checked = !allChecked);
        "
        class="px-3 py-1 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
    >
        Seleccionar / Deseleccionar todos
    </button>
</div>
