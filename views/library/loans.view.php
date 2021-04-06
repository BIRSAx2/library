<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library :: Loans</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900">
<?php include 'views/components/navbar.php' ?>


<section class="text-gray-400 bg-gray-900 body-font relative">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font  text-white">Prestiti</h1>
        </div>
      <?php include("views/components/flash_messages.php") ?>
        <form action="loans.php" method="POST">
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <input type="text" hidden name="loanABook" value="true">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-2/3">
                        <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-400">Libro</label>
                            <select id="book_id" name="book_id" required
                                    class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500
                                focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-2
                                px-3 leading-8 transition-colors duration-200 ease-in-out">
                              <?php foreach ($books as $book) : ?>
                                  <option value="<?= $book['id'] ?>"> <?= $book['title'] ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="p-2 w-1/3">
                        <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-400">Data</label>
                            <input id="datePicker" name="date" required type="date"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500
                                focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 pb-1
                                px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8
                        focus:outline-none hover:bg-indigo-600 rounded text-lg">Prendi in prestito
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="text-gray-400 bg-gray-900 body-font">
    <div class="flex flex-col text-center w-full mb-0">
        <h1 class="sm:text-3xl text-2xl font-medium title-font  text-white">I tuoi prestiti</h1>
    </div>
    <div class="container px-5 py-24 mx-auto flex flex-wrap w-full">
        <div class="flex flex-wrap -m-4 w-full">
          <?php if (sizeof($loans) == 0) : ?>
              <p>Nessun libro preso in prestito</p>
          <?php endif ?>
          <?php foreach ($loans as $loan) : ?>
              <div class="p-4 lg:w-1/4">
                  <div class="flex border-2 rounded-lg border-gray-800 p-8 sm:flex-row flex-col">
                      <div class="flex-grow">
                          <h2 class="text-white text-lg title-font font-medium mb-3"><?= $loan['title'] ?> </h2>
                          <p>Dal: <?= date_format(new DateTime($loan['loan_date']), 'm-d-Y') ?></p>
                          <a href="loans.php?loan_id=<?= $loan['loan_id'] ?>&book_id=<?= $loan['id'] ?>"
                             class="mt-3 text-indigo-400 inline-flex items-center"> Resituisci
                              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                  <path d="M5 12h14M12 5l7 7-7 7"></path>
                              </svg>
                          </a>
                        <?php if (strtotime($loan['loan_date']) < strtotime('-30 days')) : ?>
                            <p class="text-red-500">Restituzione in ritardo</p>
                        <?php endif; ?>
                      </div>
                  </div>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
</section>
</body>
<script>
    document.getElementById('datePicker').valueAsDate = new Date();
</script>
</html>
