let order = {
    dataDiri: {
        nama: null,
        telp: null,
        email: null,
        alamat: {
            provinsi: null,
            kabupaten: null,
            kecamatan: null,
            kelurahan: null,
            kodePOS: null
        },
        alamat_lengkap: null
    },
    order: {
        id_produk: null,
        nama_produk: null,
        id_ukuran: null,
        jumlah: null,
        materi: null,
        harga:null,
    },
    keterangan:{
        warna: null,
        sablon_warna: null,
    }
}
let designFile = []

let harga = 0


let nama = document.getElementById('nama')
let telp = document.getElementById('telp')
let email = document.getElementById('email')
let provinsi = document.getElementById('provinsi')
let kabupaten = document.getElementById('kabupaten')
let kecamatan = document.getElementById('kecamatan')
let kelurahan = document.getElementById('kelurahan')
let kodePOS = document.getElementById('kode-pos')
let ukuran = document.getElementById('ukuran')
let warna = document.getElementById('warna')
let sablon = document.getElementById('sablon')
let jumlah = document.getElementById('jumlah')
let materi = document.getElementById('materi')
let design = document.getElementById('design')
let designLabel = document.getElementById('design-label')
let designInput = document.getElementById('design-input')
let materiInput = document.getElementById('materi-design-input')
let noDesignRadio = document.getElementById('no-design')
let haveDesignRadio = document.getElementById('have-design')
let subTotal = document.getElementById('sub-total')
let pajak = document.getElementById('pajak')
let total = document.getElementById('total')
let submit = document.getElementById('submit')

const setOrderData = () => {
    order.dataDiri.nama = nama.value
    order.dataDiri.telp = telp.value
    order.dataDiri.email = email.value
    order.dataDiri.alamat.provinsi = provinsi.options[provinsi.selectedIndex].text
    order.dataDiri.alamat.kabupaten = kabupaten.options[kabupaten.selectedIndex].text
    order.dataDiri.alamat.kecamatan = kecamatan.options[kecamatan.selectedIndex].text
    order.dataDiri.alamat.kelurahan = kelurahan.options[kelurahan.selectedIndex].text
    order.dataDiri.alamat.kodePOS = kodePOS.value
    order.order.nama_produk = document.getElementById('title-nama-produk').innerText
    order.order.id_produk = id_produk
    order.keterangan.warna = warna.value
    order.order.id_ukuran = ukuran.value
    order.order.jumlah = jumlah.value
    order.order.materi = materi.value
    order.keterangan.sablon_warna = sablon.value
    order.order.harga = harga
    order.dataDiri.alamat_lengkap = Object.values(order.dataDiri.alamat).join(', ')

    let orderJSON = JSON.stringify(order)
    console.log(orderJSON)
    sendOrder(orderJSON)

}

const sendOrder = async (data) => {
    showLoading()
    let res = await fetch(`${baseURL}/api/pesanan/create`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: data
    })

    res = await res.json()
    console.log(res)
    Swal.close()
    res.isValid ? responseAlert('Permintaan Pesanan Anda Berhasil Dikirim, Silahkan cek email anda',res.isValid) : responseAlert(res,res.isValid)

}

const responseAlert = async (msg, cond = false) => {
    let message
    cond ? message = msg : message = Object.values(msg.errors).join(' | ')
   await Swal.fire({
        icon: cond ? 'success' : 'error',
        title: cond ? 'Success' : 'Oops...',
        text: message
    })

    cond ? window.location.replace(`${baseURL}/order`) : null
}

noDesignRadio.addEventListener('change', () => {
    designInput.style.display = 'none'
    materiInput.style.display = ''
    designFile = []
    designLabel.innerText = 'Pilih File'
})

haveDesignRadio.addEventListener('change', () => {
    designInput.style.display = ''
    materiInput.style.display = 'none'

})

ukuran.addEventListener('change',(e) => {
    harga = e.target.options[e.target.selectedIndex].getAttribute('harga')
    harga = parseInt(harga)
})

design.addEventListener('change', (e) => {
    designFile.push(e.target.files[0])
    designLabel.innerText = designFile.map(design => design.name).join(', ')
})

submit.disabled = true

jumlah.addEventListener('keyup', (e) => {
    e.target.value >= 100 ? submit.disabled = false : submit.disabled = true
    subTotal.innerText = `Rp.${(e.target.value * harga)}`
    total.innerText = subTotal.innerText

})


submit.addEventListener('click', (e) => {
    e.preventDefault()
    setOrderData()

})