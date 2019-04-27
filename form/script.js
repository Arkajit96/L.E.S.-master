var currentQuestion = 0;
var popup = 1;
var blur = 1;
var qCount = (document.getElementsByClassName("question").length);
document.getElementById("qCount").value = qCount;
showQuestion(currentQuestion);
setTimeout(function () {showPopup(popup); showBlur(blur);}, 600);

function showPopup(n) {
    if (n == 0) {
        document.getElementById("popPanel").style.visibility = "hidden";
        document.getElementById("nextButton").disabled = false;
        document.getElementById("previousButton").disabled = false;
    } else {
        document.getElementById("popPanel").style.visibility = "visible";
    }
}

function agreePopup(n) {
    popup = n;
    showPopup(n);
}

function showBlur(n) {
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

function unblur(n) {
    blur = n;
    showBlur(n);
}

function showQuestion(n) {
    var x = document.getElementsByClassName("question");
    x[n].style.display = "block";
    
    if (n == 0) {
        document.getElementById("previousButton").style.display = "none";
    } else {
        document.getElementById("previousButton").style.display = "inline-block";
    }

    if (n == (x.length - 1)) {
        document.getElementById("nextButton").innerHTML = "Submit";
/*      document.getElementById("nextButton").setAttribute('type', 'submit');*/
    } else {
        document.getElementById("nextButton").innerHTML = "Next";
    }
}

function pageChange(n) {
    document.getElementById("error").style.visibility = "hidden";
    var x = document.getElementsByClassName("question");
    x[currentQuestion].style.display = "none";
    if (n == 1) {
        checkSelection();
        if (checkSelection() == true) {
            currentQuestion = currentQuestion + n;
            if (currentQuestion >= x.length) {
                document.getElementById("form").submit();
                return false;
            }
        } else {
            document.getElementById("error").style.visibility = "visible";
        }
    } else {
        currentQuestion = currentQuestion + n;
    }
    showQuestion(currentQuestion);
}

function checkSelection() {
    var question = document.getElementsByClassName("question");
    var currentInputs = question[currentQuestion].getElementsByTagName("input");
/*
    var array = [];
    for (var z = 0; z < currentInputs.length; z++) {
        array.push(currentInputs[z].value);
    }
    var test = array.join(', ');
    window.alert(test);
*/
    var proceed = false;
    if (currentInputs[0].type == "radio") {
        for (var idx = 0; idx < currentInputs.length; idx++) {
            if (currentInputs[idx].checked) {
                proceed = true;
            }
        }
    } else if (currentInputs[0].type == "checkbox") {        
        for (var idx = 0; idx < (currentInputs.length - 1); idx++) {
            if (currentInputs[idx].checked) {
                proceed = true;
            }
        }
        if (proceed == false) {
            currentInputs[currentInputs.length - 1].disabled = false;
            proceed = true;
        }
    } else {
    }
    return proceed;
}