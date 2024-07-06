<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <link rel='icon' type='image/x-icon' href='./favicon.ico'>
    <title>To Do List</title>
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <main>
        <header>
            <h1>TO DO LIST</h1>
        </header>
        <div class='todo-wrapper'>

            @foreach ($todos as $t)

                <x-todocard :data="$t"/>

            @endforeach
            
        </div>

        <span class='add-todo-btn'>
            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='white'><path d='M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z'/></svg>
            <form class='new-todo-form' action='{{ url('/add-todo') }}'>
                <input type='text' name='new-todo' id='new-todo' class='todo-input' placeholder='Add Todo' required>
            </form>
        </span>
    </main>
</body>

</html>