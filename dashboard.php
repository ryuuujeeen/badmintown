<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Badmintown</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen">
    

  <main class="container mx-auto px-4 py-8">
    <section id="booking" class="mb-12">
      <h2 class="text-3xl font-bold mb-6 text-center">Badmintown</h2>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 class="text-xl font-semibold mb-4">Lapangan Tersedia</h3>
            <div class="space-y-4">
              <div class="court-card bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                <input type="radio" id="lapangan" name="court" value="Bambu Larangan" class="hidden peer" checked>
                <label for="lapangan" class="block peer-checked:bg-blue-50 peer-checked:dark:bg-blue-900 peer-checked:border-blue-300 peer-checked:dark:border-blue-700 p-4 rounded-lg">
                  <div class="flex justify-between items-center">
                    <span class="font-medium">Bambu Larangan</span>
                    <span class="text-blue-600 dark:text-blue-400 font-bold">Rp 50.000 /jam (Weekday), Rp 55.000 /jam (Weekend)</span>
                  </div>
                </label>
              </div>
            </div>
          </div>

          <div>
            <h3 class="text-xl font-semibold mb-4">Rincian Booking</h3>
            <div class="space-y-4">
              <div>
                <label for="date" class="block mb-1">Tanggal</label>
                <input type="date" id="date" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
              </div>
              <div>
                <label for="time" class="block mb-1">Waktu</label>
                <select id="time" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
                  <option value="09:00-11:00">09.00 - 11.00</option>
                  <option value="11:00-13:00">11.00 - 13.00</option>
                  <option value="13:00-15:00">13.00 - 15.00</option>
                  <option value="15:00-17:00">15.00 - 17.00</option>
                  <option value="18:00-20:00">18.00 - 20.00</option>
                  <option value="19:00-21:00">21.00 - 23.00</option>
                </select>
              </div>
              <div>
                <label for="players" class="block mb-1">Jumlah Pemain</label>
                <input type="number" id="players" min="2" max="10" value="4" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
              </div>
              <div>
                <label for="shuttlecockType" class="block mb-1">Pilih Jenis Kok</label>
                <select id="shuttlecockType" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
                  <option value="alpha">Alpha Black - Rp 185.000 / slop</option>
                  <option value="jp">JP - Rp 120.000 / slop</option>
                </select>
              </div>
              <div>
                <label for="shuttlecockQty" class="block mb-1">Jumlah Kok (per buah)</label>
                <input type="number" id="shuttlecockQty" min="0" max="100" value="1" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
              </div>
              <div>
                <label for="aquaQty" class="block mb-1">Aqua (Rp 7.000)</label>
                <input type="number" id="aquaQty" min="0" value="0" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
              </div>
              <div>
                <label for="pocariQty" class="block mb-1">Pocari (Rp 10.000)</label>
                <input type="number" id="pocariQty" min="0" value="0" class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
              </div>
            </div>
          </div>
        </div>

        <div class="mt-8 text-center">
          <button id="bookNow" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transition transform hover:scale-105">
            Hitung Biaya & Konfirmasi
          </button>
        </div>
      </div>
    </section>

    <!-- Modal Konfirmasi Pembayaran -->
    <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg max-w-lg w-full">
        <h3 class="text-xl font-bold mb-4 text-center">Konfirmasi Pembayaran</h3>
        <div id="paymentDetails" class="space-y-2 text-sm"></div>
        <div class="mt-6 flex justify-end space-x-4">
          <button id="cancelPayment" class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-lg">Batal</button>
          <button id="confirmPayment" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold">Konfirmasi</button>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const bookNowBtn = document.getElementById('bookNow');
        const confirmBtn = document.getElementById('confirmPayment');
        const cancelBtn = document.getElementById('cancelPayment');
        const modal = document.getElementById('paymentModal');
        const paymentDetails = document.getElementById('paymentDetails');
        const historyContainer = document.getElementById('historyContainer');
        const clearBtn = document.getElementById('clearHistory');

        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
        document.getElementById('date').min = today;

        loadHistory();

        bookNowBtn.addEventListener('click', () => {
          const date = new Date(document.getElementById('date').value);
          const isWeekend = (date.getDay() === 6 || date.getDay() === 0);
          const courtRate = isWeekend ? 55000 : 50000;
          const hours = 2;
          const courtTotal = courtRate * hours;

          const players = parseInt(document.getElementById('players').value);
          const kokType = document.getElementById('shuttlecockType').value;
          const kokQty = parseInt(document.getElementById('shuttlecockQty').value);
          const kokPrice = kokType === 'alpha' ? 185000 / 12 : 120000 / 12;
          const kokTotal = kokQty * kokPrice;

          const aquaQty = parseInt(document.getElementById('aquaQty').value);
          const pocariQty = parseInt(document.getElementById('pocariQty').value);
          const beverageTotal = aquaQty * 7000 + pocariQty * 10000;

          const subTotal = courtTotal + kokTotal + beverageTotal;
          const perPlayer = Math.ceil(subTotal / players);

          const time = document.getElementById('time').value;
          const booking = {
            date: document.getElementById('date').value,
            time,
            players,
            kokType,
            kokQty,
            kokTotal,
            courtTotal,
            beverageTotal,
            subTotal,
            perPlayer,
            dateBooked: new Date().toISOString()
          };

          confirmBtn.dataset.booking = JSON.stringify(booking);

          paymentDetails.innerHTML = `
            <p><strong>Tanggal:</strong> ${booking.date}</p>
            <p><strong>Waktu:</strong> ${booking.time}</p>
            <p><strong>Jumlah Pemain:</strong> ${players}</p>
            <p><strong>Biaya Lapangan:</strong> Rp ${courtTotal.toLocaleString()}</p>
            <p><strong>Kok (${kokType === 'alpha' ? 'Alpha Black' : 'JP'} - ${kokQty} buah):</strong> Rp ${kokTotal.toLocaleString()}</p>
            <p><strong>Minuman:</strong> Rp ${beverageTotal.toLocaleString()}</p>
            <p class="font-bold mt-2">Total: Rp ${subTotal.toLocaleString()}</p>
            <p class="font-bold">Per Pemain: Rp ${perPlayer.toLocaleString()}</p>
          `;
          modal.classList.remove('hidden');
        });

        confirmBtn.addEventListener('click', () => {
          const booking = JSON.parse(confirmBtn.dataset.booking);
          const history = JSON.parse(localStorage.getItem('bookingHistory')) || [];
          history.push(booking);
          localStorage.setItem('bookingHistory', JSON.stringify(history));
          modal.classList.add('hidden');
          loadHistory();
        });

        cancelBtn.addEventListener('click', () => {
          modal.classList.add('hidden');
        });

        clearBtn.addEventListener('click', () => {
          if (confirm('Hapus semua riwayat booking?')) {
            localStorage.removeItem('bookingHistory');
            loadHistory();
          }
        });

        function loadHistory() {
          const history = JSON.parse(localStorage.getItem('bookingHistory')) || [];
          historyContainer.innerHTML = history.length === 0 ? '<p class="text-gray-500 dark:text-gray-400">Belum ada booking.</p>' :
            history.reverse().map(h => `
              <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                <h3 class="font-bold text-lg mb-1">${h.date} (${h.time})</h3>
                <p>Pemain: ${h.players}</p>
                <p>Lapangan: Rp ${h.courtTotal.toLocaleString()}</p>
                <p>Kok: Rp ${h.kokTotal.toLocaleString()} (${h.kokQty} buah)</p>
                <p>Minuman: Rp ${h.beverageTotal.toLocaleString()}</p>
                <p>Total: Rp ${h.subTotal.toLocaleString()}</p>
                <p class="font-bold">Per Pemain: Rp ${h.perPlayer.toLocaleString()}</p>
                <p class="text-xs text-gray-500 mt-2">Dipesan: ${new Date(h.dateBooked).toLocaleString()}</p>
              </div>
            `).join('');
        }
      });
    </script>

    <section id="history" class="mb-12">
        <h2 class="text-2xl font-bold mb-4 text-center">Riwayat Booking</h2>
        <div class="flex justify-center mb-4">
            <button id="clearHistory" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow">Hapus Riwayat</button>
        </div>
        <div id="historyContainer" class="space-y-4"></div>
    </section>
  </main>
</body>
</html>
