var firstEle = document.getElementById("first");
var secondEle = document.getElementById("second");
var thirdEle = document.getElementById("third");
// var regfirstnameEle = document.getElementById("regfirstname");
// var reglastnameEle = document.getElementById("reglastname");
// var regemailEle = document.getElementById("regemail");
// var regareaEle = document.getElementById("regarea");
// var regroleEle = document.getElementById("regrole");

function preference(){
    var first = firstEle.value;
    var second = secondEle.value;
    var third = thirdEle.value;
    // alert(first);
    // alert(second);
    // alert(third);
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


// function selectFirstChoice(choice){
//     alert(choice);
//     document.getElementById("firstchoice").value = choice;
// }


// function selectSecondChoice(choice){
//     document.getElementById("secondchoice").value = choice;
// }


// function selectThirdChoice(choice){
//     document.getElementById("thirdchoice").value = choice;
// }


function newuser(){
    alert("function");
    var firstname = regfirstnameEle.value;
    var lastname = reglastnameEle.value;
    var email = regemailEle.value;
    var area = regareaEle.value;
    var role = regroleEle.value;
    window.location.href = "index.php";
    // window.location.href = "add_user.php?firstname=" + firstname + "&lastname=" + lastname + "&email=" + email + "&area=" + area + "&role=" + role;
}


function select(){
    var first = firstEle.value;
    var second = secondEle.value;
    var third = thirdEle.value;
    // alert(first);
    // alert(second);
    // alert(third);
    var valid = checkChoices(first, second, third);
    if (!valid) alert("Sorry you have made duplicated choices. Please make sure your three choices are distinct.");
    else {
        document.getElementById("valid").value = 1;
        alert("Your preference has been recorded successfully!");
        window.location.href = "preference.php?valid=" + valid + "&first=" + first + "&second=" + second + "&third=" + third;
    }
    // alert(firstEle.selectedIndex);
}

