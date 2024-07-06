<div class='todo-card {{ $status }}' data-id='{{ $todo_id }}' data-status='{{ $status }}'>

    <div class='checkbox-wrapper'>
        <span class='checkbox' name='checkbox' id='checkbox'></span>
    </div>

    <div class='content-wrapper'>
        <div class='content'>
            <p>{{ $todo }}</p>
        </div>
        <div class='action-btns'>
            <span class='delete-btn'>
                <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='white'><path d='m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Z'/></svg>
            </span>
        </div>
    </div>

</div>