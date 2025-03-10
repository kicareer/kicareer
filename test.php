<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Test</title>
</head>
<body>
    <button type="button" id="test">Test</button>
    <div id="result"></div>
    <script type="text/javascript">
    document.getElementById("test").addEventListener("click", function() {    
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://api.kiacademy.in/api/users/91", true);

        // Set Authorization header with the Bearer token
        xhr.setRequestHeader("Authorization", "Bearer ba91b88e0759d162684054d90ca17503e8090629285ecbc75f309379799df12d");

        xhr.onload = function() {
            // console.log(xhr.status);
            if (xhr.status === 200) {
                // Handle the success response
                document.getElementById("result").innerHTML = xhr.responseText;
            }  else if (xhr.status === 401) {
                // Handle 401 Unauthorized error
                document.getElementById("result").innerHTML = "Error: Unauthorized (401)";
            } else {
                // Handle other errors
                document.getElementById("result").innerHTML = "Error: " + xhr.status;
            }
        };

        xhr.onerror = function() {
            // Handle network errors
            document.getElementById("result").innerHTML = "Network Error";
        };

        xhr.send();
    });
</script>

<!-- <script>
    document.getElementById("test").addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://api.kiacademy.in/proxy", true);  // Call the CodeIgniter proxy

        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
            } else {
                document.getElementById("result").innerHTML = "Error: " + xhr.status;
            }
        };

        xhr.onerror = function() {
            document.getElementById("result").innerHTML = "Network Error";
        };

        xhr.send();
    });
</script> -->



</body>
</html>