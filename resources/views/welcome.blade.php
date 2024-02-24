<style>

:root {
  --color1:#b6e7b7; 
  --color2:#c1f8bb; 
  --color3:#3ed516; 
  --color4:#2980b9; 
  --color5: #333; 
  --color6:#026308; 
  --color7:#99ffc1;
  --color8:#0a2cc8;
  --color9:#c8344d;
  --color10:#e41313;
}
  body {
    font-family: 'Arial', sans-serif;
    background:var(--color2);
  }

  .login {
  text-align: center; /* Aliyaj bouton yo nan bò dwat div la */
}

.login button {
  background-color: var(--color5); /* Koulè ble pou bouton yo */
  color: white; /* Koulè teks la */
  padding: 8px 15px; /* Espasman nan bouton yo */
  border: none; /* Pa gen bordi nan bouton yo */
  border-radius: 4px; /* Fòme bouton yo kòn */
  margin-left: 5px; /* Espasman ant chak bouton */
  cursor: pointer; /* Afiche yon kou ki montre ke se yon eleman interaktif */
  text-decoration: none; /* Pa gen dekorasyon sou liy teks la */
  margin-top: 20px;
  margin-right: 50px;
}

.login button a {
  color: white; /* Koulè teks la pou lyen nan bouton an */
  text-decoration: none; /* Pa gen dekorasyon sou lyen nan bouton an */
}

  .titet {
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  margin: 20px 0;
}

.titet span {
  color: var(--color5); /* Koulè ble pou span yo */
}

.titet span:first-child {
  text-transform: uppercase; /* Fè premye span an tounen an majiskil */
}

.titet span:last-child {
  font-style: italic; /* Fè dezyèm span an tounen italik */
}

  .tabx {
    overflow-x: auto;
    background-color: var(--color1);
    padding: 10px;
    border-radius: 8px;
    margin-top: 20px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th, td {
    border: none ;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: var(--color7);
  }

  .description {
    display: none;
  }

  .show-button {
    cursor: pointer;
    background-color: var(--color4);
    color: white;
    padding: 8px;
    border: none;
    border-radius: 4px;
    margin-bottom: 10px; /* Ajoute yon espas anba bouton an */
  }

  .buy-now-button {
    position: absolute;
    cursor: pointer;
    background-color: var(--color6);
    color: white;
    padding: 8px;
    border: none;
    border-radius: 4px;
    width: 100px;
    margin-top: 10px; /* Ajiste espas anwo bouton an */
    right: 10px;
  }

  @media only screen and (max-width: 600px) {
    .show-button, .buy-now-button {
      display: block;
      width: 100%;
    }

    .buy-now-button {
      cursor: pointer;
      background-color: var(--color6);
      color: white;
      padding: 8px;
      border: none;
      border-radius: 4px;
      margin-top: 10px; /* Ajiste espas anwo bouton an */
    }
  }

  .crypto-section {
            width: 100%;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .crypto-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
                
        .crypto-paragraph {
            color: #666;
            margin-bottom: 0; /* Ou chanje margin-bottom la pou 0 */
            font-size: 40px;
            margin-left: 10px;
        }

        .crypto-image {
            float: right;
            margin-top: 20px; /* Ou ajoute margin-top la pou bay yon ti espas anwo imaj la */
            margin-left: 20px;
            margin-top: -20%;
            border-radius: 8px;
            box-shadow: 0 0 50px var(--color5);
            width: 30%;
            border-left-color: 1px solid #026308;
        }

        .clear {
            clear: both;
        }

        .crypto-button {
            background-color: #4CAF50;
            color: white;
            margin: 4px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .crypto-button:hover {
            background-color: #45a049;}
        /* Stilizasyon pou ekran ki pi piti (mobile) */
@media only screen and (max-width: 600px) {
    .crypto-paragraph {
        font-size: 20px; /* Ou kapab chanje siz teks la daprè bezwen ou */
    }

    .crypto-image {
        float: none; /* Fè imaj la pa flote ankò */
        margin: 20px auto; /* Mete margin pou l'aparèt anwo teks la */
        display: block; /* Fè imaj la tounen yon blok */
        width: 80%; /* Ou kapab ajuste lajè imaj la daprè bezwen ou */
    }
}
span {
    color: var(--color3);
    font-size: 50px;
    font-weight: bold;
    font-family: "Arial", sans-serif;
    /* Ajoute efè lòt kote ou bezwen */
    text-transform: uppercase; /* Fè tout lèt yo an majiskil */
    letter-spacing: 2px; /* Espas ant let yo */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Efè omb ak opasite */
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DigitalLab</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('cssfile/user.css') }}">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <!-- Autres balises meta, styles CSS, scripts, etc. -->
</head>
<body class="home">
            
  <div class= "login">
    @if (Route::has('login'))
      <div class="">
        @auth
          <button id="btn1"><a href="{{ url('/dashboard') }}" >Dashboard</a></button>
        @else
          <button id="btn2"><a href="{{ route('login') }}"  >Log in</a></button>
          @if (Route::has('register'))
            <button id="btn3"><a href="{{ route('register') }}">Register</a></button>
          @endif
        @endauth
      </div>
    @endif
  </div>
  
  <p class="titet"><span>Unlock</span> a Greater Social Media Following with a <span>Simple Click!</span></p>

  <div class="tabx">
    <table>
      <tr>
        <th>ID</th>
        <th>Service</th>
        <th>Rating</th>
        <th>Description</th>
        <th>Start Time</th>
        <th>Min Order</th>
        <th>Max Order</th>
        <th>Speed</th>
        <th>Price per 1000</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>1</td>
        <td>Instagram</td>
        <td>5.0</td>
        <td>
          <div class="show-button-container">
            <button class="show-button" data-target="service1" onclick="showDescription('service1')">Show</button>
          </div>
          <div class="description" id="service1">High-quality service to boost your social media presence. Genuine followers and engagement.</div>
          <div class="show-button-container">
            <button class="buy-now-button" onclick="buyNow('service Instagram')">Buy Now</button>
          </div>
        </td>
        <td>Immediate</td>
        <td>100</td>
        <td>5000</td>
        <td>Fast</td>
        <td>$10</td>
      </tr>
      <!-- Add more rows as needed -->
    </table>
  </div>

  
  <script>
    function showDescription(targetId) {
      var descriptionElement = document.getElementById(targetId);
      descriptionElement.style.display = 'block';
    }

    function buyNow(serviceId) {
    // Add logic for Buy Now action
    alert('Buy Now clicked for service ' + serviceId);
    
    // Redirije lè klike sou bouton an
    window.location.href = '{{ route("marketing") }}';
}

  </script>

<div class="crypto-section">
  <h2 class="crypto-title">Start Your <span>Trading</span> Journey</h2>
  <p class="crypto-paragraph">Discover million-dollar sellers  <br> securely with just a few clicks,  <br> whether you're buying or <br> selling cryptocurrency.<br></p>
  <img src="img/cbb.png" alt="Coinbase Image" class="crypto-image">
  <a href="{{ route('register') }}" class="crypto-button">Créer un compte</a>
  <div class="clear"></div> <!-- Ajoute yon div "clear" apre div yo -->
</div>

<script>
  function showDescription(targetId) {
    var descriptionElement = document.getElementById(targetId);
    descriptionElement.style.display = 'block';
  }

    function buyNow(serviceId) {
      // Add logic for Buy Now action
      alert('Buy Now clicked for service ' + serviceId);
      
      // Redirije lè klike sou bouton an
      window.location.href = '{{ route("marketing") }}';
  }

</script>

</body>
</html>
