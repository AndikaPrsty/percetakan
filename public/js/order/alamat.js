const baseURL = window.location.origin
const urlParams = new URLSearchParams(window.location.search);
const id_produk = urlParams.get('id_produk');
let alamat = {
    provinsi,
    kabupaten,
    kecamatan,
    kelurahan
}
let provinsiForm = document.getElementById('provinsi')
let kabupatenForm = document.getElementById('kabupaten')
let kecamatanForm = document.getElementById('kecamatan')
let kelurahanForm = document.getElementById('kelurahan')


const showLoading = () => {
    Swal.fire({
        allowOutsideClick: false
    })
    Swal.showLoading()
}
const fetchProvinsi = async () => {
    let res = await fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi')
    res = await res.json()
    alamat.provinsi = res.provinsi
    setProvinsi()
}

const setKabupaten = async (id_provinsi) => {
    kabupatenForm.innerHTML = '<option value="">Kabupaten</option>'
    kecamatanForm.innerHTML = null
    kelurahanForm.innerHTML = null
    let res = await fetch(`https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${id_provinsi}`)
    res = await res.json()
    alamat.kabupaten = res.kota_kabupaten
    alamat.kabupaten.forEach(kab => {
        kabupatenForm.innerHTML += `<option value="${kab.id}">${kab.nama}</option>`
    })

}

const setKecamatan = async (id_kota) => {
    kecamatanForm.innerHTML = '<option value="">Kecamatan</option>'
    let res = await fetch(`http://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${id_kota}`)
    res = await res.json()
    alamat.kecamatan = res.kecamatan
    alamat.kecamatan.forEach(kec => {
        kecamatanForm.innerHTML += `<option value="${kec.id}">${kec.nama}</option>`
    })
}

const setKelurahan = async (id_kecamatan) => {
    kelurahanForm.innerHTML = '<option value="">Kelurahan</option>'
    let res = await fetch(`http://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${id_kecamatan}`)
    res = await res.json()
    alamat.kelurahan = res.kelurahan
    alamat.kelurahan.forEach(kel => {
        kelurahanForm.innerHTML += `<option value="${kel.id}">${kel.nama}</option>`
    })
}

const setProvinsi = () => {
    provinsiForm.innerHTML = `<option value="">Provinsi</option>`
    alamat.provinsi.forEach(prov => {
        provinsiForm.innerHTML += `<option value="${prov.id}">${prov.nama}</option>`
    })
}

provinsiForm.addEventListener('change',(e) => {
    setKabupaten(e.target.value)
})

kabupatenForm.addEventListener('change',(e) => {
    console.log('kabupaten')
    setKecamatan(e.target.value)
})

kecamatanForm.addEventListener('change',(e) => {
    setKelurahan(e.target.value)
})

fetchProvinsi()
