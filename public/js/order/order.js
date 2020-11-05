let produk
let titleProduk = document.getElementById('title-nama-produk')
let imageContainer = document.getElementById('image-container')
let imageIndicators = document.getElementById('image-indicators')
let setUkuran = document.getElementById('ukuran')

const fetchProduk = async () => {
    let res = await fetch(`${baseURL}/api/produk?id=${id_produk}`)
    res = await res.json()
    produk = res
    console.log(produk)
    titleProduk.innerText = produk.produk.nama_produk
    setProductExample()
    setUkuranProduk()
    Swal.close()

}

const setUkuranProduk = () => {
    produk.ukuran.forEach(uk => {
        setUkuran.innerHTML += `<option harga="${uk.harga}" value="${uk.id}">${uk.ukuran} | Rp.${uk.harga}/pcs</option>`
    })

}

const setProductExample = () => {
    produk.gambar.forEach((img,i) => {
        let div = document.createElement('div')
        div.classList.add('carousel-item')
        i === 0 ? div.classList.add('active') : null
        div.innerHTML = `
        <img class="d-block w-100" width="420px" src="/image/produk/${img.gambar}" alt="First slide">`
        imageContainer.append(div)
    })
    let content = ''
    produk.gambar.forEach((img,i) => {
        content += `<li data-target="#ProdukExample" data-slide-to="${i}" class="${i === 0 ? 'active' : null}"></li>`
    })
    imageIndicators.innerHTML = content
}

fetchProduk()