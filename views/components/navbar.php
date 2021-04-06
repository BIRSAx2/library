<header class="text-gray-400 bg-gray-900 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
            <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
            </svg>
            <span class="ml-3 text-xl">Library</span>
        </a>
        <nav class=" md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-700	flex flex-wrap items-center text-base justify-center">
            <a href="books.php" class="mr-5 hover:text-white">Books</a>
            <a href="authors.php" class="mr-5 hover:text-white">Authors</a>

            <a href="loans.php" class="mr-5 hover:text-white">Loans</a>
        </nav>

        <?php if (isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] == 1): ?>
            <nav class="	flex flex-wrap  ml-auto">
                <a href="profile.php" class="mr-5 hover:text-white">Change password</a>
            </nav>
            <a href="index.php?logout" class="">
                <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    Log out
                </button>
            </a>
        <?php else: ?>
            <a href="index.php" class="ml-auto">
                <button class="ml-4 inline-flex text-gray-400 bg-gray-800 border-0 py-2 px-6 focus:outline-none hover:bg-gray-700 hover:text-white rounded text-lg">
                    Log in
                </button>
            </a>
        <?php endif; ?>
    </div>
</header>