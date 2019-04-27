document.getElementById("uploadCSV").addEventListener("change", upload, false);

function openTab(input) {
    var x, tabContent;
    tabs = document.getElementsByClassName("tabs");
    tabContent = document.getElementsByClassName("tabContent");
    for (x = 0; x < tabContent.length; x++) {
        if (tabContent[x].id == input) {
            tabContent[x].style.visibility = "visible";
            tabs[x].style.color = "rgb(251, 200, 57)"
        } else {
            tabContent[x].style.visibility = "hidden";
            tabs[x].style.color = "rgb(255, 255, 255)"
        }
    }
}

function showPopup(n) {
    if (n == 0) {
        document.getElementById("popPanel").style.visibility = "hidden";
    } else {
        document.getElementById("popPanel").style.visibility = "visible";
    }
    if (n == 0) {
        document.getElementsByClassName("blur")[0].setAttribute("style", "-webkit-filter: blur(0)");
        document.getElementsByClassName("blur")[0].setAttribute("style", "-moz-filter: blur(0)");
        document.getElementsByClassName("blur")[0].setAttribute("style", "-o-filter: blur(0)");
        document.getElementsByClassName("blur")[0].setAttribute("style", "-ms-filter: blur(0)");
        document.getElementsByClassName("blur")[0].style.filter = "blur(0)";
        document.getElementsByClassName("overlay")[0].style.visibility = "hidden";
    } else {
        document.getElementsByClassName("blur")[0].setAttribute("style", "-webkit-filter: blur(2px)");
        document.getElementsByClassName("blur")[0].setAttribute("style", "-moz-filter: blur(2px)");
        document.getElementsByClassName("blur")[0].setAttribute("style", "-o-filter: blur(2px)");
        document.getElementsByClassName("blur")[0].setAttribute("style", "-ms-filter: blur(2px)");
        document.getElementsByClassName("blur")[0].style.filter = "blur(2px)";
        document.getElementsByClassName("overlay")[0].style.visibility = "visible";
    }
}

function newEval(calledId) {
    var id = calledId.id;

}

function createNew(n) {
//    document.getElementById("popup").innerHTML = "<h1>Loading...</h1>";
    $.get(
        "../new/new_form.php",
//        { procedure: "1" },
        function (data) {
            var result = data;
            document.getElementById("popup").innerHTML = result;
        }
    );
}

function upload(element) {
    var file = element.target.files[0];

    var reader = new FileReader();
    reader.readAsText(file);
    reader.onload = function (event) {
        var csvData = event.target.result;

        var parsedCSV = d3.csv.parseRows(csvData);

        parsedCSV.forEach(function (d, i) {
            if (i == 0) return true; // skip the header
            if(d.constructor === Array){
                // console.log(d);
                // document.getElementById(d[0]).value = d[1];
                createForm(d);
                }
        });
    }
   }