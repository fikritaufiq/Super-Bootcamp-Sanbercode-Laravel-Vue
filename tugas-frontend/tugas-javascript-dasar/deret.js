function bintangpagar(angka) {
    for (let i = 1; i <= angka; i++) {
        let kolom = "";
        for (let j = 1; j <= i; j++) {
            if (j % 2 === 1) {
                kolom += "* ";
            } else {
                kolom += "# ";
            }
        }
        console.log(kolom);
    }
}

bintangpagar(3);
console.log('           ')
bintangpagar(5);