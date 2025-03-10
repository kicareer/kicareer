<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Submit with AJAX</title>
  <style>
    body { font-family: Arial, sans-serif; }
    .login-container { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
    input { width: 100%; padding: 10px; margin: 10px 0; }
    button { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
    button:hover { background-color: #45a049; }
    .error { color: red; }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form id="loginForm">
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email">
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password">
      </div>
      <div>
        <label>
          <input type="checkbox" name="remember" id="remember"> Remember me
        </label>
      </div>
      <button type="button" id="submitBtn">Sign In</button>
    </form>
    <div id="result" class="error"></div>
  </div>

  <script type="text/javascript">
    document.getElementById("submitBtn").addEventListener("click", function() {
      // Get the form element
      var form = document.getElementById("loginForm");

      // Create a new FormData object
      var formData = new FormData(form);

      // Create a new XMLHttpRequest object
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "https://api.kiacademy.in/api/auth/login", true); // Replace with your actual URL

      // Set Authorization header with the Bearer token (if needed)
      xhr.setRequestHeader("Authorization", "Bearer ba91b88e0759d162684054d90ca17503e8090629285ecbc75f309379799df12d");

      // Set the onload function to handle the response
      xhr.onload = function() {
        console.log(xhr);
        if (xhr.status === 200) {
          // Success: Show the response
          document.getElementById("result").innerHTML = "Login successful!";
        } else if (xhr.status === 401) {
          // Unauthorized: Invalid credentials
          document.getElementById("result").innerHTML = "Error: Unauthorized (401)";
        } else {
          // Other errors
          document.getElementById("result").innerHTML = "Error: " + xhr.status;
        }
      };

      // Handle any network errors
      xhr.onerror = function() {
        document.getElementById("result").innerHTML = "Network Error";
      };

      // Send the form data via POST
      xhr.send(formData);
    });
  </script>
</body>
</html>
