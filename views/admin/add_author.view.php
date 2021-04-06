<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library :: Add author</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="text-gray-400 body-font bg-gray-900">
<?php include 'views/components/navbar.php' ?>

<section>
    <div class="container px-5 py-12 mx-auto">
        <div class="flex flex-col text-center w-full mb-1">
            <h2 class="text-xs text-indigo-400 tracking-widest font-medium title-font mb-1">Dashboard</h2>
            <h1 class="sm:text-3xl text-3xl font-medium title-font mb-4 text-white">Aggiungi libri</h1>
        </div>
        <div class="text-center text-red-500">
          <?php include("views/components/flash_messages.php") ?>
        </div>
        <div class=" mx-auto">
            <div class="container mx-auto flex">
                <form action="add_author.php" method="POST" class="w-1/2 mx-auto">
                    <input type="text" name="addAuthor" value="addAuthor" hidden>
                    <div class="w-full bg-gray-900 shadow-md rounded-lg p-8 flex flex-col mt-10 md:mt-0 relative  mx-auto">

                        <div class="flex">
                            <div class="relative mb-4 w-1/3">
                                <label for="first_name" class="leading-7 text-sm text-gray-400">Nome</label>
                                <input type="text" id="title" name="first_name" required
                                       class="w-full bg-gray-800 rounded border border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <div class="relative mb-4 w-1/3 pl-2">
                                <label for="middle_name" class="leading-7 text-sm text-gray-400">Secondo nome</label>

                                <input type="text" id="middle_name" name="middle_name"
                                       class="w-full bg-gray-800 rounded border border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <div class="relative mb-4 w-1/3 pl-2">
                                <label for="last_name" class="leading-7 text-sm text-gray-400">Cognome</label>
                                <input type="text" id="last_name" name="last_name" required
                                       class="w-full bg-gray-800 rounded border border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="relative mb-4">
                            <label for="description" class="leading-7 text-sm text-gray-400">Descrizione</label>
                            <textarea id="description" name="description" required
                                      class="w-full bg-gray-800 rounded border border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900 h-32 text-base outline-none text-gray-100 py-1 px-3 leading-6 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                        <button type="submit"
                                class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                            Aggiungi Autore
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
</body>
</html>