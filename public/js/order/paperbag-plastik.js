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
        alamat_lengkap:null
    },
    order: {
        id_produk: null,
        nama_produk: null,
        ukuran: null,
        warna: null,
        jumlah: null,
        sablon_warna: null,
        materi: null
    }
}
let designFile = []


let nama = document.getElementById('nama')
let telp = document.getElementById('telp')
let email = document.getElementById('email')
let provinsi = document.getElementById('provinsi')
let kabupaten = document.getElementById('kabupaten')
let kecamatan = document.getElementById('kecamatan')
let kelurahan = document.getElementById('kelurahan')
let kodePOS = document.getElementById('kode-pos')
let ukuran = document.getElementById('ukuran')
let ukuranCustom = document.getElementById('ukuran-custom')
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
    order.order.warna = warna.value
    order.order.ukuran = ukuranCustom.value === '' ? ukuran.value : ukuranCustom.value 
    order.order.jumlah = jumlah.value
    order.order.materi = materi.value
    order.order.sablon_warna = sablon.value
    order.dataDiri.alamat_lengkap = Object.values(order.dataDiri.alamat).join(', ')

    let orderJSON = JSON.stringify(order)
    console.log(orderJSON)
    // sendOrder(orderJSON)

}

const sendOrder = async (data) => {
    let res = await fetch(`${baseURL}/api/pesanan/create`,{
        method:"POST",
        headers:{
            "Content-Type":"application/json"
        },
        body:data
    })

    res = await res.json()
    console.log(res)
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
    e.target.value == 'custom' ? document.getElementById('ukuranCustomInput').style.display = null : document.getElementById('ukuranCustomInput').style.display = 'none'
    ukuranCustom.value = ''
})

design.addEventListener('change',(e) => {
    designFile.push(e.target.files[0])
    designLabel.innerText = designFile.map(design => design.name).join(', ')
})

submit.addEventListener('click', (e) => {
    e.preventDefault()
    setOrderData()

})