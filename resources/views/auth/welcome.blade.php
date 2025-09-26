<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>spaceedujo</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: sans-serif;
    }

    body, html {
      height: 100%;
      width: 100%;
    }

    .imgg {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 50%; 
      overflow: hidden;
      z-index: 1;
    }

    .imgg img {
      width: 100%;
      height: 100%;
      object-fit: cover; 
    }

    .container {
      margin-left: 50%; 
      width: 50%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
      background-color: white;
      z-index: 2;
      position: relative;
    }

    .content {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .content h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .content p {
      font-size: 30px;
      font-weight: bold;
      margin-bottom: 2rem;
    }

    .buttons {
      display: flex;
      gap: 2rem;
      justify-content: center;
    }

    .buttons button {
      padding: 20px 30px;
      font-size: 20px;
      border-radius: 5px;
      cursor: pointer;
      border: 1px solid black;
      transition: 0.6s;
    }

    .buttons .login {
      background-color: white;
    }

    .buttons .signup {
      background-color: black;
      color: white;
    }

    @media (max-width: 768px) {
      .imgg {
        display: none;
      }

      .container {
        margin-left: 0;
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="imgg">
    <img src="c:\Users\user\Downloads\ea1c8a07-2577-4b24-83e8-6cb367f39d4c.jpg" alt="Logo" />
  </div>

  <div class="container">
    <div class="content">
      <h1>مرحبا بك</h1>
      <p><b>Education Space</b></p>
      <div class="buttons">
        <button class="login" onclick="window.location.href='spacejo2.html'">log in</button>
        <button class="signup" onclick="window.location.href='spacejowe.html'">sign up</button>
      </div>
    </div>
  </div>

</body>
</html>