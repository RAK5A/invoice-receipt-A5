function searchTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toUpperCase();
    const tableId = input.getAttribute('data-search-table');
    const table = document.getElementById(tableId);

    if (!table) {
        console.error(`Table with ID "${tableId}" not found`);
        return;
    }

    const tbody = table.querySelector('tbody');
    if (!tbody) return;

    const tr = tbody.getElementsByTagName('tr');

    for (let i = 0; i < tr.length; i++) {
        let txtValue = tr[i].textContent || tr[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
        } else {
            tr[i].style.display = 'none';
        }
    }
}

// function searchTable(tableId) {
//     const input = document.getElementById("searchInput");
//     const filter = input.value.toUpperCase();
//     const table = document.getElementById(tableId);

//     if (!table) {
//         console.error(`Table with ID "${tableId}" not found`);
//         return;
//     }

//     const tr = table.getElementsByTagName("tr");

//     for (let i = 1; i < tr.length; i++) {
//         let txtValue = tr[i].textContent || tr[i].innerText;
//         if (txtValue.toUpperCase().indexOf(filter) > -1) {
//             tr[i].style.display = "";
//         } else {
//             tr[i].style.display = "none";
//         }
//     }
// }isplay = "none";
//         }
//     }
// }