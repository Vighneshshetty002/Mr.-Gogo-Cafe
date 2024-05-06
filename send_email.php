<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "vighneshshetty002@gmail.com";
    $subject = "Order Details";
    
    $cartItems = json_decode(file_get_contents("php://input"), true);
    $totalPrice = 0;
    $emailContent = "Order Details:\n\n";
    
    foreach ($cartItems as $item) {
        $itemName = $item['itemName'];
        $itemPrice = $item['itemPrice'];
        $emailContent .= "Item: $itemName\nPrice: $itemPrice\n\n";
        $totalPrice += intval($itemPrice);
    }
    
    $emailContent .= "Total Price: $totalPrice/-";

    // Send email
    mail($to, $subject, $emailContent);

    // Return success response
    echo json_encode(["status" => "success"]);
} else {
    // Return error response
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
