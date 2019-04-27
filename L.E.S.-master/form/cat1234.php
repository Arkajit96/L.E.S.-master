<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
} else {
    header("Location: ../homepage/login");
    exit;
}

?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>form</title>
        <link rel="stylesheet" href="../globalStyle.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="popPanel">
            <div id="popup">
                <p class="warning">This survey consists of 6 short questions. Your honest feedback is highly valued!</p>
                <p class="warning">But first, since this survey is about your class experience, only proceed if you were in class today?</p>
                <p class="warning">(Be honest; there is no penalty for saying no).</p>
                <div id="buttonPane">
                    <button type="button" id="popupButton" onclick="agreePopup(0), unblur(0)">Agree</button>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
        <div class="blur">
            <div class="headPanel">
                <div id="logoBox">
                    <img class="logo" src="../source/logo.png" alt="university_of_pittsburgh_logo">
                    <h1 id="pageName">L.E.S.</h1>
                </div>
                <div id="centerBox">
                    <div id="center">
                        <h2 id="courseName">Introduction to Psychology</h2>
                        <h2 id="name">Professor Schunn</h2>
                    </div>
                </div>
                <div id="rightBox">
                    <div id="right">
                        <h5 id="rightText">04/01/2019</h5>                        
                    </div>
                </div>
            </div>
            <div class="bodyPanel">
                <form id="form" action="submission" method="POST">
                    <input id="qCount" name="qCount" type="hidden" value="">
                    <div class="question">
                        <h2 class="qTitle">At the start of class, the instructor provided...</h2>
                        <div>
                            <input type="radio" name="q1" value="1" id="q1a1">
                            <label for="q1a1">no outline or preview - they immediately launched into lecture</label>
                        </div>
                        <div>
                            <input type="radio" name="q1" value="2" id="q1a2">
                            <label for="q1a2">an outline or preview, but it did not explain the relevance of the lecture to the
                                course or psychology overall</label>
                        </div>
                        <div>
                            <input type="radio" name="q1" value="3" id="q1a3">
                            <label for="q1a3">a short preview of topics or goals that raised my interest in the lecture</label>
                        </div>
                    </div>
                    <div class="question">
                        <h2 class="qTitle">At the start of class, the instructor...</h2>
                        <div>
                            <input type="radio" name="q2" value="1" id="q2a1">
                            <label for="q2a1">did no review at all; jumped straight into new material</label>
                        </div>
                        <div>
                            <input type="radio" name="q2" value="2" id="q2a2">
                            <label for="q2a2">mentioned previous class material without explanation</label>
                        </div>
                        <div>
                            <input type="radio" name="q2" value="3" id="q2a3">
                            <label for="q2a3">gave of a brief explanation of concepts from the last lecture</label>
                        </div>
                        <div>
                            <input type="radio" name="q2" value="4" id="q2a4">
                            <label for="q2a4">gave a short review of things that came up in a few prior lectures and that led
                                naturally into the lecture</label>
                        </div>
                    </div>
                    <div class="question">
                        <h2 class="qTitle">Across the different topics we covered today, the instructor provided...</h2>
                        <div>
                            <input type="radio" name="q3" value="1" id="q3a1">
                            <label for="q3a1">no summary or transition when moving from topic to topic</label>
                        </div>
                        <div>
                            <input type="radio" name="q3" value="2" id="q3a2">
                            <label for="q3a2">a summary or transition, but it was confusing or too long</label>
                        </div>
                        <div>
                            <input type="radio" name="q3" value="3" id="q3a3">
                            <label for="q3a3">a short, clear summary of each topic before moving on</label>
                        </div>
                    </div>
                    <div class="question">
                        <h2 class="qTitle">In class today...</h2>
                        <div>
                            <input type="radio" name="q4" value="1" id="q4a1">
                            <label for="q4a1">there were no new psychology terms introduced in class today</label>
                        </div>
                        <div>
                            <input type="radio" name="q4" value="2" id="q4a2">
                            <label for="q4a2">new psychology terms were used but not defined</label>
                        </div>
                        <div>
                            <input type="radio" name="q4" value="3" id="q4a3">
                            <label for="q4a3">only a few of the new terms were defined</label>
                        </div>
                        <div>
                            <input type="radio" name="q4" value="4" id="q4a4">
                            <label for="q4a4">new terms were defined but the definitions were hard to understand</label>
                        </div>
                        <div>
                            <input type="radio" name="q4" value="5" id="q4a5">
                            <label for="q4a5">new terms were well defined but too many at once or too far from when we first applied
                                the terms</label>
                        </div>
                        <div>
                            <input type="radio" name="q4" value="6" id="q4a6">
                            <label for="q4a6">all terms are well defined and the definitions came just when the concepts were being
                                first applied</label>
                        </div>
                    </div>
                    <div class="question">
                        <h2 class="qTitle">Today in class, my instructor (check all that apply)...</h2>
                        <div>
                            <input type="checkbox" name="q7[]" value="1" id="q7a1">
                            <label for="q7a1">never asked us to questions to see if we understood or answered questions from
                                students</label>
                        </div>
                        <div>
                            <input type="checkbox" name="q7[]" value="2" id="q7a2">
                            <label for="q7a2">checked once to see if we understood and answered students questions</label>
                        </div>
                        <div>
                            <input type="checkbox" name="q7[]" value="3" id="q7a3">
                            <label for="q7a3">asked us questions multiple times</label>
                        </div>
                        <div>
                            <input type="checkbox" name="q7[]" value="4" id="q7a4">
                            <label for="q7a4">used ideas from student answers to questions as part of the lecture</label>
                        </div>
                        <input type="hidden" name="q7[]" value="0" id="q7a0" disabled>
                    </div>
                    <p id="error">(Please select an option!)</p>
                    <div id="buttonPane">
                        <button type="button" id="previousButton" onclick="pageChange(-1)" disabled>Previous</button>
                        <button type="button" id="nextButton" onclick="pageChange(1)" disabled>Next</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>