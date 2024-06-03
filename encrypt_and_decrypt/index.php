<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Encrypt and Decrypt</title>
  </head>
  <body>
  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // PHP functions here
        function encrypt($plaintext, $key, $iv) {
            $cipher = "aes-256-cbc";
            $options = 0;
            
            // Encrypt the data
            $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options, $iv);
            
            // Convert to hexadecimal
            $ciphertext_hex = bin2hex($ciphertext);
            
            return $ciphertext_hex;
        }

        function decrypt($ciphertext_hex, $key, $iv) {
            $cipher = "aes-256-cbc";
            $options = 0;
            
            // Convert hexadecimal back to binary
            $ciphertext = hex2bin($ciphertext_hex);
            
            // Decrypt the data
            $plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options, $iv);
            
            return $plaintext;
        }

        // Example usage
        $plaintext = $_POST['text'];
        $key = "thisisaverysecurekeyof32byteslength"; // 32 bytes key for AES-256
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));

        $encrypted_text = encrypt($plaintext, $key, $iv);
        $decrypted_text = decrypt($encrypted_text, $key, $iv);

        echo "Original Text: " . htmlspecialchars($plaintext) . "<br>";
        echo "Encrypted Text (HEX): " . $encrypted_text . "<br>";
        echo "Decrypted Text: " . htmlspecialchars($decrypted_text) . "<br>";
    }
    ?>
    


    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1>Encrypt and Decrypt</h1>

                <form method="post">
                    <label for="text">Enter text to encrypt and decrypt:</label><br>
                    <input type="text" id="text" name="text" required><br><br>
                    <button type="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
  </body>
</html>
