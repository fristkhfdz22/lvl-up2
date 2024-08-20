
    function initMap() {
        var location = { lat: -6.8605, lng: 109.1197 }; // Ganti dengan koordinat lokasi restoran kamu
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location,
            mapTypeId: 'roadmap'
        });
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }


    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.menu-item').forEach(item => {
            const qtyInput = item.querySelector('.menu-qty');
            const qty = parseInt(qtyInput.value, 10) || 0;
            const price = parseFloat(item.querySelector('.menu-price').value) || 0;
            total += qty * price;
        });
        document.getElementById('totalCost').innerText = total.toFixed(2);
    }
    
    function placeOrder() {
        // Implement your order placement logic here
        alert('Pesanan Anda telah dibuat!');
    
        // Reset all quantity inputs to 0
        document.querySelectorAll('.menu-qty').forEach(input => {
            input.value = 0;
        });
    
        // Reset total cost
        document.getElementById('totalCost').innerText = '0.00';
    
        // Optionally, you can also clear any other related order state or UI elements here
    }function placeOrder() {
        // Menampilkan notifikasi
        const notification = document.getElementById('notification');
        notification.style.display = 'block';
    
        // Menetapkan waktu delay sebelum menyembunyikan notifikasi
        setTimeout(() => {
            closeNotification();
        }, 4000); // 4 detik delay
    
        // Reset semua input kuantitas ke 0
        document.querySelectorAll('.menu-qty').forEach(input => {
            input.value = 0;
        });
    
        // Reset total cost
        document.getElementById('totalCost').innerText = '0.00';
    }
    
    function closeNotification() {
        // Menyembunyikan notifikasi
        document.getElementById('notification').style.display = 'none';
    }
    