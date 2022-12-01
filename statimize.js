removeEntries = (item) => {
    let bin = document.getElementsByClassName("nav-link");
    for (let i=0; i<bin.length; i++) {
        if (bin[i].text == item) {
            bin[i].parentElement.style.display = "none";
        }
    }
}

/*
    let bin = document.getElementsByClassName("nav-link");
    for (let i=0; i<bin.length; i++) {
        if (bin[i].text == $this.getValue("concealItems")) {
            bin[i].parentElement.style.display = "none";
        }
    }
*/