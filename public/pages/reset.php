<?php
session_start();

?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset  - Forget password Tutorial</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="../assets/img/forgot-password-office.jpeg"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../assets/img/forgot-password-office-dark.jpeg"
              alt="Office"
            />
          </div>


          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Reset password
              </h1>
              <form  action="../validate/reset_inc.php" method="post">
              <?php
        if (isset($_GET['mail']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',base64_decode($_GET['mail'])))
        {
            $email = base64_decode($_GET['mail']);

        }
        if (isset($_GET['key']) && (strlen($_GET['key']) == 32))//The Activation key will always be 32 since it is MD5 Hash
        {
            $key = $_GET['key'];
        }


        if (isset($email) && isset($key))
        {
    ?>
             

              
		<?php 
                                    include '../validate/reset_inc.php';
                                    
                                    if(isset($_SESSION['success'])=="true"){
                                        echo '<div class="alert alert-success absolue center text-center" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <span class="text-success">
                                                    Password reset successful. 
                                                    <a class="btn btn-success" href="index.php">Login</a>
                                                </span>
                                            </div>';
                                        unset($_SESSION['new']); 
                                    }
                                ?>

              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">New Password</span>
                <input
                type="text" name="new" required " 
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="New Password" id="email"
                  
                />
              </label>

              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
                <input
                type="password" name="confirm" required " 
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                 placeholder="Confirm Password" id="email"
                  
                />
					  <input type="text" name="email" required  value="<?php echo $email?>"class="form-control change" id="password" placeholder="Confirm New Password"/>
              <input type="text" name="key" required  value="<?php echo $key?>" class="form-control change" id="password" placeholder="Confirm New Password"/>
              </label>

             
              <button
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                name="submit"
                type="submit"
              >
                Recover password
              </button>

              </form>
<?php 
    }else{
        echo'<div class="alert alert-danger absolue center text-center" role="alert">
                <span class="text-danger">Opps! Error Occured.</span>
            </div>';
    }
?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/jquery/dist/jquery.min.js"></script>
    <script src="../assets/dist/bootstrap/js/bootstrap.min.js"></script>
    
  </body>
</html>