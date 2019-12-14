var firstEle = document.getElementById("first");
var secondEle = document.getElementById("second");
var thirdEle = document.getElementById("third");

function preference(){
    // alert(first.value);
    // alert(second.value);
    // alert(third.value);
    var first = firstEle.value;
    var second = secondEle.value;
    var third = thirdEle.value;
    var valid = checkChoices(first, second, third);
    if (!valid) alert("Sorry you have made duplicated choices. Please make sure your three choices are distinct.");
    else {
        document.getElementById("valid").value = 1;
        alert("Your preference has been recorded successfully!");
        window.location.href = "preference.php?valid=" + valid + "&first=" + first + "&second=" + second + "&third=" + third;
    }
}


function checkChoices(first, second, third){
    if (first == second || first == third || second == third) return false;
    return true;
}


