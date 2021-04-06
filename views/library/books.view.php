<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library :: Books</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900">
<?php include 'views/components/navbar.php' ?>

<? //= print_r($books) ?>
<section class="text-gray-400 bg-gray-900 body-font">
    <section class="text-gray-400 bg-gray-900 body-font">
        <div class="container px-5 py-24 mx-auto">
            <form action="books.php" method="POST">
                <div class="flex ml-6 items-center mb-4">
                    <div class="relative flex">
                        <label for="filter">
                            Diponibilità
                            <select name="filter" value=""
                                    class="bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500
                                focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100
                                py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="all" <?= (isset($_POST['filter']) and $_POST['filter'] == 'all') ? 'selected' : '' ?> >
                                    Mostra tutti
                                </option>
                                <option value="onlyAvailable" <?= (isset($_POST['filter']) and $_POST['filter'] == 'onlyAvailable') ? 'selected' : '' ?>>
                                    Solo libri disponibili
                                </option>
                                <option value="onlyBorrowed" <?= (isset($_POST['filter']) and $_POST['filter'] == 'onlyBorrowed') ? 'selected' : '' ?>>
                                    Solo libri non disponibili
                                </option>
                            </select>
                        </label>

                        <div class="mx-2">

                            <label for="filterByAuthor ml-">
                                Autore
                                <select name="filterByAuthor" value=""
                                        class="bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500
                                focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none
                                text-gray-100
                                py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value="noFilter">Nessun filtro</option>
                                  <?php foreach ($authors as $author) : ?>
                                      <option value="<?= $author['id'] ?>" <?= (isset($_POST['filterByAuthor']) and $_POST['filterByAuthor'] == $author['id']) ? 'selected' : '' ?> >
                                        <?= implode(' ', array_slice($author, 1, 3)) ?>
                                      </option>
                                  <?php endforeach; ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <button class="flex  ml-2 text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                            type="submit">Filtra
                    </button>
                  <?php if (isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'admin') : ?>
                      <a href="add_book.php" class="mx-auto mr-0">
                          <button class="flex  mx-auto mr-0 text-white bg-green-600 border-0 py-2 px-6 focus:outline-none hover:bg-green-700 rounded"
                                  type="button">Aggiungi libro
                          </button>
                      </a>
                  <?php endif; ?>
                </div>
            </form>
            <div class="flex flex-wrap -mx-4 -my-8">
              <?php if (sizeof($books) == 0) : ?>
                  <p class="mt-12">Nessun libro</p>
              <?php endif ?>
              <?php foreach ($books as $book) : ?>
                  <div class="py-8 px-4 lg:w-1/2 ">
                      <div class="h-full flex items-start bg-gray-800 rounded-lg py-4 px-2">
                          <div class="flex-grow pl-6">
                              <div class="flex w-full">

                                  <h2 class="tracking-widest text-xs  font-medium text-indigo-400 mb-1">
                                    <?= $book['genre']; ?></h2>
                                  <h2 class=" ml-auto tracking-widest text-xs  font-medium  mb-1 <?= $book['is_available'] ? "text-green-500" : "text-red-500"; ?> ">
                                    <?= $book['is_available'] ? "Available" : "Not available"; ?></h2>

                              </div>
                              <h1 class="title-font text-xl font-medium text-white mb-3"><?= $book['title']; ?></h1>
                              <p class="leading-relaxed mb-5"><?= $book['description']; ?></p>
                              <a class="inline-flex items-center">
                                  <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor"
                                       viewBox="0 0 24 24"
                                       xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                  </svg>
                                  <span class="flex-grow flex flex-col pl-3">
                                <span class="title-font font-medium text-white">
                                  <?php foreach ($book['author'] as $book) {
                                    echo implode(' ', $book);
                                    echo "<br>";
                                  }; ?>
                                </span>
                            </span>
                              </a>

                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>

            </div>
        </div>
    </section>
</body>

</html>
