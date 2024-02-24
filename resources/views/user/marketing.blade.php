<title>Marketing</title>
<style>
   body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #f4f4f4;
    color: #333;
}

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

.x-app-layout {
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.alert {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    background-color: #f2f2f2;
}

form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: var(--color1);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
}
.bbm {
    max-height: 150px; /* Limit div la */
    overflow-y: auto; /* Ou ka itilize auto pou fè li montre li lè sa nesesè */
    background: #1bc63d; /* Koulè div la */
    padding: 10px; /* Padding div la, ou ka modifye sa selon preferans ou */
    border-radius: 5px; /* Kòb div la, ou ka modifye sa selon preferans ou */
    width: 30%;
    border: #1bc63d 4px;
}

.fds {
    width: 100%;
    max-height: 150px; /* Set a fixed maximum height for the container */
    overflow-y: auto; /* Add scroll bar to the div */
    padding: 10px; /* Padding for the div, you can modify this according to your preference */
    border-radius: 5px; /* Border radius for the div, modify as needed */
    font-size: 16px; /* Font size for better readability on mobile */
}

.fds option {
    font-size: 0.7rem; /* Font size for better readability on mobile */
    margin: 0; /* Reduce the width of the options in the <select> */
    background-color: var(--color2); /* Background color for options */
    height: 50px;
    
}






.custom-dropdown {
    width: 100%;
    max-height: 150px; /* Set a fixed maximum height for the container */
    overflow-y: auto; /* Add scroll bar to the div */
    padding: 10px; /* Padding for the div, you can modify this according to your preference */
    border-radius: 5px; /* Border radius for the div, modify as needed */
    font-size: 16px; /* Font size for better readability on mobile */
    position: relative;
  }

  .custom-dropdown option {
    font-size: 16px; /* Font size for better readability on mobile */
    padding: 10px; /* Padding for each option to make them shorter */
    margin: 0; /* Reduce the width of the options in the <select> */
    background-color: #1bc63d; /* Background color for options */
    white-space: nowrap; /* Prevent options from wrapping to multiple lines */
    display: none; /* Hide options by default */
  }

  /* .custom-dropdown option:nth-child(-n+5) {
    display: block;
  } */


select {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
    overflow: auto; /* Ajoute sa isi pou gen yon scroll bar */
}

button {
    background-color: #4a90e2;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    display: inline-block;
}

button:hover {
    background-color: #357ebd;
}

/* Ajoute lòt stil yo isit la */

@media only screen and (max-width: 600px) {
    form {
        max-width: 100%;
    }

    select {
        width: 100%;
    }
}

/* Kòd CSS responsif */
.bfm {
  width: 100%; /* Fè sèvis la okipe tout lajè ekran an */
  box-sizing: border-box; /* Kalkile total lajè ak gwo pwopriyete (pati souf lajè an wè lè li gen limit) */
  font-size: 16px; /* Si ou vle chanje gwosè tèks la sou telefòn, ou ka modifye sa */
  background: red;
}

/* Styilize opsyon nan lis la */
.bfm option {
  padding: 10px;
  font-size: 10px; /* Si ou vle chanje gwosè tèks opsyon yo sou telefòn, ou ka modifye sa */
  background-color: var(--color3);
  width: 4px;
}

/* Ajoute lòt stil yo isit la */

@media only screen and (max-width: 600px) {
    form, .rzt {
        max-width: 100%;
    }

    select,
    input {
        width: 100%;
    }
}
 
/* Styilize kantite */
label[for="quantity"], label[for="url"] {
  display: block; /* Fè label yo chak yon blok pou yo tonbe anba lòt */
  margin-bottom: 8px; /* Espas anba chak label */
}

input[type="number"], input[type="text"] {
  width: 100%; /* Fè input yo okipe tout lajè ekran an */
  padding: 10px; /* Ajoute yon piti pad pou plis estil */
  margin-bottom: 16px; /* Espas anba chak input */
  box-sizing: border-box; /* Kalkile total lajè ak gwo pwopriyete (pati souf lajè an wè lè li gen limit) */
}

button[type="submit"], button[type="button"] {
  background-color: var(--color5); /* Koulè fon bouton soumèt epi kalkile */
  color: white; /* Koulè tèks sou bouton soumèt epi kalkile */
  padding: 12px 20px; /* Ajoute yon piti pad pou plis estil */
  border: none; /* Pa gen bord sou bouton yo */
  border-radius: 4px; /* Rondi bò bouton yo */
  cursor: pointer; /* Fè kòrsè a vire lè ou pase sou bouton an */
  margin-bottom: 16px; /* Espas anba chak bouton */
}


/* Styilize div rzt */
.rzt {
  margin-top: 20px; /* Espas anwo div rzt la */
  position: static;
  display: inline;
  font-size: 5px;
}

/* Styilize rezilta ak total yo */
#result, #total-quantity, #total-price {
  margin-bottom: 16px; /* Espas anba chak div rezilta ak total */
  font-size: 16px;
}

/* Styilize bouton peye montan */
button[type="submit"].pay {
  background-color: #008CBA; /* Koulè fon bouton peye montan */
}

button[type="submit"].pay:hover {
  background-color: #007B9F; /* Koulè fon lè ou pase sou bouton peye montan */
}

 
</style>

<title>Marketing</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="phs">
        <div class="arletview">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
    
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>
    

    <form  action="{{ route('marketing.store') }}" method="POST" class="dbr">
        <div class="rzt">
            <p id="result"></p>
            <p id="total-quantity"></p>
            <p id="total-price"></p>
        </div>    
        @csrf
        <label for="platform">Chwazi Platform:</label>
        <select id="platform" name="platform" class="fds">
           
                <option value="Facebook">Facebook</option>
                <option value="Instagram">Instagram</option>
                <option value="TikTok">TikTok</option>
                <option value="Telegram">Telegram</option>
                <option value="Twitter">Twitter</option>
                <option value="Twich">Twich</option>
                <option value="TikTok">Facebook</option>
                <option value="Facebook">Souncloud</option>
                <option value="Spotify">Spotify</option>
                <option value="Redit">Redit</option>
                <option value="Kick">Kick</option>
                <option value="Audiomack">Audiomack</option>
                <option value="Pinterest">Pinterest</option>
                <option value="Whatssap">Whatssap</option>
                <option value="Rumble">Rumble</option>
                <option value="Quora">Quora</option>
                <option value="Vimeo">Vimeo</option>
                <option value="Website">Website</option>
                <option value="Audiomack">Audiomack</option>
                <option value="Pinterest">Pinterest</option>
                <option value="Whatssap">Whatssap</option>
                <option value="Audiomack">Audiomack</option>
                <option value="Pinterest">Pinterest</option>
                <option value="Whatssap">Whatssap</option>
                <option value="Rumble">Rumble</option>
                <option value="Quora">Quora</option>
                <option value="Vimeo">Vimeo</option>
                {{-- <option value="Website">Website</option> --}}
                <option value="Audiomack">Audiomack</option>
                <option value="Pinterest">Pinterest</option>
                <option value="Whatssap">Whatssap</option>
                <option value="Rumble">Rumble</option>
                <option value="Quora">Quora</option>
                <option value="Vimeo">Vimeo</option>
                <option value="Website">Website</option>
            <!-- Ajoute lòt platfòm isit la -->
        </select>
        <br><br>
        <label for="service">Chwazi Tip de Sèvis:</label>
        <select id="service" name="service" class="bfm">
            <option value="Views GeoTarge">Views GeoTarget</option>
            <option value="Live Stream Viewers 15 Minutes">Live Stream Viewers 15 Minutes</option>
            <option value="Comment Likes">Comment Likes</option>
            <option value="Custom Comments">Custom Comments</option>
            <option value="Watch Time Hours">Watch Time Hours - </option>
            <option value="Live Stream Viewers 90 Minutes">Live Stream Viewers 90 Minutes</option>
            <option value="Live Stream Viewers 6 Hours">Live Stream Viewers 6 Hours</option>
            <option value="Shorts Likes">Shorts Likes</option>
            <option value="Views from AdWords Campaign">Views from AdWords Campaign</option>
            <option value="Views from Native Ads">Views from Native Ads</option>
            <option value="Random Emoji Comments">Random Emoji Comments</option>
            <option value="Social Shares">Social Shares</option>
            <option value="Social Shares USA">Social Shares USA</option>
            <option value="Live Stream Viewers 10 Minutes">Live Stream Viewers 10 Minutes</option>
            <option value="Live Stream Viewers 30 Minutes">Live Stream Viewers 30 Minutes</option>
            <option value="Live Stream Viewers 60 Minutes">Live Stream Viewers 60 Minutes</option>
            <option value="YouTube Views">YouTube Views</option>
            <option value="YouTube Likes">YouTube Likes</option>
            <option value="YouTube Subscribers">YouTube Subscribers</option>
            <option value="YouTube Comment Likes">YouTube Comment Likes</option>
            <option value="Instagram Likes">Instagram Likes</option>
            <option value="Instagram Followers">Instagram Followers</option>
            <option value="Instagram Views">Instagram Views</option>
            <option value="TikTok Followers">TikTok Followers</option>
            <option value="TikTok Views">TikTok Views</option>
            <option value="TikTok Likes">TikTok Likes</option>
            <option value="Telegram Post Views">Telegram Post Views</option>
            <option value="Telegram Members/Subscribers">Telegram Members/Subscribers</option>
            <option value="Telegram Post Shares">Telegram Post Shares</option>
            <option value="Twitter Impressions">Twitter Impressions</option>
            <option value="Twitter Followers">Twitter Followers</option>
            <option value="Twitter Likes">Twitter Likes</option>
            <option value="Twitter Retweets">Twitter Retweets</option>
            <option value="Twitter Custom Comments">Twitter Custom Comments</option>
            <option value="Twitch Followers">Twitch Followers</option>
            <option value="Twitch Clip Views USA">Twitch Clip Views USA</option>
            <option value="Twitch Live Stream Viewers 30 Minutes">Twitch Live Stream Viewers 30 Minutes</option>
            <option value="Facebook Post Likes">Facebook Post Likes</option>
            <option value="Facebook Page Likes">Facebook Page Likes</option>
            <option value="Facebook Page Followers">Facebook Page Followers</option>
            <option value="Facebook Video Views">Facebook Video Views</option>
            <option value="Facebook Live Stream Viewers 60 Minutes">Facebook Live Stream Viewers 60 Minutes</option>
            <option value="Facebook Profile Followers">Facebook Profile Followers</option>
            <option value="SoundCloud Plays">SoundCloud Plays</option>
            <option value="SoundCloud Likes USA">SoundCloud Likes USA</option>
            <option value="SoundCloud Followers">SoundCloud Followers</option>
            <option value="SoundCloud Reposts">SoundCloud Reposts</option>
            <option value="SoundCloud Followers USA">SoundCloud Followers USA</option>
            <option value="SoundCloud Custom Comments">SoundCloud Custom Comments</option>
            <option value="Spotify Followers">Spotify Followers</option>
            <option value="Spotify Playlist Likes">Spotify Playlist Likes</option>
            <option value="Spotify Saves">Spotify Saves</option>
            <option value="Spotify Add To Playlists">Spotify Add To Playlists</option>
            <option value="Spotify Saves USA">Spotify Saves USA</option>
            <option value="Reddit Post Upvotes">Reddit Post Upvotes</option>
            <option value="Reddit Post Views">Reddit Post Views</option>
            <option value="Reddit Post Shares">Reddit Post Shares</option>
            <option value="Reddit Channel Members">Reddit Channel Members</option>
            <option value="Quora Upvotes">Quora Upvotes</option>
            <option value="Quora Shares">Quora Shares</option>
            <option value="Quora Upvotes">Quora Upvotes</option>
            <option value="Quora Shares">Quora Shares</option>
            <option value="Pinterest Followers">Pinterest Followers</option>
            <option value="Pinterest Repins">Pinterest Repins</option>
            <option value="Vimeo Views">Vimeo Views</option>
            <option value="Vimeo Likes">Vimeo Likes</option>
            <option value="Vimeo Followers">Vimeo Followers</option>
            <option value="Threads Followers">Threads Followers</option>
            <option value="Threads Likes">Threads Likes</option>
            <option value="Threads Verified Random Replies">Threads Verified Random Replies</option>
            <option value="Audiomack Plays USA">Audiomack Plays USA</option>
            <option value="Audiomack Plays">Audiomack Plays</option>
            <option value="Audiomack Likes">Audiomack Likes</option>
            <option value="WhatsApp Channel Followers/Members">WhatsApp Channel Followers/Members</option>
            <option value="Rumble Views">Rumble Views</option>
            <option value="CHZZK Video Views South Korea">CHZZK Video Views South Korea</option>
            <!-- Ajoute lòt tip de sèvis isit la -->
        </select>
        <br><br>
        <label for="quantity">Kantite:</label>
        <input type="number" id="quantity" name="quantity">
        <br><br>
        <input type="hidden" id="price-per-thousand" name="price_per_thousand" value="0">
        <input type="hidden" id="totalPriceInput" name="total_price" value="0">

        <label for="url">add yourURL:</label>
        <input type="text" id="url" name="url" placeholder="ad your link here">
        <button type="submit">Pay Amount</button>

        <button type="button" onclick="calculatePrice()">Kalkile Pri</button>
        
    </form>
</div>

{{-- <button type="submit" onclick="payAmount()">Pay Amount</button> --}}
</div>
<script>
   function calculatePrice() {
    var service = document.getElementById("service").value;
    var quantity = document.getElementById("quantity").value;
    var pricePerThousand = calculatePricePerThousand(service);
    var totalPrice = (quantity / 1000) * pricePerThousand;

    document.getElementById("total-quantity").innerText = "Kantite: " + quantity;
    document.getElementById("total-price").innerText = "Pri: $" + totalPrice.toFixed(2);

    // Mettre la valeur dans l'input hidden
    document.getElementById("totalPriceInput").value = totalPrice.toFixed(2);

    // Afficher le total sur le bouton
    document.getElementById("pay-button").innerText = "Pay Amount: $" + totalPrice.toFixed(2);

    // Soumettre le formulaire
    document.getElementById("marketing-form").submit();
}

    function calculatePricePerThousand(service) {
        var prices = {
            "Views GeoTarget": 8,
            "Live Stream Viewers 15 Minutes": 8,
            "Comment Likes": 8,
            "Custom Comments": 8,
            "Watch Time Hours": 8,
            "Live Stream Viewers 90 Minutes": 8,
            "Live Stream Viewers 6 Hours": 8,
            "Shorts Likes": 8,
            "Views from AdWords Campaign": 8,
            "Views from Native Ads": 8,
            "Random Emoji Comments": 8,
            "Social Shares": 8,
            "Social Shares US": 8,
            "Live Stream Viewers 10 Minutes": 8,
            "Live Stream Viewers 30 Minutes": 8,
            "Live Stream Viewers 60 Minutes": 8,
            "YouTube Views": 7,
            "YouTube Likes": 4,
            "YouTube Subscribers": 13,
            "YouTube Comment Likes": 5,
            "Instagram Likes": 1,
            "Instagram Followers": 6,
            "Instagram Views": 1.5,
            "TikTok Views": 1.5,
            "TikTok Followers": 8,
            "TikTok Likes": 8,
            "Telegram Post Views": 0.8,
            "Telegram Post Shares": 2,
            "Twitter Impressions": 0.8,
            "Twitter Followers": 35,
            "Twitter Likes": 17,
            "Twitter Retweets": 20,
            "Twitch Followers": 3,
            "Twitch Clip Views USA": 13,
            "Twitch Live Stream Viewers 30 Minutes": 34,
            "Facebook Post Likes": 15,
            "Facebook Page Likes": 5,
            "Facebook Page Followers": 6,
            "Facebook Video Views": 2.5,
            "Facebook Live Stream Viewers 60 Minutes": 20,
            "Facebook Profile Followers":10,
            "SoundCloud Plays": 1,
            "SoundCloud Likes USA": 6,
            "SoundCloud Likes ": 12,
            "SoundCloud Reposts": 6,
            "SoundCloud Followers USA": 8,
            "SoundCloud Followers ": 5,
            "SoundCloud Custom Comments": 110,
            "Spotify Followers": 5,
            "Spotify Playlist Likes": 8,
            "Spotify Saves": 8,
            "Spotify Add To Playlists": 5,
            "Spotify Saves USA": 8,
            "Spotify Saves": 5,
            "Reddit Post Upvotes": 45,
            "Reddit Post Views": 5,
            "Reddit Channel Members": 12,
            "Quora Upvotes": 18,
            "Quora Shares": 24,
            "Pinterest Followers": 18,
            "Vimeo Views": 6,
            "Vimeo Likes": 26,
            "Vimeo Followers": 21,
            "Threads Followers": 15,
            "Threads Likes": 16,
            "Threads Verified Random Replies": 650,
            "Audiomack Plays USA": 12,
            "Audiomack Plays": 4,
            "Audiomack Likes": 10,
            "WhatsApp Channel Followers/Members": 8,
            "Rumble Views": 17,
            "CHZZK Video Views South Korea": 7,
            // Ajoute lòt pri yo isit la
        };
        return prices[service];
    }

    function payAmount() {
        // Fonksyon sa pral rete menm jan
        var totalPrice = parseFloat(document.getElementById("total-price").innerText.split("$")[1]);
        document.getElementById("pay-button").innerText = "Pay Amount: $" + totalPrice.toFixed(2);
    }
</script>

@include('layouts.usermenu')
</x-app-layout>

