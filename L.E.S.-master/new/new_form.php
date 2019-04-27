<?php
require("../config.php");

class template {
    private $tags = [];
    private $template;

    public function getFile($file) {
        if(file_exists($file)) {
            $file = file_get_contents($file);
            return $file;
        } else {
            return false;
        }
    }

    private function replaceTags() {
        foreach ($this->tags as $tag => $value) {
            $this->template = str_replace("{@".$tag."}", $value, $this->template);
        }
        return true;
    }

    public function set($tag, $value) {
        $this->tags[$tag] = $value;
    }

    public function __construct($templateFile) {
        $this->template = $this->getFile($templateFile);

        if(!$this->template) {
            return "Error! Cannot load the template file $templateFile";
        }
    }

    public function render() {
        $this->replaceTags();
        return $this->template;
    }
}

$query = "SELECT q.`radio/checklist/text`, q.question, q.answer1, q.answer2, q.answer3, q.answer4, q.answer5, q.answer6, q.answer7, q.answer8, q.answer9, q.answer10  FROM questions q;";
$allQuestions = $conn->query($query);
$questionCount = mysqli_num_rows($allQuestions);

$qNum = 1;
while ($row = $allQuestions->fetch_assoc()) {
    $aNum = 1;
    foreach ($row as $key=>$value) {
        if ($key == "radio/checklist/text") {
            $qType = $value;
        } else if ($key == "question") {
            switch ($qType) {
                case 1:
                $q = new template("radio.html");
                break;
                case 2:
                $q = new template("checkbox.html");
                break;
                case 3:
                $q = new template("text.html");
                break;
                default:
                $q = new template("radio.html");
            }
            $q->set("qTitle", $value);
            $q->set("qNum", "q".$qNum);
        } else {
            if ($value != null) {
                switch ($qType) {
                    case 1:
                    $aAppend = new template("radioAnswer.html");
                    break;
                    case 2:
                    $aAppend = new template("checkboxAnswer.html");
                    break;
                    case 3:
                    $aAppend = new template("textAnswer.html");
                    break;
                    default:
                    $aAppend = new template("radioAnswer.html");
                }
                $aAppend->set("qNum", "q".$qNum);
                $aAppend->set("aNum", $aNum);
                $aAppend->set("answer", $value);
                $answer .= ($aAppend->render());
                $aNum++;

            }
        }
    }
    $q->set("answers", $answer);
    unset($answer);
    $insertQuestions .= ($q->render());
    unset($q);
    $qNum++;
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["instructor"]) || empty($_POST["course"])) {
        die(Failed);
    }
}


$date = date("m/d/Y");
$tpl = new template("template.html");
$tpl->set("courseName", "Testology");
$tpl->set("instructorName", "Kenny Wu");
$tpl->set("date", $date);
$tpl->set("questions", $insertQuestions);
//$tpl->set("questions", $tpl->getFile("test.tpl"));
//echo ($tpl->render());



$created = false;
while ($created == false) {
    $animalArray = array("Alpaca", "Ant", "Ape", "Ass", "Avocet", "Baboon", "Badger", "Barb", "Bat", "Beagle", "Bear", "Beaver", "Bee", "Beetle", "Bird", "Birman", "Bison", "Boar", "Bobcat", "Bombay", "Bongo", "Bonobo", "Booby", "Caiman", "Camel", "Cat", "Cattle", "Chough", "Clam", "Coati", "Cobra", "Cod", "Collie", "Coral", "Cougar", "Cow", "Coyote", "Crab", "Crane", "Crow", "Curlew", "Cuscus", "Deer", "Dhole", "Dingo", "Discus", "Dodo", "Dog", "Donkey", "Dove", "Drever", "Duck", "Dugong", "Dunker", "Dunlin", "Eagle", "Earwig", "Eel", "Eland", "Elk", "Emu", "Falcon", "Ferret", "Finch", "Fish", "Fly", "Fossa", "Fox", "Frog", "Galago", "Gar", "Gaur", "Gecko", "Gerbil", "Gibbon", "Gnat", "Gnu", "Goat", "Goose", "Gopher", "Grouse", "Gull", "Guppy", "Hare", "Hawk", "Heron", "Hornet", "Horse", "Human", "Hyena", "Ibis", "Iguana", "Impala", "Indri", "Insect", "Jackal", "Jaguar", "Jay", "Kakapo", "Kiwi", "Koala", "Kudu", "Lark", "Lemur", "Liger", "Lion", "Lizard", "Llama", "Locust", "Loris", "Louse", "Lynx", "Macaw", "Magpie", "Marten", "Mayfly", "Mink", "Mole", "Molly", "Monkey", "Moose", "Moth", "Mouse", "Mule", "Newt", "Numbat", "Ocelot", "Okapi", "Olm", "Oryx", "Otter", "Owl", "Ox", "Oyster", "Parrot", "Pig", "Pigeon", "Pika", "Pike", "Pony", "Poodle", "Possum", "Prawn", "Puffin", "Pug", "Puma", "Quail", "Quelea", "Quokka", "Quoll", "Rabbit", "Rail", "Ram", "Rat", "Raven", "Robin", "Rook", "Ruff", "Salmon", "Saola", "Seal", "Serval", "Shark", "Sheep", "Shrew", "Shrimp", "Skunk", "Sloth", "Snail", "Snake", "Somali", "Spider", "Sponge", "Squid", "Stoat", "Stork", "Swan", "Tang", "Tapir", "Tetra", "Tiger", "Toad", "Toucan", "Trout", "Turkey", "Turtle", "Uakari", "Uguisu", "Vicuña", "Viper", "Walrus", "Wasp", "Weasel", "Whale", "Wolf", "Wombat", "Worm", "Wrasse", "Wren", "Yak", "Zebra", "Zebu", "Zonkey", "Zorse");
    $randAnimal = strtolower($animalArray[array_rand($animalArray)]);
    $randNumber = rand(1,999);
    $randCode = $randAnimal.$randNumber;

    if (!file_exists("../form/".$randCode.".php")) {
        $query = "SELECT f.id FROM forms f WHERE f.code = '$randCode';";
        $checkExist = $conn->query($query);
        $row = mysqli_num_rows($checkExist);
        if ($row > 0) {

        } else {
            $query = "CALL createNewForm('$randCode');";
            $createTable = $conn->query($query);
            if ($createTable == true) {
                $newfile = fopen("../form/".$randCode.".php", "w");
                fwrite ($newfile, $tpl->render());
                fclose($newfile);
                echo ($randCode);
            } else {
            }
            $created = true;
        }
    }
}

?>