<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    // Function to generate a unique reference code
    function generate_ref_code($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ref_code = '';
        $max_index = strlen($characters) - 1;
        
        // Generate a random character and append it to the ref_code
        for ($i = 0; $i < $length; $i++) {
            $ref_code .= $characters[rand(0, $max_index)];
        }
        
        return $ref_code;
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data)) {
        
        $phone_number = htmlentities(strip_tags($data['phone_number']), ENT_QUOTES, 'UTF-8');
        $mobile_network = htmlentities(strip_tags($data['mobile_network']), ENT_QUOTES, 'UTF-8');
            // Generate a unique reference code
        $ref_code = generate_ref_code();

        // Check if all required parameters are present
        if (isset($data['phone_number']) && isset($data['mobile_network'])) {
            
            $status = 'success';

            // Prepare the response data
            $response_data = array(
                'status' => $status,
                'phone_number' => $phone_number,
                'mobile_network' => $mobile_network,
                'ref_code' => $ref_code,            
                'message' => 'Registration successful',            
            );

            // Encode the response data to JSON format
            $response_json = json_encode($response_data);

            // Set the content type header to JSON
            header('Content-Type: application/json');

            // Send the JSON response
            echo $response_json;
        } else {
            // If any required parameter is missing, return a bad request error
            http_response_code(400);
            echo json_encode(array('error' => 'Bad Request'));
        }
    } else {
        echo json_encode(["message" => "Credentials not provided!"]);
    }
    
?>
