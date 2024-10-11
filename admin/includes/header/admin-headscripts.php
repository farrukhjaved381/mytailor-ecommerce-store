<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/myweb/mera-darzi/admin/css/admin-styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        .container h1 {
            margin: 20px 0;
        }

        .container a {
            text-decoration: none;
            color: white;
        }

        .container button {
            padding: 7px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container button:hover {
            background-color: darkblue;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .container th,
        .container td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .container th {
            background-color: #f2f2f2;
        }

        .container tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .container tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons span {
            display: inline-block;
            margin-right: 10px;
        }

        .action-buttons button {
            background-color: green;
            padding: 5px 10px;
        }

        .action-buttons button.delete {
            background-color: red;
        }

        .top-heading {
            margin-top: 100px;
            margin-right: 5px;
        }
    </style>
</head>