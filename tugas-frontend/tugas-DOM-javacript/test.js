function naikAngkot(arrPenumpang) {
    // Rute yang tersedia
    const rute = ['A', 'B', 'C', 'D', 'E', 'F'];
    const tarifPerRute = 2000;
    let hasil = [];

    for (let i = 0; i < arrPenumpang.length; i++) {
        let penumpang = arrPenumpang[i];
        let nama = penumpang[0];
        let naikDari = penumpang[1];
        let tujuan = penumpang[2];


        let indexNaikDari = rute.indexOf(naikDari);
        let indexTujuan = rute.indexOf(tujuan);
        let jumlahRute = indexTujuan - indexNaikDari;
        let biaya = jumlahRute * tarifPerRute;

        let arrPenumpang = {
            penumpang: nama,
            naikDari: naikDari,
            tujuan: tujuan,
            bayar: biaya
        };

        hasil.push(arrPenumpang);
    }

    return hasil;
}

console.log(naikAngkot([
    ['Dimitri', 'B', 'F'],
    ['Icha', 'A', 'B']
]));
