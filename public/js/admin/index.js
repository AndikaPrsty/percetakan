const baseURL = window.location.origin
let pesanan = []

let tabelPesananMasuk = document.getElementById('tabel-pesanan-masuk')



const fetchPesanan = async () => {
    let res = await fetch(`${baseURL}/api/pesanan`)
    res = await res.json()
    pesanan = res
    console.log(res)
    !res.isValid ? null : null
    pesanan ? setPesananMasuk() : null
    Swal.close()
}

const setPesananMasuk = () => {
    pesanan.forEach(order => {
        let tr  = document.createElement('tr')
        tr.innerHTML = `<td>${order.nomor_pesanan}</td>
        <td>${order.produk[0].nama_produk}</td>
        <td>${order.ukuran[0].ukuran}</td>
        <td>${order.jumlah}</td>
        <td>${order.tanggal_pesan}</td>
        <td><span class="badge badge-info">${order.status}</span></td>
        <td><a href="${baseURL}/admin/home/order_detail?orderId=${order.id}" class="btn btn-info btn-sm">lihat detail pesanan</a></td>`
        tabelPesananMasuk.append(tr)
    })

}


fetchPesanan()