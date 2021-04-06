<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library :: Profile</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900">
<?php include 'views/components/navbar.php' ?>
<section class="text-gray-400  body-font relative">
    <form method="post" action="profile.php">
        <input type="text" hidden name="changePassword" value="change">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-white">Profile</h1>
            </div>
            <?php include("views/components/flash_messages.php") ?>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="login_input_password_new" class="leading-7 text-sm text-gray-400">Nuova Password
                            (min. 8 caratteri)</label>
                        <input id="login_input_password_new" type="password" name="user_password_new" pattern=".{8,}"
                               required autocomplete="off"
                               class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <div class="p-2 w-full">
                    <input type="text" name="login" value="Log in" hidden/>
                    <button type="submit"
                            class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                        Cambia password
                    </button>
                </div>

            </div>
        </div>
    </form>
</section>
</body>
</html>
