var input = document.getElementById('searchtxtbox').addEventListener('keyup',function(e){
    if (e.keyCode == 13) {
        RunSearchQuery();
    }
})

function RunSearchQuery() {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var formattedData = JSON.parse(this.responseText);
            printJsonToCards(formattedData);

        }
    };

    searchquery = document.getElementById("searchtxtbox").value;
    xhttp.open("GET", "../php/index.php?q=" + searchquery, true);
    xhttp.send();
}

function printACard(trackTitle, artistTitle, downloadLink, albumCover) {
    
    document.getElementById("cardsContainer").innerHTML =
        `${document.getElementById("cardsContainer").innerHTML} \
        <article class="card"> \
            <img class="cardImg" src="${albumCover}" alt="album cover" height="200px" width="200px"> \
            <div class="cardText"> \
                <h3 class="cardTitle">${trackTitle}</h3> \
                <p class="cardArtist">${artistTitle}</p> \
                <button class="cardButton">Play</button> \
                <button class="cardButton" onclick="window.open(value)" value="${downloadLink}">Download</button> \
            </div> \
        </article>`

}

function printJsonToCards(jsonData) {

    document.getElementById("cardsContainer").innerHTML = "";

    for (i = 0; i < jsonData.length; i++) {
        var tt = jsonData[i].trackTitle;
        var at = jsonData[i].artistTitle;
        var dl = jsonData[i].downloadLink;
        var ac = jsonData[i].albumCover;

        if (!ac) {
            ac = "../img/nocover.png";
        }

        tt = tt.substring(0, 15);
        at = at.substring(0, 15);

        printACard(tt, at, dl, ac);

    }

}
