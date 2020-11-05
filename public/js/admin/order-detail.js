Swal.close()
const baseURL = window.location.origin
const urlParams = new URLSearchParams(window.location.search);
const id_pesanan = urlParams.get('orderId');

let pesanan

let nomorPesananLabel = document.getElementById('nomor-pesanan-label')
let nama = document.getElementById('nama')
let provinsiKabupaten = document.getElementById('provinsi-kabupaten')
let kecamatanKelurahanKodePost = document.getElementById('kecamatan-kelurahan-kodepos')
let telp = document.getElementById('telp')
let email = document.getElementById('email')
let nomorPesanan  = document.getElementById('nomor-pesanan')
let kodePesanan = document.getElementById('kode-pesanan')
let tabelPesanan = document.getElementById('tabel-pesanan')
let design = document.getElementById('design')
let materi = document.getElementById('materi')


const fetchPesanan = async () => {
    let res  = await fetch(`${baseURL}/api/pesanan?orderId=${id_pesanan}`)
    res = await res.json()
    pesanan = res[0]
    console.log(pesanan)
    setPesanan()
}

const setPesanan = () => {
    nama.innerText = pesanan.pembeli[0].nama
    nomorPesananLabel.innerText = pesanan.nomor_pesanan
    provinsiKabupaten.innerText = `${pesanan.alamat[0].provinsi}, ${pesanan.alamat[0].kabupaten}`
    kecamatanKelurahanKodePost.innerText = `${pesanan.alamat[0].kecamatan}, ${pesanan.alamat[0].kelurahan}, ${pesanan.alamat[0].kode_pos}`
    telp.innerText = pesanan.pembeli[0].no_telp
    email.innerText = pesanan.pembeli[0].email
    nomorPesanan.innerText = pesanan.nomor_pesanan
    kodePesanan.innerText = pesanan.kode_pesanan
}

fetchPesanan()