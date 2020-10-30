let baseURL = window.location.origin
let table = document.getElementById('table-produk')
let tableBody = table.getElementsByTagName('tbody')
let tableFilter = document.getElementById('table-filter')
let filterSelect = document.getElementById('filter-select')
let tambahProduk = document.getElementById('tambah_produk')
let produk
let kategori
let nomor = 1


const fetchProduk = async () => {
    let res = await fetch(`${baseURL}/api/produk`)
    res = await res.json()
    produk = res
    fetchKategori()
    setProduk()
    Swal.close()
}

const fetchKategori = async () => {
    let res = await fetch(`${baseURL}/api/kategori`)
    res = await res.json()
    kategori = res.kategori
    setKategori()
}

fetchProduk()

const setProduk = () => {
    produk.forEach(produk => {
        let content =''
        let tr = document.createElement('tr')
        content += `<td>${nomor}</td>
        <td>${produk.nama_produk}</td>
        <td>${produk.nama_kategori}</td>
        <td><span class="badge badge-success">Approved</span></td>
        <td><a href="${baseURL}/admin/produk/edit?id=${produk.id}" class="btn btn-info"><i class="fas fa-eye mr-1"></i>Detail</a>
        </td>`
        nomor++
        tr.innerHTML = content
        let tableBodyArray =  [].slice.call(tableBody)
        tableBodyArray[0].append(tr)
    })
}

const setKategori = () => {
    kategori.forEach(ktg => {
        filterSelect.innerHTML += `<option value="${ktg.nama_kategori}">${ktg.nama_kategori}</option>`
    })
}

tableFilter.addEventListener('keyup',(e) => {
    let filter = e.target.value.toUpperCase()
    let tr = tableBody[0].getElementsByTagName('tr')
    let trArray = [].slice.call(tr)
    let td
    let textValue
    trArray.forEach(tr => {
        td1 = tr.getElementsByTagName('td')[1]
        td2 = tr.getElementsByTagName('td')[2]
        if(td1){
            textValue1 = td1.textContent.toUpperCase() || td1.innerText.toUpperCase()
            textValue2 = td2.textContent.toUpperCase() || td2.innerText.toUpperCase()
            if(textValue1.indexOf(filter) > -1 || textValue2.indexOf(filter) > -1){
                tr.style.display = ''
            } else {
                tr.style.display = 'none'
            }
        }
    })
})
filterSelect.addEventListener('change', (e) => {
    let filter = e.target.value.toUpperCase()
    let tr = tableBody[0].getElementsByTagName('tr')
    let trArray = [].slice.call(tr)
    let td
    let textValue
    trArray.forEach(tr => {
        td1 = tr.getElementsByTagName('td')[1]
        td2 = tr.getElementsByTagName('td')[2]
        if(td1){
            textValue1 = td1.textContent.toUpperCase() || td1.innerText.toUpperCase()
            textValue2 = td2.textContent.toUpperCase() || td2.innerText.toUpperCase()
            if(textValue1.indexOf(filter) > -1 || textValue2.indexOf(filter) > -1){
                tr.style.display = ''
            } else {
                tr.style.display = 'none'
            }
        }
    })
})
tambahProduk.addEventListener('click',() => {
    window.location.replace(`${baseURL}/admin/produk/tambah`)
})