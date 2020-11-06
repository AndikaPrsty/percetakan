Swal.close()

const baseURL = window.location.origin

let email = document.getElementById('email')
let kodePesanan = document.getElementById('kode-pesanan')


const responseAlert = (msg, cond = false) => {
    let message
    cond ? message = msg : message = Object.values(msg.errors).join(' | ')
    Swal.fire({
        icon: cond ? 'success' : 'error',
        title: cond ? 'Success' : 'Oops...',
        text: message
    })
}


const cekPesanan = async () => {
    let data = {
        email: email.value,
        kodePesanan: kodePesanan.value
    }

    data = JSON.stringify(data)

    let res = await fetch(`${baseURL}/api/pesanan/cek_pesanan`, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: "POST",
        body:data
    })

    res = await res.json()
    console.log(res)
    res.isValid ?     window.location.replace(`${baseURL}/order/detail?orderId=${res.id_pesanan[0].id}`)
    : responseAlert('Email atau Kode Pesanan yang anda masukan salah',res.isValid)


}

submit.addEventListener('click',(e) => {
    e.preventDefault()
    cekPesanan()
})