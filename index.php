<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta http-equiv="refresh" content="5"> dodala sam da se stranica osvezava na svakih 5 sekundi -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Projekat</title>
    <link rel="icon" type="image/x-icon" href="img2/favicon.png">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div>

        <header>

            <div id="demo" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>
               
                <?php
                    $images = ["img2/10.jpg", "img2/11.jpg", "img2/12.jpg", "img2/13.jpg", "img2/14.jpg", "img2/15.jpg", "img2/16.jpg", "img2/17.jpg", "img2/18.jpg", "img2/19.jpg"];
                    shuffle($images);
                ?>
                <div class="carousel-inner">
                <?php for($i = 0; $i < 3; $i++) { ?>
                    <div class="carousel-item <?php if($i == 0) { echo 'active'; } ?>">
                        <img src="<?php echo $images[$i]; ?>" alt="Slideshow Image width="1100" height="300"">
                    </div>
                <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

        </header>

    </div>

    <div>
        <nav class="navbar navbar-expand-sm navbar-light">
            <a class="navbar-brand" href="#">
                <img style="width:30px;" src="img2/sun.png" alt="Sunce">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?kategorija=posao">Posao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?kategorija=zdravlje">Zdravlje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?kategorija=ljubav">Ljubav</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?kategorija=motivacija">Motivacija</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div>
        <section>
            <?php

                if (isset($_GET['kategorija'])) // pomocu isset proveravamo da li postoji parametar kategorija u URL-u.
                //$_GET je jedan od PHP superglobalnih asocijativnih nizova, koji se koristi za prikupljanje podataka koje korisnik salje putem URL-a ili HTTP GET metodom. Ovaj niz sadrži ključ-vrednost parove podataka koje korisnik prosleđuje iz HTML forme ili URL-a, a pristupa se mu se preko ključeva (naziva) koje korisnik definiše. Na primer, ako korisnik prosledi vrednost preko URL-a http://primer.com/?ime=John&prezime=Doe, tada se ta vrednost može dobiti u PHP kodu koristeći $_GET superglobalni niz sa ključevima ime i prezime.
                {
                    
                    $kategorija = $_GET['kategorija']; // ako postoji cita se vrednost parametra
                    //echo "$kategorija";
                    switch ($kategorija)
                    {
                        case "posao":
                            $file = __DIR__ . "/posao.txt";
                            break;
                        case "zdravlje":
                            $file = __DIR__ . "/zdravlje.txt";
                            break;
                        case "ljubav":
                            $file = __DIR__ . "/ljubav.txt";
                            break;
                        case "motivacija":
                            $file = __DIR__ . "/motivacija.txt";
                            break;
                        default:
                            echo "Greska";
                            break;
                    }
                    
                    $redovi = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $broj_redova = count($redovi);

                    $random_broj = rand(0, $broj_redova / 2 - 1); //Bira se slucajan broj izmedju 0 i broja koji predstavlja polovinu broja linija u fajlu. Ovo je zato sto svaki citat ima svog autora, pa ce broj linija u fajlu biti dva puta veci od broja citata. Kad podelimo br linija sa 2 dobijamo broj citata. U ovom slucaju, -1 se koristi zato sto $broj_redova predstavlja ukupan broj linija u fajlu, a mi zelimo broj citata. Svakom citatu u datoteci odgovara dva reda - jedan za sam citat i drugi za autora. Broj citata u datoteci je polovina od ukupnog broja linija, ali posto indeksi u PHP-u počinju od 0, pa ako zelimo da poslednji indeks bude ispravan, moramo da oduzmemo 1 od broja citata.
                    $citat = trim($redovi[$random_broj * 2]); //trim() funkcija se koristi za uklanjanje belih prostora na pocetku i kraju stringa koji predstavlja citat. Prvo se nasumicno generise broj izmedju 0 i ($broj_redova / 2 - 1), a zatim se taj broj mnozi sa 2 jer su citati zapisani u svakom drugom redu.
                    $autor = trim($redovi[$random_broj * 2 + 1]); 

                    echo $citat . '<br>';
                    echo $autor . '<br>';
                }

                else 
                {
                    $citati = ['posao.txt', 'zdravlje.txt', 'ljubav.txt', 'motivacija.txt'];
                    $file = __DIR__ . '/' . $citati[array_rand($citati)];

                    $redovi = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $broj_redova = count($redovi);

                    $random_broj = rand(0, $broj_redova / 2 - 1); 
                    $citat = trim($redovi[$random_broj * 2]); 
                    $autor = trim($redovi[$random_broj * 2 + 1]); 
                    echo $citat . '<br>';
                    echo $autor . '<br>';
                }

            ?>
        </section>
    </div>

    <div class="slike">
        <figure>
            <img style="width: 200px;" src="img/8.jpg" alt="Believe in your dreams">
            <figcaption>Please smile! &#128522;</figcaption>
        </figure>
        <figure>
            <img style="width: 200px;" src="img/4.jpg" alt="Believe in your dreams">
            <figcaption>You can! &#128077;</figcaption>
        </figure>
        <figure>
            <img style="width: 200px;" src="img/3.jpg" alt="Believe in your dreams">
            <figcaption>Believe in your dreams! &#128525;</figcaption>
        </figure>
        <figure>
            <img style="width: 200px;" src="img/5.jpg" alt="Believe in your dreams">
            <figcaption>Love yourself! &#128156;</figcaption>
        </figure>
        <figure>
            <img style="width: 200px;" src="img/2.jpg" alt="Believe in your dreams">
            <figcaption>Positive life! &#127749;</figcaption>
        </figure>
        <figure>
            <img style="width: 200px;" src="img/10.jpg" alt="Believe in your dreams">
            <figcaption>Elephants love! &#128024;</figcaption>
        </figure>

    </div>

<div class="container">
    <div class="row">
        <div class="anketa" class="col-6">
            <p style="font-size:20px; padding-bottom:10px;"><b>Odaberite ljubavni citat koji Vam se najviše dopada:<br></b></p>
            <form action="anketa.php" method="post">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="1">
                    <label class="form-check-label">"Ljubav je igra koju može igrati dvoje, a da oboje pobede."</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="2">
                    <label class="form-check-label">"Čovek samo srcem dobro vidi. Suština se očima ne da sagledati."</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="3">
                    <label class="form-check-label">"Vreme koje si uložio oko svoje ruže čini tu ružu tako dragocenom."</label>
                </div>
                <button type="submit" class="btn btn-info">Glasaj</button>
            </form>
        </div>
        <div class="anketa" class="col-6">
            <p style="font-size:20px; padding-bottom:10px;"><b>Odaberite poslovni citat koji Vam se najviše dopada:<br></b></p>
            <form action="anketa.php" method="post">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="1">
                    <label class="form-check-label">"Usredsredite se na mogućnosti za uspeh, a ne na potencijal za neuspeh. "</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="2">
                    <label class="form-check-label">"Ne morate biti bolji od drugih, budite samo najbolji što možete."</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="3">
                    <label class="form-check-label">"Nemojte pokušavati biti samo uspešna osoba nego i osoba od vrednosti."</label>
                </div>
                <button type="submit" class="btn  btn-info">Glasaj</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="anketa" class="col-sm-6">
            <p style="font-size:20px; padding-bottom:10px;"><b>Odaberite motivacioni citat koji Vam se najviše dopada:<br></b></p>
            <form action="anketa.php" method="post">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="1">
                    <label class="form-check-label">"Kreativan čovek motivisan je željom da postigne, a ne željom da pobedi druge."</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="2">
                    <label class="form-check-label">"Ciljaj ka Mesecu. I ako promašiš, možda ćeš da pogodiš zvezdu."</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="citat" value="3">
                    <label class="form-check-label">"Ne postoji osoba koja nije sposobna da uradi više od onoga što misli da može."</label>
                </div>
                <button type="submit" class="btn btn-info">Glasaj</button>
            </form>
        </div>
        <div class="anketa" class="col-sm-6">
            <p style="font-size:20px; padding-bottom:10px;"><b>Odaberite citat o zdravlju koji Vam se najviše dopada:<br></b></p>
            <form action="anketa.php" method="post">
                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" name="citat" value="1">
                    <label class="form-check-label">"Koristite svaku priliku za smeh. To je najjeftiniji lek."</label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" name="citat" value="2">
                    <label class="form-check-label">"Svaka prekomernost se suprotstavlja Prirodi."</label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" name="citat" value="3">
                    <label class="form-check-label">"Veselo srce – pola zdravlja."</label>
                </div>
                <button type="submit" class="btn  btn-info">Glasaj</button>
            </form>
        </div>
    </div>
</div>

    <div>
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php date_default_timezone_set('Europe/Belgrade'); ?>
                        <p><b><?php echo date('d.m.Y.'); ?></b></p>
                        <p><b><?php echo date('H:i:s'); ?></b></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>

