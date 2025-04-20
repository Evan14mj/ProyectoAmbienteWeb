<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/solicitudes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
        body {
            overflow-x: hidden;
        }
        .hero-section {
            position: relative;
            height: 100vh;
            min-height: 600px;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
    
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.pexels.com/photos/296301/pexels-photo-296301.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 1;
        }
    
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 2;
        }
    
        .hero-content {
            position: relative;
            z-index: 3;
            color: white;
            padding: 2rem;
            width: 100%;
        }


        .modal-dialog {
            max-width: 400px;
        }
        .toast {
            background-color: #0f4c5c;
            color: white;
        }
        .toast-header {
            background-color: #0a2e38;
            color: white;
        }

    </style>
    <title>Inicio</title>
</head>
<body>