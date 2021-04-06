<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library :: Authors</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900">
<?php include 'views/components/navbar.php' ?>

<section class="text-gray-400 bg-gray-900 body-font">
    <section class="text-gray-400 bg-gray-900 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-wrap">
          <?php if (isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'admin') : ?>
              <a href="add_author.php" class="mx-auto mr-0 mb-4">
                  <button class="flex  mx-auto mr-0 text-white bg-green-600 border-0 py-2 px-6 focus:outline-none hover:bg-green-700 rounded"
                          type="button">Aggiungi autore
                  </button>
              </a>
          <?php endif; ?>
            <div class="flex flex-wrap -m-4">

              <?php foreach ($authors as $author) : ?>
                  <div class="p-4 lg:w-1/2 md:w-full">
                      <div class="flex border-2 rounded-lg border-gray-800 p-8 sm:flex-row flex-col">
                          <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-gray-800 text-indigo-400 flex-shrink-0">
                              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                  <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                  <circle cx="12" cy="7" r="4"></circle>
                              </svg>
                          </div>
                          <div class="flex-grow">
                              <h2 class="text-white text-lg title-font font-medium mb-3"><?= implode(' ', array_slice($author, 1, 3)) ?></h2>
                              <p class="leading-relaxed text-base"> <?= $author['description'] ?></p>
                              <a href="https://en.wikipedia.org/wiki/<?= $author['first_name'] ?>_<?= $author['last_name'] ?>"
                                 class="mt-3 text-indigo-400 inline-flex items-center">Altro
                                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                       stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                      <path d="M5 12h14M12 5l7 7-7 7"></path>
                                  </svg>
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
