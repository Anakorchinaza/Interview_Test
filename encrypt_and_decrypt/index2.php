<?php
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
    $plaintext = "Welcome to Lagos";
    $key = "thisisaverysecurekeyof32byteslength"; // 32 bytes key for AES-256
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));

    echo "Original Text: " . $plaintext . "<br>";

    $encrypted_text = encrypt($plaintext, $key, $iv);
    echo "Encrypted Text (HEX): " . $encrypted_text . "<br>";

    $decrypted_text = decrypt($encrypted_text, $key, $iv);
    echo "Decrypted Text: " . $decrypted_text . "";
?>
