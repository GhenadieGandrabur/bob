function attachTableInteractions(tableId, editUrl, deleteUrl) {
   const table = document.getElementById(tableId);
   if (!table) {
     console.error('Table with the specified ID not found');
     return;
   }
 
   // Attach double-click and context menu events to table rows
   const rows = table.querySelectorAll('tr');
   rows.forEach(row => {
     // Double-click event to open the edit page
     row.addEventListener('dblclick', function() {
       const rowId = this.querySelector('td:first-child').textContent;
       window.location.href = `${editUrl}?id=${rowId}`;
     });
 
     // Right-click event to show the custom context menu with Delete option
     row.addEventListener('contextmenu', function(e) {
       e.preventDefault(); // Prevent the default context menu
       // Position and show the custom context menu
       const contextMenu = document.getElementById('contextMenu');
       contextMenu.style.top = `${e.pageY}px`;
       contextMenu.style.left = `${e.pageX}px`;
       contextMenu.style.display = 'block';
 
       // Remember the row for actions
       const rowId = this.querySelector('td:first-child').textContent;
 
       // Handle delete in the context menu
       document.getElementById('deleteRow').onclick = function() {
         if (confirm('Are you sure you want to delete this unit?')) {
           const form = document.createElement('form');
           form.method = 'post';
           form.action = `${deleteUrl}?id=${rowId}`;
           form.innerHTML = `<input type="hidden" name="id" value="${rowId}">`;
           document.body.appendChild(form);
           form.submit();
         }
       };
     });
   });
 
   // Hide the context menu when clicking elsewhere
   document.addEventListener('click', function(e) {
     document.getElementById('contextMenu').style.display = 'none';
   });
 }
 
