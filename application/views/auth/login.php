<style>
    /* Custom styles for the background image */
    body {
        background-image: url(<?= base_url('public/images/login.jpg'); ?>);
        /* Replace with your actual image URL */
        background-size: cover;
        background-position: center;
        min-height: 100vh;
    }
</style>
<div class="flex">
    <div class="w-full">
        <section class="p-2 flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
            <?= form_open('login', array('class' => 'w-full px-6 py-6 space-y-3 sm:px-5 sm:space-y-4')) ?>
                <div class="flex flex-wrap">
                    <label for="empid" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                        Employee ID
                    </label>
                    <input id="empid" name="empid" type="text" class="bg-gray-50 border  <?php echo isset($error) ? 'border-red-500' : 'border-gray-200' ?> text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Employee ID" required autofocus autocomplete="off"/>
                </div>

                <div class="flex flex-wrap">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                        Password
                    </label>
                    
                    <input id="password" name="password" type="password" class="bg-gray-50 border  <?php echo isset($error) ? 'border-red-500' : 'border-gray-200' ?> text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Password" required autofocus autocomplete="off"/>
                </div>

                <div class="flex flex-wrap py-4">
                    <button type="submit" name="btnSignIn" class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                        Login
                    </button>
                </div>
            <?= form_close(); ?>

        </section>
    </div>
</div>