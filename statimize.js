const re = /\[([^\[]*)\]\((.*)\)/;

window.onload = () => {
    // for...
    let myMatch = items[0].match(re);
    console.log(myMatch);
    if (myMatch.length === 3) {
        console.log('text: ' + myMatch[1]);
        console.log('url: ' + myMatch[2]);
    }
};