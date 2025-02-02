<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Sola Chemicals</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for Fluent UI-like styling -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 500px;
            width: 100%;
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            max-width: 100px;
        }

        .form-label {
            font-weight: 600;
            color: #323130;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #edebe9;
            padding: 0.5rem 0.75rem;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #0078d4;
            box-shadow: 0 0 0 2px rgba(0, 120, 212, 0.2);
        }

        .btn-primary {
            background-color: #0078d4;
            border: none;
            border-radius: 4px;
            padding: 0.5rem 1rem;
            font-size: 14px;
            font-weight: 600;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #106ebe;
        }

        .error-message {
            color: #a4262c;
            font-size: 12px;
            margin-top: 0.25rem;
            display: none;
        }

        .text-center a {
            color: #0078d4;
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
