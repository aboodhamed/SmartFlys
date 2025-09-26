function initializeModals() {
       document.querySelectorAll('.show-hall').forEach(btn => {
           btn.removeEventListener('click', showModalHandler);
           btn.addEventListener('click', showModalHandler);
       });
   }

   async function showModalHandler() {
       const hallId = this.dataset.hallId;
       try {
           const response = await fetch(`/my-halls/${hallId}/modal`, {
               headers: { 'X-Requested-With': 'XMLHttpRequest' }
           });
           if (!response.ok) throw new Error('Network error');
           const data = await response.text();
           const modalContainer = document.createElement('div');
           modalContainer.innerHTML = data;
           document.body.appendChild(modalContainer);
           modalContainer.querySelector('#close-modal-btn').addEventListener('click', () => {
               modalContainer.remove();
           });
       } catch (error) {
           console.error('Error loading modal:', error);
           alert('حدث خطأ أثناء تحميل التفاصيل.');
       }
   }

   document.querySelectorAll('[data-action="accept"]').forEach(btn => {
       btn.addEventListener('click', async () => {
           const bookingId = btn.dataset.id;
           try {
               const response = await fetch(`/my-halls/bookings/${bookingId}/accept`, {
                   method: 'POST',
                   headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'X-Requested-With': 'XMLHttpRequest' }
               });
               const data = await response.json();
               alert(data.message);
               location.reload();
           } catch (error) {
               console.error('Error accepting booking:', error);
               alert('حدث خطأ أثناء قبول الحجز.');
           }
       });
   });

   document.querySelectorAll('[data-action="reject"]').forEach(btn => {
       btn.addEventListener('click', async () => {
           const bookingId = btn.dataset.id;
           try {
               const response = await fetch(`/my-halls/bookings/${bookingId}/reject`, {
                   method: 'POST',
                   headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'X-Requested-With': 'XMLHttpRequest' }
               });
               const data = await response.json();
               alert(data.message);
               location.reload();
           } catch (error) {
               console.error('Error rejecting booking:', error);
               alert('حدث خطأ أثناء رفض الحجز.');
           }
       });
   });

   document.querySelectorAll('[data-action="cancel"]').forEach(btn => {
       btn.addEventListener('click', async () => {
           const bookingId = btn.dataset.id;
           try {
               const response = await fetch(`/my-halls/bookings/${bookingId}/cancel`, {
                   method: 'POST',
                   headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'X-Requested-With': 'XMLHttpRequest' }
               });
               const data = await response.json();
               alert(data.message);
               location.reload();
           } catch (error) {
               console.error('Error cancelling booking:', error);
               alert('حدث خطأ أثناء إلغاء الحجز.');
           }
       });
   });

   document.querySelectorAll('[data-action="show-dates"]').forEach(btn => {
       btn.addEventListener('click', async () => {
           const bookingId = btn.dataset.id;
           try {
               const response = await fetch(`/my-halls/bookings/${bookingId}/dates`, {
                   headers: { 'X-Requested-With': 'XMLHttpRequest' }
               });
               const data = await response.json();
               const datesList = document.querySelector('#course-dates_list');
               datesList.innerHTML = data.dates.map(date => `<li>${date}</li>`).join('');
               const modal = document.querySelector('#course-dates-modal');
               modal.classList.remove('hidden');
               modal.querySelector('#close-modal').addEventListener('click', () => {
                   modal.classList.add('hidden');
               });
           } catch (error) {
               console.error('Error loading course dates:', error);
               alert('حدث خطأ أثناء تحميل تواريخ الدورة.');
           }
       });
   });

   document.addEventListener('DOMContentLoaded', initializeModals);