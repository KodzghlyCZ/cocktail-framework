<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$title ?? 'Anonymní tiketovací systém'?></title>
		<link rel="icon" type="image/x-icon" href="https://www.cataniagroup.cz/wp-content/uploads/2019/10/CATANIA-GROUP-s.r.o..png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            .logo-link {
                text-decoration: none;
                color: inherit;
                display: block;
                text-align: center;
                font-size: 24px;
                margin: 10px 0;
            }

            @media only screen and (max-width: 600px) {
                .logo-link {
                    font-size: 18px;
                }
            }
        </style>
	</head>
	<body>
    <nav class="navtop">
    	<div class="logo-container">
            <a href="https://dev.tickets.catania-service.cz">
                <img src="https://www.cataniagroup.cz/wp-content/uploads/2019/10/CATANIA-GROUP-s.r.o..png" alt="Logo" class="logo-img">
            </a>
            <a href="https://dev.tickets.catania-service.cz" class="logo-link">Anonymní tiketovací systém</a>
            <a href="login.php"><i class="fas fa-ticket-alt"></i>Přihlášení</a>
    	</div>
    </nav>