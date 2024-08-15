{{-- resources/views/errors/payment_error.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Error</title>
</head>
<body>
    <h1>Payment Error</h1>
    <p>There was an issue processing your payment. Please try again later.</p>
    <p>Error Message: {{ $message }}</p>
</body>
</html>
