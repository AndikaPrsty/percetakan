const baseURL = window.location.origin
let tableKategori = document.getElementById('table-kategori')
let kategori
let nomor = 1


const navLink = document.getElementById('nav-link-masterdata')
const KategoriLink = document.getElementById('kategori-link')
navLink.parentElement.classList.add('menu-open')
navLink.classList.add('active')
KategoriLink.classList.add('active')


const fetchKategori = async () => {
    let res = await fetch(`${baseURL}/api/kategori`)
    res = await res.json()
    kategori = res.kategori
    console.log(kategori)
    setKategori()
    Swal.close()
}

const setKategori = () => {
    let tbody = tableKategori.getElementsByTagName('tbody')
    tbody = [].slice.call(tbody)
    tbody = tbody[0]
    kategori.map(ktg => {
        let tr = document.createElement('tr')
        tr.innerHTML = `
        <tr>
            <td>${nomor}</td>
            <td>${ktg.nama_kategori}</td>
            <td><a href="${baseURL}/admin/kategori/edit?id=${ktg.id}" class="btn btn-sm btn-info"><i class="fas fa-edit mr-1"></i>edit</a></td>
        </tr>`
        tbody.append(tr)
        nomor++
    })

}
fetchKategori()
