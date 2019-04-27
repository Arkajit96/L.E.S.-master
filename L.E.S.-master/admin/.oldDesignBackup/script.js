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