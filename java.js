
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
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah pengiriman formulir default
    
        var formData = new FormData(this);
    
        fetch('submit_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            var formMessage = document.getElementById('formMessage');
            formMessage.innerHTML = data;
            formMessage.classList.remove('error', 'hide');
            formMessage.classList.add('success', 'show');
            setTimeout(() => {
                formMessage.classList.remove('show');
                formMessage.classList.add('hide');
            }, 3000); // Menghilangkan pesan setelah 3 detik
            // Mengosongkan formulir
            document.getElementById('contactForm').reset();
        })
        .catch(error => {
            console.error('Error:', error);
            var formMessage = document.getElementById('formMessage');
            formMessage.innerHTML = '<p>Terjadi kesalahan. Silakan coba lagi nanti.</p>';
            formMessage.classList.remove('success', 'hide');
            formMessage.classList.add('error', 'show');
            setTimeout(() => {
                formMessage.classList.remove('show');
                formMessage.classList.add('hide');
            }, 3000); // Menghilangkan pesan setelah 3 detik
        });
    });
    