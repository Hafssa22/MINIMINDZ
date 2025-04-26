<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MiniMindz Kids Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> 
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
            width: 100%;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            z-index: -1;
        }
        
        .main-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            text-align: left;
        }
        
        .hero {
            background: url("{{ asset('images/backgroundindex2.png') }}") no-repeat center center;
            background-size: cover;      /* always covers entire screen */
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px #000
        }
        
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 120px;
        }   
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: left;
            text-align: left;
            padding: 20px;
        }
        
        .hero h1 {
            font-size: 5rem;
            z-index: 1;
            padding: 0 20px;
            margin-top: 60px; /* Pour éviter que le texte ne soit caché par le logo */
        }
        
        .buttons-container {
            display: flex;
            justify-content: left;
            align-items: left;
            gap: 30px;
            padding: 40px;
            text-align: left;
        }
        
        .bouton {
            background-color: white; 
            font-family: 'Marykate', 'Comic Sans MS', cursive, sans-serif;
            color: #0cc0df; 
            padding: 12px 24px; 
            border: none; 
            border-radius: 15px; 
            font-size: 25px; 
            cursor: pointer; 
            transition: all 0.3s ease;
            min-width: 150px;
            text-align: center;
        }
        
        .bouton:hover {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="hero">
            <img src="{{ asset('images/logoMINIMINDZ.jpg') }}" alt="Logo du site" class="logo">

            <div class="content">
                <h1>Welcome to MINIMINDZ Kids Academy</h1>
                <div class="buttons-container">
                    <button class="bouton" onclick="location.href='{{ url('/kids') }}'">I'M A KID</button>
                    <button class="bouton" onclick="location.href='{{ url('/tutor/dashboard') }}'">I'M A TUTOR</button>
                </div>    
            </div>    
        </div>
    </div> 

</body>
</html>
