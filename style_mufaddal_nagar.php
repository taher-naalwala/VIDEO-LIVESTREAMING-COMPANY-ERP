<html>
<style>
    /* make sidebar nav vertical */
    @media (min-width: 768px) {
        #dashboard {
            margin-left: 90px;
        }

        #maincard {
            width: 300px;
            height: 300px;
        }

        #innercard {
            width: 250px;
            height: 150px;
        }


        .nav-item {
            margin-left: 20px;
        }


        #first_card {
            margin-left: 10px;
        }

        #last_card {
            margin-right: 10px;
        }

        #forms {
            margin-left: 10px;
            width: 50%;
            margin: 0 auto;
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
        }

        #report_forms {
            margin-left: 10px;
            width: 70%;
            margin: 0 auto;
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
        }
    }

    .show-read-more .more-text {
        display: none;
    }

    .card-header {
        background-color: #52658F;
        color: white
    }



    body {
        background-color: #EFEFEF
    }
</style>


<?php

?>

<nav class="navbar sticky-top navbar-expand-lg" style="background-color: #000033;">
    <b> <a class="navbar-brand" href="#" style="color: #FFF;">Relay</a></b>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span><img src="photos/menu-toggler.png" /></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
           


        </ul>
        <?php

        
        echo "<br><div style='color:#FFF' class='text-right'><a class='card-header' href='logout_mufaddal_nagar.php'>LogOut</a></div><br>";
        ?>
    </div>
</nav>


</div>
</nav>


</html>