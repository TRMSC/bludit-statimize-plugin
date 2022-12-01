showNavbar = () => {
    let show = document.getElementsByClassName("navbar-nav")[0];
    show.style.opacity = 1;
};

removeEntries = (item) => {
    let bin = document.getElementsByClassName("nav-link");
    for (let i=0; i<bin.length; i++) {
        if (bin[i].text == item) {
            bin[i].parentElement.style.display = "none";
        }
    }
};