const re = /\[([^\[]*)\]\((.*)\)/;

window.onload = () => {
    for (let i=0; i<items.length; i++) {
        myMatch = items[i].match(re);
        if (myMatch != null && myMatch.length == 3) {
            console.log('text: ' + myMatch[1]);
            console.log('url: ' + myMatch[2]);
        }
    }
};