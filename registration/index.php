<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Registration Form</title>
  </head>
  <body>   

    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h1>Registration Form</h1>
                <form action="register.php" method="post" onsubmit="return validateForm()">
                    <div class="row mt-5">
                        <div class="col-6">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="phone">Phone number (11 digits):</label>
                            <input class="form-control" type="phone" id="phone" name="phone" required><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="email">Email (gmail or yahoo):</label>
                            <input class="form-control" type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@(gmail|yahoo)\.com" required><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>                    
        
                </form>
            </div>
        </div>
    </div>

  

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        function validateForm() {
            var phone = document.getElementById('phone').value;
            var email = document.getElementById('email').value;
            var phoneRegex = /^\d{11}$/;
            var emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail|yahoo)\.com$/;

            if (!phoneRegex.test(phone)) {
                alert("Phone number must be 11 digits and only contain numbers.");
                return false;
            }

            if (!emailRegex.test(email)) {
                alert("Email should be a valid Gmail or Yahoo address.");
                return false;
            }

            return true;
        }
    </script>
   
  </body>
</html>
