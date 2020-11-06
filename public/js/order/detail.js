moment.locale('id')
const urlParams = new URLSearchParams(window.location.search);
const id_pesanan = urlParams.get('orderId');
const baseURL = window.location.origin

let pesanan

let timeline = document.getElementById('timeline')
let nomorPesanan  = document.getElementById('nomor-pesanan')
let kodePesanan = document.getElementById('kode-pesanan')
let tabelPesanan = document.getElementById('tabel-pesanan')
let jumlah = document.getElementById('jumlah')
let nama_produk = document.getElementById('nama_produk')
let ukuran = document.getElementById('ukuran')
let keterangan = document.getElementById('keterangan')
let design = document.getElementById('design')
let materi = document.getElementById('materi')
let total = document.getElementById('total')

const responseAlert = async (msg, cond = false) => {
    let message
  await  Swal.fire({
        icon: cond ? 'info' : 'error',
        title: cond ? '' : 'Oops...',
        text: msg
    })
}

const fetchPesanan = async () => {
    let res = await fetch(`${baseURL}/api/pesanan?orderId=${id_pesanan}`)
    res = await res.json()
    console.log(res)
    pesanan = res[0]
    res.isValid == false ? responseAlert('Pesanan tidak ditemukan',false) : null
    pesanan.status_bayar === 'belum' ? await responseAlert('Mohon Segera Melakukan Pembayaran Agar Pesanan Anda Segera Diproses',true) :null
    setLogPesanan()
    setPesanan()
    Swal.close()

}

const setPesanan = () => {
    nomorPesanan.innerText = pesanan.nomor_pesanan
    kodePesanan.innerText = pesanan.kode_pesanan
    jumlah.innerHTML = pesanan.jumlah
    nama_produk.innerText = pesanan.produk[0].nama_produk
    ukuran.innerText = pesanan.ukuran[0].ukuran
    keterangan.innerText = pesanan.keterangan
    materi.innerText = pesanan.materi
    total.innerText = `Rp.${pesanan.total_harga}`
}

const setLogPesanan = () => {
    pesanan.log.forEach((log,i) => {

        timeline.innerHTML += `
        <div class="time-label">
         
        </div>
        <div>
            <i class="fas fa-info bg-blue"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>${moment(log.created_at).fromNow()}</span>
                <h3 class="timeline-header">Sistem</h3>

                <div class="timeline-body">
                    ${log.log}
                </div>
            </div>
        </div>
`
    })
}



fetchPesanan()