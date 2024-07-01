if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

function disableButtons() {
    window.document.getElementById("Submit").disabled = true;
    window.document.getElementById("Reset").disabled = true;
}

function toggleButtons(neededinputs) {
    let inputs = window.document.getElementsByClassName("textbar");
    let filledinputs = 0;
    let validinputs = false;

    for (let input of inputs) {
        if (input.value !== "") {
            filledinputs++;
        }
        if (filledinputs >= neededinputs) {
            validinputs = true;
            break;
        }
    }
    
    if (validinputs) {
        window.document.getElementById("Submit").disabled = false;
        window.document.getElementById("Reset").disabled = false;
        return true;
    } else {
        window.document.getElementById("Submit").disabled = true;
        window.document.getElementById("Reset").disabled = true;
        return false;
    }
}

function enableButtons(neededinputs) {
    let inputs = window.document.getElementsByClassName("textbar");
    // let vitalinput = window.document.getElementById("vital");
    let filledinputs = 0;
    let validinputs = false;

    for (let input of inputs) {
        if (input.value !== "") {
            filledinputs++;
        }
        if (filledinputs >= neededinputs) {
            validinputs = true;
            break;
        }
    }

    if (validinputs && (inputs.namedItem("ID").value !== "")) {
        window.document.getElementById("Submit").disabled = false;
        window.document.getElementById("Reset").disabled = false;
        return true;
    } else {
        window.document.getElementById("Submit").disabled = true;
        window.document.getElementById("Reset").disabled = true;
        return false;
    }
}

function checkInputs(validform) {
    if (validform) {
        window.document.getElementById("webform").submit();
    } else {
        window.alert("Error! The form was not filled correctly! Try again.");
    }
}

function goToURL(link) {
    window.location.href = link;
}
