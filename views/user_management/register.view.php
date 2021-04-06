<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900">
<?php include 'views/components/navbar.php' ?>

<section class="text-gray-400  body-font relative">

    <form method="post" action="register.php" name="registerform">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-white">Sign up</h1>
            </div>
            <?php include("views/components/flash_messages.php") ?>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <div class="flex flex-wrap -m-2">

                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="login_input_firstname" class="leading-7 text-sm text-gray-400">Nome</label>
                            <input id="login_input_firstname" type="text" name="firstname" placeholder="Mario"
                                   value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>"
                                   required
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="login_input_lastname" class="leading-7 text-sm text-gray-400">Cognome</label>
                            <input id="login_input_lastname" type="text" name="lastname" placeholder="Rossi"
                                   value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>"
                                   required
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="login_input_username" class="leading-7 text-sm text-gray-400">Username (solo
                                lettere e numeri, tra 2 e 64 caratteri)</label>
                            <input id="login_input_username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name"
                                   placeholder="" value="<?= isset($_POST['user_name']) ? $_POST['user_name'] : '' ?>"
                                   required
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="login_input_email" class="leading-7 text-sm text-gray-400">Email</label>
                            <input id="login_input_email" type="email" name="user_email" placeholder="email@example.com"
                                   value="<?= isset($_POST['user_email']) ? $_POST['user_email'] : '' ?>"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>


                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="login_input_password_new" class="leading-7 text-sm text-gray-400">Password (min. 8 caratteri)</label>
                            <input id="login_input_password_new" type="password"
                                   name="user_password_new" pattern=".{8,}"
                                   required autocomplete="off"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="login_input_password_repeat" class="leading-7 text-sm text-gray-400">Ripeti Password</label>
                            <input id="login_input_password_repeat" type="password" name="user_password_repeat"
                                   pattern=".{8,}"
                                   required autocomplete="off"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="login_input_role" class="leading-7 text-sm text-gray-400">Ruolo</label>
                            <select id="login_input_role" type="select" name="user_role"
                                    class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <?php foreach ($roles as $role => $role_name) : ?>
                                    <option value="<?= $role_name ?>"> <?= ucwords($role_name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <input type="text" name="register" value="Register" hidden/>
                        <button type="submit"
                                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                            Sign up
                        </button>
                        <p class="text-indigo-400">
                            <a href="index.php">Log in</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </form>

</section>
</body>
</html>


